<?php include('header.php'); ?>
  <style>
    .content-wrapper {background: #2d2e47 !important;}
    .p-5 {padding: 1rem !important;}
    .content-wrapper {padding: 1.75rem 1.25rem !important;}
    .auth .brand-logo {margin-bottom: -1rem !important;}
    @media only screen and (max-width: 600px) {
        .row_mob{margin-top: -160px !important;}
    }
  </style>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow row_mob">
            <div class="col-lg-6 mx-auto">
                <div class="auth-form-light text-center p-5">
                    <p style="margin: 0;font-size: 20px;color: #2d2f47;"><?php print_r($frase[0]->frase);?></p>
                </div>
                <br>
                <div class="auth-form-light text-center p-5">
                    <div class="brand-logo">
                        <img src="<?=base_url(); ?>assets/img/logo.png">
                    </div><br><br>
                    <form class="pt-3">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="pass" class="form-control form-control-lg" id="pass" placeholder="Password">
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" style="width: 100%;" id="submit">Entrar</button>
                        </div>
                        <div class="my-3 justify-content-between align-items-center">
                            <div style="display: none;margin-top: 20px;" class="alert alert-danger" id="msg_alert" role="alert">
                            E-mail ou senha estão errados!
                            </div>
                        </div>

                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?=base_url(); ?>dash/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/off-canvas.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/hoverable-collapse.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/misc.js"></script>
    <script>
    $(document).ready(function() {

      $('#submit').click(function() {
        event.preventDefault();
        ajax_call();
      });

      function ajax_call() {
        var email = $('#email').val();
        var pass = $('#pass').val();

        $.ajax({
          type: "POST",
          data: {
            email: email,
            pass: pass
          },
          url: "<?php echo base_url(); ?>admin/Login/log",
          dataType: "JSON",
          beforeSend: function() {
            // Show image container
            $("#loader").show();
          },
          success: function(result) {
            console.log(result.data);
            $.each(result.data, function(i) {
              console.log(result.data[i].logado);
              if (result.data[i].logado === 'sim') {
                window.location.href = "<?php echo base_url() ?>admin/dashboard";
              } else {
                $('#msg_alert').css('display', 'block');
              }
            })
          },
          complete: function(data) {
            // Hide image container
            $("#loader").hide();
          }
        });
      }
    });
  </script>
  </body>
</html>