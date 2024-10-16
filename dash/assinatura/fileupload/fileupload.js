/*
 * jQuery Iframe Transport Plugin 10.2.0
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2011, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

/* global define, require */

(function(factory) {
  'use strict';
  if (typeof define === 'function' && define.amd) {
    // Register as an anonymous AMD module:
    define(['jquery'], factory);
  } else if (typeof exports === 'object') {
    // Node/CommonJS:
    factory(require('jquery'));
  } else {
    // Browser globals:
    factory(window.jQuery);
  }
})(function($) {
  'use strict';

  // Helper variable to create unique names for the transport iframes:
  var counter = 0,
    jsonAPI = $,
    jsonParse = 'parseJSON';

  if ('JSON' in window && 'parse' in JSON) {
    jsonAPI = JSON;
    jsonParse = 'parse';
  }

  // The iframe transport accepts four additional options:
  // options.fileInput: a jQuery collection of file input fields
  // options.paramName: the parameter name for the file form data,
  //  overrides the name property of the file input field(s),
  //  can be a string or an array of strings.
  // options.formData: an array of objects with name and value properties,
  //  equivalent to the return data of .serializeArray(), e.g.:
  //  [{name: 'a', value: 1}, {name: 'b', value: 2}]
  // options.initialIframeSrc: the URL of the initial iframe src,
  //  by default set to "javascript:false;"
  $.ajaxTransport('iframe', function(options) {
    if (options.async) {
      // javascript:false as initial iframe src
      // prevents warning popups on HTTPS in IE6:
      // eslint-disable-next-line no-script-url
      var initialIframeSrc = options.initialIframeSrc || 'javascript:false;',
        form,
        iframe,
        addParamChar;
      return {
        send: function(_, completeCallback) {
          form = $('<form style="display:none;"></form>');
          form.attr('accept-charset', options.formAcceptCharset);
          addParamChar = /\?/.test(options.url) ? '&' : '?';
          // XDomainRequest only supports GET and POST:
          if (options.type === 'DELETE') {
            options.url = options.url + addParamChar + '_method=DELETE';
            options.type = 'POST';
          } else if (options.type === 'PUT') {
            options.url = options.url + addParamChar + '_method=PUT';
            options.type = 'POST';
          } else if (options.type === 'PATCH') {
            options.url = options.url + addParamChar + '_method=PATCH';
            options.type = 'POST';
          }
          // IE versions below IE8 cannot set the name property of
          // elements that have already been added to the DOM,
          // so we set the name along with the iframe HTML markup:
          counter += 1;
          iframe = $(
            '<iframe src="' +
              initialIframeSrc +
              '" name="iframe-transport-' +
              counter +
              '"></iframe>'
          ).on('load', function() {
            var fileInputClones,
              paramNames = Array.isArray(options.paramName)
                ? options.paramName
                : [options.paramName];
            iframe.off('load').on('load', function() {
              var response;
              // Wrap in a try/catch block to catch exceptions thrown
              // when trying to access cross-domain iframe contents:
              try {
                response = iframe.contents();
                // Google Chrome and Firefox do not throw an
                // exception when calling iframe.contents() on
                // cross-domain requests, so we unify the response:
                if (!response.length || !response[0].firstChild) {
                  throw new Error();
                }
              } catch (e) {
                response = undefined;
              }
              // The complete callback returns the
              // iframe content document as response object:
              completeCallback(200, 'success', { iframe: response });
              // Fix for IE endless progress bar activity bug
              // (happens on form submits to iframe targets):
              $('<iframe src="' + initialIframeSrc + '"></iframe>').appendTo(
                form
              );
              window.setTimeout(function() {
                // Removing the form in a setTimeout call
                // allows Chrome's developer tools to display
                // the response result
                form.remove();
              }, 0);
            });
            form
              .prop('target', iframe.prop('name'))
              .prop('action', options.url)
              .prop('method', options.type);
            if (options.formData) {
              $.each(options.formData, function(index, field) {
                $('<input type="hidden"/>')
                  .prop('name', field.name)
                  .val(field.value)
                  .appendTo(form);
              });
            }
            if (
              options.fileInput &&
              options.fileInput.length &&
              options.type === 'POST'
            ) {
              fileInputClones = options.fileInput.clone();
              // Insert a clone for each file input field:
              options.fileInput.after(function(index) {
                return fileInputClones[index];
              });
              if (options.paramName) {
                options.fileInput.each(function(index) {
                  $(this).prop('name', paramNames[index] || options.paramName);
                });
              }
              // Appending the file input fields to the hidden form
              // removes them from their original location:
              form
                .append(options.fileInput)
                .prop('enctype', 'multipart/form-data')
                // enctype must be set as encoding for IE:
                .prop('encoding', 'multipart/form-data');
              // Remove the HTML5 form attribute from the input(s):
              options.fileInput.removeAttr('form');
            }
            form.trigger('submit');
            // Insert the file input fields at their original location
            // by replacing the clones with the originals:
            if (fileInputClones && fileInputClones.length) {
              options.fileInput.each(function(index, input) {
                var clone = $(fileInputClones[index]);
                // Restore the original name and form properties:
                $(input)
                  .prop('name', clone.prop('name'))
                  .attr('form', clone.attr('form'));
                clone.replaceWith(input);
              });
            }
          });
          form.append(iframe).appendTo(document.body);
        },
        abort: function() {
          if (iframe) {
            // javascript:false as iframe src aborts the request
            // and prevents warning popups on HTTPS in IE6.
            iframe.off('load').prop('src', initialIframeSrc);
          }
          if (form) {
            form.remove();
          }
        }
      };
    }
  });

  // The iframe transport returns the iframe content document as response.
  // The following adds converters from iframe to text, json, html, xml
  // and script.
  // Please note that the Content-Type for JSON responses has to be text/plain
  // or text/html, if the browser doesn't include application/json in the
  // Accept header, else IE will show a download dialog.
  // The Content-Type for XML responses on the other hand has to be always
  // application/xml or text/xml, so IE properly parses the XML response.
  // See also
  // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup#content-type-negotiation
  $.ajaxSetup({
    converters: {
      'iframe text': function(iframe) {
        return iframe && $(iframe[0].body).text();
      },
      'iframe json': function(iframe) {
        return iframe && jsonAPI[jsonParse]($(iframe[0].body).text());
      },
      'iframe html': function(iframe) {
        return iframe && $(iframe[0].body).html();
      },
      'iframe xml': function(iframe) {
        var xmlDoc = iframe && iframe[0];
        return xmlDoc && $.isXMLDoc(xmlDoc)
          ? xmlDoc
          : $.parseXML(
              (xmlDoc.XMLDocument && xmlDoc.XMLDocument.xml) ||
                $(xmlDoc.body).html()
            );
      },
      'iframe script': function(iframe) {
        return iframe && $.globalEval($(iframe[0].body).text());
      }
    }
  });
});

/*
 * jQuery File Upload Plugin 10.2.0
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

/* global define, require */
/* eslint-disable new-cap */

(function(factory) {
  'use strict';
  if (typeof define === 'function' && define.amd) {
    // Register as an anonymous AMD module:
    define(['jquery', 'jquery-ui/ui/widget'], factory);
  } else if (typeof exports === 'object') {
    // Node/CommonJS:
    factory(require('jquery'), require('./vendor/jquery.ui.widget'));
  } else {
    // Browser globals:
    factory(window.jQuery);
  }
})(function($) {
  'use strict';

  // Detect file input support, based on
  // https://viljamis.com/2012/file-upload-support-on-mobile/
  $.support.fileInput = !(
    new RegExp(
      // Handle devices which give false positives for the feature detection:
      '(Android (1\\.[0156]|2\\.[01]))' +
        '|(Windows Phone (OS 7|8\\.0))|(XBLWP)|(ZuneWP)|(WPDesktop)' +
        '|(w(eb)?OSBrowser)|(webOS)' +
        '|(Kindle/(1\\.0|2\\.[05]|3\\.0))'
    ).test(window.navigator.userAgent) ||
    // Feature detection for all other devices:
    $('<input type="file"/>').prop('disabled')
  );

  // The FileReader API is not actually used, but works as feature detection,
  // as some Safari versions (5?) support XHR file uploads via the FormData API,
  // but not non-multipart XHR file uploads.
  // window.XMLHttpRequestUpload is not available on IE10, so we check for
  // window.ProgressEvent instead to detect XHR2 file upload capability:
  $.support.xhrFileUpload = !!(window.ProgressEvent && window.FileReader);
  $.support.xhrFormDataFileUpload = !!window.FormData;

  // Detect support for Blob slicing (required for chunked uploads):
  $.support.blobSlice =
    window.Blob &&
    (Blob.prototype.slice ||
      Blob.prototype.webkitSlice ||
      Blob.prototype.mozSlice);

  /**
   * Helper function to create drag handlers for dragover/dragenter/dragleave
   *
   * @param {string} type Event type
   * @returns {Function} Drag handler
   */
  function getDragHandler(type) {
    var isDragOver = type === 'dragover';
    return function(e) {
      e.dataTransfer = e.originalEvent && e.originalEvent.dataTransfer;
      var dataTransfer = e.dataTransfer;
      if (
        dataTransfer &&
        $.inArray('Files', dataTransfer.types) !== -1 &&
        this._trigger(type, $.Event(type, { delegatedEvent: e })) !== false
      ) {
        e.preventDefault();
        if (isDragOver) {
          dataTransfer.dropEffect = 'copy';
        }
      }
    };
  }

  // The fileupload widget listens for change events on file input fields defined
  // via fileInput setting and paste or drop events of the given dropZone.
  // In addition to the default jQuery Widget methods, the fileupload widget
  // exposes the "add" and "send" methods, to add or directly send files using
  // the fileupload API.
  // By default, files added via file input selection, paste, drag & drop or
  // "add" method are uploaded immediately, but it is possible to override
  // the "add" callback option to queue file uploads.
  $.widget('blueimp.fileupload', {
    options: {
      // The drop target element(s), by the default the complete document.
      // Set to null to disable drag & drop support:
      dropZone: $(document),
      // The paste target element(s), by the default undefined.
      // Set to a DOM node or jQuery object to enable file pasting:
      pasteZone: undefined,
      // The file input field(s), that are listened to for change events.
      // If undefined, it is set to the file input fields inside
      // of the widget element on plugin initialization.
      // Set to null to disable the change listener.
      fileInput: undefined,
      // By default, the file input field is replaced with a clone after
      // each input field change event. This is required for iframe transport
      // queues and allows change events to be fired for the same file
      // selection, but can be disabled by setting the following option to false:
      replaceFileInput: true,
      // The parameter name for the file form data (the request argument name).
      // If undefined or empty, the name property of the file input field is
      // used, or "files[]" if the file input name property is also empty,
      // can be a string or an array of strings:
      paramName: undefined,
      // By default, each file of a selection is uploaded using an individual
      // request for XHR type uploads. Set to false to upload file
      // selections in one request each:
      singleFileUploads: true,
      // To limit the number of files uploaded with one XHR request,
      // set the following option to an integer greater than 0:
      limitMultiFileUploads: undefined,
      // The following option limits the number of files uploaded with one
      // XHR request to keep the request size under or equal to the defined
      // limit in bytes:
      limitMultiFileUploadSize: undefined,
      // Multipart file uploads add a number of bytes to each uploaded file,
      // therefore the following option adds an overhead for each file used
      // in the limitMultiFileUploadSize configuration:
      limitMultiFileUploadSizeOverhead: 512,
      // Set the following option to true to issue all file upload requests
      // in a sequential order:
      sequentialUploads: false,
      // To limit the number of concurrent uploads,
      // set the following option to an integer greater than 0:
      limitConcurrentUploads: undefined,
      // Set the following option to true to force iframe transport uploads:
      forceIframeTransport: false,
      // Set the following option to the location of a redirect url on the
      // origin server, for cross-domain iframe transport uploads:
      redirect: undefined,
      // The parameter name for the redirect url, sent as part of the form
      // data and set to 'redirect' if this option is empty:
      redirectParamName: undefined,
      // Set the following option to the location of a postMessage window,
      // to enable postMessage transport uploads:
      postMessage: undefined,
      // By default, XHR file uploads are sent as multipart/form-data.
      // The iframe transport is always using multipart/form-data.
      // Set to false to enable non-multipart XHR uploads:
      multipart: true,
      // To upload large files in smaller chunks, set the following option
      // to a preferred maximum chunk size. If set to 0, null or undefined,
      // or the browser does not support the required Blob API, files will
      // be uploaded as a whole.
      maxChunkSize: undefined,
      // When a non-multipart upload or a chunked multipart upload has been
      // aborted, this option can be used to resume the upload by setting
      // it to the size of the already uploaded bytes. This option is most
      // useful when modifying the options object inside of the "add" or
      // "send" callbacks, as the options are cloned for each file upload.
      uploadedBytes: undefined,
      // By default, failed (abort or error) file uploads are removed from the
      // global progress calculation. Set the following option to false to
      // prevent recalculating the global progress data:
      recalculateProgress: true,
      // Interval in milliseconds to calculate and trigger progress events:
      progressInterval: 100,
      // Interval in milliseconds to calculate progress bitrate:
      bitrateInterval: 500,
      // By default, uploads are started automatically when adding files:
      autoUpload: true,
      // By default, duplicate file names are expected to be handled on
      // the server-side. If this is not possible (e.g. when uploading
      // files directly to Amazon S3), the following option can be set to
      // an empty object or an object mapping existing filenames, e.g.:
      // { "image.jpg": true, "image (1).jpg": true }
      // If it is set, all files will be uploaded with unique filenames,
      // adding increasing number suffixes if necessary, e.g.:
      // "image (2).jpg"
      uniqueFilenames: undefined,

      // Error and info messages:
      messages: {
        uploadedBytes: 'Uploaded bytes exceed file size'
      },

      // Translation function, gets the message key to be translated
      // and an object with context specific data as arguments:
      i18n: function(message, context) {
        // eslint-disable-next-line no-param-reassign
        message = this.messages[message] || message.toString();
        if (context) {
          $.each(context, function(key, value) {
            // eslint-disable-next-line no-param-reassign
            message = message.replace('{' + key + '}', value);
          });
        }
        return message;
      },

      // Additional form data to be sent along with the file uploads can be set
      // using this option, which accepts an array of objects with name and
      // value properties, a function returning such an array, a FormData
      // object (for XHR file uploads), or a simple object.
      // The form of the first fileInput is given as parameter to the function:
      formData: function(form) {
        return form.serializeArray();
      },

      // The add callback is invoked as soon as files are added to the fileupload
      // widget (via file input selection, drag & drop, paste or add API call).
      // If the singleFileUploads option is enabled, this callback will be
      // called once for each file in the selection for XHR file uploads, else
      // once for each file selection.
      //
      // The upload starts when the submit method is invoked on the data parameter.
      // The data object contains a files property holding the added files
      // and allows you to override plugin options as well as define ajax settings.
      //
      // Listeners for this callback can also be bound the following way:
      // .on('fileuploadadd', func);
      //
      // data.submit() returns a Promise object and allows to attach additional
      // handlers using jQuery's Deferred callbacks:
      // data.submit().done(func).fail(func).always(func);
      add: function(e, data) {
        if (e.isDefaultPrevented()) {
          return false;
        }
        if (
          data.autoUpload ||
          (data.autoUpload !== false &&
            $(this).fileupload('option', 'autoUpload'))
        ) {
          data.process().done(function() {
            data.submit();
          });
        }
      },

      // Other callbacks:

      // Callback for the submit event of each file upload:
      // submit: function (e, data) {}, // .on('fileuploadsubmit', func);

      // Callback for the start of each file upload request:
      // send: function (e, data) {}, // .on('fileuploadsend', func);

      // Callback for successful uploads:
      // done: function (e, data) {}, // .on('fileuploaddone', func);

      // Callback for failed (abort or error) uploads:
      // fail: function (e, data) {}, // .on('fileuploadfail', func);

      // Callback for completed (success, abort or error) requests:
      // always: function (e, data) {}, // .on('fileuploadalways', func);

      // Callback for upload progress events:
      // progress: function (e, data) {}, // .on('fileuploadprogress', func);

      // Callback for global upload progress events:
      // progressall: function (e, data) {}, // .on('fileuploadprogressall', func);

      // Callback for uploads start, equivalent to the global ajaxStart event:
      // start: function (e) {}, // .on('fileuploadstart', func);

      // Callback for uploads stop, equivalent to the global ajaxStop event:
      // stop: function (e) {}, // .on('fileuploadstop', func);

      // Callback for change events of the fileInput(s):
      // change: function (e, data) {}, // .on('fileuploadchange', func);

      // Callback for paste events to the pasteZone(s):
      // paste: function (e, data) {}, // .on('fileuploadpaste', func);

      // Callback for drop events of the dropZone(s):
      // drop: function (e, data) {}, // .on('fileuploaddrop', func);

      // Callback for dragover events of the dropZone(s):
      // dragover: function (e) {}, // .on('fileuploaddragover', func);

      // Callback before the start of each chunk upload request (before form data initialization):
      // chunkbeforesend: function (e, data) {}, // .on('fileuploadchunkbeforesend', func);

      // Callback for the start of each chunk upload request:
      // chunksend: function (e, data) {}, // .on('fileuploadchunksend', func);

      // Callback for successful chunk uploads:
      // chunkdone: function (e, data) {}, // .on('fileuploadchunkdone', func);

      // Callback for failed (abort or error) chunk uploads:
      // chunkfail: function (e, data) {}, // .on('fileuploadchunkfail', func);

      // Callback for completed (success, abort or error) chunk upload requests:
      // chunkalways: function (e, data) {}, // .on('fileuploadchunkalways', func);

      // The plugin options are used as settings object for the ajax calls.
      // The following are jQuery ajax settings required for the file uploads:
      processData: false,
      contentType: false,
      cache: false,
      timeout: 0
    },

    // A list of options that require reinitializing event listeners and/or
    // special initialization code:
    _specialOptions: [
      'fileInput',
      'dropZone',
      'pasteZone',
      'multipart',
      'forceIframeTransport'
    ],

    _blobSlice:
      $.support.blobSlice &&
      function() {
        var slice = this.slice || this.webkitSlice || this.mozSlice;
        return slice.apply(this, arguments);
      },

    _BitrateTimer: function() {
      this.timestamp = Date.now ? Date.now() : new Date().getTime();
      this.loaded = 0;
      this.bitrate = 0;
      this.getBitrate = function(now, loaded, interval) {
        var timeDiff = now - this.timestamp;
        if (!this.bitrate || !interval || timeDiff > interval) {
          this.bitrate = (loaded - this.loaded) * (1000 / timeDiff) * 8;
          this.loaded = loaded;
          this.timestamp = now;
        }
        return this.bitrate;
      };
    },

    _isXHRUpload: function(options) {
      return (
        !options.forceIframeTransport &&
        ((!options.multipart && $.support.xhrFileUpload) ||
          $.support.xhrFormDataFileUpload)
      );
    },

    _getFormData: function(options) {
      var formData;
      if ($.type(options.formData) === 'function') {
        return options.formData(options.form);
      }
      if (Array.isArray(options.formData)) {
        return options.formData;
      }
      if ($.type(options.formData) === 'object') {
        formData = [];
        $.each(options.formData, function(name, value) {
          formData.push({ name: name, value: value });
        });
        return formData;
      }
      return [];
    },

    _getTotal: function(files) {
      var total = 0;
      $.each(files, function(index, file) {
        total += file.size || 1;
      });
      return total;
    },

    _initProgressObject: function(obj) {
      var progress = {
        loaded: 0,
        total: 0,
        bitrate: 0
      };
      if (obj._progress) {
        $.extend(obj._progress, progress);
      } else {
        obj._progress = progress;
      }
    },

    _initResponseObject: function(obj) {
      var prop;
      if (obj._response) {
        for (prop in obj._response) {
          if (Object.prototype.hasOwnProperty.call(obj._response, prop)) {
            delete obj._response[prop];
          }
        }
      } else {
        obj._response = {};
      }
    },

    _onProgress: function(e, data) {
      if (e.lengthComputable) {
        var now = Date.now ? Date.now() : new Date().getTime(),
          loaded;
        if (
          data._time &&
          data.progressInterval &&
          now - data._time < data.progressInterval &&
          e.loaded !== e.total
        ) {
          return;
        }
        data._time = now;
        loaded =
          Math.floor(
            (e.loaded / e.total) * (data.chunkSize || data._progress.total)
          ) + (data.uploadedBytes || 0);
        // Add the difference from the previously loaded state
        // to the global loaded counter:
        this._progress.loaded += loaded - data._progress.loaded;
        this._progress.bitrate = this._bitrateTimer.getBitrate(
          now,
          this._progress.loaded,
          data.bitrateInterval
        );
        data._progress.loaded = data.loaded = loaded;
        data._progress.bitrate = data.bitrate = data._bitrateTimer.getBitrate(
          now,
          loaded,
          data.bitrateInterval
        );
        // Trigger a custom progress event with a total data property set
        // to the file size(s) of the current upload and a loaded data
        // property calculated accordingly:
        this._trigger(
          'progress',
          $.Event('progress', { delegatedEvent: e }),
          data
        );
        // Trigger a global progress event for all current file uploads,
        // including ajax calls queued for sequential file uploads:
        this._trigger(
          'progressall',
          $.Event('progressall', { delegatedEvent: e }),
          this._progress
        );
      }
    },

    _initProgressListener: function(options) {
      var that = this,
        xhr = options.xhr ? options.xhr() : $.ajaxSettings.xhr();
      // Accesss to the native XHR object is required to add event listeners
      // for the upload progress event:
      if (xhr.upload) {
        $(xhr.upload).on('progress', function(e) {
          var oe = e.originalEvent;
          // Make sure the progress event properties get copied over:
          e.lengthComputable = oe.lengthComputable;
          e.loaded = oe.loaded;
          e.total = oe.total;
          that._onProgress(e, options);
        });
        options.xhr = function() {
          return xhr;
        };
      }
    },

    _deinitProgressListener: function(options) {
      var xhr = options.xhr ? options.xhr() : $.ajaxSettings.xhr();
      if (xhr.upload) {
        $(xhr.upload).off('progress');
      }
    },

    _isInstanceOf: function(type, obj) {
      // Cross-frame instanceof check
      return Object.prototype.toString.call(obj) === '[object ' + type + ']';
    },

    _getUniqueFilename: function(name, map) {
      // eslint-disable-next-line no-param-reassign
      name = String(name);
      if (map[name]) {
        // eslint-disable-next-line no-param-reassign
        name = name.replace(/(?: \(([\d]+)\))?(\.[^.]+)?$/, function(
          _,
          p1,
          p2
        ) {
          var index = p1 ? Number(p1) + 1 : 1;
          var ext = p2 || '';
          return ' (' + index + ')' + ext;
        });
        return this._getUniqueFilename(name, map);
      }
      map[name] = true;
      return name;
    },

    _initXHRData: function(options) {
      var that = this,
        formData,
        file = options.files[0],
        // Ignore non-multipart setting if not supported:
        multipart = options.multipart || !$.support.xhrFileUpload,
        paramName =
          $.type(options.paramName) === 'array'
            ? options.paramName[0]
            : options.paramName;
      options.headers = $.extend({}, options.headers);
      if (options.contentRange) {
        options.headers['Content-Range'] = options.contentRange;
      }
      if (!multipart || options.blob || !this._isInstanceOf('File', file)) {
        options.headers['Content-Disposition'] =
          'attachment; filename="' +
          encodeURI(file.uploadName || file.name) +
          '"';
      }
      if (!multipart) {
        options.contentType = file.type || 'application/octet-stream';
        options.data = options.blob || file;
      } else if ($.support.xhrFormDataFileUpload) {
        if (options.postMessage) {
          // window.postMessage does not allow sending FormData
          // objects, so we just add the File/Blob objects to
          // the formData array and let the postMessage window
          // create the FormData object out of this array:
          formData = this._getFormData(options);
          if (options.blob) {
            formData.push({
              name: paramName,
              value: options.blob
            });
          } else {
            $.each(options.files, function(index, file) {
              formData.push({
                name:
                  ($.type(options.paramName) === 'array' &&
                    options.paramName[index]) ||
                  paramName,
                value: file
              });
            });
          }
        } else {
          if (that._isInstanceOf('FormData', options.formData)) {
            formData = options.formData;
          } else {
            formData = new FormData();
            $.each(this._getFormData(options), function(index, field) {
              formData.append(field.name, field.value);
            });
          }
          if (options.blob) {
            formData.append(
              paramName,
              options.blob,
              file.uploadName || file.name
            );
          } else {
            $.each(options.files, function(index, file) {
              // This check allows the tests to run with
              // dummy objects:
              if (
                that._isInstanceOf('File', file) ||
                that._isInstanceOf('Blob', file)
              ) {
                var fileName = file.uploadName || file.name;
                if (options.uniqueFilenames) {
                  fileName = that._getUniqueFilename(
                    fileName,
                    options.uniqueFilenames
                  );
                }
                formData.append(
                  ($.type(options.paramName) === 'array' &&
                    options.paramName[index]) ||
                    paramName,
                  file,
                  fileName
                );
              }
            });
          }
        }
        options.data = formData;
      }
      // Blob reference is not needed anymore, free memory:
      options.blob = null;
    },

    _initIframeSettings: function(options) {
      var targetHost = $('<a></a>')
        .prop('href', options.url)
        .prop('host');
      // Setting the dataType to iframe enables the iframe transport:
      options.dataType = 'iframe ' + (options.dataType || '');
      // The iframe transport accepts a serialized array as form data:
      options.formData = this._getFormData(options);
      // Add redirect url to form data on cross-domain uploads:
      if (options.redirect && targetHost && targetHost !== location.host) {
        options.formData.push({
          name: options.redirectParamName || 'redirect',
          value: options.redirect
        });
      }
    },

    _initDataSettings: function(options) {
      if (this._isXHRUpload(options)) {
        if (!this._chunkedUpload(options, true)) {
          if (!options.data) {
            this._initXHRData(options);
          }
          this._initProgressListener(options);
        }
        if (options.postMessage) {
          // Setting the dataType to postmessage enables the
          // postMessage transport:
          options.dataType = 'postmessage ' + (options.dataType || '');
        }
      } else {
        this._initIframeSettings(options);
      }
    },

    _getParamName: function(options) {
      var fileInput = $(options.fileInput),
        paramName = options.paramName;
      if (!paramName) {
        paramName = [];
        fileInput.each(function() {
          var input = $(this),
            name = input.prop('name') || 'files[]',
            i = (input.prop('files') || [1]).length;
          while (i) {
            paramName.push(name);
            i -= 1;
          }
        });
        if (!paramName.length) {
          paramName = [fileInput.prop('name') || 'files[]'];
        }
      } else if (!Array.isArray(paramName)) {
        paramName = [paramName];
      }
      return paramName;
    },

    _initFormSettings: function(options) {
      // Retrieve missing options from the input field and the
      // associated form, if available:
      if (!options.form || !options.form.length) {
        options.form = $(options.fileInput.prop('form'));
        // If the given file input doesn't have an associated form,
        // use the default widget file input's form:
        if (!options.form.length) {
          options.form = $(this.options.fileInput.prop('form'));
        }
      }
      options.paramName = this._getParamName(options);
      if (!options.url) {
        options.url = options.form.prop('action') || location.href;
      }
      // The HTTP request method must be "POST" or "PUT":
      options.type = (
        options.type ||
        ($.type(options.form.prop('method')) === 'string' &&
          options.form.prop('method')) ||
        ''
      ).toUpperCase();
      if (
        options.type !== 'POST' &&
        options.type !== 'PUT' &&
        options.type !== 'PATCH'
      ) {
        options.type = 'POST';
      }
      if (!options.formAcceptCharset) {
        options.formAcceptCharset = options.form.attr('accept-charset');
      }
    },

    _getAJAXSettings: function(data) {
      var options = $.extend({}, this.options, data);
      this._initFormSettings(options);
      this._initDataSettings(options);
      return options;
    },

    // jQuery 1.6 doesn't provide .state(),
    // while jQuery 1.8+ removed .isRejected() and .isResolved():
    _getDeferredState: function(deferred) {
      if (deferred.state) {
        return deferred.state();
      }
      if (deferred.isResolved()) {
        return 'resolved';
      }
      if (deferred.isRejected()) {
        return 'rejected';
      }
      return 'pending';
    },

    // Maps jqXHR callbacks to the equivalent
    // methods of the given Promise object:
    _enhancePromise: function(promise) {
      promise.success = promise.done;
      promise.error = promise.fail;
      promise.complete = promise.always;
      return promise;
    },

    // Creates and returns a Promise object enhanced with
    // the jqXHR methods abort, success, error and complete:
    _getXHRPromise: function(resolveOrReject, context, args) {
      var dfd = $.Deferred(),
        promise = dfd.promise();
      // eslint-disable-next-line no-param-reassign
      context = context || this.options.context || promise;
      if (resolveOrReject === true) {
        dfd.resolveWith(context, args);
      } else if (resolveOrReject === false) {
        dfd.rejectWith(context, args);
      }
      promise.abort = dfd.promise;
      return this._enhancePromise(promise);
    },

    // Adds convenience methods to the data callback argument:
    _addConvenienceMethods: function(e, data) {
      var that = this,
        getPromise = function(args) {
          return $.Deferred()
            .resolveWith(that, args)
            .promise();
        };
      data.process = function(resolveFunc, rejectFunc) {
        if (resolveFunc || rejectFunc) {
          data._processQueue = this._processQueue = (
            this._processQueue || getPromise([this])
          )
            .then(function() {
              if (data.errorThrown) {
                return $.Deferred()
                  .rejectWith(that, [data])
                  .promise();
              }
              return getPromise(arguments);
            })
            .then(resolveFunc, rejectFunc);
        }
        return this._processQueue || getPromise([this]);
      };
      data.submit = function() {
        if (this.state() !== 'pending') {
          data.jqXHR = this.jqXHR =
            that._trigger(
              'submit',
              $.Event('submit', { delegatedEvent: e }),
              this
            ) !== false && that._onSend(e, this);
        }
        return this.jqXHR || that._getXHRPromise();
      };
      data.abort = function() {
        if (this.jqXHR) {
          return this.jqXHR.abort();
        }
        this.errorThrown = 'abort';
        that._trigger('fail', null, this);
        return that._getXHRPromise(false);
      };
      data.state = function() {
        if (this.jqXHR) {
          return that._getDeferredState(this.jqXHR);
        }
        if (this._processQueue) {
          return that._getDeferredState(this._processQueue);
        }
      };
      data.processing = function() {
        return (
          !this.jqXHR &&
          this._processQueue &&
          that._getDeferredState(this._processQueue) === 'pending'
        );
      };
      data.progress = function() {
        return this._progress;
      };
      data.response = function() {
        return this._response;
      };
    },

    // Parses the Range header from the server response
    // and returns the uploaded bytes:
    _getUploadedBytes: function(jqXHR) {
      var range = jqXHR.getResponseHeader('Range'),
        parts = range && range.split('-'),
        upperBytesPos = parts && parts.length > 1 && parseInt(parts[1], 10);
      return upperBytesPos && upperBytesPos + 1;
    },

    // Uploads a file in multiple, sequential requests
    // by splitting the file up in multiple blob chunks.
    // If the second parameter is true, only tests if the file
    // should be uploaded in chunks, but does not invoke any
    // upload requests:
    _chunkedUpload: function(options, testOnly) {
      options.uploadedBytes = options.uploadedBytes || 0;
      var that = this,
        file = options.files[0],
        fs = file.size,
        ub = options.uploadedBytes,
        mcs = options.maxChunkSize || fs,
        slice = this._blobSlice,
        dfd = $.Deferred(),
        promise = dfd.promise(),
        jqXHR,
        upload;
      if (
        !(
          this._isXHRUpload(options) &&
          slice &&
          (ub || ($.type(mcs) === 'function' ? mcs(options) : mcs) < fs)
        ) ||
        options.data
      ) {
        return false;
      }
      if (testOnly) {
        return true;
      }
      if (ub >= fs) {
        file.error = options.i18n('uploadedBytes');
        return this._getXHRPromise(false, options.context, [
          null,
          'error',
          file.error
        ]);
      }
      // The chunk upload method:
      upload = function() {
        // Clone the options object for each chunk upload:
        var o = $.extend({}, options),
          currentLoaded = o._progress.loaded;
        o.blob = slice.call(
          file,
          ub,
          ub + ($.type(mcs) === 'function' ? mcs(o) : mcs),
          file.type
        );
        // Store the current chunk size, as the blob itself
        // will be dereferenced after data processing:
        o.chunkSize = o.blob.size;
        // Expose the chunk bytes position range:
        o.contentRange =
          'bytes ' + ub + '-' + (ub + o.chunkSize - 1) + '/' + fs;
        // Trigger chunkbeforesend to allow form data to be updated for this chunk
        that._trigger('chunkbeforesend', null, o);
        // Process the upload data (the blob and potential form data):
        that._initXHRData(o);
        // Add progress listeners for this chunk upload:
        that._initProgressListener(o);
        jqXHR = (
          (that._trigger('chunksend', null, o) !== false && $.ajax(o)) ||
          that._getXHRPromise(false, o.context)
        )
          .done(function(result, textStatus, jqXHR) {
            ub = that._getUploadedBytes(jqXHR) || ub + o.chunkSize;
            // Create a progress event if no final progress event
            // with loaded equaling total has been triggered
            // for this chunk:
            if (currentLoaded + o.chunkSize - o._progress.loaded) {
              that._onProgress(
                $.Event('progress', {
                  lengthComputable: true,
                  loaded: ub - o.uploadedBytes,
                  total: ub - o.uploadedBytes
                }),
                o
              );
            }
            options.uploadedBytes = o.uploadedBytes = ub;
            o.result = result;
            o.textStatus = textStatus;
            o.jqXHR = jqXHR;
            that._trigger('chunkdone', null, o);
            that._trigger('chunkalways', null, o);
            if (ub < fs) {
              // File upload not yet complete,
              // continue with the next chunk:
              upload();
            } else {
              dfd.resolveWith(o.context, [result, textStatus, jqXHR]);
            }
          })
          .fail(function(jqXHR, textStatus, errorThrown) {
            o.jqXHR = jqXHR;
            o.textStatus = textStatus;
            o.errorThrown = errorThrown;
            that._trigger('chunkfail', null, o);
            that._trigger('chunkalways', null, o);
            dfd.rejectWith(o.context, [jqXHR, textStatus, errorThrown]);
          })
          .always(function() {
            that._deinitProgressListener(o);
          });
      };
      this._enhancePromise(promise);
      promise.abort = function() {
        return jqXHR.abort();
      };
      upload();
      return promise;
    },

    _beforeSend: function(e, data) {
      if (this._active === 0) {
        // the start callback is triggered when an upload starts
        // and no other uploads are currently running,
        // equivalent to the global ajaxStart event:
        this._trigger('start');
        // Set timer for global bitrate progress calculation:
        this._bitrateTimer = new this._BitrateTimer();
        // Reset the global progress values:
        this._progress.loaded = this._progress.total = 0;
        this._progress.bitrate = 0;
      }
      // Make sure the container objects for the .response() and
      // .progress() methods on the data object are available
      // and reset to their initial state:
      this._initResponseObject(data);
      this._initProgressObject(data);
      data._progress.loaded = data.loaded = data.uploadedBytes || 0;
      data._progress.total = data.total = this._getTotal(data.files) || 1;
      data._progress.bitrate = data.bitrate = 0;
      this._active += 1;
      // Initialize the global progress values:
      this._progress.loaded += data.loaded;
      this._progress.total += data.total;
    },

    _onDone: function(result, textStatus, jqXHR, options) {
      var total = options._progress.total,
        response = options._response;
      if (options._progress.loaded < total) {
        // Create a progress event if no final progress event
        // with loaded equaling total has been triggered:
        this._onProgress(
          $.Event('progress', {
            lengthComputable: true,
            loaded: total,
            total: total
          }),
          options
        );
      }
      response.result = options.result = result;
      response.textStatus = options.textStatus = textStatus;
      response.jqXHR = options.jqXHR = jqXHR;
      this._trigger('done', null, options);
    },

    _onFail: function(jqXHR, textStatus, errorThrown, options) {
      var response = options._response;
      if (options.recalculateProgress) {
        // Remove the failed (error or abort) file upload from
        // the global progress calculation:
        this._progress.loaded -= options._progress.loaded;
        this._progress.total -= options._progress.total;
      }
      response.jqXHR = options.jqXHR = jqXHR;
      response.textStatus = options.textStatus = textStatus;
      response.errorThrown = options.errorThrown = errorThrown;
      this._trigger('fail', null, options);
    },

    _onAlways: function(jqXHRorResult, textStatus, jqXHRorError, options) {
      // jqXHRorResult, textStatus and jqXHRorError are added to the
      // options object via done and fail callbacks
      this._trigger('always', null, options);
    },

    _onSend: function(e, data) {
      if (!data.submit) {
        this._addConvenienceMethods(e, data);
      }
      var that = this,
        jqXHR,
        aborted,
        slot,
        pipe,
        options = that._getAJAXSettings(data),
        send = function() {
          that._sending += 1;
          // Set timer for bitrate progress calculation:
          options._bitrateTimer = new that._BitrateTimer();
          jqXHR =
            jqXHR ||
            (
              ((aborted ||
                that._trigger(
                  'send',
                  $.Event('send', { delegatedEvent: e }),
                  options
                ) === false) &&
                that._getXHRPromise(false, options.context, aborted)) ||
              that._chunkedUpload(options) ||
              $.ajax(options)
            )
              .done(function(result, textStatus, jqXHR) {
                that._onDone(result, textStatus, jqXHR, options);
              })
              .fail(function(jqXHR, textStatus, errorThrown) {
                that._onFail(jqXHR, textStatus, errorThrown, options);
              })
              .always(function(jqXHRorResult, textStatus, jqXHRorError) {
                that._deinitProgressListener(options);
                that._onAlways(
                  jqXHRorResult,
                  textStatus,
                  jqXHRorError,
                  options
                );
                that._sending -= 1;
                that._active -= 1;
                if (
                  options.limitConcurrentUploads &&
                  options.limitConcurrentUploads > that._sending
                ) {
                  // Start the next queued upload,
                  // that has not been aborted:
                  var nextSlot = that._slots.shift();
                  while (nextSlot) {
                    if (that._getDeferredState(nextSlot) === 'pending') {
                      nextSlot.resolve();
                      break;
                    }
                    nextSlot = that._slots.shift();
                  }
                }
                if (that._active === 0) {
                  // The stop callback is triggered when all uploads have
                  // been completed, equivalent to the global ajaxStop event:
                  that._trigger('stop');
                }
              });
          return jqXHR;
        };
      this._beforeSend(e, options);
      if (
        this.options.sequentialUploads ||
        (this.options.limitConcurrentUploads &&
          this.options.limitConcurrentUploads <= this._sending)
      ) {
        if (this.options.limitConcurrentUploads > 1) {
          slot = $.Deferred();
          this._slots.push(slot);
          pipe = slot.then(send);
        } else {
          this._sequence = this._sequence.then(send, send);
          pipe = this._sequence;
        }
        // Return the piped Promise object, enhanced with an abort method,
        // which is delegated to the jqXHR object of the current upload,
        // and jqXHR callbacks mapped to the equivalent Promise methods:
        pipe.abort = function() {
          aborted = [undefined, 'abort', 'abort'];
          if (!jqXHR) {
            if (slot) {
              slot.rejectWith(options.context, aborted);
            }
            return send();
          }
          return jqXHR.abort();
        };
        return this._enhancePromise(pipe);
      }
      return send();
    },

    _onAdd: function(e, data) {
      var that = this,
        result = true,
        options = $.extend({}, this.options, data),
        files = data.files,
        filesLength = files.length,
        limit = options.limitMultiFileUploads,
        limitSize = options.limitMultiFileUploadSize,
        overhead = options.limitMultiFileUploadSizeOverhead,
        batchSize = 0,
        paramName = this._getParamName(options),
        paramNameSet,
        paramNameSlice,
        fileSet,
        i,
        j = 0;
      if (!filesLength) {
        return false;
      }
      if (limitSize && files[0].size === undefined) {
        limitSize = undefined;
      }
      if (
        !(options.singleFileUploads || limit || limitSize) ||
        !this._isXHRUpload(options)
      ) {
        fileSet = [files];
        paramNameSet = [paramName];
      } else if (!(options.singleFileUploads || limitSize) && limit) {
        fileSet = [];
        paramNameSet = [];
        for (i = 0; i < filesLength; i += limit) {
          fileSet.push(files.slice(i, i + limit));
          paramNameSlice = paramName.slice(i, i + limit);
          if (!paramNameSlice.length) {
            paramNameSlice = paramName;
          }
          paramNameSet.push(paramNameSlice);
        }
      } else if (!options.singleFileUploads && limitSize) {
        fileSet = [];
        paramNameSet = [];
        for (i = 0; i < filesLength; i = i + 1) {
          batchSize += files[i].size + overhead;
          if (
            i + 1 === filesLength ||
            batchSize + files[i + 1].size + overhead > limitSize ||
            (limit && i + 1 - j >= limit)
          ) {
            fileSet.push(files.slice(j, i + 1));
            paramNameSlice = paramName.slice(j, i + 1);
            if (!paramNameSlice.length) {
              paramNameSlice = paramName;
            }
            paramNameSet.push(paramNameSlice);
            j = i + 1;
            batchSize = 0;
          }
        }
      } else {
        paramNameSet = paramName;
      }
      data.originalFiles = files;
      $.each(fileSet || files, function(index, element) {
        var newData = $.extend({}, data);
        newData.files = fileSet ? element : [element];
        newData.paramName = paramNameSet[index];
        that._initResponseObject(newData);
        that._initProgressObject(newData);
        that._addConvenienceMethods(e, newData);
        result = that._trigger(
          'add',
          $.Event('add', { delegatedEvent: e }),
          newData
        );
        return result;
      });
      return result;
    },

    _replaceFileInput: function(data) {
      var input = data.fileInput,
        inputClone = input.clone(true),
        restoreFocus = input.is(document.activeElement);
      // Add a reference for the new cloned file input to the data argument:
      data.fileInputClone = inputClone;
      $('<form></form>')
        .append(inputClone)[0]
        .reset();
      // Detaching allows to insert the fileInput on another form
      // without loosing the file input value:
      input.after(inputClone).detach();
      // If the fileInput had focus before it was detached,
      // restore focus to the inputClone.
      if (restoreFocus) {
        inputClone.trigger('focus');
      }
      // Avoid memory leaks with the detached file input:
      $.cleanData(input.off('remove'));
      // Replace the original file input element in the fileInput
      // elements set with the clone, which has been copied including
      // event handlers:
      this.options.fileInput = this.options.fileInput.map(function(i, el) {
        if (el === input[0]) {
          return inputClone[0];
        }
        return el;
      });
      // If the widget has been initialized on the file input itself,
      // override this.element with the file input clone:
      if (input[0] === this.element[0]) {
        this.element = inputClone;
      }
    },

    _handleFileTreeEntry: function(entry, path) {
      var that = this,
        dfd = $.Deferred(),
        entries = [],
        dirReader,
        errorHandler = function(e) {
          if (e && !e.entry) {
            e.entry = entry;
          }
          // Since $.when returns immediately if one
          // Deferred is rejected, we use resolve instead.
          // This allows valid files and invalid items
          // to be returned together in one set:
          dfd.resolve([e]);
        },
        successHandler = function(entries) {
          that
            ._handleFileTreeEntries(entries, path + entry.name + '/')
            .done(function(files) {
              dfd.resolve(files);
            })
            .fail(errorHandler);
        },
        readEntries = function() {
          dirReader.readEntries(function(results) {
            if (!results.length) {
              successHandler(entries);
            } else {
              entries = entries.concat(results);
              readEntries();
            }
          }, errorHandler);
        };
      // eslint-disable-next-line no-param-reassign
      path = path || '';
      if (entry.isFile) {
        if (entry._file) {
          // Workaround for Chrome bug #149735
          entry._file.relativePath = path;
          dfd.resolve(entry._file);
        } else {
          entry.file(function(file) {
            file.relativePath = path;
            dfd.resolve(file);
          }, errorHandler);
        }
      } else if (entry.isDirectory) {
        dirReader = entry.createReader();
        readEntries();
      } else {
        // Return an empty list for file system items
        // other than files or directories:
        dfd.resolve([]);
      }
      return dfd.promise();
    },

    _handleFileTreeEntries: function(entries, path) {
      var that = this;
      return $.when
        .apply(
          $,
          $.map(entries, function(entry) {
            return that._handleFileTreeEntry(entry, path);
          })
        )
        .then(function() {
          return Array.prototype.concat.apply([], arguments);
        });
    },

    _getDroppedFiles: function(dataTransfer) {
      // eslint-disable-next-line no-param-reassign
      dataTransfer = dataTransfer || {};
      var items = dataTransfer.items;
      if (
        items &&
        items.length &&
        (items[0].webkitGetAsEntry || items[0].getAsEntry)
      ) {
        return this._handleFileTreeEntries(
          $.map(items, function(item) {
            var entry;
            if (item.webkitGetAsEntry) {
              entry = item.webkitGetAsEntry();
              if (entry) {
                // Workaround for Chrome bug #149735:
                entry._file = item.getAsFile();
              }
              return entry;
            }
            return item.getAsEntry();
          })
        );
      }
      return $.Deferred()
        .resolve($.makeArray(dataTransfer.files))
        .promise();
    },

    _getSingleFileInputFiles: function(fileInput) {
      // eslint-disable-next-line no-param-reassign
      fileInput = $(fileInput);
      var entries =
          fileInput.prop('webkitEntries') || fileInput.prop('entries'),
        files,
        value;
      if (entries && entries.length) {
        return this._handleFileTreeEntries(entries);
      }
      files = $.makeArray(fileInput.prop('files'));
      if (!files.length) {
        value = fileInput.prop('value');
        if (!value) {
          return $.Deferred()
            .resolve([])
            .promise();
        }
        // If the files property is not available, the browser does not
        // support the File API and we add a pseudo File object with
        // the input value as name with path information removed:
        files = [{ name: value.replace(/^.*\\/, '') }];
      } else if (files[0].name === undefined && files[0].fileName) {
        // File normalization for Safari 4 and Firefox 3:
        $.each(files, function(index, file) {
          file.name = file.fileName;
          file.size = file.fileSize;
        });
      }
      return $.Deferred()
        .resolve(files)
        .promise();
    },

    _getFileInputFiles: function(fileInput) {
      if (!(fileInput instanceof $) || fileInput.length === 1) {
        return this._getSingleFileInputFiles(fileInput);
      }
      return $.when
        .apply($, $.map(fileInput, this._getSingleFileInputFiles))
        .then(function() {
          return Array.prototype.concat.apply([], arguments);
        });
    },

    _onChange: function(e) {
      var that = this,
        data = {
          fileInput: $(e.target),
          form: $(e.target.form)
        };
      this._getFileInputFiles(data.fileInput).always(function(files) {
        data.files = files;
        if (that.options.replaceFileInput) {
          that._replaceFileInput(data);
        }
        if (
          that._trigger(
            'change',
            $.Event('change', { delegatedEvent: e }),
            data
          ) !== false
        ) {
          that._onAdd(e, data);
        }
      });
    },

    _onPaste: function(e) {
      var items =
          e.originalEvent &&
          e.originalEvent.clipboardData &&
          e.originalEvent.clipboardData.items,
        data = { files: [] };
      if (items && items.length) {
        $.each(items, function(index, item) {
          var file = item.getAsFile && item.getAsFile();
          if (file) {
            data.files.push(file);
          }
        });
        if (
          this._trigger(
            'paste',
            $.Event('paste', { delegatedEvent: e }),
            data
          ) !== false
        ) {
          this._onAdd(e, data);
        }
      }
    },

    _onDrop: function(e) {
      e.dataTransfer = e.originalEvent && e.originalEvent.dataTransfer;
      var that = this,
        dataTransfer = e.dataTransfer,
        data = {};
      if (dataTransfer && dataTransfer.files && dataTransfer.files.length) {
        e.preventDefault();
        this._getDroppedFiles(dataTransfer).always(function(files) {
          data.files = files;
          if (
            that._trigger(
              'drop',
              $.Event('drop', { delegatedEvent: e }),
              data
            ) !== false
          ) {
            that._onAdd(e, data);
          }
        });
      }
    },

    _onDragOver: getDragHandler('dragover'),

    _onDragEnter: getDragHandler('dragenter'),

    _onDragLeave: getDragHandler('dragleave'),

    _initEventHandlers: function() {
      if (this._isXHRUpload(this.options)) {
        this._on(this.options.dropZone, {
          dragover: this._onDragOver,
          drop: this._onDrop,
          // event.preventDefault() on dragenter is required for IE10+:
          dragenter: this._onDragEnter,
          // dragleave is not required, but added for completeness:
          dragleave: this._onDragLeave
        });
        this._on(this.options.pasteZone, {
          paste: this._onPaste
        });
      }
      if ($.support.fileInput) {
        this._on(this.options.fileInput, {
          change: this._onChange
        });
      }
    },

    _destroyEventHandlers: function() {
      this._off(this.options.dropZone, 'dragenter dragleave dragover drop');
      this._off(this.options.pasteZone, 'paste');
      this._off(this.options.fileInput, 'change');
    },

    _destroy: function() {
      this._destroyEventHandlers();
    },

    _setOption: function(key, value) {
      var reinit = $.inArray(key, this._specialOptions) !== -1;
      if (reinit) {
        this._destroyEventHandlers();
      }
      this._super(key, value);
      if (reinit) {
        this._initSpecialOptions();
        this._initEventHandlers();
      }
    },

    _initSpecialOptions: function() {
      var options = this.options;
      if (options.fileInput === undefined) {
        options.fileInput = this.element.is('input[type="file"]')
          ? this.element
          : this.element.find('input[type="file"]');
      } else if (!(options.fileInput instanceof $)) {
        options.fileInput = $(options.fileInput);
      }
      if (!(options.dropZone instanceof $)) {
        options.dropZone = $(options.dropZone);
      }
      if (!(options.pasteZone instanceof $)) {
        options.pasteZone = $(options.pasteZone);
      }
    },

    _getRegExp: function(str) {
      var parts = str.split('/'),
        modifiers = parts.pop();
      parts.shift();
      return new RegExp(parts.join('/'), modifiers);
    },

    _isRegExpOption: function(key, value) {
      return (
        key !== 'url' &&
        $.type(value) === 'string' &&
        /^\/.*\/[igm]{0,3}$/.test(value)
      );
    },

    _initDataAttributes: function() {
      var that = this,
        options = this.options,
        data = this.element.data();
      // Initialize options set via HTML5 data-attributes:
      $.each(this.element[0].attributes, function(index, attr) {
        var key = attr.name.toLowerCase(),
          value;
        if (/^data-/.test(key)) {
          // Convert hyphen-ated key to camelCase:
          key = key.slice(5).replace(/-[a-z]/g, function(str) {
            return str.charAt(1).toUpperCase();
          });
          value = data[key];
          if (that._isRegExpOption(key, value)) {
            value = that._getRegExp(value);
          }
          options[key] = value;
        }
      });
    },

    _create: function() {
      this._initDataAttributes();
      this._initSpecialOptions();
      this._slots = [];
      this._sequence = this._getXHRPromise(true);
      this._sending = this._active = 0;
      this._initProgressObject(this);
      this._initEventHandlers();
    },

    // This method is exposed to the widget API and allows to query
    // the number of active uploads:
    active: function() {
      return this._active;
    },

    // This method is exposed to the widget API and allows to query
    // the widget upload progress.
    // It returns an object with loaded, total and bitrate properties
    // for the running uploads:
    progress: function() {
      return this._progress;
    },

    // This method is exposed to the widget API and allows adding files
    // using the fileupload API. The data parameter accepts an object which
    // must have a files property and can contain additional options:
    // .fileupload('add', {files: filesList});
    add: function(data) {
      var that = this;
      if (!data || this.options.disabled) {
        return;
      }
      if (data.fileInput && !data.files) {
        this._getFileInputFiles(data.fileInput).always(function(files) {
          data.files = files;
          that._onAdd(null, data);
        });
      } else {
        data.files = $.makeArray(data.files);
        this._onAdd(null, data);
      }
    },

    // This method is exposed to the widget API and allows sending files
    // using the fileupload API. The data parameter accepts an object which
    // must have a files or fileInput property and can contain additional options:
    // .fileupload('send', {files: filesList});
    // The method returns a Promise object for the file upload call.
    send: function(data) {
      if (data && !this.options.disabled) {
        if (data.fileInput && !data.files) {
          var that = this,
            dfd = $.Deferred(),
            promise = dfd.promise(),
            jqXHR,
            aborted;
          promise.abort = function() {
            aborted = true;
            if (jqXHR) {
              return jqXHR.abort();
            }
            dfd.reject(null, 'abort', 'abort');
            return promise;
          };
          this._getFileInputFiles(data.fileInput).always(function(files) {
            if (aborted) {
              return;
            }
            if (!files.length) {
              dfd.reject();
              return;
            }
            data.files = files;
            jqXHR = that._onSend(null, data);
            jqXHR.then(
              function(result, textStatus, jqXHR) {
                dfd.resolve(result, textStatus, jqXHR);
              },
              function(jqXHR, textStatus, errorThrown) {
                dfd.reject(jqXHR, textStatus, errorThrown);
              }
            );
          });
          return this._enhancePromise(promise);
        }
        data.files = $.makeArray(data.files);
        if (data.files.length) {
          return this._onSend(null, data);
        }
      }
      return this._getXHRPromise(false, data && data.context);
    }
  });
});

/**
 * __DinarteCoelho FileUpload Widget__
 *
 * FileUpload goes beyond the browser input `type="file"` functionality and features an HTML5 powered rich solution with
 * graceful degradation for legacy browsers.
 *
 * @typedef DinarteCoelho.widget.FileUpload.OnAddCallback Callback invoked when file was selected and is added to this
 * widget. See also {@link FileUploadCfg.onAdd}.
 * @this {DinarteCoelho.widget.FileUpload} DinarteCoelho.widget.FileUpload.OnAddCallback
 * @param {File} DinarteCoelho.widget.FileUpload.OnAddCallback.file The file that was selected for the upload.
 * @param {(processedFile: File) => void} DinarteCoelho.widget.FileUpload.OnAddCallback.callback Callback that needs to be
 * invoked with the file that should be added to the upload queue.
 *
 * @typedef DinarteCoelho.widget.FileUpload.OnCancelCallback Callback that is invoked when a file upload was canceled. See
 * also {@link FileUploadCfg.oncancel}.
 * @this {DinarteCoelho.widget.FileUpload} DinarteCoelho.widget.FileUpload.OnCancelCallback
 *
 * @typedef DinarteCoelho.widget.FileUpload.OnUploadCallback Callback to execute before the files are sent.
 * If this callback returns false, the file upload request is not started. See also {@link FileUploadCfg.onupload}.
 * @this {DinarteCoelho.widget.FileUpload} DinarteCoelho.widget.FileUpload.OnUploadCallback
 *
 * @typedef DinarteCoelho.widget.FileUpload.OnCompleteCallback Callback that is invoked after a file was uploaded to the
 * server successfully. See also {@link FileUploadCfg.oncomplete}.
 * @this {DinarteCoelho.widget.FileUpload} DinarteCoelho.widget.FileUpload.OnCompleteCallback
 * @param {DinarteCoelho.ajax.DinarteCoelhoArgs} DinarteCoelho.widget.FileUpload.OnCompleteCallback.pfArgs The additional
 * arguments from the jQuery XHR requests.
 * @param {JQueryFileUpload.JQueryAjaxCallbackData} DinarteCoelho.widget.FileUpload.OnCompleteCallback.data Details about
 * the uploaded file or files.
 *
 * @typedef DinarteCoelho.widget.FileUpload.OnErrorCallback Callback that is invoked when a file could not be uploaded to
 * the server. See also {@link FileUploadCfg.onerror}.
 * @this {DinarteCoelho.widget.FileUpload} DinarteCoelho.widget.FileUpload.OnErrorCallback
 * @param {JQuery.jqXHR} DinarteCoelho.widget.FileUpload.OnErrorCallback.jqXHR The XHR object from the HTTP request.
 * @param {string} DinarteCoelho.widget.FileUpload.OnErrorCallback.textStatus The HTTP status text of the failed request.
 * @param {DinarteCoelho.ajax.DinarteCoelhoArgs} DinarteCoelho.widget.FileUpload.OnErrorCallback.pfArgs The additional arguments
 * from the jQuery XHR request.
 *
 * @typedef DinarteCoelho.widget.FileUpload.OnStartCallback Callback that is invoked at the beginning of a file upload,
 * when a file is sent to the server. See also {@link FileUploadCfg.onstart}.
 * @this {DinarteCoelho.widget.FileUpload} DinarteCoelho.widget.FileUpload.OnStartCallback
 *
 * @interface {DinarteCoelho.widget.FileUpload.UploadMessage} UploadMessage A error message for a file upload widget.
 * @prop {number} UploadMessage.filesize The size of the uploaded file in bytes.
 * @prop {string} UploadMessage.filename The name of the uploaded file.
 * @prop {string} UploadMessage.summary A short summary of this message.
 *
 * @interface {DinarteCoelho.widget.FileUpload.UploadFile} UploadFile Represents an uploaded file added to the upload
 * widget.
 * @prop {JQuery} UploadFile.row Row of an uploaded file.
 *
 * @prop {JQuery} buttonBar The DOM element for the bar with the buttons of this widget.
 * @prop {number} dragoverCount Amount of dragover on drop zone and its children.
 * @prop {string} customDropZone Custom drop zone to use for drag and drop.
 * @prop {string} dropZone Drop zone to use for drag and drop.
 * @prop {JQuery} cancelButton The DOM element for the button for canceling a file upload.
 * @prop {JQuery} chooseButton The DOM element for the button for selecting a file.
 * @prop {string} clearMessagesSelector Selector for the button to clear the error messages.
 * @prop {JQuery} clearMessageLink The DOM element for the button to clear the file upload messages (which inform the
 * user about whether a file was uploaded).
 * @prop {JQuery} content The DOM element for the content of this widget.
 * @prop {number} fileAddIndex Current index where to add files.
 * @prop {string} fileId ID of the current file.
 * @prop {File[]} files List of currently selected files.
 * @prop {JQuery} filesTbody The DOM element for the table tbody with the files.
 * @prop {JQuery} form The DOM element for the form containing this upload widget.
 * @prop {JQuery} messageContainer The DOM element of the container with the file upload messages which inform the user
 * about whether a file was uploaded.
 * @prop {JQuery} messageList The DOM element of the UL list element with the file upload messages which inform the user
 * about whether a file was uploaded.
 * @prop {string} rowActionSelector Selector for the available actions (buttons) of a row.
 * @prop {string} rowCancelActionSelector Selector for the button for canceling a file upload.
 * @prop {string[]} sizes Suffixes for formatting files sizes.
 * @prop {JQueryFileUpload.FileUploadOptions} ucfg Options for the BlueImp jQuery file upload plugin.
 * @prop {JQuery} uploadButton The DOM element for the button for starting the file upload.
 * @prop {number} uploadedFileCount Number of currently uploaded files.
 *
 * @interface {DinarteCoelho.widget.FileUploadCfg} cfg The configuration for the {@link  FileUpload| FileUpload widget}.
 * You can access this configuration via {@link DinarteCoelho.widget.BaseWidget.cfg|BaseWidget.cfg}. Please note that this
 * configuration is usually meant to be read-only and should not be modified.
 * @extends {DinarteCoelho.widget.BaseWidgetCfg} cfg
 *
 * @prop {RegExp} cfg.allowTypes Regular expression for accepted file types.
 * @prop {boolean} cfg.auto When set to true, selecting a file starts the upload process implicitly.
 * @prop {boolean} cfg.dnd Whether drag and drop is enabled.
 * @prop {string} cfg.dropZone Custom drop zone to use for drag and drop.
 * @prop {boolean} cfg.disabled Whether this file upload is disabled.
 * @prop {number} cfg.fileLimit Maximum number of files allowed to upload.
 * @prop {string} cfg.fileLimitMessage Message to display when file limit exceeds.
 * @prop {boolean} cfg.global Global AJAX requests are listened to by `ajaxStatus`. When `false`, `ajaxStatus` will not
 * get triggered.
 * @prop {string} cfg.invalidFileMessage Message to display when file is not accepted.
 * @prop {string} cfg.invalidSizeMessage Message to display when size limit exceeds.
 * @prop {number} cfg.maxFileSize Maximum allowed size in bytes for files.
 * @prop {string} cfg.messageTemplate Message template to use when displaying file validation errors.
 * @prop {DinarteCoelho.widget.FileUpload.OnAddCallback} cfg.onAdd Callback invoked when an uploaded file is added.
 * @prop {DinarteCoelho.widget.FileUpload.OnUploadCallback} cfg.onupload Callback to execute before the files are sent.
 * If this callback returns false, the file upload request is not started.
 * @prop {DinarteCoelho.widget.FileUpload.OnCancelCallback} cfg.oncancel Callback that is invoked when a file upload was
 * canceled.
 * @prop {DinarteCoelho.widget.FileUpload.OnCompleteCallback} cfg.oncomplete Callback that is invoked after a file was
 * uploaded to the server successfully.
 * @prop {DinarteCoelho.widget.FileUpload.OnErrorCallback} cfg.onerror Callback that is invoked when a file could not be
 * uploaded to the server.
 * @prop {DinarteCoelho.widget.FileUpload.OnStartCallback} cfg.onstart Callback that is invoked at the beginning of a file
 * upload, when a file is sent to the server.
 * @prop {number} cfg.previewWidth Width for image previews in pixels.
 * @prop {string} cfg.process Component(s) to process in fileupload request.
 * @prop {boolean} cfg.sequentialUploads `true` to upload files one after each other, `false` to upload in parallel.
 * @prop {string} cfg.update Component(s) to update after fileupload completes.
 * @prop {number} cfg.maxChunkSize To upload large files in smaller chunks, set this option to a preferred maximum chunk
 * size. If set to `0`, `null` or `undefined`, or the browser does not support the required Blob API, files will be
 * uploaded as a whole.
 * @prop {number} cfg.maxRetries Only for chunked file upload: Amount of retries when upload gets interrupted due to
 * e.g. an unstable network connection.
 * @prop {number} cfg.retryTimeout Only for chunked file upload: (Base) timeout in milliseconds to wait until the next
 * retry. It is multiplied with the retry count. (first retry: `retryTimeout * 1`, second retry: `retryTimeout * 2`,
 * ...)
 * @prop {string} cfg.resumeContextPath Server-side path which provides information to resume chunked file upload.
 */
DinarteCoelho.widget.FileUpload = DinarteCoelho.widget.BaseWidget.extend({

    /**
     * Regular expression that matches image files for which a preview can be shown.
     * @type {RegExp}
     */
    IMAGE_TYPES: /(\.|\/)(gif|jpe?g|png)$/i,

    /**
     * @override
     * @inheritdoc
     * @param {DinarteCoelho.PartialWidgetCfg<TCfg>} cfg
     */
    init: function(cfg) {
        this._super(cfg);
        if(this.cfg.disabled) {
            return;
        }

        this.ucfg = {};
        this.form = this.jq.closest('form');
        this.buttonBar = this.jq.children('.ui-fileupload-buttonbar');
        this.dragoverCount = 0;
        this.customDropZone = this.cfg.dropZone !== undefined ? DinarteCoelho.expressions.SearchExpressionFacade.resolveComponentsAsSelector(this.cfg.dropZone) : null;
        this.dropZone = (this.cfg.dnd === false) ? null : this.customDropZone || this.jq;
        this.chooseButton = this.buttonBar.children('.ui-fileupload-choose');
        this.uploadButton = this.buttonBar.children('.ui-fileupload-upload');
        this.cancelButton = this.buttonBar.children('.ui-fileupload-cancel');
        this.content = this.jq.children('.ui-fileupload-content');
        this.filesTbody = this.content.find('> div.ui-fileupload-files > div');
        this.sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        this.files = [];
        this.fileAddIndex = 0;
        this.cfg.invalidFileMessage = this.cfg.invalidFileMessage || 'Tipo de arquivo inválido';
        this.cfg.invalidSizeMessage = this.cfg.invalidSizeMessage || 'Tamanho de arquivo inválido';
        this.cfg.fileLimitMessage = this.cfg.fileLimitMessage || 'Número máximo de arquivos excedido';
        this.cfg.messageTemplate = this.cfg.messageTemplate || '{name} {size}';
        this.cfg.previewWidth = this.cfg.previewWidth || 80;
        this.cfg.maxRetries = this.cfg.maxRetries || 30;
        this.cfg.retryTimeout = this.cfg.retryTimeout || 1000;
        this.cfg.global = (this.cfg.global === true || this.cfg.global === undefined) ? true : false;
        this.uploadedFileCount = 0;
        this.fileId = 0;

        this.renderMessages();

        this.bindEvents();

        var $this = this;

        var parameterPrefix = DinarteCoelho.ajax.Request.extractParameterNamespace(this.form);

        this.ucfg = {
            url: DinarteCoelho.ajax.Utils.getPostUrl(this.form),
            portletForms: DinarteCoelho.ajax.Utils.getPorletForms(this.form, parameterPrefix),
            paramName: this.id,
            dataType: 'xml',
            dropZone: this.dropZone,
            sequentialUploads: this.cfg.sequentialUploads,
            maxChunkSize: this.cfg.maxChunkSize,
            maxRetries: this.cfg.maxRetries,
            retryTimeout: this.cfg.retryTimeout,
            source: $this.id,
            formData: function() {
                return $this.createPostData();
            },
            beforeSend: function(xhr, settings) {
                xhr.setRequestHeader('Faces-Request', 'partial/ajax');
                xhr.pfSettings = settings;
                xhr.pfArgs = {}; // default should be an empty object
                if($this.cfg.global) {
                    $(document).trigger('pfAjaxSend', [xhr, this]);
                }
            },
            start: function(e) {
                if($this.cfg.onstart) {
                    $this.cfg.onstart.call($this);
                }
            },
            add: function(e, data) {
                $this.chooseButton.removeClass('ui-state-hover ui-state-focus');

                if($this.fileAddIndex === 0) {
                    $this.clearMessages();
                }

                if($this.cfg.fileLimit && ($this.uploadedFileCount + $this.files.length + 1) > $this.cfg.fileLimit) {
                    $this.clearMessages();
                    $this.showMessage({
                        summary: $this.cfg.fileLimitMessage
                    });

                    return;
                }

                var file = data.files ? data.files[0] : null;
                if(file) {
                    var validMsg = $this.validate(file);

                    if(validMsg) {
                        $this.showMessage({
                            summary: validMsg,
                            filename: file.name,
                            filesize: file.size
                        });

                        $this.postSelectFile(data);

                        if ($this.cfg.onvalidationfailure) {
                        	$this.cfg.onvalidationfailure({
                                summary: validMsg,
                                filename: file.name,
                                filesize: file.size
                            });
                        }
                    }
                    else {
                        if($this.cfg.onAdd) {
                            $this.cfg.onAdd.call($this, file, function(processedFile) {
                                file = processedFile;
                                data.files[0] = processedFile;
                                $this.addFileToRow(file, data);
                            });
                        }
                        else {
                            $this.addFileToRow(file, data);
                        }
                    }

                    if ($this.cfg.resumeContextPath && $this.cfg.maxChunkSize > 0) {
                        $.getJSON($this.cfg.resumeContextPath, {'X-File-Id': $this.createXFileId(file)}, function (result) {
                            var uploadedBytes = result.uploadedBytes;
                            data.uploadedBytes = uploadedBytes;
                        });
                    }
                }
            },
            send: function(e, data) {
                if(!window.FormData) {
                    for(var i = 0; i < data.files.length; i++) {
                        var file = data.files[i];
                        if(file.row) {
                            file.row.children('.ui-fileupload-progress').find('> .ui-progressbar > .ui-progressbar-value')
                                    .addClass('ui-progressbar-value-legacy')
                                    .css({
                                        width: '100%',
                                        display: 'block'
                                    });
                        }
                    }
                }
            },
            fail: function(e, data) {
                if (data.errorThrown === 'abort') {
                    if ($this.cfg.resumeContextPath && $this.cfg.maxChunkSize > 0) {
                        $.ajax({
                            url: $this.cfg.resumeContextPath + '?' + $.param({'X-File-Id' : $this.createXFileId(data.files[0])}),
                            dataType: 'json',
                            type: 'DELETE'
                        });
                    }

                    if ($this.cfg.oncancel) {
                        $this.cfg.oncancel.call($this);
                    }
                    return;
                }
                if ($this.cfg.resumeContextPath && $this.cfg.maxChunkSize > 0) {
                    if (data.context === undefined) {
                        data.context = $(this);
                    }

                    // jQuery Widget Factory uses "namespace-widgetname" since version 1.10.0:
                    var fu = $(this).data('blueimp-fileupload') || $(this).data('fileupload');
                    var retries = data.context.data('retries') || 0;

                    var retry = function () {
                        $.getJSON($this.cfg.resumeContextPath, {'X-File-Id': $this.createXFileId(data.files[0])})
                            .done(function (result) {
                                var uploadedBytes = result.uploadedBytes;
                                data.uploadedBytes = uploadedBytes;
                                // clear the previous data:
                                data.data = null;
                                data.submit();
                            })
                            .fail(function () {
                                fu._trigger('fail', e, data);
                            });
                    };

                    if (data.errorThrown !== 'abort' &&
                        data.uploadedBytes < data.files[0].size &&
                        retries < fu.options.maxRetries) {
                        retries += 1;
                        data.context.data('retries', retries);
                        window.setTimeout(retry, retries * fu.options.retryTimeout);
                        return;
                    }
                    data.context.removeData('retries');
                }

                if ($this.cfg.onerror) {
                    $this.cfg.onerror.call($this, data.jqXHR, data.textStatus, data.jqXHR.pfArgs);
                }
            },
            progress: function(e, data) {
                if(window.FormData) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);

                    for(var i = 0; i < data.files.length; i++) {
                        var file = data.files[i];
                        if(file.row) {
                            file.row.children('.ui-fileupload-progress').find('> .ui-progressbar > .ui-progressbar-value').css({
                                width: progress + '%',
                                display: 'block'
                            });
                        }
                    }
                }
            },
            done: function(e, data) {
                $this.uploadedFileCount += data.files.length;
                $this.removeFiles(data.files);

                DinarteCoelho.ajax.Response.handle(data.result, data.textStatus, data.jqXHR, null);
            },
            always: function(e, data) {
                if($this.cfg.oncomplete) {
                    $this.cfg.oncomplete.call($this, data.jqXHR.pfArgs, data);
                }
                if($this.cfg.global) {
                    $(document).trigger('pfAjaxComplete');
                }
            },

            chunkbeforesend: function (e, data) {
                var params = $this.createPostData();
                var file = data.files[0];
                params.push({name : 'X-File-Id', value: $this.createXFileId(file)});
                data.formData = params;
            }
        };

        this.jq.fileupload(this.ucfg);
    },

    /**
     * Adds a file selected by the user to this upload widget.
     * @private
     * @param {File} file A file to add.
     * @param {JQueryFileUpload.AddCallbackData} data The data from the selected file.
     */
    addFileToRow: function(file, data) {
        var $this = this,
            row = $('<div class="ui-fileupload-row"></div>')
                .append('<div class="ui-fileupload-preview"></td>')
                .append('<div class="ui-fileupload-filename">' + DinarteCoelho.escapeHTML(file.name) + '</div>')
                .append('<div>' + this.formatSize(file.size) + '</div>')
                .append('<div class="ui-fileupload-progress"></div>')
                .append('<div><button class="ui-fileupload-cancel ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only"><span class="ui-button-icon-left ui-icon ui-icon ui-icon-close"></span><span class="ui-button-text">ui-button</span></button></div>')
                .appendTo(this.filesTbody);

        if(this.filesTbody.children('.ui-fileupload-row').length > 1) {
            $('<div class="ui-widget-content"></div>').prependTo(row);
        }

        //preview
        if(window.File && window.FileReader && $this.IMAGE_TYPES.test(file.name)) {
            var imageCanvas = $('<canvas></canvas>')
                                    .appendTo(row.children('div.ui-fileupload-preview')),
            context = imageCanvas.get(0).getContext('2d'),
            winURL = window.URL||window.webkitURL,
            url = winURL.createObjectURL(file),
            img = new Image();

            img.onload = function() {
                var imgWidth = null, imgHeight = null, scale = 1;

                if($this.cfg.previewWidth > this.width) {
                    imgWidth = this.width;
                }
                else {
                    imgWidth = $this.cfg.previewWidth;
                    scale = $this.cfg.previewWidth / this.width;
                }

                var imgHeight = parseInt(this.height * scale);

                imageCanvas.attr({width:imgWidth, height: imgHeight});
                context.drawImage(img, 0, 0, imgWidth, imgHeight);
            };

            img.src = url;
        }

        //progress
        row.children('div.ui-fileupload-progress')
                .append('<div class="ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="ui-progressbar-value ui-widget-header ui-corner-left" style="display: none; width: 0%;"></div></div>');

        file.row = row;
        file.row.data('fileId', this.fileId++);
        file.row.data('filedata', data);

        this.files.push(file);

        if(this.cfg.auto) {
            this.upload();
        }

        this.postSelectFile(data);
    },

    /**
     * Called after a file was added to this upload widget. Takes care of the UI buttons.
     * @private
     * @param {JQueryFileUpload.AddCallbackData} data Data of the selected file.
     */
    postSelectFile: function(data) {
        if(this.files.length > 0) {
            this.enableButton(this.uploadButton);
            this.enableButton(this.cancelButton);
        }

        this.fileAddIndex++;
        if(this.fileAddIndex === (data.originalFiles.length)) {
            this.fileAddIndex = 0;
        }
    },

    /**
     * Sets up all events listeners for this file upload widget.
     * @private
     */
    bindEvents: function() {
        var $this = this;

        DinarteCoelho.skinButton(this.buttonBar.children('button'));

        var isChooseButtonClick = false;

        this.chooseButton.off('mouseover.fileupload mouseout.fileupload mouseup.fileupload focus.fileupload blur.fileupload mousedown.fileupload click.fileupload keydown.fileupload');
        this.chooseButton.on('mouseover.fileupload', function(){
            var el = $(this);
            if(!el.prop('disabled')) {
                el.addClass('ui-state-hover');
            }
        })
        .on('mouseout.fileupload', function() {
            $(this).removeClass('ui-state-active ui-state-hover');
        })
        .on('mouseup.fileupload', function() {
            $(this).removeClass('ui-state-active').addClass('ui-state-hover');
        })
        .on('focus.fileupload', function() {
            $(this).addClass('ui-state-focus');
        })
        .on('blur.fileupload', function() {
            $(this).removeClass('ui-state-focus');
            isChooseButtonClick = false;
        })
        .on('mousedown.fileupload', function() {
            var el = $(this);
            if(!el.prop('disabled')) {
                el.addClass('ui-state-active').removeClass('ui-state-hover');
            }
        })
        .on('click.fileupload', function(e) {
            $this.show();
        })
        .on('keydown.fileupload', function(e) {
            var keyCode = $.ui.keyCode,
            key = e.which;

            if(key === keyCode.SPACE || key === keyCode.ENTER) {
                $this.show();
                $(this).trigger('blur');
                e.preventDefault();
            }
        });

        this.chooseButton.children('input').off('click.fileupload').on('click.fileupload', function(e){
            if (isChooseButtonClick) {
                isChooseButtonClick = false;
                e.preventDefault();
                e.stopPropagation();
            }
            else {
                isChooseButtonClick = true;
            }
        });

        this.uploadButton.off('click.fileupload').on('click.fileupload', function(e) {
            e.preventDefault();

            // GitHub #6396 allow cancel of upload with callback
            if ($this.cfg.onupload) {
                if ($this.cfg.onupload.call($this) === false) {
                    return false;
                }
            }

            $this.disableButton($this.uploadButton);
            $this.disableButton($this.cancelButton);

            $this.upload();
        });

        this.cancelButton.off('click.fileupload').on('click.fileupload', function(e) {
            $this.clear();
            $this.disableButton($this.uploadButton);
            $this.disableButton($this.cancelButton);

            e.preventDefault();
        });

        this.clearMessageLink.off('click.fileupload').on('click.fileupload', function(e) {
            $this.messageContainer.fadeOut(function() {
                $this.messageList.children().remove();
            });

            e.preventDefault();
        });

        this.rowActionSelector = this.jqId + " .ui-fileupload-files button";
        this.rowCancelActionSelector = this.jqId + " .ui-fileupload-files .ui-fileupload-cancel";
        this.clearMessagesSelector = this.jqId + " .ui-messages .ui-messages-close";

        $(document).off('mouseover.fileupload mouseout.fileupload mousedown.fileupload mouseup.fileupload focus.fileupload blur.fileupload click.fileupload ', this.rowCancelActionSelector)
                .on('mouseover.fileupload', this.rowCancelActionSelector, null, function(e) {
                    $(this).addClass('ui-state-hover');
                })
                .on('mouseout.fileupload', this.rowCancelActionSelector, null, function(e) {
                    $(this).removeClass('ui-state-hover ui-state-active');
                })
                .on('mousedown.fileupload', this.rowCancelActionSelector, null, function(e) {
                    $(this).addClass('ui-state-active').removeClass('ui-state-hover');
                })
                .on('mouseup.fileupload', this.rowCancelActionSelector, null, function(e) {
                    $(this).addClass('ui-state-hover').removeClass('ui-state-active');
                })
                .on('focus.fileupload', this.rowCancelActionSelector, null, function(e) {
                    $(this).addClass('ui-state-focus');
                })
                .on('blur.fileupload', this.rowCancelActionSelector, null, function(e) {
                    $(this).removeClass('ui-state-focus');
                })
                .on('click.fileupload', this.rowCancelActionSelector, null, function(e) {
                    var row = $(this).closest('.ui-fileupload-row');
                    var removedFile = $.grep($this.files, function (value) {
                         return (value.row.data('fileId') === row.data('fileId'));
                    });

                    if (removedFile[0]) {
                        if (removedFile[0].ajaxRequest) {
                            removedFile[0].ajaxRequest.abort();
                        }

                        $this.removeFile(removedFile[0]);

                        if ($this.files.length === 0) {
                            $this.disableButton($this.uploadButton);
                            $this.disableButton($this.cancelButton);
                        }
                    }

                    e.preventDefault();
                });

        if (this.dropZone) {
            this.dropZone
                    .off('dragover.fucdropzone dragenter.fucdropzone dragleave.fucdropzone drop.fucdropzone dragdrop.fucdropzone')
                    .on('dragover.fucdropzone', function(e){
                        e.preventDefault();
                    })
                    .on('dragenter.fucdropzone', function(e){
                        e.preventDefault();
                        $this.dragoverCount++;
                        $this.dropZone.addClass('ui-state-drag');
                    })
                    .on('dragleave.fucdropzone', function(e){
                        $this.dragoverCount--;
                        if ($this.dragoverCount === 0) {
                            $this.dropZone.removeClass('ui-state-drag');
                        }
                    })
                    .on('drop.fucdropzone dragdrop.fucdropzone', function(e){
                        $this.dragoverCount = 0;
                        $this.dropZone.removeClass('ui-state-drag');
                    });
        }
    },

    /**
     * Uploads the selected files to the server.
     * @private
     */
    upload: function() {
        if(this.cfg.global) {
            $(document).trigger('pfAjaxStart');
        }

        for(var i = 0; i < this.files.length; i++) {
            this.files[i].ajaxRequest = this.files[i].row.data('filedata');
            this.files[i].ajaxRequest.submit();
        }
    },

    /**
     * Creates the HTML post data for uploading the selected files.
     * @private
     * @return {DinarteCoelho.ajax.RequestParameter} Parameters to post when upload the files.
     */
    createPostData: function() {
        var process = this.cfg.process ? this.id + ' ' + DinarteCoelho.expressions.SearchExpressionFacade.resolveComponents(this.cfg.process).join(' ') : this.id;
        var params = this.form.serializeArray();

        var parameterPrefix = DinarteCoelho.ajax.Request.extractParameterNamespace(this.form);

        DinarteCoelho.ajax.Request.addParam(params, DinarteCoelho.PARTIAL_REQUEST_PARAM, true, parameterPrefix);
        DinarteCoelho.ajax.Request.addParam(params, DinarteCoelho.PARTIAL_PROCESS_PARAM, process, parameterPrefix);
        DinarteCoelho.ajax.Request.addParam(params, DinarteCoelho.PARTIAL_SOURCE_PARAM, this.id, parameterPrefix);

        if (this.cfg.update) {
            var update = DinarteCoelho.expressions.SearchExpressionFacade.resolveComponents(this.cfg.update).join(' ');
            DinarteCoelho.ajax.Request.addParam(params, DinarteCoelho.PARTIAL_UPDATE_PARAM, update, parameterPrefix);
        }

        return params;
    },


    /**
     * Creates a unique identifier (file key) for a given file. That identifier consists e.g. of the name of the
     * uploaded file, its last modified-attribute etc. This is used by the server to identify uploaded files.
     * @private
     * @param {File} file A file for which to create an identifier.
     * @return {string} An identifier for the given file.
     */
    createXFileId: function(file) {
      return [file.name, file.lastModified, file.type, file.size].join();
    },

    /**
     * Formats the given file size in a more human-friendly format, e.g. `1.5 MB` etc.
     * @param {number} bytes File size in bytes to format
     * @return {string} The given file size, formatted in a more human-friendly format.
     */
    formatSize: function(bytes) {
        if(bytes === undefined)
            return '';

        if (bytes === 0)
            return 'N/A';

        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        if (i === 0)
            return bytes + ' ' + this.sizes[i];
        else
            return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + this.sizes[i];
    },

    /**
     * Removes the given uploaded file from this upload widget.
     * @private
     * @param {DinarteCoelho.widget.FileUpload.UploadFile[]} files Files to remove from this widget.
     */
    removeFiles: function(files) {
        for (var i = 0; i < files.length; i++) {
            this.removeFile(files[i]);
        }
    },

    /**
     * Removes the given uploaded file from this upload widget.
     * @private
     * @param {DinarteCoelho.widget.FileUpload.UploadFile} file File to remove from this widget.
     */
    removeFile: function(file) {
        var $this = this;

        this.files = $.grep(this.files, function(value) {
            return (value.row.data('fileId') === file.row.data('fileId'));
        }, true);

        $this.removeFileRow(file.row);
        file.row = null;
    },

    /**
     * Removes a row with an uploaded file form this upload widget.
     * @private
     * @param {JQuery} row Row of an uploaded file to remove.
     */
    removeFileRow: function(row) {
        if(row) {
            this.disableButton(row.find('> div:last-child').children('.ui-fileupload-cancel'));

            row.fadeOut(function() {
                $(this).remove();
            });
        }
    },

    /**
     * Clears this file upload field, i.e. removes all uploaded files.
     */
    clear: function() {
        for (var i = 0; i < this.files.length; i++) {
            this.removeFileRow(this.files[i].row);
            this.files[i].row = null;
        }

        this.clearMessages();

        this.files = [];
    },

    /**
     * Validates the given file against the current validation settings
     * @private
     * @param {File} file Uploaded file to validate.
     * @return {string | null} `null` if the given file is valid, or an error message otherwise.
     */
    validate: function(file) {
        if (this.cfg.allowTypes && !(this.cfg.allowTypes.test(file.type) || this.cfg.allowTypes.test(file.name))) {
            return this.cfg.invalidFileMessage;
        }

        if (this.cfg.maxFileSize && file.size > this.cfg.maxFileSize) {
            return this.cfg.invalidSizeMessage;
        }

        return null;
    },

    /**
     * Displays the current error messages on this widget.
     * @private
     */
    renderMessages: function() {
        var markup = '<div class="ui-messages ui-widget ui-helper-hidden ui-fileupload-messages"><div class="ui-messages-error ui-corner-all">' +
                '<a class="ui-messages-close" href="#"><span class="ui-icon ui-icon-close"></span></a>' +
                '<span class="ui-messages-error-icon"></span>' +
                '<ul></ul>' +
                '</div></div>';

        this.messageContainer = $(markup).prependTo(this.content);
        this.messageList = this.messageContainer.find('> .ui-messages-error > ul');
        this.clearMessageLink = this.messageContainer.find('> .ui-messages-error > a.ui-messages-close');
    },

    /**
     * Removes all error messages that are shown for this widget.
     */
    clearMessages: function() {
        this.messageContainer.hide();
        this.messageList.children().remove();
    },

    /**
     * Shows the given error message
     * @param {DinarteCoelho.widget.FileUpload.UploadMessage} msg Error message to show.
     * @private
     */
    showMessage: function(msg) {
        var summary = msg.summary,
        detail = '';

        if(msg.filename && msg.filesize) {
            detail = this.cfg.messageTemplate.replace('{name}', msg.filename).replace('{size}', this.formatSize(msg.filesize));
        }

        this.messageList.append('<li><span class="ui-messages-error-summary">' + DinarteCoelho.escapeHTML(summary) + '</span><span class="ui-messages-error-detail">' + DinarteCoelho.escapeHTML(detail) + '</span></li>');
        this.messageContainer.show();
    },

    /**
     * Disabled the given file upload button.
     * @param {JQuery} btn Button to disabled.
     * @private
     */
    disableButton: function(btn) {
        btn.prop('disabled', true).attr('aria-disabled', true).addClass('ui-state-disabled').removeClass('ui-state-hover ui-state-active ui-state-focus');
    },

    /**
     * Enables the given file upload button.
     * @param {JQuery} btn Button to enable.
     * @private
     */
    enableButton: function(btn) {
        btn.prop('disabled', false).attr('aria-disabled', false).removeClass('ui-state-disabled');
    },

    /**
     * Brings up the native file selection dialog.
     */
    show: function() {
        this.chooseButton.children('input').trigger('click');
    }
});

/**
 * __DinarteCoelho Simple FileUpload Widget__
 *
 * @prop {JQuery} button The DOM element for the button for selecting a file.
 * @prop {JQuery} display The DOM element for the UI display.
 * @prop {JQuery} form The DOM element of the (closest) form that contains this file upload.
 * @prop {JQuery} input The DOM element for the file input element.
 * @prop {number} maxFileSize Maximum allowed size in bytes for files.
 * @prop {string[]} sizes Array with suffixes for file sizes (`Bytes`, `KB` etc.).
 *
 * @interface {DinarteCoelho.widget.SimpleFileUploadCfg} cfg The configuration for the
 * {@link  SimpleFileUpload| SimpleFileUpload widget}.
 * You can access this configuration via {@link DinarteCoelho.widget.BaseWidget.cfg|BaseWidget.cfg}. Please note that this
 * configuration is usually meant to be read-only and should not be modified.
 * @extends {DinarteCoelho.widget.BaseWidgetCfg} cfg
 *
 * @prop {boolean} cfg.disabled Whether this file upload is disabled.
 * @prop {number} cfg.fileLimit Maximum number of files allowed to upload.
 * @prop {string} cfg.fileLimitMessage Message to display when file limit exceeds.
 * @prop {boolean} cfg.global Global AJAX requests are listened to by `ajaxStatus`. When `false`, `ajaxStatus` will not
 * get triggered.
 * @prop {string} cfg.invalidFileMessage Message to display when file is not accepted.
 * @prop {string} cfg.invalidSizeMessage Message to display when size limit exceeds.
 * @prop {number} cfg.maxFileSize Maximum allowed size in bytes for files.
 * @prop {string} cfg.messageTemplate Message template to use when displaying file validation errors.
 * @prop {boolean} cfg.skinSimple Whether to apply theming to the simple upload widget.
 */
DinarteCoelho.widget.SimpleFileUpload = DinarteCoelho.widget.BaseWidget.extend({

    /**
     * @override
     * @inheritdoc
     * @param {DinarteCoelho.PartialWidgetCfg<TCfg>} cfg
     */
    init: function(cfg) {
        this._super(cfg);
        if(this.cfg.disabled) {
            return;
        }

        this.cfg.invalidFileMessage = this.cfg.invalidFileMessage || 'Tipo de arquivo inválido';
        this.cfg.invalidSizeMessage = this.cfg.invalidSizeMessage || 'Tamanho de arquivo inválido';
        this.cfg.fileLimitMessage = this.cfg.fileLimitMessage || 'Número máximo de arquivos excedido';
        this.cfg.messageTemplate = this.cfg.messageTemplate || '{name} {size}';
        this.cfg.global = (this.cfg.global === true || this.cfg.global === undefined) ? true : false;
        this.sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];

        this.maxFileSize = this.cfg.maxFileSize;
        this.form = this.jq.closest('form');
        this.input = $(this.jqId);

        if (this.cfg.skinSimple) {
            this.input = $(this.jqId + '_input');
            this.button = this.jq.children('.ui-button');
            this.display = this.jq.children('.ui-fileupload-filename');

            if (!this.input.prop('disabled')) {
                this.bindEvents();
            }
        }
        else if (this.cfg.auto) {
            var $this = this;
            this.input.on('change.fileupload', function() {
                $this.upload();
            });
        }
    },

    /**
     * Sets up all events listeners for this file upload widget.
     * @private
     */
    bindEvents: function() {
        var $this = this;

        this.button.on('mouseover.fileupload', function(){
            var el = $(this);
            if (!el.prop('disabled')) {
                el.addClass('ui-state-hover');
            }
        })
        .on('mouseout.fileupload', function() {
            $(this).removeClass('ui-state-active ui-state-hover');
        })
        .on('mousedown.fileupload', function() {
            var el = $(this);
            if (!el.prop('disabled')) {
                el.addClass('ui-state-active').removeClass('ui-state-hover');
            }
        })
        .on('mouseup.fileupload', function() {
            $(this).removeClass('ui-state-active').addClass('ui-state-hover');
        });

        this.input.on('change.fileupload', function() {
            var files = $this.input[0].files;
            if (files) {
            	var validationFailureMessage;
            	var validationFileName;
            	var validationFileSize;
            	if (files.length > $this.cfg.fileLimit) {
            		validationFailureMessage = $this.cfg.fileLimitMessage;
            		validationFileName = null;
            		validationFileSize = null;
            	}
            	// checking each file until find a violation
            	var i = 0;
            	for(; !validationFailureMessage && i < files.length; ++i) {
                    var file = files[i];
                    var validMsg = $this.validate(file);
                    if (validMsg) {
                    	validationFailureMessage = validMsg;
                    	validationFileName = file.name;
                		validationFileSize = file.size;
                    }
            	}

                if(validationFailureMessage) {
                    //a violation was found. Display the respective message, clear the input and
                    // call the validation failure handler if exists
                    var details = '';
                    if (validationFileName && validationFileSize) {
                            details += ': ' + $this.cfg.messageTemplate.replace('{name}', validationFileName).replace('{size}', $this.formatSize(validationFileSize));
                    }
                    $this.display.text(validationFailureMessage + details);
                    $this.input.val('');

                    if ($this.cfg.onvalidationfailure) {
                    	$this.cfg.onvalidationfailure({
                            summary: validationFailureMessage,
                            filename: validationFileName,
                            filesize: validationFileSize
                        });
                    }
                } else {
                    // If everything is ok, format the message and display it
                    var toDisplay = $this.cfg.messageTemplate.replace('{name}', files[0].name).replace('{size}', $this.formatSize(files[0].size));

                    if (files.length > 1) {
                            toDisplay = toDisplay + " + " + (files.length - 1);
                    }
                    $this.display.text(toDisplay);
                }

                if ($this.cfg.auto) {
                    $this.upload();
                }
            } else {
            	// no data was found so clear the input
            	$this.input.val('');
            }
        })
        .on('focus.fileupload', function() {
            $this.button.addClass('ui-state-focus');
        })
        .on('blur.fileupload', function() {
            $this.button.removeClass('ui-state-focus');
        });

    },

    /**
     * Validates the given file against the current validation settings
     * @private
     * @param {File} file Uploaded file to validate.
     * @return {string | null} `null` if the given file is valid, or an error message otherwise.
     */
    validate: function(file) {
        if (this.cfg.allowTypes && !(this.cfg.allowTypes.test(file.type) || this.cfg.allowTypes.test(file.name))) {
            return this.cfg.invalidFileMessage;
        }

        if (this.cfg.maxFileSize && file.size > this.cfg.maxFileSize) {
            return this.cfg.invalidSizeMessage;
        }

        return null;
    },

    /**
     * Formats the given file size in a more human-friendly format, e.g. `1.5 MB` etc.
     * @param {number} bytes File size in bytes to format
     * @return {string} The given file size, formatted in a more human-friendly format.
     */
    formatSize: function(bytes) {
        if (bytes === undefined)
            return '';

        if (bytes === 0)
            return 'N/A';

        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        if (i === 0)
            return bytes + ' ' + this.sizes[i];
        else
            return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + this.sizes[i];
    },

    /**
     * Brings up the native file selection dialog.
     */
    show: function() {
        if (this.cfg.skinSimple) {
            this.input.trigger("click");
        }
        else {
            this.jq.trigger("click");
        }
    },

    /**
     * Uploads all selected files via AJAX.
     * @private
     */
    upload: function() {

        var $this = this,
            files = this.input[0].files;
        var parameterPrefix = DinarteCoelho.ajax.Request.extractParameterNamespace(this.form);
        var process = this.cfg.process ? this.id + ' ' + DinarteCoelho.expressions.SearchExpressionFacade.resolveComponents(this.cfg.process).join(' ') : this.id;
        var update = this.cfg.update ? DinarteCoelho.expressions.SearchExpressionFacade.resolveComponents(this.cfg.update).join(' ') : null;
        var formData = DinarteCoelho.ajax.Request.createFacesAjaxFormData(this.form, parameterPrefix, this.id, process, update);

        if($this.cfg.global) {
            $(document).trigger('pfAjaxStart');
        }

        // append files
        for (var i = 0; i < files.length; i++) {
            formData.append(this.input.attr('id'), files[i]);
        }

        var xhrOptions = {
            url: DinarteCoelho.ajax.Utils.getPostUrl(this.form),
            portletForms: DinarteCoelho.ajax.Utils.getPorletForms(this.form, parameterPrefix),
            type : "POST",
            cache : false,
            dataType : "xml",
            data: formData,
            processData: false,
            contentType: false,
            global: false,
            beforeSend: function(xhr, settings) {
                xhr.setRequestHeader('Faces-Request', 'partial/ajax');
                xhr.pfSettings = settings;
                xhr.pfArgs = {}; // default should be an empty object
                if($this.cfg.global) {
                     $(document).trigger('pfAjaxSend', [xhr, this]);
                }
            }
        };

        var jqXhr = $.ajax(xhrOptions)
            .fail(function(xhr, status, errorThrown) {
                var location = xhr.getResponseHeader("Location");
                if (xhr.status === 401 && location) {
                    DinarteCoelho.debug('Unauthorized status received. Redirecting to ' + location);
                    window.location = location;
                    return;
                }
                if($this.cfg.onerror) {
                    $this.cfg.onerror.call(this, xhr, status, errorThrown);
                }

                DinarteCoelho.error('Request return with error:' + status + '.');
            })
            .done(function(data, status, xhr) {
                DinarteCoelho.debug('Response received successfully.');
                try {
                    var parsed;

                    //call user callback
                    if($this.cfg.onsuccess) {
                        parsed = $this.cfg.onsuccess.call(this, data, status, xhr);
                    }

                    //do not execute default handler as response already has been parsed
                    if(parsed) {
                        return;
                    }
                    else {
                        DinarteCoelho.ajax.Response.handle(data, status, xhr);
                    }
                }
                catch(err) {
                    DinarteCoelho.error(err);
                }

                DinarteCoelho.debug('DOM is updated.');
            })
            .always(function(data, status, xhr) {
                if($this.cfg.oncomplete) {
                    $this.cfg.oncomplete.call(this, xhr, status, xhr.pfArgs, data);
                }

                DinarteCoelho.debug('Response completed.');

                if ($this.display) {
                    $this.display.text('');
                }
                $this.input.val('');

                if($this.cfg.global) {
                    $(document).trigger('pfAjaxComplete', [xhr, this]);
                }
            });

        DinarteCoelho.ajax.Queue.addXHR(jqXhr);

    }

});

