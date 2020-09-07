<style>
    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==') right center no-repeat;
    }



    .chzn-container {
        width: 100% !important;
    }
</style>
<?php

error_reporting(4);

/**
 * add_edit view helper function **
 * 
 *  
 * * */
function field_datepicker($t_key = NULL, $table_meta, $table_td)
{
    if (is_array($table_meta['config']['datepicker_columns'])) {
        $arr_index = array_search($t_key, $table_meta['config']['datepicker_columns']);
        if ($arr_index !== FALSE) {
            ?>

                <div class="control-group span-12">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-calendar"></i></span>

                            <input type="text" class="input-xlarge datepicker " name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                        </div> <span class="help-inline"></span>
                    </div>
                </div>

        <?
                    return true;
                } else {
                    return false;
                }
            }
        }

        function field_date_time_picker($t_key = NULL, $table_meta, $table_td)
        {

            if (is_array($table_meta['config']['datetimepicker_columns'])) {
                $arr_index = array_search($t_key, $table_meta['config']['datetimepicker_columns']);
                if ($arr_index !== FALSE) {
                    ?>

                <div class="control-group span-12">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                            <input typex="text"  type="datetime-local" class="input-xlarge datetimepickerx" name="<?=$t_key ?>" value="<?=  date('Y-m-d\TH:i:s', $table_td?strtotime($table_td):time()) ?>">
                        </div> <span class="help-inline"></span>
                    </div>
                </div>

        <?
                    return true;
                } else {
                    return false;
                }
            }
        }

        function field_status($t_key, $table_meta, $table_td)
        {
            if (is_array($table_meta['config']['use_status_columns'])) {
                if (in_array($t_key, $table_meta['config']['use_status_columns']) === TRUE) {
                    ?>
 <div class="control-group span-12">

                <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                 <div class="controls">
                <input name="<?= $t_key ?>" data-no-uniform="true" type="checkbox" class="iphone-togglex" <?php
                                                                                                                        if (intval($table_td)) {
                                                                                                                            echo 'checked="checked"';
                                                                                                                        }
                                                                                                                        ?> value="1">
</div>
</div>
        <?
                    return true;
                } else {
                    return false;
                }
            }
        }

        function field_textarea($t_key = NULL, $table_meta, $table_td)
        {
            if (is_array($table_meta['config']['textarea_columns'])) {
                $arr_index = array_search($t_key, $table_meta['config']['textarea_columns']);
                if ($arr_index !== FALSE) {
                    ?>

                <div class="control-group span-12">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <div class="controls">
                        <textarea class="cleditor" name="<?= $t_key ?>" id="textarea2" style="width:100%"><?= $table_td ?></textarea>
                        <span class="help-inline"></span>
                    </div>
                </div>

        <?
                    return true;
                } else {
                    return false;
                }
            }
        }

        function is_primry_key($t_key = NULL, $table_meta)
        {
            if ($table_meta['config']['tablePrimaryKey'] == $t_key)
                return TRUE;
            else
                return FALSE;
        }

        function field_image($t_key = NULL, $table_meta, $table_td)
        {
            if (is_array($table_meta['config']['use_image_columns'])) {
                $arr_index = array_search($t_key, $table_meta['config']['use_image_columns']);
                if ($arr_index !== FALSE) {
                    ?>

                <div class="control-group span-12">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <img id="file_uploader_image<?= $t_key ?>" class="file_uploaded_img" style="max-width: 300px" src='<?= $table_td ? ($table_meta['config']['use_image_columns_path'][0] ? $table_meta['config']['use_image_columns_path'][0] : '') . $table_td : cdn_url() . 'uploads/noImage.jpg'; ?>' alt="<?= $table_td ?>" />
                    <div class="controls">
                        <input type="hidden" id="file_uploader_field<?= $t_key ?>" name="<?= $t_key ?>" value="<?= $table_td ?>" value="<?= $table_td ?>" />
                        <input type="file" data-no-uniform="true" id="file_uploader<?= $t_key ?>" />
                        <span class="help-inline"></span>
                    </div>


                <script>
                    $('#file_uploader<?= $t_key ?>').uploadify({
                        'swf': '<?= cdn_url() ?>js/uploadify.swf',
                        'uploader': '<?= cdn_url() ?>uploader/',
                        'multi': <?= $table_meta['config']['multi_upload'] ?>,
                        'onUploadSuccess': function(file, data, response) {
                            $('#file_uploader_image<?= $t_key ?>').attr('src', '<?= $table_meta['config']['use_image_columns_path'][0] ?>' + $.trim(data));
                            $('#file_uploader_field<?= $t_key ?>').val($.trim(data));
                        }
                        // Put your options here
                    });
                </script>
            </div>
        <?
                    return true;
                } else {
                    return false;
                }
            }
        }

        function field_files($t_key = NULL, $table_meta, $table_td)
        {
            if (is_array($table_meta['config']['use_file_columns'])) {
                $arr_index = array_search($t_key, $table_meta['config']['use_file_columns']);
                if ($arr_index !== FALSE) {
                    ?>

                <div class="control-group span-12">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <div class="controls">
                        <span style="width: 100%;display: block;overflow: hidden;">File Name: "<?= $table_td ?>"</span>
                        <input type="hidden" id="file_uploader_field<?= $t_key ?>" name="<?= $t_key ?>" value="<?= $table_td ?>" value="<?= $table_td ?>" />
                        <input type="file" onchange="uploadFile()" data-no-uniform="true" id="file_uploader<?= $t_key ?>" />
                        <span class="help-inline"></span>
                        <progress  id="progressBar<?= $t_key ?>" value="0" max="100" style="width:300px;"></progress>
                        <h3 id="status<?= $t_key ?>"></h3>
                        <p id="loaded_n_total<?= $t_key ?>"></p>
                    </div>

                <script>
                    function _(el) {
                        return document.getElementById(el);
                    }

                    function uploadFile() {
                        var file = _("file_uploader<?= $t_key ?>").files[0];
                        // alert(file.name+" | "+file.size+" | "+file.type);
                        var formdata = new FormData();
                        formdata.append("Filedata", file);
                        formdata.append("FilePath",  '<?php echo isset( $table_meta['config']['use_file_columns_path'][$t_key])?$table_meta['config']['use_file_columns_path'][$t_key]:''?>');

                        var ajax = new XMLHttpRequest();
                        ajax.upload.addEventListener("progress", progressHandler, false);
                        ajax.addEventListener("load", completeHandler, false);
                        ajax.addEventListener("error", errorHandler, false);
                        ajax.addEventListener("abort", abortHandler, false);
                        ajax.open("POST", "<?= cdn_url() ?>uploader/"); 
                        ajax.send(formdata);
                    }

                    function progressHandler(event) {
                        _("loaded_n_total<?= $t_key ?>").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
                        var percent = (event.loaded / event.total) * 100;
                        _("progressBar<?= $t_key ?>").value = Math.round(percent);
                        _("status<?= $t_key ?>").innerHTML = Math.round(percent) + "% uploaded... please wait";
                    }

                    function completeHandler(event) {
                        _("status<?= $t_key ?>").innerHTML = event.target.responseText;
                        _("file_uploader_field<?= $t_key ?>").value = event.target.responseText;
                        _("progressBar<?= $t_key ?>").value = 0; //wil clear progress bar after successful upload
                    }

                    function errorHandler(event) {
                        _("status<?= $t_key ?>").innerHTML = "Upload Failed";
                    }

                    function abortHandler(event) {
                        _("status<?= $t_key ?>").innerHTML = "Upload Aborted";
                    }
                </script>
            </div>
        <?
                    return true;
                } else {
                    return false;
                }
            }
        }

        function field_dropdown($t_key = NULL, $table_meta, $table_td)
        {
            if (is_array($table_meta['config']['use_dropdown_columns'])) {
                $arr_index = array_search($t_key, $table_meta['config']['use_dropdown_columns']);
                if ($arr_index !== FALSE) {
                    ?>

                <div class="control-group span-12 spab">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <div class="controls">
                        <select <?= is_readonly($t_key, $table_meta['config']['readonly_columns']) ? 'disabled = "disabled"' : '' ?> <?= isset($table_meta['config']['use_dropdown_columns_options']['multi'][$t_key]) ? " multiple name='" . $t_key . "[]'" : " name='$t_key'" ?> data-placeholder="type here" data-rel="chosen">
                            <option value="">--Choose An Option-- </option>
                            <?php
                                        $optionList = (isset($table_meta['config']['use_dropdown_columns_options'][$t_key]) ? $table_meta['config']['use_dropdown_columns_options'][$t_key] : $table_meta['config']['use_dropdown_columns_options']);
                                        foreach ($optionList as $optkey => $optvalue) :
                                            ?>
                                <option value="<?= $optkey ?>" <?php
                                                                                if (isset($table_meta['config']['use_dropdown_columns_options']['multi'][$t_key])) {
                                                                                    if (!empty($table_td) && array_search($optkey, json_decode($table_td, TRUE)) !== FALSE) {
                                                                                        ?>selected="selected" <?php
                                                                                    }
                                                                                } else {
                                                                                    if ($optkey == $table_td) {
                                                                                        ?>selected="selected" <?php
                                                                                            }
                                                                                        }
                                                                                        ?>><?= $optvalue ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-inline"></span>
                    </div>
                </div>

        <?
                    return true;
                } else {
                    return false;
                }
            }
        }

        function field_text($t_key = NULL, $table_meta, $table_td)
        {
            if (is_readonly($t_key, $table_meta) || is_primry_key($t_key, $table_meta)) {
                ?>

            <div class="control-group span-12">
                <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                <div class="controls">
                    <input type="text"  class="input-xlarge" readonly="readonly" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                    <span class="help-inline"></span>
                </div>
            </div>

    <?
        } else {

            ?>


            <div class="control-group span-12">
                <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                <div class="controls">
                    <input type="text" class="input-xlarge" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                    <span class="help-inline"></span>
                </div>
            </div>

<?
    }
}
?>
<form id="addEditForm" class="form-horizontal" method="post" action="save_details" onsubmit="return false">
<fieldset>    
<?php foreach ($table_meta['data'] as $t_key => $table_td) : ?>
        <?php
         $field_value = null;
            if (!is_array($table_td))
                $field_value = $table_td;

            if (field_status($t_key, $table_meta, $field_value))
                continue;
            if (field_image($t_key, $table_meta, $field_value))
                continue;
                if (field_files($t_key, $table_meta, $field_value))
                continue;
            if (field_dropdown($t_key, $table_meta, $field_value))
                continue;

            if (field_textarea($t_key, $table_meta, $field_value))
                continue;
            if (field_datepicker($t_key, $table_meta, $field_value))
                continue;
            if (field_date_time_picker($t_key, $table_meta, $field_value))
                continue;
            field_text($t_key, $table_meta, $field_value);
            ?>
    <?php endforeach; ?>
</fieldset>
    <div class="form-actions" style="clear: both">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button class="btn" onclick="goBack()">Cancel</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.iphone-togglex').iphoneStyle()
            $('.file_uploader').uploadify({
                'swf': '<?= cdn_url() ?>js/uploadify.swf',
                'uploader': '<?= cdn_url() ?>uploader/',
                'multi': <?= $table_meta['config']['multi_upload'] ?>,
                'onUploadSuccess': function(file, data, response) {
                    $('.file_uploaded_img').attr('src', '<?= $table_meta['config']['use_image_columns_path'][0] ?>' + $.trim(data));
                    $('#file_uploader_field').val($.trim(data));
                }
                // Put your options here
            });
        }, 200);
    })
    var validationMeta = $.parseJSON('<?= json_encode($table_meta['config']['validation']); ?>');
    $.each(validationMeta, function(key, value) {
        $('#addEditForm').find('[name=' + key + ']').attr('from-validation', value);
    });

	var datenow = '<?=date("Y-m-s H")?>'
    //$('.cleditor').cleditor();
    <?php if (isset($this->page_config['autocomplete'])) : ?>
        var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
        $.each(autoComplete, function(targetField, value) {
            $.each(value, function(model, fieldToSearch) {
                $('[name="' + targetField + '"]').autocomplete({
                    source: page_url + "autocomplete/" + model + '/' + fieldToSearch,
                    minLength: 1
                });
            });
        });
    <?php endif; ?>
    /*****/
</script>
