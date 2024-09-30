<?php

ini_set('display_errors',0);
ini_set('display_startup_erros',0);
error_reporting(E_ALL);

?>
<?php include('header.php'); 
// print_r($haste);exit;
if($haste == 0){
    $haste = (!isset($_GET['haste']) || $_GET['haste'] == '' ? 0 : $_GET['haste']);
}
if($numeracao == 0){
    $numeracao = (!isset($_GET['numeracao']) || $_GET['numeracao'] == '' ? 0 : $_GET['numeracao']);
}

?>

<style>
    /* Reset */
        html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp, small, strong, sub, sup, var, b, i, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary, time, mark, audio, video { margin: 0; padding: 0; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; }

        article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; }

        blockquote, q { quotes: none; }
        blockquote:before, blockquote:after, q:before, q:after { content: ""; content: none; }
        ins { background-color: #ff9; color: #000; text-decoration: none; }
        mark { background-color: #ff9; color: #000; font-style: italic; font-weight: bold; }
        del { text-decoration: line-through; }
        abbr[title], dfn[title] { border-bottom: 1px dotted; cursor: help; }
        table { border-collapse: collapse; border-spacing: 0; }
        hr { display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; }
        input, select { vertical-align: middle; }

        body { font:13px/1.231 sans-serif; *font-size:small; } /* Hack retained to preserve specificity */
        select, input, textarea, button { font:99% sans-serif; }
        pre, code, kbd, samp { font-family: monospace, sans-serif; }


        body { background: #EEE; color: #444; line-height: 1.4em; }

        header h1 { color: black; font-size: 2em; line-height: 1.1em; display: inline-block; height: 27px; margin: 20px 0 25px; }
        header h1 small { font-size: 0.6em; }

        div#content { background: white; border: 1px solid #ccc; border-width: 0 1px 1px; margin: 0 auto; padding: 40px 50px 40px; width: 738px; }

        footer { color: #999; padding-top: 40px; font-size: 0.8em; text-align: center; }

        body { font-family: sans-serif; font-size: 1em; }

        p { margin: 0 0 .7em; max-width: 700px; }
        table+p { margin-top: 1em; }

        h2 { border-bottom: 1px solid #ccc; font-size: 1.2em; margin: 3em 0 1em 0; font-weight: bold;}
        h3 { font-weight: bold; }

        h2.intro { border-bottom: none; font-size: 1em; font-weight: normal; margin-top:0; }

        ul li { list-style: disc; margin-left: 1em; margin-bottom: 1.25em; }
        ol li { margin-left: 1.25em; }
        ol ul, ul ul { margin: .25em 0 0; }
        ol ul li, ul ul li { list-style-type: circle; margin: 0 0 .25em 1em; }

        li > p { margin-top: .25em; }

        div.side-by-side { width: 100%; margin-bottom: 1em; }
        div.side-by-side > div { float: left; width: 49%; }
        div.side-by-side > div > em { margin-bottom: 10px; display: block; }

        .faqs em { display: block; }

        .clearfix:after {
        content: "\0020";
        display: block;
        height: 0;
        clear: both;
        overflow: hidden;
        visibility: hidden;
        }

        a { color: #F36C00; outline: none; text-decoration: none; }
        a:hover { text-decoration: underline; }

        ul.credits li { margin-bottom: .25em; }

        strong { font-weight: bold; }
        i { font-style: italic; }

        .button {
        background: #fafafa;
        background: -webkit-linear-gradient(top, #ffffff, #eeeeee);
        background: -moz-linear-gradient(top, #ffffff, #eeeeee);
        background: -o-linear-gradient(top, #ffffff, #eeeeee);
        background: linear-gradient(to bottom, #ffffff, #eeeeee);
        border: 1px solid #bbbbbb;
        border-radius: 4px;
        box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.2);
        color: #555555;
        cursor: pointer;
        display: inline-block;
        font-family: "Helvetica Neue", Arial, Verdana, "Nimbus Sans L", sans-serif;
        font-size: 13px;
        font-weight: 500;
        height: 31px;
        line-height: 28px;
        outline: none;
        padding: 0 13px;
        text-shadow: 0 1px 0 white;
        text-decoration: none;
        vertical-align: middle;
        white-space: nowrap;
        -webkit-font-smoothing: antialiased;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        }

        .button-blue {
        background: #1385e5;
        background: -webkit-linear-gradient(top, #53b2fc, #1385e5);
        background: -moz-linear-gradient(top, #53b2fc, #1385e5);
        background: -o-linear-gradient(top, #53b2fc, #1385e5);
        background: linear-gradient(to bottom, #53b2fc, #1385e5);
        border-color: #075fa9;
        color: white;
        font-weight: bold;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
        }


        /* Tweak navbar brand link to be super sleek
        -------------------------------------------------- */
        .oss-bar {
        top: 0;
        right: 20px;
        position: fixed;
        z-index: 1030;
        }
        .oss-bar ul {
        float: right;
        margin: 0;
        list-style: none;
        }
        .oss-bar ul li {
        list-style: none;
        float: left;
        line-height: 0;
        margin: 0;
        }
        .oss-bar ul li a {
        -moz-box-sizing:    border-box;
        -webkit-box-sizing: border-box;
        -ms-box-sizing:     border-box;
        box-sizing:        border-box;
        border: 0;
        margin-top: -10px;
        display: block;
        height: 58px;
        background: #F36C00 url(oss-credit.png) no-repeat 20px 22px;
        padding: 22px 20px 12px 20px;
        text-indent: 120%; /* stupid padding */
        white-space: nowrap;
        overflow: hidden;
        -webkit-transition: all 0.10s ease-in-out;
        -moz-transition: all 0.10s ease-in-out;
        transition: all 0.15s ease-in-out;
        }
        .oss-bar ul li a:hover {
        margin-top: 0px;
        }
        .oss-bar a.harvest {
        width: 196px;
        background-color: #F36C00;
        background-position: -142px 22px;
        padding-right: 22px; /* optical illusion */
        }
        .oss-bar a.fork {
        width: 162px;
        background-color: #333333;
        }

        .docs-table th, .docs-table td {
        border: 1px solid #000;
        padding: 4px 6px;
        white-space: nowrap;
        }

        .docs-table td:last-child {
        white-space: normal;
        }

        .docs-table th {
        font-weight: bold;
        text-align: left;
        }

        #content pre[class*=language-] {
        font-size: 14px;
        margin-bottom: 20px;
        }

        #content pre[class*=language-] code {
        font-size: 14px;
        padding: 0;
        }

        #content code[class*=language-] {
        font-size: 12px;
        padding: 2px 4px;
        }

        .anchor {
        color: inherit;
        position: relative;
        }

        .anchor:hover {
        background: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSI3Ij48ZyBmaWxsPSIjNDE0MDQyIj48cGF0aCBkPSJNOS44IDdoLS45bC0uOS0uMWMtLjctLjMtMS40LS43LTEuOC0xLjMtLjItLjEtLjMtLjMtLjMtLjVsLS4zLS40Yy0uMS0uNC0uMi0uOC0uMi0xLjIgMC0uNC4xLS44LjItMS4yaDEuN2MtLjMuNC0uNC44LS40IDEuMiAwIC40LjEuOC4zIDEuMS4xLjIuMi4zLjQuNC4xLjEuMi4yLjQuMy4zLjIuNy4zIDEgLjNoMy40YzEuMiAwIDIuMi0uOSAyLjItMi4xcy0xLTIuMS0yLjItMi4xaC0xLjRjLS4zLS42LS43LTEtMS4yLTEuNGgyLjZjMiAwIDMuNiAxLjYgMy42IDMuNXMtMS42IDMuNS0zLjYgMy41aC0yLjZ6TTguNCAyYy0uMS0uMS0uMi0uMy0uNC0uMy0uMy0uMi0uNy0uMy0xLS4zaC0zLjRjLTEuMiAwLTIuMi45LTIuMiAyLjEgMCAxLjIgMSAyLjEgMi4yIDIuMWgxLjRjLjMuNS43IDEgMS4yIDEuNGgtMi42Yy0yIDAtMy42LTEuNi0zLjYtMy41czEuNi0zLjUgMy42LTMuNWgzLjUwMDAwMDAwMDAwMDAwMDRsLjkuMWMuNy4yIDEuNC43IDEuOCAxLjMuMS4xLjIuMy4zLjUuMS4xLjIuMy4yLjUuMS40LjIuOC4yIDEuMiAwIC40LS4xLjgtLjIgMS4yaC0xLjZjLjMtLjUuNC0uOS40LTEuM3MtLjEtLjgtLjMtMS4xYy0uMS0uMi0uMi0uMy0uNC0uNHoiLz48L2c+PC9zdmc+) 0 50% no-repeat;
        background-size: 21px 9px;
        margin-left: -27px;
        padding-left: 27px;
        text-decoration: none;
        }

        .select,
        .chosen-select,
        .chosen-select-no-single,
        .chosen-select-no-results,
        .chosen-select-deselect,
        .chosen-select-rtl,
        .chosen-select-width {
        width: 350px;
        }

        .jquery-version-refer {
        margin-top: 40px;
        font-style: italic;
        }
        /**
        * okaidia theme for JavaScript, CSS and HTML
        * Loosely based on Monokai textmate theme by http://www.monokai.nl/
        * @author ocodia
        */

        code[class*="language-"],
        pre[class*="language-"] {
            color: #f8f8f2;
            text-shadow: 0 1px rgba(0,0,0,0.3);
            font-family: Consolas, Monaco, 'Andale Mono', monospace;
            direction: ltr;
            text-align: left;
            white-space: pre;
            word-spacing: normal;
            
            -moz-tab-size: 4;
            -o-tab-size: 4;
            tab-size: 4;
            
            -webkit-hyphens: none;
            -moz-hyphens: none;
            -ms-hyphens: none;
            hyphens: none;
        }

        /* Code blocks */
        pre[class*="language-"] {
            padding: 1em;
            margin: .5em 0;
            overflow: auto;	
            border-radius: 0.3em;
        }

        :not(pre) > code[class*="language-"],
        pre[class*="language-"] {
            background: #272822;
        }

        /* Inline code */
        :not(pre) > code[class*="language-"] {
            padding: .1em;
            border-radius: .3em;
        }

        .token.comment,
        .token.prolog,
        .token.doctype,
        .token.cdata {
            color: slategray;
        }

        .token.punctuation {
            color: #f8f8f2;
        }

        .namespace {
            opacity: .7;
        }

        .token.property,
        .token.tag {
            color: #f92672;
        }

        .token.boolean,
        .token.number{
            color: #ae81ff;
        }

        .token.selector,
        .token.attr-name,
        .token.string {
            color: #a6e22e;
        }


        .token.operator,
        .token.entity,
        .token.url,
        .language-css .token.string,
        .style .token.string {
            color: #f8f8f2;
        }

        .token.atrule,
        .token.attr-value
        {
            color: #e6db74;
        }


        .token.keyword{
        color: #66d9ef;
        }

        .token.regex,
        .token.important {
            color: #fd971f;
        }

        .token.important {
            font-weight: bold;
        }

        .token.entity {
            cursor: help;
        }
        /*!
        Chosen, a Select Box Enhancer for jQuery and Prototype
        by Patrick Filler for Harvest, http://getharvest.com

        Version 1.8.7
        Full source at https://github.com/harvesthq/chosen
        Copyright (c) 2011-2018 Harvest http://getharvest.com

        MIT License, https://github.com/harvesthq/chosen/blob/master/LICENSE.md
        This file is generated by `grunt build`, do not edit it by hand.
        */

        /* @group Base */
        .chosen-container {
        position: relative;
        display: inline-block;
        vertical-align: middle;
        font-size: 13px;
        -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
                user-select: none;
        }

        .chosen-container * {
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
        }

        .chosen-container .chosen-drop {
        position: absolute;
        top: 100%;
        z-index: 1010;
        width: 100%;
        border: 1px solid #aaa;
        border-top: 0;
        background: #fff;
        -webkit-box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);
                box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);
        clip: rect(0, 0, 0, 0);
        -webkit-clip-path: inset(100% 100%);
                clip-path: inset(100% 100%);
        }

        .chosen-container.chosen-with-drop .chosen-drop {
        clip: auto;
        -webkit-clip-path: none;
                clip-path: none;
        }

        .chosen-container a {
        cursor: pointer;
        }

        .chosen-container .search-choice .group-name, .chosen-container .chosen-single .group-name {
        margin-right: 4px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        font-weight: normal;
        color: #999999;
        }

        .chosen-container .search-choice .group-name:after, .chosen-container .chosen-single .group-name:after {
        content: ":";
        padding-left: 2px;
        vertical-align: top;
        }

        /* @end */
        /* @group Single Chosen */
        .chosen-container-single .chosen-single {
        position: relative;
        display: block;
        overflow: hidden;
        padding: 0 0 0 8px;
        height: 25px;
        border: 1px solid #aaa;
        border-radius: 5px;
        background-color: #fff;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(20%, #fff), color-stop(50%, #f6f6f6), color-stop(52%, #eee), to(#f4f4f4));
        background: linear-gradient(#fff 20%, #f6f6f6 50%, #eee 52%, #f4f4f4 100%);
        background-clip: padding-box;
        -webkit-box-shadow: 0 0 3px #fff inset, 0 1px 1px rgba(0, 0, 0, 0.1);
                box-shadow: 0 0 3px #fff inset, 0 1px 1px rgba(0, 0, 0, 0.1);
        color: #444;
        text-decoration: none;
        white-space: nowrap;
        line-height: 24px;
        }

        .chosen-container-single .chosen-default {
        color: #999;
        }

        .chosen-container-single .chosen-single span {
        display: block;
        overflow: hidden;
        margin-right: 26px;
        text-overflow: ellipsis;
        white-space: nowrap;
        }

        .chosen-container-single .chosen-single-with-deselect span {
        margin-right: 38px;
        }

        .chosen-container-single .chosen-single abbr {
        position: absolute;
        top: 6px;
        right: 26px;
        display: block;
        width: 12px;
        height: 12px;
        background: url("chosen-sprite.png") -42px 1px no-repeat;
        font-size: 1px;
        }

        .chosen-container-single .chosen-single abbr:hover {
        background-position: -42px -10px;
        }

        .chosen-container-single.chosen-disabled .chosen-single abbr:hover {
        background-position: -42px -10px;
        }

        .chosen-container-single .chosen-single div {
        position: absolute;
        top: 0;
        right: 0;
        display: block;
        width: 18px;
        height: 100%;
        }

        .chosen-container-single .chosen-single div b {
        display: block;
        width: 100%;
        height: 100%;
        background: url("chosen-sprite.png") no-repeat 0px 2px;
        }

        .chosen-container-single .chosen-search {
        position: relative;
        z-index: 1010;
        margin: 0;
        padding: 3px 4px;
        white-space: nowrap;
        }

        .chosen-container-single .chosen-search input[type="text"] {
        margin: 1px 0;
        padding: 4px 20px 4px 5px;
        width: 100%;
        height: auto;
        outline: 0;
        border: 1px solid #aaa;
        background: url("chosen-sprite.png") no-repeat 100% -20px;
        font-size: 1em;
        font-family: sans-serif;
        line-height: normal;
        border-radius: 0;
        }

        .chosen-container-single .chosen-drop {
        margin-top: -1px;
        border-radius: 0 0 4px 4px;
        background-clip: padding-box;
        }

        .chosen-container-single.chosen-container-single-nosearch .chosen-search {
        position: absolute;
        clip: rect(0, 0, 0, 0);
        -webkit-clip-path: inset(100% 100%);
                clip-path: inset(100% 100%);
        }

        /* @end */
        /* @group Results */
        .chosen-container .chosen-results {
        color: #444;
        position: relative;
        overflow-x: hidden;
        overflow-y: auto;
        margin: 0 4px 4px 0;
        padding: 0 0 0 4px;
        max-height: 240px;
        -webkit-overflow-scrolling: touch;
        }

        .chosen-container .chosen-results li {
        display: none;
        margin: 0;
        padding: 5px 6px;
        list-style: none;
        line-height: 15px;
        word-wrap: break-word;
        -webkit-touch-callout: none;
        }

        .chosen-container .chosen-results li.active-result {
        display: list-item;
        cursor: pointer;
        }

        .chosen-container .chosen-results li.disabled-result {
        display: list-item;
        color: #ccc;
        cursor: default;
        }

        .chosen-container .chosen-results li.highlighted {
        background-color: #3875d7;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(20%, #3875d7), color-stop(90%, #2a62bc));
        background-image: linear-gradient(#3875d7 20%, #2a62bc 90%);
        color: #fff;
        }

        .chosen-container .chosen-results li.no-results {
        color: #777;
        display: list-item;
        background: #f4f4f4;
        }

        .chosen-container .chosen-results li.group-result {
        display: list-item;
        font-weight: bold;
        cursor: default;
        }

        .chosen-container .chosen-results li.group-option {
        padding-left: 15px;
        }

        .chosen-container .chosen-results li em {
        font-style: normal;
        text-decoration: underline;
        }

        /* @end */
        /* @group Multi Chosen */
        .chosen-container-multi .chosen-choices {
        position: relative;
        overflow: hidden;
        margin: 0;
        padding: 0 5px;
        width: 100%;
        height: auto;
        border: 1px solid #aaa;
        background-color: #fff;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(1%, #eee), color-stop(15%, #fff));
        background-image: linear-gradient(#eee 1%, #fff 15%);
        cursor: text;
        }

        .chosen-container-multi .chosen-choices li {
        float: left;
        list-style: none;
        }

        .chosen-container-multi .chosen-choices li.search-field {
        margin: 0;
        padding: 0;
        white-space: nowrap;
        }

        .chosen-container-multi .chosen-choices li.search-field input[type="text"] {
        margin: 1px 0;
        padding: 0;
        height: 25px;
        outline: 0;
        border: 0 !important;
        background: transparent !important;
        -webkit-box-shadow: none;
                box-shadow: none;
        color: #999;
        font-size: 100%;
        font-family: sans-serif;
        line-height: normal;
        border-radius: 0;
        width: 25px;
        }

        .chosen-container-multi .chosen-choices li.search-choice {
        position: relative;
        margin: 3px 5px 3px 0;
        padding: 3px 20px 3px 5px;
        border: 1px solid #aaa;
        max-width: 100%;
        border-radius: 3px;
        background-color: #eeeeee;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), to(#eee));
        background-image: linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
        background-size: 100% 19px;
        background-repeat: repeat-x;
        background-clip: padding-box;
        -webkit-box-shadow: 0 0 2px #fff inset, 0 1px 0 rgba(0, 0, 0, 0.05);
                box-shadow: 0 0 2px #fff inset, 0 1px 0 rgba(0, 0, 0, 0.05);
        color: #333;
        line-height: 13px;
        cursor: default;
        }

        .chosen-container-multi .chosen-choices li.search-choice span {
        word-wrap: break-word;
        }

        .chosen-container-multi .chosen-choices li.search-choice .search-choice-close {
        position: absolute;
        top: 4px;
        right: 3px;
        display: block;
        width: 12px;
        height: 12px;
        background: url("chosen-sprite.png") -42px 1px no-repeat;
        font-size: 1px;
        }

        .chosen-container-multi .chosen-choices li.search-choice .search-choice-close:hover {
        background-position: -42px -10px;
        }

        .chosen-container-multi .chosen-choices li.search-choice-disabled {
        padding-right: 5px;
        border: 1px solid #ccc;
        background-color: #e4e4e4;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), to(#eee));
        background-image: linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
        color: #666;
        }

        .chosen-container-multi .chosen-choices li.search-choice-focus {
        background: #d4d4d4;
        }

        .chosen-container-multi .chosen-choices li.search-choice-focus .search-choice-close {
        background-position: -42px -10px;
        }

        .chosen-container-multi .chosen-results {
        margin: 0;
        padding: 0;
        }

        .chosen-container-multi .chosen-drop .result-selected {
        display: list-item;
        color: #ccc;
        cursor: default;
        }

        /* @end */
        /* @group Active  */
        .chosen-container-active .chosen-single {
        border: 1px solid #5897fb;
        -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        .chosen-container-active.chosen-with-drop .chosen-single {
        border: 1px solid #aaa;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(20%, #eee), color-stop(80%, #fff));
        background-image: linear-gradient(#eee 20%, #fff 80%);
        -webkit-box-shadow: 0 1px 0 #fff inset;
                box-shadow: 0 1px 0 #fff inset;
        }

        .chosen-container-active.chosen-with-drop .chosen-single div {
        border-left: none;
        background: transparent;
        }

        .chosen-container-active.chosen-with-drop .chosen-single div b {
        background-position: -18px 2px;
        }

        .chosen-container-active .chosen-choices {
        border: 1px solid #5897fb;
        -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        .chosen-container-active .chosen-choices li.search-field input[type="text"] {
        color: #222 !important;
        }

        /* @end */
        /* @group Disabled Support */
        .chosen-disabled {
        opacity: 0.5 !important;
        cursor: default;
        }

        .chosen-disabled .chosen-single {
        cursor: default;
        }

        .chosen-disabled .chosen-choices .search-choice .search-choice-close {
        cursor: default;
        }

        /* @end */
        /* @group Right to Left */
        .chosen-rtl {
        text-align: right;
        }

        .chosen-rtl .chosen-single {
        overflow: visible;
        padding: 0 8px 0 0;
        }

        .chosen-rtl .chosen-single span {
        margin-right: 0;
        margin-left: 26px;
        direction: rtl;
        }

        .chosen-rtl .chosen-single-with-deselect span {
        margin-left: 38px;
        }

        .chosen-rtl .chosen-single div {
        right: auto;
        left: 3px;
        }

        .chosen-rtl .chosen-single abbr {
        right: auto;
        left: 26px;
        }

        .chosen-rtl .chosen-choices li {
        float: right;
        }

        .chosen-rtl .chosen-choices li.search-field input[type="text"] {
        direction: rtl;
        }

        .chosen-rtl .chosen-choices li.search-choice {
        margin: 3px 5px 3px 0;
        padding: 3px 5px 3px 19px;
        }

        .chosen-rtl .chosen-choices li.search-choice .search-choice-close {
        right: auto;
        left: 4px;
        }

        .chosen-rtl.chosen-container-single .chosen-results {
        margin: 0 0 4px 4px;
        padding: 0 4px 0 0;
        }

        .chosen-rtl .chosen-results li.group-option {
        padding-right: 15px;
        padding-left: 0;
        }

        .chosen-rtl.chosen-container-active.chosen-with-drop .chosen-single div {
        border-right: none;
        }

        .chosen-rtl .chosen-search input[type="text"] {
        padding: 4px 5px 4px 20px;
        background: url("chosen-sprite.png") no-repeat -30px -20px;
        direction: rtl;
        }

        .chosen-rtl.chosen-container-single .chosen-single div b {
        background-position: 6px 2px;
        }

        .chosen-rtl.chosen-container-single.chosen-with-drop .chosen-single div b {
        background-position: -12px 2px;
        }

        /* @end */
        /* @group Retina compatibility */
        @media only screen and (-webkit-min-device-pixel-ratio: 1.5), only screen and (min-resolution: 144dpi), only screen and (min-resolution: 1.5dppx) {
        .chosen-rtl .chosen-search input[type="text"],
        .chosen-container-single .chosen-single abbr,
        .chosen-container-single .chosen-single div b,
        .chosen-container-single .chosen-search input[type="text"],
        .chosen-container-multi .chosen-choices .search-choice .search-choice-close,
        .chosen-container .chosen-results-scroll-down span,
        .chosen-container .chosen-results-scroll-up span {
            background-image: url("chosen-sprite@2x.png") !important;
            background-size: 52px 37px !important;
            background-repeat: no-repeat !important;
        }
        }
        .assinatura_click{
            color: black;
            text-decoration: none;
            width: 100% !important;
            display: block;
            border: 1px gray solid;
            padding: 4px 5px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            background: #dffdfc;
        }
        /* @end */
</style>
<style>
    
    select.form-control {
        color: #5a5a5a !important;
        background: white !important;
    }
    #assinatura{
        margin: 0 auto;
        margin-bottom: 60px;
    }
    .ak_btn{
        width: 100%;
    margin-top: 10px;
    background: #1d1e29;
    color: white;
    margin-bottom: 10px;
    }
    .chosen-disabled .chosen-single {cursor: default !important;height: 34px !important;color: black !important;padding: 0.3em 0.8em !important;background: white !important;}

    .chosen-container {width: 100% !important;}
    .chosen-container-multi .chosen-choices {width: 100% !important;height: 36px;border: none;padding: 0.2rem 0.5rem !important;}
    .bg-gradient-info {
        background: -webkit-gradient(linear, left top, right top, from(#90caf9), color-stop(99%, #047edf)) !important;
        background: linear-gradient(to right, #4bc3be, #2d2f47 99%) !important;}
    .card_color_hover:hover{background: linear-gradient(to right, #4bc3be78, #2d2f47de 99%) !important;}        
    .card_color_hover{cursor: pointer;}    
    .btn_voltar{color: inherit;display: inline-block;font-size: 0.875rem;line-height: 1;vertical-align: middle;text-decoration: none;margin-top: 20px;}    
    .btn_voltar:hover{color:#2d2f4785}    
    .form-control {padding: 0.6rem 0.375rem !important}
    .btn {width: 100%;}
    .row_border{border: 1px #cbcbcb solid;padding: 20px 10px 0px 10px;margin-bottom: 10px;}
    .panel {}
    .button_outer {background: #83ccd3; border-radius:30px; text-align: center; height: 30px; width: 160px; display: inline-block; transition: .2s; position: relative; overflow: hidden;}
    .btn_upload {padding: 7px 20px 12px; color: #fff; text-align: center; position: relative; display: inline-block; overflow: hidden; z-index: 3; white-space: nowrap;}
    .btn_upload input {position: absolute; width: 100%; left: 0; top: 0; width: 100%; height: 105%; cursor: pointer; opacity: 0;}
    .file_uploading {width: 100%; height: 10px; margin-top: 20px; background: #ccc;}
    .file_uploading .btn_upload {display: none;}
    .processing_bar {position: absolute; left: 0; top: 0; width: 0; height: 100%; border-radius: 30px; background:#83ccd3; transition: 3s;}
    .file_uploading .processing_bar {width: 100%;}
    .success_box {display: none;width: 40px;height: 10px;position: relative;}
    .success_box:before {content: '';display: block;width: 11px;height: 20px;border-bottom: 6px solid #fff;border-right: 6px solid #fff;-webkit-transform: rotate(45deg);-moz-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);position: absolute;left: 15px;top: 10px;}
    .file_uploaded .success_box {display: inline-block;}
    .file_uploaded {margin-top: 0; width: 50px; background:#83ccd3; height: 50px;}
    .uploaded_file_view {max-width: 150px;margin: 15px auto;text-align: center;position: relative;transition: .2s;opacity: 0;;padding: 15px;}
    .file_remove{width: 30px; height: 30px; border-radius: 50%; display: block; position: absolute; background: #aaa; line-height: 30px; color: #fff; font-size: 12px; cursor: pointer; right: -15px; top: -15px;}
    .file_remove:hover {background: #222; transition: .2s;}
    .uploaded_file_view img {max-width: 100%;}
    .uploaded_file_view.show {opacity: 1;}
    .error_msg {text-align: center; color: #f00}
    select.form-control {color: #5a5a5a !important;}
    /* input[type=checkbox]{height: 0;width: 0;visibility: hidden;} */
    #gooey {border-radius: 50px;cursor: pointer;text-indent: -9999px;width: 50px;height: 25px;display: block;position: relative;/* filter: url('#gooey'); */background: #FF4651;box-shadow: 0 8px 16px -1px rgba(255, 70, 81, 0.2);transition: .3s ease-in-out;transition-delay: .2s;}
    input:checked+#gooey:after {background:#fff;animation:expand-right .5s linear forwards;/* left: calc(100% - 5px); *//* transform: translateX(-100%); */}
    #gooey:after {content: '';position: absolute;top: 2px;left: 2px;width: 21px;height: 21px;background: #fff;border-radius: 21px;/* transition: 0.3s; */animation:expand-left .5s linear forwards;}
    input:checked+#gooey {background: #4ac4bf;box-shadow: 0 2px 5px -1px rgb(74 196 191 / 57%);}
    input:checked+#gooey:after {background:#fff;animation:expand-right .5s linear forwards;}
    .form-control:disabled, .form-control[readonly] {background-color: #ffffff !important;opacity: 1;color: black;}
    @-webkit-keyframes expand-right
    {
        0%
        {
            left:2px;
            /* background:white; */
        }
        30%,50%    /* 50% 80% */
        {
            left:2px;
            width:46px;
            
        }
        
        60%
        {
            left:34px;
            width:14px;
        }
        80%
        {
            left:24px;
            width:24px;   
        }
        90%
        {
            left:29px;
            width:19px;  
        }
        100%
        {
            left:27px;
            width:21px;
        }
    }
    @keyframes expand-right
    {
        0%
        {
            left:2px;
            /* background:white; */
        }
        30%,50%    /* 50% 80% */
        {
            left:2px;
            width:46px;
            
        }
        
        60%
        {
            left:34px;
            width:14px;
        }
        80%
        {
            left:24px;
            width:24px;   
        }
        90%
        {
            left:29px;
            width:19px;  
        }
        100%
        {
            left:27px;
            width:21px;
        }
    }

    @-webkit-keyframes expand-left
    {
        0%
        {
            left:27px;
            /* background:white; */
        }
        30%,50%
        {
            left:2px;
            width:46px;
        }
        60%
        {
            right:34px;
            width:14px;
        }
        80%
        {
            right:24px;
            width:24px;   
        }
        90%
        {
            right:29px;
            width:19px;  
        }
        100%
        {
            left:2px;
            width:21px;
        }
    }
    @keyframes expand-left
    {
        0%
        {
            left:27px;
            /* background:white; */
        }
        30%,50%
        {
            left:2px;
            width:46px;
        }
        60%
        {
            right:34px;
            width:14px;
        }
        80%
        {
            right:24px;
            width:24px;   
        }
        90%
        {
            right:29px;
            width:19px;  
        }
        100%
        {
            left:2px;
            width:21px;
        }
    }
    @media (max-width: 575px) {
        .table thead th {
            font-size: 7px !important;
        }
        .table th, .table td {
            font-size: 8px !important; 
        }
        .col-xs-2 {
            flex: 0 0 auto;
            width: 66% !important;
        }
        .col-xs-3 {
            flex: 0 0 auto !important;
            width: 25% !important;
        }
        .col-xs-6 {
            flex: 0 0 auto;
            width: 50%  !important;
        }
        .col-xs-4 {
            flex: 0 0 auto;
            width: 33.33333333% !important;
        }
        .col-xs-5 {
            flex: 0 0 auto;
            width: 41.66667% !important;
        }
        .col-xs-8 {
            flex: 0 0 auto;
            width: 66.66666667% !important;
        }
    }
</style>
    <div class="container-scroller">
      <?php include('nav.php'); ?>
      <div class="container-fluid page-body-wrapper">
        <?php include('menu.php'); ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <a href="<?=base_url()?>admin/rdf/lista_rdf/<?=$detalhes_bra[0]->id_obra?>" class="btn_voltar"><i class="mdi mdi-keyboard-return"></i> Voltar</a>
                <div style="text-align: center;">
                    <h1 class="page-title mb-3" style="font-size: 1.5rem !important;">
                        RELATÓRIO DIÁRIO DE FURO (RDF) - <b><?=date('d/m/Y',$rdfs[0]->data)?></b>
                    </h1>
                </div>
                <div class="page-header" style="margin: 50px 0px 0px 0px !important;">
                    <h3 class="page-title">
                        <?php echo $detalhes_bra[0]->obra_nome.' ('.$detalhes_bra[0]->numero_id.')'; ?>
                    </h3>
                </div>
                <form class="forms-sample" action="<?=base_url()?>admin/rdf/insere_lista_da_obra_gravar" method="POST">
                    <input type="hidden" class="form-control" id="id_obra" name="obra_id" value="<?=$rdfs[0]->id_obra?>" readonly>  
                    <input type="hidden" class="form-control" id="id" name="rdf_id" value="<?=$rdf_id?>" readonly>  
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-4 col-xs-4">
                                <div class="form-group">
                                    <label for="cliente">Haste</label>
                                    <select class="form-control" id="haste" name="haste">
                                        <option <?= ($haste == 0) ? 'selected="selected"' : '' ?> value="0">Selecione</option>
                                        <option <?= ($haste == 1.5) ? 'selected="selected"' : '' ?> value="1.5">1.5</option>
                                        <option <?= ($haste == 3) ? 'selected="selected"' : '' ?> value="3">3</option>
                                        <option <?= ($haste == 4.5) ? 'selected="selected"' : '' ?> value="4.5">4.5</option>
                                        <option <?= ($haste == 6.1) ? 'selected="selected"' : '' ?> value="6.1">6.1</option>
                                        <option <?= ($haste == 9.1) ? 'selected="selected"' : '' ?> value="9.1">9.1</option>
                                        <option <?= ($haste == 12.5) ? 'selected="selected"' : '' ?> value="12.5">12.5</option>
                                    </select>    
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-4">
                                <div class="form-group">
                                    <label for="data">PV</label>
                                    <input type="text" class="form-control" id="" name="pv" value="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-4">
                                <div class="form-group">
                                    <label for="contagem">Contagem</label>
                                    <br>
                                    <!-- <input type="checkbox" id="contagem" name="contagem" value="1"> -->
                                    <select class="form-control" id="contagem" name="contagem">  
                                        <option value="3">Selecione</option>
                                        <option value="0">NAO</option>
                                        <option value="1">SIM</option>
                                    </select>  
                                </div>
                            </div>
                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <div class="form-group">
                                    <label for="data">Barra/Metros</label>
                                    <!-- <input type="text" class="form-control" id="" name="numeracao" value="">             -->
                                    <select class="form-control" id="numeracao" name="numeracao">
                                        <option value="0">Selecione</option>
                                        <!-- <option value="1">0/0</option> -->
                                    </select> 
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="form-group">
                                    <label for="tu">Prof: </label>
                                    <input type="text" class="form-control" id="" name="Prof" value="" required>            
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="form-group">
                                    <label for="data_furo_piloto">Pith:</label>
                                    <input type="text" class="form-control" id="" name="Pith" value="" required>    
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="form-group">
                                    <label for="data_puxe">AM/LAT:</label>
                                    <input type="text" class="form-control" id="" name="amlat" value="">    
                                </div>
                            </div>
                        </div>
                    </div>
                         
                    <button type="submit" id="salvar_item" class="btn btn-gradient-primary me-2 mt-2" disabled>Salvar</button>
                </form>

                <div class="row_border">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="height: 70px;">
                                        <th colspan="6" style="text-align: center;"><b>LISTA</b></th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Barra/Metros</th>
                                        <th scope="col">Prof</th>
                                        <th scope="col">Pith (%)</th>
                                        <th scope="col">AM/LAT</th>
                                        <th scope="col">PV</th>
                                        <th scope="col"><i class="mdi mdi-delete mdi-24px"></i></th>
                                    </tr>
                                </thead>
                                <?php

                                // p($rdfs_lista);
                                
                                foreach ($rdfs_lista as $key => $rdf){  ?>
                                <tr>
                                    <td><?=$rdf->numeracao?></td>     
                                    <td><?=$rdf->prof?></td>                                            
                                    <td><?=$rdf->pith?></td>                                            
                                    <td><?=$rdf->amlat?></td>  
                                    <td>
                                        <?php 

                                            if(isset($rdfs_lista[$key-1]->pv) and ($rdfs_lista[$key-1]->pv == $rdf->pv) and ($rdf->pv != '')){
                                                echo '--';
                                            }else{
                                                echo $rdf->pv;
                                            }
                                        ?>   
                                    </td>                                            
                                    <!-- <td>
                                        <?= $rdf->cargo == 0 ? 'Selecione' : ''?>
                                    </td> -->
                                    <td>
                                        <?php if((count($rdfs_lista) - 1) == $key){ ?>
                                            <i class="mdi mdi-close-circle-outline mdi-24px" onclick="excluir(this)" data-id="<?=$rdf->id?>" style="color:red;cursor: pointer;"></i>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </table>

                            <hr>

                            <br><br>
                            <form class="forms-sample" id="form_" action="" method="POST">
                                <input type="hidden" class="form-control" id="obra_id" name="obra_id" value="<?=$rdfs[0]->id_obra?>" readonly>  
                                <input type="hidden" class="form-control" id="rdf_id" name="rdf_id" value="<?=$rdf_id?>" readonly>  
                                <div class="">
                                    <div class="row">
                                        <div class="col-lg-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="conta_certa">Valor real total do furo:</label>
                                                <p style="font-size: 12px;">Insira manualmente o valor total desse furo</p>
                                                <input type="text" class="form-control" id="valor" name="conta_certa" value="<?=$valor_certo_furos?>">
                                                <button type="submit" class="btn btn-gradient-primary me-2 mt-2">Salvar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <br><br>
                            <p>Desenho do furo:</p>
                            <br>
                            <?php 
                                $soma_dos_pvs = 0;
                                $i = 1;
                                foreach($soma_final as $key => $soma){
                                    if($i < count($soma_final)){
                                        $soma_dos_pvs += $soma['total'];
                                    }
                                ?>
                                    <span style="border: 1px #3a3c53 solid;padding: 7px 5px;font-size: 10px;"><?=$key?></span>
                                    <?php  if($i < count($soma_final)){ ?>
                                        <span style="padding: 1px 10px;border-bottom: 1px #3a3c53 solid;font-size: 10px;"><?=$soma['total']?></span>
                                     <?php  } ?>

                                <?php $i++; } ?>

                                <br><br>
                                <p><span style="font-weight: 700;">Valor Sugerido: </span><?=$soma_dos_pvs?></p>
                        </div>
                    </div>
                    <br>
                </div>
                

                <a href="<?=base_url()?>admin/rdf/lista_rdf/<?=$rdfs[0]->id_obra?>" class="btn_voltar"><i class="mdi mdi-keyboard-return"></i> Voltar</a>
            </div>
            
          <?php include('footer.php'); ?>
        </div>
      </div>
    </div>

    <script src="<?=base_url(); ?>dash/assets/vendors/js/vendor.bundle.base.js"></script>

    <script src="<?=base_url(); ?>dash/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/jquery.cookie.js" type="text/javascript"></script>

    <script src="<?=base_url(); ?>dash/assets/js/off-canvas.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/hoverable-collapse.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/misc.js"></script>

    <script src="<?=base_url(); ?>dash/assets/js/dashboard.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/todolist.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script>

        inicia_combo();
        
        $("#haste").change(function(){
            $('#numeracao').children().remove().end()
            let valor = $("#haste").val();
            var text = "";
            // var text = "<option value='0/0'>0/0</option>";
            var i = 1;
            while (i <= 92) {
                var total = valor * i
                text += "<option value='"+i+'/'+total.toFixed(1)+"'>"+i+'/'+total.toFixed(1)+"</option>";
                i++;
            }
            $("#numeracao").append(text);

        });

        function inicia_combo(){
            let valor = <?=$haste?>;
            let numeracao = <?=$numeracao?>;
            var text = "";
            // var text = "<option value='0/0'>0/0</option>";
            var i = 1;
            while (i <= 92) {
                var total = valor * i
                if(i == (numeracao + 1)){
                    text += "<option selected='selected' value='"+i+'/'+total.toFixed(1)+"'>"+i+'/'+total.toFixed(1)+"</option>";
                }else{
                    text += "<option value='"+i+'/'+total.toFixed(1)+"'>"+i+'/'+total.toFixed(1)+"</option>";
                }
                i++;
            }
            $("#numeracao").append(text);
        }

        function excluir(elem) {
            var site_url     = "<?=base_url()?>";
            let haste = <?=$haste?>;
            var id           =  $(elem).attr("data-id");
            var rdf_id       =  $('#id').val();
            var obra_id       =  $('#id_obra').val();
            
            

            $.ajax({
                type: "POST",
                url: site_url + "admin/rdf/excluir_furo_da_lista",
                data: {id: id, rdf: rdf_id},
                success: function(resp) {
                    var numeracao = JSON.parse(resp)
                    window.location.href = site_url +'admin/rdf/add_lista/'+obra_id+'/'+rdf_id+'?haste='+haste+'&numeracao='+(numeracao - 1);
                }
            });
        }

        $(document).ready(function () {
            
            // $("#salvar_item").append(text);
            // $(this).prop("disabled",true);
            $("#contagem").change(function(){
                if($("#contagem").val() != 3){
                    $('#salvar_item').prop("disabled",false);
                }else{
                    $('#salvar_item').prop("disabled",true);
                }
            });

            $("#form_").submit(function (event) {
                var url = '<?=BASE_URL()."admin/rdf/salvar_valor_certo"?>'
                var formData = {
                    rdf: $("#rdf_id").val(),
                    obra: $("#obra_id").val(),
                    valor: $("#valor").val(),
                };

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function (data) {
                    console.log(data);
                });

                event.preventDefault();
            });
        });

    </script>
    </body>
</html>