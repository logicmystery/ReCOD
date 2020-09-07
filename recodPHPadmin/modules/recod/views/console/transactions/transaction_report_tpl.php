<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="shortcut icon" href="/uploads/fab.png">
                    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                        <link id="bs-css" href="/css/bootstrap-spacelab.css" rel="stylesheet">
                            <script>
                                $(function () {
                                    $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
                                });
                            </script>
                            <script>
                                var reqst = null;
                                $(document).ready(function () {
                                    $('#report_sub').click(function () {
                                        reqst = $.post("<?= base_url() ?>console/transactions/transaction_report", $('form').serialize(), function (resp) {
                                            $(".ajax_resp").html(resp);
                                            $('div#container').hide();
                                        });
                                    });
                                    $('div#container').hide();

                                    /*   $('select').on("change", function () {
                                     $('div#container').show();
                                     $(".ajax_resp").html("<img src='data:image/gif;base64,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rHFAFUB06OGHIIaow4YCGDDFiSimqOKKT8Dg4oswxigjDCEAADsAAAAAAAAAAAA8YnIgLz4KPGI+V2FybmluZzwvYj46ICBteXNxbF9xdWVyeSgpIFs8YSBocmVmPSdmdW5jdGlvbi5teXNxbC1xdWVyeSc+ZnVuY3Rpb24ubXlzcWwtcXVlcnk8L2E+XTogQ2FuJ3QgY29ubmVjdCB0byBsb2NhbCBNeVNRTCBzZXJ2ZXIgdGhyb3VnaCBzb2NrZXQgJy92YXIvcnVuL215c3FsZC9teXNxbGQuc29jaycgKDIpIGluIDxiPi9ob21lL2FqYXhsb2FkL3d3dy9saWJyYWlyaWVzL2NsYXNzLm15c3FsLnBocDwvYj4gb24gbGluZSA8Yj42ODwvYj48YnIgLz4KPGJyIC8+CjxiPldhcm5pbmc8L2I+OiAgbXlzcWxfcXVlcnkoKSBbPGEgaHJlZj0nZnVuY3Rpb24ubXlzcWwtcXVlcnknPmZ1bmN0aW9uLm15c3FsLXF1ZXJ5PC9hPl06IEEgbGluayB0byB0aGUgc2VydmVyIGNvdWxkIG5vdCBiZSBlc3RhYmxpc2hlZCBpbiA8Yj4vaG9tZS9hamF4bG9hZC93d3cvbGlicmFpcmllcy9jbGFzcy5teXNxbC5waHA8L2I+IG9uIGxpbmUgPGI+Njg8L2I+PGJyIC8+CjxiciAvPgo8Yj5XYXJuaW5nPC9iPjogIG15c3FsX3F1ZXJ5KCkgWzxhIGhyZWY9J2Z1bmN0aW9uLm15c3FsLXF1ZXJ5Jz5mdW5jdGlvbi5teXNxbC1xdWVyeTwvYT5dOiBDYW4ndCBjb25uZWN0IHRvIGxvY2FsIE15U1FMIHNlcnZlciB0aHJvdWdoIHNvY2tldCAnL3Zhci9ydW4vbXlzcWxkL215c3FsZC5zb2NrJyAoMikgaW4gPGI+L2hvbWUvYWpheGxvYWQvd3d3L2xpYnJhaXJpZXMvY2xhc3MubXlzcWwucGhwPC9iPiBvbiBsaW5lIDxiPjY4PC9iPjxiciAvPgo8YnIgLz4KPGI+V2FybmluZzwvYj46ICBteXNxbF9xdWVyeSgpIFs8YSBocmVmPSdmdW5jdGlvbi5teXNxbC1xdWVyeSc+ZnVuY3Rpb24ubXlzcWwtcXVlcnk8L2E+XTogQSBsaW5rIHRvIHRoZSBzZXJ2ZXIgY291bGQgbm90IGJlIGVzdGFibGlzaGVkIGluIDxiPi9ob21lL2FqYXhsb2FkL3d3dy9saWJyYWlyaWVzL2NsYXNzLm15c3FsLnBocDwvYj4gb24gbGluZSA8Yj42ODwvYj48YnIgLz4KPGJyIC8+CjxiPldhcm5pbmc8L2I+OiAgbXlzcWxfcXVlcnkoKSBbPGEgaHJlZj0nZnVuY3Rpb24ubXlzcWwtcXVlcnknPmZ1bmN0aW9uLm15c3FsLXF1ZXJ5PC9hPl06IENhbid0IGNvbm5lY3QgdG8gbG9jYWwgTXlTUUwgc2VydmVyIHRocm91Z2ggc29ja2V0ICcvdmFyL3J1bi9teXNxbGQvbXlzcWxkLnNvY2snICgyKSBpbiA8Yj4vaG9tZS9hamF4bG9hZC93d3cvbGlicmFpcmllcy9jbGFzcy5teXNxbC5waHA8L2I+IG9uIGxpbmUgPGI+Njg8L2I+PGJyIC8+CjxiciAvPgo8Yj5XYXJuaW5nPC9iPjogIG15c3FsX3F1ZXJ5KCkgWzxhIGhyZWY9J2Z1bmN0aW9uLm15c3FsLXF1ZXJ5Jz5mdW5jdGlvbi5teXNxbC1xdWVyeTwvYT5dOiBBIGxpbmsgdG8gdGhlIHNlcnZlciBjb3VsZCBub3QgYmUgZXN0YWJsaXNoZWQgaW4gPGI+L2hvbWUvYWpheGxvYWQvd3d3L2xpYnJhaXJpZXMvY2xhc3MubXlzcWwucGhwPC9iPiBvbiBsaW5lIDxiPjY4PC9iPjxiciAvPgo='>");
                                     reqst = $.post("<?= base_url() ?>console/customer/billing_report/", $('form').serialize(), function (resp) {
                                     $(".ajax_resp").html(resp);
                                     $('div#container').hide();
                                     });
                                     
                                     });
                                     $('input').on("keyup", function () {
                                     $('div#container').show();
                                     $(".ajax_resp").html("<img src='data:image/gif;base64,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rHFAFUB06OGHIIaow4YCGDDFiSimqOKKT8Dg4oswxigjDCEAADsAAAAAAAAAAAA8YnIgLz4KPGI+V2FybmluZzwvYj46ICBteXNxbF9xdWVyeSgpIFs8YSBocmVmPSdmdW5jdGlvbi5teXNxbC1xdWVyeSc+ZnVuY3Rpb24ubXlzcWwtcXVlcnk8L2E+XTogQ2FuJ3QgY29ubmVjdCB0byBsb2NhbCBNeVNRTCBzZXJ2ZXIgdGhyb3VnaCBzb2NrZXQgJy92YXIvcnVuL215c3FsZC9teXNxbGQuc29jaycgKDIpIGluIDxiPi9ob21lL2FqYXhsb2FkL3d3dy9saWJyYWlyaWVzL2NsYXNzLm15c3FsLnBocDwvYj4gb24gbGluZSA8Yj42ODwvYj48YnIgLz4KPGJyIC8+CjxiPldhcm5pbmc8L2I+OiAgbXlzcWxfcXVlcnkoKSBbPGEgaHJlZj0nZnVuY3Rpb24ubXlzcWwtcXVlcnknPmZ1bmN0aW9uLm15c3FsLXF1ZXJ5PC9hPl06IEEgbGluayB0byB0aGUgc2VydmVyIGNvdWxkIG5vdCBiZSBlc3RhYmxpc2hlZCBpbiA8Yj4vaG9tZS9hamF4bG9hZC93d3cvbGlicmFpcmllcy9jbGFzcy5teXNxbC5waHA8L2I+IG9uIGxpbmUgPGI+Njg8L2I+PGJyIC8+CjxiciAvPgo8Yj5XYXJuaW5nPC9iPjogIG15c3FsX3F1ZXJ5KCkgWzxhIGhyZWY9J2Z1bmN0aW9uLm15c3FsLXF1ZXJ5Jz5mdW5jdGlvbi5teXNxbC1xdWVyeTwvYT5dOiBDYW4ndCBjb25uZWN0IHRvIGxvY2FsIE15U1FMIHNlcnZlciB0aHJvdWdoIHNvY2tldCAnL3Zhci9ydW4vbXlzcWxkL215c3FsZC5zb2NrJyAoMikgaW4gPGI+L2hvbWUvYWpheGxvYWQvd3d3L2xpYnJhaXJpZXMvY2xhc3MubXlzcWwucGhwPC9iPiBvbiBsaW5lIDxiPjY4PC9iPjxiciAvPgo8YnIgLz4KPGI+V2FybmluZzwvYj46ICBteXNxbF9xdWVyeSgpIFs8YSBocmVmPSdmdW5jdGlvbi5teXNxbC1xdWVyeSc+ZnVuY3Rpb24ubXlzcWwtcXVlcnk8L2E+XTogQSBsaW5rIHRvIHRoZSBzZXJ2ZXIgY291bGQgbm90IGJlIGVzdGFibGlzaGVkIGluIDxiPi9ob21lL2FqYXhsb2FkL3d3dy9saWJyYWlyaWVzL2NsYXNzLm15c3FsLnBocDwvYj4gb24gbGluZSA8Yj42ODwvYj48YnIgLz4KPGJyIC8+CjxiPldhcm5pbmc8L2I+OiAgbXlzcWxfcXVlcnkoKSBbPGEgaHJlZj0nZnVuY3Rpb24ubXlzcWwtcXVlcnknPmZ1bmN0aW9uLm15c3FsLXF1ZXJ5PC9hPl06IENhbid0IGNvbm5lY3QgdG8gbG9jYWwgTXlTUUwgc2VydmVyIHRocm91Z2ggc29ja2V0ICcvdmFyL3J1bi9teXNxbGQvbXlzcWxkLnNvY2snICgyKSBpbiA8Yj4vaG9tZS9hamF4bG9hZC93d3cvbGlicmFpcmllcy9jbGFzcy5teXNxbC5waHA8L2I+IG9uIGxpbmUgPGI+Njg8L2I+PGJyIC8+CjxiciAvPgo8Yj5XYXJuaW5nPC9iPjogIG15c3FsX3F1ZXJ5KCkgWzxhIGhyZWY9J2Z1bmN0aW9uLm15c3FsLXF1ZXJ5Jz5mdW5jdGlvbi5teXNxbC1xdWVyeTwvYT5dOiBBIGxpbmsgdG8gdGhlIHNlcnZlciBjb3VsZCBub3QgYmUgZXN0YWJsaXNoZWQgaW4gPGI+L2hvbWUvYWpheGxvYWQvd3d3L2xpYnJhaXJpZXMvY2xhc3MubXlzcWwucGhwPC9iPiBvbiBsaW5lIDxiPjY4PC9iPjxiciAvPgo='>");
                                     if (reqst) {
                                     reqst.abort();
                                     }
                                     reqst = $.post("<?= base_url() ?>console/customer/billing_report/", $('form').serialize(), function (resp) {
                                     $(".ajax_resp").html(resp);
                                     $('div#container').hide();
                                     });
                                     
                                     });*/


                                });



                            </script>

                            <title>Transaction Record</title>
                            </head>

                            <body>
                                <style>
                                    body {
                                        background: #FFFFFF;
                                    }
                                    body, td, th, input, select, textarea, option, optgroup {
                                        font-family: Verdana, Arial, Helvetica, sans-serif;
                                        font-size: 12px;
                                        color: #000000;
                                    }
                                    h1 {
                                        text-transform: uppercase;
                                        color: #CCCCCC;
                                        text-align: right;
                                        font-size: 24px;
                                        font-weight: normal;
                                        padding-bottom: 5px;
                                        margin-top: 0px;
                                        margin-bottom: 15px;
                                        border-bottom: 1px solid black;
                                    }
                                    .store {
                                        width: 100%;
                                        margin-bottom: 20px;
                                    }
                                    .div2 {
                                        float: left;
                                        display: inline-block;
                                    }
                                    .div3 {
                                        float: right;
                                        display: inline-block;
                                        padding: 5px;
                                    }
                                    .heading td {
                                        background: #E7EFEF;
                                    }
                                    .address, .product {
                                        border-collapse: collapse;
                                    }
                                    .address {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                    }
                                    .address th, .address td {
                                        border-left: 1px solid black;
                                        border-bottom: 1px solid black;
                                        padding: 5px;
                                        vertical-align: text-bottom;
                                    }
                                    .address td {
                                        width: 50%;
                                    }
                                    .product {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                    }
                                    .product td {
                                        border-left: 1px solid black;
                                        border-bottom: 1px solid black;
                                        padding: 5px;
                                    }
                                </style>
                                <style media="print">
                                    body {
                                        background-color: #FFF;
                                        background-image: none;
                                    }

                                    .delete, .button, #addrow, #head, #actions {
                                        display: none;
                                    }

                                    #main {
                                        border: none;
                                        height: auto;
                                    }

                                    table tr td textarea {
                                        margin-top: 0;
                                    }

                                    body {
                                        margin-top: -50px;
                                    }

                                    textarea {
                                        background: #FFF;
                                    }

                                    input {
                                        background: #FFF;
                                    }

                                    .sub-total {
                                        border-top: 1px dashed #CCC;
                                        border-bottom: 1px dashed #CCC;
                                    }
                                </style>
                                <style> 
                                    /* http://meyerweb.com/eric/tools/css/reset/ 
                                       v2.0 | 20110126
                                       License: none (public domain)
                                    */

                                    html, body, div, span, applet, object, iframe,
                                    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
                                    a, abbr, acronym, address, big, cite, code,
                                    del, dfn, em, img, ins, kbd, q, s, samp,
                                    small, strike, strong, sub, sup, tt, var,
                                    b, u, i, center,
                                    dl, dt, dd, ol, ul, li,
                                    fieldset, form, label, legend,
                                    table, caption, tbody, tfoot, thead, tr, th, td,
                                    article, aside, canvas, details, embed, 
                                    figure, figcaption, footer, header, hgroup, 
                                    menu, nav, output, ruby, section, summary,
                                    time, mark, audio, video {
                                        margin: 0;
                                        padding: 0;
                                        border: 0;
                                        font-size: 100%;
                                        font: inherit;
                                        vertical-align: baseline;
                                    }
                                    /* HTML5 display-role reset for older browsers */
                                    article, aside, details, figcaption, figure, 
                                    footer, header, hgroup, menu, nav, section {
                                        display: block;
                                    }
                                    body {
                                        line-height: 1;
                                    }
                                    ol, ul {
                                        list-style: none;
                                    }
                                    blockquote, q {
                                        quotes: none;
                                    }
                                    blockquote:before, blockquote:after,
                                    q:before, q:after {
                                        content: '';
                                        content: none;
                                    }
                                    table {
                                        border-collapse: collapse;
                                        border-spacing: 0;
                                    }

                                    /*__________________________________________________Universal
                                    Universal
                                    */

                                    body {
                                        background-color: #F0F0F0;
                                        background-repeat:repeat;
                                        font-size: 100%;
                                        color: #000;
                                        font-family: Arial, Helvetica, sans-serif;
                                    }

                                    .left {
                                        float: left;
                                    }

                                    .right {
                                        float: right;
                                    }

                                    .clear {
                                        clear: both;
                                    }

                                    input, textarea {
                                        margin: 0;
                                        padding: 0;
                                        border: none;
                                        outline: none;
                                        background: transparent;
                                        font-family: Arial, Helvetica, sans-serif;
                                    }

                                    p, input {
                                        font-size: 1em;
                                        padding: 2px 0;
                                    }

                                    textarea {
                                        display: block;
                                        background: #E3FAFA;
                                    }

                                    input {
                                        background: #E3FAFA;
                                    }

                                    input:hover, textarea:hover {
                                        background: #FFFFCC;
                                    }

                                    input:focus, textarea:focus {
                                        border: 1px solid #666;
                                    }

                                    .price:hover {
                                        background: #FFF;
                                    }

                                    .price:focus {
                                        border: none;
                                    }

                                    .button {
                                        display: inline;
                                        padding: 4px 8px; 
                                        background: url(../images/button-bg.png) repeat-x; 
                                        color: #666;
                                        border: 1px solid #ccc; 
                                        font: bold .95em Helvetica; 
                                        text-decoration: none;
                                    }

                                    .button:hover { 
                                        color: #333;
                                        border: 1px solid #666;
                                        background: url(../images/button-bg.png) repeat-x; 
                                    }

                                    .button:active {
                                        background: url(../images/button-bg.png) repeat-x; 
                                        background-position: bottom left;
                                    }

                                    /*__________________________________________________Head
                                    Head
                                    */

                                    #head {
                                        margin: 0 auto;
                                        padding-top: 10px;
                                        margin-bottom: 20px;
                                        width: 864px;
                                    }

                                    h1 {
                                        padding-bottom: 10px;
                                        color: #EEE;
                                        font-weight: normal;
                                        font-size: 2em;
                                    }

                                    #about-head {
                                        margin-bottom: 4px;
                                    }

                                    h3 {
                                        color: #333;
                                        font-size: 1.4em;
                                        display: inline;
                                    }

                                    #about, #how-to {
                                        padding: 5px;
                                        background: #EEE;
                                        color: #333;
                                        border: 1px solid #666;
                                    }

                                    #about p, #how-to p {
                                        padding-bottom: 8px;
                                    }

                                    strong {
                                        font-weight: bold;
                                    }   

                                    /*__________________________________________________Banner Ad
                                    Banner AD
                                    */

                                    #banner-ad {
                                        margin-bottom: 20px;
                                    }

                                    /*__________________________________________________Actions
                                    Actions
                                    */

                                    #actions {
                                        margin: 0 auto;
                                        padding-top: 10px;
                                        margin-bottom: -20px;
                                        width: 864px;
                                    }

                                    /*__________________________________________________Main
                                    Main
                                    */

                                    #main {
                                        margin: 30px auto;
                                        padding: 32px;
                                        width: 800px;
                                        height: 1040px;
                                        background: #FFF;
                                        border: 1px solid #808080;
                                    }
                                    .main {
                                        margin: 30px auto;
                                        padding: 32px;
                                        /*width: 800px;*/
                                        height: 1040px;
                                        background: #FFF;
                                        border: 1px solid #808080;
                                        page-break-after: always;
                                    }

                                    /*__________________________________________________Invoice
                                    Invoice
                                    */

                                    #title {
                                        font-weight: bold;
                                        text-align: center;
                                        padding-bottom: 16px;
                                    }

                                    #title h1 {
                                        padding: 0;
                                        margin: 0;
                                        font-size: 1.25em;
                                        color: #000;
                                    }

                                    #title h2 {
                                        font-size: 1em;
                                        color: #000;
                                    }


                                    #invHeader {
                                        padding-bottom: 16px;
                                        margin-bottom: 16px;
                                        border-bottom: 1px solid #CCC;
                                    }

                                    #headLeft, #signatureLeft {
                                        float: left;
                                        width: 392px;
                                        border-bottom: 1px solid #CCC;
                                    }

                                    #headLeft p, #headRight p, #signatureLeft p, #signatureRight p {
                                        font-weight: bold;
                                        font-size: .85em;
                                    }

                                    #legal {
                                        padding: 4px;
                                        margin-bottom: 4px;
                                        border: 1px solid #CCC;
                                        font-size: .70em;
                                    }

                                    #legal ul {
                                        list-style-type: circle;
                                    }

                                    #legal ul li {
                                        padding: 4px 0;
                                        margin-left: 2em;
                                    }

                                    #signature p {
                                        padding-left: 4px;
                                    }

                                    #headLeft div {
                                        padding: 4px;
                                        border-top: 1px solid #CCC;
                                        border-left: 1px solid #CCC;
                                        border-right: 1px solid #CCC;
                                    }

                                    #signatureLeft div {
                                        padding: 1px 4px;
                                        border-top: 1px solid #CCC;
                                        border-left: 1px solid #CCC;
                                        border-right: 1px solid #CCC;
                                    }

                                    #signatureRight div {
                                        padding: 1px 4px;
                                    }

                                    #signatureRightRight {
                                        border-left: none !important;
                                    }

                                    #headLeft textarea {
                                        font-size: 1.2em;
                                        text-align: left;
                                        width: 100%;
                                        height: 96px;
                                    }

                                    #headRight {
                                        margin-left: 12px;
                                        float: left;
                                        width: 392px;
                                        border: 1px solid #CCC;
                                    }

                                    #signatureRight {
                                        float: left;
                                        width: 402px;
                                        border-bottom: 1px solid #CCC;
                                    }

                                    #headRightRight div, #headRightLeft div {
                                        padding: 0 4px;
                                    }

                                    #headRight p {
                                        padding-left: 4px;
                                    }

                                    #headLeft input, #headRight input, #signatureLeft input, #signatureRight input {
                                        margin-bottom: 8px;
                                        width: 100%;
                                        display: block;
                                    }

                                    #headRightLeft, #headRightRight {
                                        padding-top: 32px;
                                        padding-bottom: 60px;
                                        float: left;
                                        width: 192px;
                                    }

                                    #signatureRightLeft, #signatureRightRight {
                                        float: left;
                                        width: 192px;
                                    }

                                    #headRight textarea {
                                        font-size: 1em;
                                        text-align: left;
                                        width: 100%;
                                        height: 72px;
                                    }

                                    #headRightBottom {
                                        padding: 4px;
                                        border-top: 1px solid #CCC;
                                        width: 374px;
                                    }

                                    #headRightBottom textarea {
                                        font-size: 1.2em;
                                        text-align: left;
                                        width: 100%;
                                        height: 96px;
                                    }

                                    table {
                                        width: 800px;
                                    }

                                    table { border-collapse: collapse; }
                                    table td, table th { padding: 5px; }

                                    table th {
                                        text-align: left;
                                        font-weight: bold;
                                        border-bottom: 1px solid #CCC;
                                    }

                                    table th input {
                                        font-weight: bold;
                                        display: inline;
                                        width: 32px;
                                    }

                                    table tr td input {
                                        width: 100%;
                                    }

                                    table tr td textarea {
                                        margin-top: -16px;
                                        width: 100%;
                                        height: 24px;
                                        font-size: 16px;
                                    }

                                    .item-name {
                                        width: 432px;
                                    }


                                    .hsNo {
                                        width: 80px;
                                    }

                                    .NC {
                                        width: 80px;
                                    }

                                    .mfr {
                                        width: 80px;
                                    }

                                    .pref {
                                        width: 80px;
                                    }

                                    .country {
                                        width: 80px;
                                    }

                                    .countryInpt {
                                        width: 80px;
                                    }

                                    .delete-wpr input {
                                        display: inline;
                                        width: 432px;
                                    }

                                    .delete {
                                        text-decoration: none;
                                        font-weight: bold;
                                        color: red;
                                        padding-right: 3px;
                                        margin-right: 3px;
                                        margin-left: -19px;
                                        border-right: 1px solid #000;
                                    }

                                    #addrow {
                                        text-decoration: none;
                                        color: green;
                                    }
                                    .total-line,  .total-weight, .total-qty, .total-value {
                                        font-weight: bold;
                                    }

                                    .sub-total {
                                        background: #DDD;
                                    }

                                    #signature {
                                        margin-top: 32px;
                                    }
                                    /**default*/

                                    .main h1 {
                                        text-transform: uppercase;
                                        color: #CCCCCC;
                                        text-align: right;
                                        font-size: 24px;
                                        font-weight: normal;
                                        padding-bottom: 5px;
                                        margin-top: 0px;
                                        margin-bottom: 15px;
                                        border-bottom: 1px solid #CDDDDD;
                                    }
                                    .main .store {
                                        width: 100%;
                                        margin-bottom: 20px;
                                    }
                                    .main .div2 {
                                        float: left;
                                        display: inline-block;
                                    }
                                    .main .div3 {
                                        float: right;
                                        display: inline-block;
                                        padding: 5px;
                                    }
                                    .main .heading td {
                                        background: #E7EFEF;
                                    }
                                    .main .address,.main .product {
                                        border-collapse: collapse;
                                    }
                                    .main .address {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid #CDDDDD;
                                        border-right: 1px solid #CDDDDD;
                                    }
                                    .main .address th,.main.address td {
                                        border-left: 1px solid #CDDDDD;
                                        border-bottom: 1px solid #CDDDDD;
                                        padding: 5px;
                                        vertical-align: text-bottom;
                                    }
                                    .main .address td {
                                        width: 50%;
                                    }
                                    .main .product {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid #CDDDDD;
                                        border-right: 1px solid #CDDDDD;
                                    }
                                    .main .product td {
                                        border-left: 1px solid #CDDDDD;
                                        border-bottom: 1px solid #CDDDDD;
                                        padding: 5px;
                                    }
                                    textarea, input[type=text]
                                    {
                                        font-size:13px!important;
                                    }
                                    .main
                                    {
                                        border:none!important;
                                        /* height: 1095px;*/
                                        margin: 0 auto;
                                    }
                                    .main .calculation {
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                    }
                                    .main .calculation th, .calculation td {
                                        border: 1px solid black;
                                        border: 1px solid black;
                                    }
                                    .main .address {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                    }
                                    .main h1 {
                                        border-bottom: 1px solid black;
                                    }
                                    @page {
                                        size: A4 portrait;
                                        margin:0.1in 0.1in 0in 0in;
                                    }
                                    @media print {
                                        /* td{
                                             border-color: black;
                                             border-width: 2px;
                                             background:#fff;
                                         }
                                        */
                                    }
                                    .main+.main {
                                        page-break-before:always;
                                    }
                                </style>
                                <style>
                                    .address th, .address td {
                                        border-left: 0px solid #000;
                                        border-bottom: 1px solid #000;
                                        padding: 5px;
                                        vertical-align: text-bottom;
                                    }
                                    .main .address {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid #000;
                                        border-right: 0px solid #000;
                                    }

                                    .main .calculation {
                                        border-top: 1px solid #000;
                                        border-right: 0px solid #000;
                                    }
                                    .main .calculation th, .calculation td {
                                        border: 1px solid #000;
                                        border-top-width: 1px;
                                        border-right-width: 0px;
                                        border-bottom-width: 1px;
                                        border-left-width: 1px;
                                        border-top-style: solid;
                                        border-right-style: solid;
                                        border-bottom-style: solid;
                                        border-left-style: solid;
                                        border-top-color: #000;
                                        border-right-color: #000;
                                        border-bottom-color: #000;
                                        border-left-color: #000;
                                        -moz-border-top-colors: none;
                                        -moz-border-right-colors: none;
                                        -moz-border-bottom-colors: none;
                                        -moz-border-left-colors: none;
                                        border-image-source: none;
                                        border-image-slice: 100% 100% 100% 100%;
                                        border-image-width: 1 1 1 1;
                                        border-image-outset: 0 0 0 0;
                                        border-image-repeat: stretch stretch;
                                    }

                                </style>
                                <style>
                                    .main {
                                        border: medium none !important;
                                        height: auto;
                                        display: block;
                                    }
                                    .main .calculation {
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                        width: 100%;
                                        border-spacing: 0px;
                                        border-collapse: collapse;
                                    }
                                    .main .calculation th, .calculation td {
                                        border: 1px solid black;
                                        border: 1px solid black;
                                    }
                                    .main .address {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                    }
                                    .main h1 {
                                        border-bottom: 1px solid black;
                                    }
                                    td{font-size: 10px;}
                                    @media print{
                                        .form_div{
                                            display:none;
                                        }
                                    }
                                    .ajax_resp{text-align:center}
                                </style>

                    <div class="main" style="page-break-after: always;">
                        <h1 style="color:black; text-align:center;">Transaction Report Sheet</h1>
                        <a href="/console/" >
                            <img src="/uploads/rkproduction/logo.jpg" style="position: absolute;top: 0;background-color: white; height: 50px">
                        </a><hr/>
                        <!-- <div class="form_div" style="margin-bottom: 10px;text-align: center; "> -->
                        <div class="container">
                            <div class="row form-group">
                                <form method="post" onsubmit="return false">
                                    <div class="form-row">
                                        <div class="form-group col-sm-3">
                                        <label for="transaction_type">Transaction Type:</label>
                                        <select name="transaction_type" class="transaction_type form-control">
                                            <option value="">--transaction type--</option>
                                            <option value="credit">Credit</option>
                                            <option value="debit">Debit</option>
                                        </select>
                                        </div>
                                        <div class="form-group col-sm-3">
                                        <label for="transaction_category">Transaction Category:</label>
                                        <select name="transaction_category" class="transaction_category form-control">
                                            <option value="">--transaction category--</option>
                                            <option value="comission">Comission</option>
                                            <option value="topup">Topup</option>
                                        </select>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="user_name">User Name:</label>
                                            <input type="text" name="user_name" id="user_name" placeholder="user name" style="height: 34px" class="user_name form-control">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="transaction_note">Transaction Note:</label>
                                            <input type="text" name="transaction_note" id="transaction_note" placeholder="transaction note" style="height: 34px" class="transaction_note form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-3">
                                            <label for="user_member_id">User Member Id:</label>
                                            <input type="text" name="user_member_id" id="user_member_id" placeholder="user member id" style="height: 34px" class="user_member_id form-control">
                                        </div>
                                    <div class="form-row">
                                        <div class="form-group col-sm-3">
                                            <label for="datepicker">Start Date:</label>
                                            <input typex="text" type="date-local" value="<?=  date('Y-m-d',strtotime("-1 month")) ?>" id="start_date" name="start" class="datepicker form-control">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="end_date">End Date:</label>
                                            <input typex="text" type="date-local" value="<?=  date('Y-m-d') ?>" id="end_date" name="end" class="datepicker form-control">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <button id="report_sub" class="btn btn-info" style=" margin-top: 9%;">SEARCH</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="ajax_resp">Choose Filter To Generate Data</div>
                        </div>                                                
                    </body>
                </html>
                <div class="container-fluid" style="padding-right: 20px; padding-left: 20px;">
                <hr style="border-top: 1px solid #f5f5f5; border-bottom: 1px solid #cccccc;">   
                <footer style="text-shadow: 0px 1px 9px #99B8C4;font-weight: bold;font-size: smaller;">
               <!--  <div class="row-fluid">
                    <div class="span4">© <?=date('Y')?> SimpleBillings - All Rights Reserved</div>
                    <div class="span4" style="text-align: center;"><p class="center">Powered By <br> <a target="_blank" href="https://www.logicmystery.com"><img style="height: 50px;" src="/img/logicmystery.png"/></a></p></div> -->
                <!-- <div id="google_translate_element" class="span4" style="text-align: right;"></div>
                </div>

                <script type="text/javascript">
                function googleTranslateElementInit() {
                  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                }
                </script>

                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> -->
                </footer>
                </div>