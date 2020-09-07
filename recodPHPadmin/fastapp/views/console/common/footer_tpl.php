<!-- content ends -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->

<hr>

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3 class="modal-title">Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here settings can be configured...</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">OK</a>
    </div>
</div>

<div class="modal hide fade" id="formModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body">
        <p></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
    </div>
</div>

<div class="modal hide fade" id="formAddEditModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body">
        <p></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
    </div>
</div>

<footer>
    <p class="pull-left"><?= $site_settings['site_setting_copyright'] ?></p>
<!--    <p class="pull-right">Developed by: <a href="http://hex-co.de">HexCode</a></p>-->
</footer>

</div><!--/.fluid-container-->

<!-- external javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- jQuery UI -->
<script src="<?= cdn_url(); ?>js/jquery-ui-1.8.21.custom.min.js"></script>
<!-- transition / effect library -->
<script src="<?= cdn_url(); ?>js/bootstrap-transition.js"></script>
<!-- alert enhancer library -->
<script src="<?= cdn_url(); ?>js/bootstrap-alert.js"></script>
<!-- modal / dialog library -->
<script src="<?= cdn_url(); ?>js/bootstrap-modal.js"></script>
<!-- custom dropdown library -->
<script src="<?= cdn_url(); ?>js/bootstrap-dropdown.js"></script>
<!-- scrolspy library -->
<script src="<?= cdn_url(); ?>js/bootstrap-scrollspy.js"></script>
<!-- library for creating tabs -->
<script src="<?= cdn_url(); ?>js/bootstrap-tab.js"></script>
<!-- library for advanced tooltip -->
<script src="<?= cdn_url(); ?>js/bootstrap-tooltip.js"></script>
<!-- popover effect library -->
<script src="<?= cdn_url(); ?>js/bootstrap-popover.js"></script>
<!-- button enhancer library -->
<script src="<?= cdn_url(); ?>js/bootstrap-button.js"></script>
<!-- accordion library (optional, not used in demo) -->
<script src="<?= cdn_url(); ?>js/bootstrap-collapse.js"></script>
<!-- carousel slideshow library (optional, not used in demo) -->
<script src="<?= cdn_url(); ?>js/bootstrap-carousel.js"></script>
<!-- autocomplete library -->
<script src="<?= cdn_url(); ?>js/bootstrap-typeahead.js"></script>
<!-- tour library -->
<script src="<?= cdn_url(); ?>js/bootstrap-tour.js"></script>
<!-- library for cookie management -->
<script src="<?= cdn_url(); ?>js/jquery.cookie.js"></script>
<!-- data table plugin -->
<script src='<?= cdn_url(); ?>js/jquery.dataTables.min.js'></script>

<!-- chart libraries start -->
<script src="<?= cdn_url(); ?>js/excanvas.js"></script>
<script src="<?= cdn_url(); ?>js/jquery.flot.min.js"></script>
<script src="<?= cdn_url(); ?>js/jquery.flot.pie.min.js"></script>
<script src="<?= cdn_url(); ?>js/jquery.flot.stack.js"></script>
<script src="<?= cdn_url(); ?>js/jquery.flot.resize.min.js"></script>
<!-- chart libraries end -->

<!-- select or dropdown enhancer -->
<script src="<?= cdn_url(); ?>js/jquery.chosen.min.js"></script>
<!-- checkbox, radio, and file input styler -->
<script src="<?= cdn_url(); ?>js/jquery.uniform.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?= cdn_url(); ?>js/jquery.colorbox.min.js"></script>
<!-- rich text editor library -->
<script src="<?= cdn_url(); ?>js/jquery.cleditor.min.js"></script>
<!-- notification plugin -->
<script src="<?= cdn_url(); ?>js/jquery.noty.js"></script>
<!-- file manager library -->
<script src="<?= cdn_url(); ?>js/jquery.elfinder.min.js"></script>
<!-- star rating plugin -->
<script src="<?= cdn_url(); ?>js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?= cdn_url(); ?>js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?= cdn_url(); ?>js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?= cdn_url(); ?>js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?= cdn_url(); ?>js/jquery.history.js"></script>
<script src="<?= cdn_url(); ?>js/jquery.datetimepicker.js"></script>
<script src="<?= cdn_url(); ?>js/bootstrap-tagsinput.js"></script>



<!-- application script for Charisma demo -->
<script src="<?= cdn_url(); ?>js/charisma.js"></script>


<!-- application script for projectx -->
<script src="<?= cdn_url(); ?>js/fastapp.js"></script>
    <? execute_hook('footer');?>
</body>
</html>
