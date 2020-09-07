
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-list-alt"></i>admin Profile</h2>
        </div>
        <div class="box-content">
            <div class="center">
                

                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-list-alt"></i>Profile Details</h2>
                    </div>
                    <div class="box-content">
                        <div class="center">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>

                                    <tr>
                                        <th>Name</th>           
                                        <th>Data</th> 
                                    </tr>
                                </thead>   
                                <tbody>
                                    <tr>    
                                        <td class="center">Name</td>                    

                                        <td class="center"><?= htmlspecialchars_decode($table_meta['data']['admin_firstname'].' '.$table_meta['data']['admin_lastname']) ?></td>

                                    </tr>

                                    <tr>    
                                        <td class="center">E-mail</td>                    

                                        <td class="center"><?= htmlspecialchars_decode($table_meta['data']['admin_email']) ?></td>

                                    </tr>

                         
                                    <tr>
                                        <td class="center" colspan="2">
                                            <button class="btn btn-info" onclick="editProfile()">Edit</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
        /*save operation
         **/
        var saveOperation = function(method) {
            if (validate_form($('#addEditForm'),
                    {
                        beforeValidation: function(targetObject) {
                            $(targetObject).parent().parent('.control-group').removeClass('error');
                            $(targetObject).parent().parent('.control-group').find('.help-inline').html('');

                        },
                        onValidationError: function(targetObject, validationType) {
                            $(targetObject).parent().parent('.control-group').addClass('error');
                            switch (validationType) {
                                case 'required':
                                    $(targetObject).parent().parent('.control-group').find('.help-inline').html('This is Required!!');
                                    break;
                                default:
                                    $(targetObject).parent().parent('.control-group').find('.help-inline').html('Please Enter A valid Data');
                            }
                        },
                        captchaValidator: function(targetObject) {
                            return validate_captcha(targetObject);
                        },
                        duplicateValidator: function(targetObject) {
                            return duplicate_check(targetObject);
                        }

                    })) {
                
                currentPostRequest = $.post(page_url+'edit_profile', $('#addEditForm').serialize(), function(respData) {
                    if (respData.status = 'success') {

                        $('.modal-body p').html(respData.message);
                        $('#myModal').modal('show');
                        $('.modal-footer .btn-primary').removeClass('btn-danger btn-success').addClass('btn-success').attr('onclick', 'goBack();');

                        setTimeout(function() {
                            goBack();
                        }, 1000);
                        //
                    }
                }, 'json');
            }

        }


        /*****/
           /**
         *Edit single operations
         **/
        editProfile = function(targetItem) {
            var loadEditForm = function() {
                currentPostRequest = $.post(page_url + 'edit_profile', {
                    'load_edit_entry': ''
                }, function(respData) {
                    if (respData != '') {
                        $('.index-wrapper').html(respData);
                        $('.breadcrumb').append('<li><a href="javascript:void(0);">Edit Detail</a></li>');
                        if (typeof $('.form-actions button.btn-primary').attr('onclick') == 'undefined') {
                            $('.form-actions button.btn-primary').attr('onclick', "saveOperation('edit')");
                        }
                        setTimeout(function() {
                            $('.iphone-toggle').iphoneStyle();
                            $('[data-rel="chosen"],[rel="chosen"]').chosen();
                            $('.datepicker').each(function() {

                                dateVal = $(this).val();
                                $(this).datepicker();
                                $(this).datepicker("option", "dateFormat", "yy-mm-dd");
                                $(this).datepicker("setDate", dateVal);
                            });


                        }, 300);
                    }
                }, 'html');
            }

            loadEditForm(targetItem);
        }


</script>