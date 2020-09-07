/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var current_language = null;
$(document).ready(function () {
    /**
     * for language
     * 
     * */
    current_language = $.cookie('current_language') == null ? '1' : $.cookie('current_language');
    $('#language a[data-value="' + current_language + '"]').find('i').addClass('icon-ok');
    $('#language a').click(function (e) {
        e.preventDefault();
        current_language = $(this).attr('data-value');
        $.cookie('current_language', current_language, {expires: 365, path: '/'});
        $('#language i').removeClass('icon-ok');
        $(this).find('i').addClass('icon-ok');
        window.location.reload();
    });



    /*********foldabale nav***********/
    $('.accordion > a').click(function (e) {
        console.log(1123);
        e.preventDefault();
        var $ul = $(this).siblings('ul');
        var $li = $(this).parent();
        if ($ul.is(':visible'))
            $li.removeClass('active').parent('ul').parent('li').find('i').removeClass('icon-chevron-down').addClass('icon-chevron-right');
        else
            $li.addClass('active').parent('ul').parent('li').find('i').removeClass('icon-chevron-right').addClass('icon-chevron-down');
        $ul.slideToggle();
        console.log($li);
    });

    $('.accordion li.active:first').parents('ul').slideDown();
    $('.accordion li.active:first').parent('ul').parent('li').addClass('active');
    $('.accordion li.active:first').parent('ul').parent('li').find('i').removeClass('icon-chevron-right').addClass('icon-chevron-down');

    /*********foldabale nav***********/


    /**
     *for table_tpl.php
     **/
    /**
     *for select all
     **/
    $('.btn_select_all').live('click', function () {
        $(this).parent('form').find('.selectedItem').attr('checked', 'checked').parent('span').addClass('checked');
    });


    /**
     *for deselect all
     **/
    $('.btn_deselect_all').live('click', function () {
        $(this).parent('form').find('.selectedItem').removeAttr('checked').parent('span').removeClass('checked');
    });

    $('.datepicker').each(function () {

        dateVal = $(this).val();
        $(this).datepicker();
        $(this).datepicker("option", "dateFormat", "yy-mm-dd");
        $(this).datepicker("setDate", dateVal);
    });


    $('.datetimepicker').each(function () {
        $(this).datetimepicker();
    });
    /**
     * table order loader
     * */
    if ($(".orderable").length)
        reorderTable();
    else
        setSorting();
});


var currentPostRequest = null;
/***
 *pagination
 *
 *must follow the .pagination ul li a structure
 */
var currentPageinationLink = '';
ajaxPagination = function () {

    $('.pagination ul li a').live('click', function (e) {
        e.preventDefault();
        console.log($(this).attr('href'));
        currentPageinationLink = $(this).attr('href');
        if ($(this).attr('href') == '#') {
            return;
        }
        targetObj = $(this);

        currentPostRequest = $.post($(this).attr('href'), $('.search-table-form').serialize()
                , function (resData) {
                    $(targetObj).parents('.table_view_wrapper').html('').html(resData);
                    //$('body').animate({scrollTop:400}, '500');
                    postTableGeneration();
                }, 'html');
        return;
    });
}

/**
 *search box
 ***/
$('.search_box input').on('change', function () {
    initSearch();
});

$('.search_box select').on('change', function () {
    initSearch();
});

$('.search_box .iphone-toggle').iphoneStyle({
    onChange: function () {
        initSearch();
    }
});

/**
 * post table generation 
 *
 **/
function postTableGeneration() {
    $(window).ready();
    $(document).ready();
    docReady();

    if ($(".orderable").length)
        reorderTable();
    else
        setSorting();
}
var postDetailLoad = function () {
}
/**
 *init search
 **/
initSearch = function () {
    $(window).ready();
    $(document).ready();
    var dataToPost = $('.search-table-form').serialize();
    if (dataToPost == '') {
        dataToPost = {
            'dummy': 'hammy'
        };
    }
    var formUrl = '';
    if (typeof $('.search-table-form').attr('action') != 'undefined') {
        formUrl = $('.search-table-form').attr('action');
    }
    currentPostRequest = $.post(page_url + formUrl, dataToPost
            , function (resData) {
                $('.table_view_wrapper').html('').html(resData);
                postTableGeneration();
            }, 'html');
   currentPageinationLink="";
}

/**********************************************delete operation***************************/
/**
 *delete all operations
 **/
popupDeleteAll = function () {
    $('.modal-header h3').html('Delete Selected');
    $('.modal-footer .btn-primary').html('Yes! Delete All Selected');
    $('.modal-body p').html('Are You Sure to delete the selected?');
    $('.modal-footer .btn-primary').removeClass('btn-danger btn-success').addClass('btn-danger').attr('onclick', 'deleteAllOperation();');
    $('#myModal').modal('show');
}
var deleteAllOperation = function () {

    currentPostRequest = $.post(page_url + 'delete', $('.choose_entry_form').live().serialize(), function (respData) {
        if (respData.status != '') {
            $('#myModal').modal('hide');
            initSearch();
        }
    }, 'json');
}

/**
 *delete sinle operations
 **/
popupDeleteSingle = function (targetItem) {
    $('.modal-header h3').html('Delete');
    $('.modal-footer .btn-primary').html('Yes! Delete This Entry');
    $('.modal-body p').html('Are You Sure to delete this entry?');
    $('.modal-footer .btn-primary').removeClass('btn-danger btn-success').addClass('btn-danger').attr('onclick', 'deleteSingleOperation("' + targetItem + '");');
    $('#myModal').modal('show');
}
var deleteSingleOperation = function (targetItem) {

    currentPostRequest = $.post(page_url + 'delete', {
        entry: targetItem
    }, function (respData) {
        if (respData.status != '') {
            $('#myModal').modal('hide');
            initSearch();
        }
    }, 'json');
}
/**********************************************delete operation***************************/

/**********************************************view operation***************************/
/**
 *Preview single operations
 **/
popupViewSingle = function (targetItem) {
    $('.modal-header h3').html('Detail');
    $('.modal-footer .btn-primary').html('Ok!');
    $('.modal-body p').html('Please Wait...');
    viewSingleOperation(targetItem);
    $('.modal-footer .btn-primary').removeClass('btn-danger btn-success').addClass('btn-success').attr('onclick', "$('#myModal').modal('hide')");
    $('#myModal').modal('show');
}
var viewSingleOperation = function (targetItem) {
    currentPostRequest = $.post(page_url + 'view_detail', {
        entry: targetItem
    }, function (respData) {
        if (respData != '') {
            $('.modal-body p').html(respData);
            postDetailLoad();
        }
    }, 'html');
}
/**********************************************view operation***************************/


/**********************************************Edit operation***************************/
/**
 *Edit single operations
 **/
popupEditSingle = function (targetItem) {
    $('#formAddEditModal .modal-header h3').html('Edit Detail');
    $('#formAddEditModal .modal-footer .btn-primary').html('Save!');
    $('#formAddEditModal .modal-body p').html('Please Wait...');
    loadEditForm(targetItem);
    //$('.modal-footer .btn-primary').removeClass('btn-danger btn-success').addClass('btn-success').attr('onclick', "saveSingleOperation()");
    $('#formAddEditModal').modal('show');
}
var loadEditForm = function (targetItem) {

    currentPostRequest = $.post(page_url + 'edit_detail', {
        'load_edit_entry': targetItem
    }, function (respData) {
        if (respData != '') {
            $('#formAddEditModal .modal-body p').html(respData);
            setTimeout(function () {
                $('.iphone-toggle').iphoneStyle();
                $('[data-rel="chosen"],[rel="chosen"]').chosen();
                $('.datepicker').each(function () {

                    dateVal = $(this).val();
                    $(this).datepicker();
                    $(this).datepicker("option", "dateFormat", "yy-mm-dd");
                    $(this).datepicker("setDate", dateVal);
                });

                $('.datetimepicker').each(function () {
                    dateVal = $(this).val();
                    $(this).datetimepicker();
                });

                $('#formAddEditModal input:first').focus();

            }, 300);
            $('#formAddEditModal .form-actions button[type="submit"]').attr('onclick', "saveSingleOperation()");

        }
    }, 'html');
}
var saveSingleOperation = function () {
    if (validate_form($('#addEditForm'),
            {
                beforeValidation: function (targetObject) {
                    $(targetObject).parent().parent('.control-group').removeClass('error');
                    $(targetObject).parent().parent('.control-group').find('.help-inline').html('');

                },
                onValidationError: function (targetObject, validationType) {
                    $(targetObject).parent().parent('.control-group').addClass('error');
                    switch (validationType) {
                        case 'required':
                            $(targetObject).parent().parent('.control-group').find('.help-inline').html('This is Required!!');
                            break;
                        default:
                            $(targetObject).parent().parent('.control-group').find('.help-inline').html('Please Enter A valid Data');
                    }
                },
                captchaValidator: function (targetObject) {
                    return validate_captcha(targetObject);
                },
                duplicateValidator: function (targetObject) {
                    return duplicate_check(targetObject);
                }

            })) {

        currentPostRequest = $.post(page_url + 'edit_detail', $('#addEditForm').serialize(), function (respData) {
            if (respData.status = 'success') {

                currentPostRequest = $.post(currentPageinationLink, $('.search-table-form').serialize()
                        , function (resData) {
                            $('.table_view_wrapper').html('').html(resData);
                            postTableGeneration();
                        }, 'html');


                $('#formAddEditModal .modal-body p').html(respData.message);
                $('#formAddEditModal .modal-footer .btn-primary').removeClass('btn-danger btn-success').addClass('btn-success').removeAttr('onclick');

                setTimeout(function () {
                    $('#formAddEditModal').modal('hide');


                }, 3000);
                //
            }
        }, 'json');
    }

}
/**********************************************Edit operation***************************/

/**********************************************add operation***************************/
/**
 *Add single operations
 **/
popupAddNew = function (targetItem) {
    $('#formAddEditModal .modal-header h3').html('Add New Entry');
    $('#formAddEditModal .modal-footer .btn-primary').html('Save!');
    $('#formAddEditModal .modal-body p').html('Please Wait...');
    loadAddForm(targetItem);
    //$(' #formAddEditModal .modal-footer .btn-primary').removeClass(' btn-danger btn-success').addClass('btn-success').attr('onclick', "addSingleOperation()");
    $('#formAddEditModal').modal('show');
}
var loadAddForm = function () {

    currentPostRequest = $.post(page_url + 'add_detail', {
        'load_add_entry': 'yes'
    }, function (respData) {
        if (respData != '') {
            $('#formAddEditModal .modal-body p').html(respData);
            setTimeout(function () {
                $(document).find('.iphone-toggle').iphoneStyle();
                $(document).find('.chosen-select-deselect').chosen({
                    allow_single_deselect: true
                });
                $(document).find('[data-rel="chosen"],[rel="chosen"]').chosen();
                $(document).find('.datepicker').each(function () {
                    dateVal = $(this).val();
                    $(this).datepicker();
                    $(this).datepicker("option", "dateFormat", "yy-mm-dd");
                    $(this).datepicker("setDate", dateVal);
                });
                $(document).find('.datetimepicker').each(function () {
                    dateVal = $(this).val();
                    $(this).datetimepicker();
                });
                $('#formAddEditModal input:first').focus();
            }, 500);
            $('#formAddEditModal .form-actions button[type="submit"]').attr('onclick', "addSingleOperation()");
        }
    }, 'html');
}
var addSingleOperation = function () {
    if (validate_form($('#addEditForm'),
            {
                beforeValidation: function (targetObject) {
                    $(targetObject).parent().parent('.control-group').removeClass('error');
                    $(targetObject).parent().parent('.control-group').find('.help-inline').html('');

                },
                onValidationError: function (targetObject, validationType) {
                    $(targetObject).parent().parent('.control-group').addClass('error');
                    switch (validationType) {
                        case 'required':
                            $(targetObject).parent().parent('.control-group').find('.help-inline').html('This is Required!!');
                            break;
                        default:
                            $(targetObject).parent().parent('.control-group').find('.help-inline').html('Please Enter A valid Data');
                    }
                },
                captchaValidator: function (targetObject) {
                    return validate_captcha(targetObject);
                },
                duplicateValidator: function (targetObject) {
                    return duplicate_check(targetObject);
                }

            })) {

        currentPostRequest = $.post(page_url + 'add_detail', $('#addEditForm').serialize(), function (respData) {
            if (respData.status = 'success') {

                currentPostRequest = $.post(currentPageinationLink, $('.search-table-form').serialize()
                        , function (resData) {
                            $('.table_view_wrapper').html('').html(resData);
                            postTableGeneration();
                        }, 'html');


                $('#formAddEditModal .modal-body p').html(respData.message);
                $('#formAddEditModal .modal-footer .btn-primary').removeClass('btn-danger btn-success').addClass('btn-success').removeAttr('onclick');
                setTimeout(function () {
                    $('#formAddEditModal').modal('hide');

                }, 3000);
                //
            }
        }, 'json');
    }


}
/**********************************************Edit operation***************************/

/**
 *@name validate_form
 *@description  all in one from validation
 * user can use it by putting attribute from-validation="required|email|.."
 *@param object targetForm target form
 *@param object settings callbacks
 *@ the callbacks are
 *@ function beforeValidation 
 *@ function onValidationSuccess 
 *@ function onValidationError 
 *@type bool true|false on full validated or error
 *
 */
function validate_form(targetForm, settings) {
    formInputs = $(targetForm).find('input,textarea,hidden,select');
    passWords = {};
    var isValid = true;
    $(formInputs).each(function () {
        beforeValidation($(this));
        fromvalidation = '';
        fromvalidation = $(this).attr('from-validation');
        if (typeof fromvalidation != "undefined") {
            validationArray = fromvalidation.split('|');
            // console.log($.inArray('required', validationArray));
            if ($.inArray('required', validationArray) != -1) {
                if (!required_validation($(this))) {
                    onValidationError($(this), 'required');
                    isValid = false;
                }
            }

            if ($.inArray('password', validationArray) != -1) {
                if ($.inArray('confirm', validationArray) != -1) {
                    passWords[1] = $(this);
                    if (!confirm_password_validation(passWords)) {
                        onValidationError($(this), 'password');
                        isValid = false;
                    }
                } else {
                    passWords[0] = $(this);
                }

            }
            if ($.inArray('email', validationArray) != -1) {
                if (!email_validation($(this))) {
                    onValidationError($(this), 'email');
                    isValid = false;
                }
            }

            if ($.inArray('captcha', validationArray) != -1) {
                if (!captcha_validation($(this))) {
                    onValidationError($(this), 'captcha');
                    isValid = false;
                }
            }

            if ($.inArray('duplicate', validationArray) != -1) {
                if (!duplicate_validation($(this))) {
                    onValidationError($(this), 'duplicate');
                    isValid = false;
                }
            }
        }
    });
    /**
     *CONFIRM PASSWORD FIELD VALIDATION
     **/
    function confirm_password_validation(targetObjects) {
        console.log(targetObjects);
        if ($(targetObjects[0]).val() == $(targetObjects[1]).val()) {
            return true;
        } else {
            return false;
        }
    }
    /**
     *REQUIRED FIELD VALIDATION
     **/
    function required_validation(targetObject) {
        if ($.trim($(targetObject).val()) == '') {

            return false;
        } else {
            return true;
        }
    }

    /**
     *Captcha VALIDATION
     **/
    function captcha_validation(targetObject) {
        if ($.trim($(targetObject).val()) == '') {
            return false;
        } else {
            if (typeof settings.captchaValidator == 'function') {
                return settings.captchaValidator(targetObject);
            }
            return false;
        }
    }
    /**
     *Duplicate VALIDATION
     **/
    function duplicate_validation(targetObject) {
        if ($.trim($(targetObject).val()) == '') {
            return false;
        } else {
            if (typeof settings.duplicateValidator == 'function') {
                return settings.duplicateValidator(targetObject);
            }
            return false;
        }
    }
    /**
     *EMAIL VALIDATION
     **/
    function email_validation(targetObject) {
        var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
        if (emailRegex.test($.trim($(targetObject).val()))) {
            return true;
        } else {
            return false;
        }
    }
    /**a default AFTER VALIDATION ERROR function **/
    function onValidationError(targetObject, validationType) {
        if (typeof settings.onValidationError == 'function') {
            settings.onValidationError(targetObject, validationType);
        }
    }
    /**a default PREVALIDATE function **/
    function beforeValidation(targetObject) {
        if (typeof settings.beforeValidation == 'function') {
            settings.beforeValidation(targetObject);
        }
    }

    if (isValid) {
        function onValidationSuccess() {
            if (typeof settings.onValidationSuccess == 'function') {
                settings.onValidationSuccess();
            }
        }
    }

    return isValid;
}

/**
 *event caender*/
if ($("#eventCalendar").length) {
    $("#eventCalendar").eventCalendar({
        eventsjson: console_url + 'home/event_json',
        jsonDateFormat: 'human'
    });
}
/*
 **
 *pie chart
 **/
var dataP = [
    {
        label: "Internet Explorer",
        data: 12
    },
    {
        label: "Mobile",
        data: 27
    },
    {
        label: "Safari",
        data: 85
    },
    {
        label: "Opera",
        data: 64
    },
    {
        label: "Firefox",
        data: 90
    },
    {
        label: "Chrome",
        data: 112
    }
];
$(document).ready(function () {
    if ($("#piechart").length)
    {
        generatePieChart($("#piechart"));
    }

    if ($("#donutchart").length)
    {
        generateDonutChat($("#donutchart"));
    }

});

$(window).resize(function () {
    if ($("#piechart").length)
    {
        generatePieChart($("#piechart"));
    }

    if ($("#donutchart").length)
    {
        generateDonutChat($("#donutchart"));
    }
});


/** sorting function start**/

/**
 *set sorting order
 **/

var setSorting = function () {
    $('.shorter').bind('click', function () {
        $('.shorter').not(this).removeClass('icon-triangle-n').removeClass('icon-triangle-s').addClass('icon-triangle-ns');
        var sortingOrder = '';
        var sortingField = $(this).attr('data-rel');
        if ($(this).hasClass('icon-triangle-s')) {
            sortingOrder = 'asc';
            $(this).removeClass('icon-triangle-s').addClass('icon-triangle-n');
        } else if ($(this).hasClass('icon-triangle-n')) {
            sortingOrder = 'desc';
            $(this).removeClass('icon-triangle-n').addClass('icon-triangle-s');
        } else {
            sortingOrder = 'desc';
            $(this).removeClass('icon-triangle-ns').addClass('icon-triangle-s');
        }

        $.cookie('orderBy_' + section, sortingField + ':' + sortingOrder, {
            expires: 365,
            path: section
        });

        initSearch();
    });
    if ($.cookie('orderBy_' + section)) {
        var orderBy = $.cookie('orderBy_' + section).split(':');
        var sortingField = orderBy[0];
        var sortingOrder = orderBy[1];
        $('.shorter').each(function () {
            if ($(this).attr('data-rel') == sortingField) {
                if (sortingOrder == 'desc') {
                    $(this).removeClass('icon-triangle-ns').addClass('icon-triangle-s');
                }
                if (sortingOrder == 'asc') {
                    $(this).removeClass('icon-triangle-ns').addClass('icon-triangle-n');
                }

            }
        });
    }

}

$(document).ready(function () {

    if ($("#viewport").length) {
        initTree($("#viewport"));
    }




    /** sorting function end**/
    initWidgetLoad();
})

//stack chart
if ($("#purchaseChart").length)
{
    var d1 = [];
    for (var i = 0; i <= 12; i += 1) {
        d1[i] = [i, parseInt(Math.random() * 30)];
    }
    //d1.push([1, parseInt(Math.random() * 30)]);

    var d2 = [];
    for (var i = 0; i <= 10; i += 1)
        d2.push([i, parseInt(Math.random() * 30)]);

    var d3 = [];
    for (var i = 0; i <= 10; i += 1)
        d3.push([i, parseInt(Math.random() * 30)]);

    var stack = 0, bars = true, lines = false, steps = false;
    console.log([d1]);
    function plotWithOptions() {
        $.plot($("#purchaseChart"), [d1], {
            series: {
                stack: stack,
                lines: {
                    show: lines,
                    fill: true,
                    steps: steps
                },
                bars: {
                    show: bars,
                    barWidth: 0.6
                }
            }
        });
    }

    plotWithOptions();

    $(".stackControls input").click(function (e) {
        e.preventDefault();
        stack = $(this).val() == "With stacking" ? true : null;
        plotWithOptions();
    });
    $(".graphControls input").click(function (e) {
        e.preventDefault();
        bars = $(this).val().indexOf("Bars") != -1;
        lines = $(this).val().indexOf("Lines") != -1;
        steps = $(this).val().indexOf("steps") != -1;
        plotWithOptions();
    });
}

/****
 *comment feed section
 ***/
$(document).ready(function () {
    if (typeof commentFeed != 'undefined') {
        commentFeed();
        setInterval(function () {
            commentFeed()
        }, 10000);
    }
});
/**
 *Preview single Profile
 **/
popupviewProfile = function (targetItem) {
    /**load and generate data in popup*/
    var viewSingleOperation = function (targetItem) {

        currentPostRequest = $.post(console_url + 'user/profile', {
            entry: targetItem
        }, function (respData) {
            if (respData != '') {
                $('.modal-body p').html(respData);
            }
        }, 'html');
    }

    $('.modal-header h3').html('Detail');
    $('.modal-footer .btn-primary').html('Ok!');
    $('.modal-body p').html('Please Wait...');
    viewSingleOperation(targetItem);
    $('.modal-footer .btn-primary').removeClass('btn-danger btn-success').addClass('btn-success').attr('onclick', "$('#myModal').modal('hide')");
    $('#myModal').modal('show');

}

/**********************************************view operation***************************/
var topLoader = null;

setInterval(function () {
    if (currentPostRequest != null) {
        if (currentPostRequest.readyState == 4) {
            $('#noty_xhr').hide()
            docReady();
        }

        if (currentPostRequest.readyState == 1) {
            $('#noty_xhr').show();
        }
    }
}, 100);


/**
 *
 *widget start
 ***/
var initWidgetLoad = function () {
    $(widgetArray).each(function (key, widgetElement) {
        $.post(console_url + widgetElement + '/widget', {
            bla: 'bla'
        }, function (respData) {
            $('.widget-area').append(respData);
            docReady();
        }, 'html');
    });


}

var widgetArray = Array();
var loadWidget = function (targetFunction) {
    widgetArray.push(targetFunction);
}

/**
 *
 *widget ends
 ***/
/****************special*********/

/**********************************************view operation***************************/
/**
 *Preview single operations
 **/
generateDetailedView = function (targetItem) {
    var viewSingleOperation = function (targetItem) {
        currentPostRequest = $.post(page_url + 'view_detail', {
            entry: targetItem
        }, function (respData) {
            if (respData != '') {
                $('.modal-body p').html(respData);
                $('#myModal').modal('show');
            }
        }, 'html');
    }
    viewSingleOperation(targetItem);
}
/**********************************************view operation***************************/

/**********************************************Edit operation***************************/
/**
 *Edit single operations
 **/
generateEditView = function (targetItem) {
    var loadEditForm = function (targetItem) {
        currentPostRequest = $.post(page_url + 'edit_detail', {
            'load_edit_entry': targetItem
        }, function (respData) {
            if (respData != '') {
                $('.index-wrapper').html(respData);
                if ($('.br_edt').length == 0)
                    $('.breadcrumb').append('<li class="br_edt"><a href="javascript:void(0);">Edit Detail</a></li>');
                if (typeof $('.form-actions button.btn-primary').attr('onclick') == 'undefined') {
                    $('.form-actions button.btn-primary').attr('onclick', "saveOperation('edit')");
                }
                setTimeout(function () {
                    $('.iphone-toggle').iphoneStyle();
                    $('[data-rel="chosen"],[rel="chosen"]').chosen();
                    $('.datepicker').each(function () {

                        dateVal = $(this).val();
                        $(this).datepicker();
                        $(this).datepicker("option", "dateFormat", "yy-mm-dd");
                        $(this).datepicker("setDate", dateVal);
                    });

                    $('.datetimepicker').each(function () {
                        $(this).datetimepicker({format: 'Y-m-d H:i:s'});
                    });
                }, 300);
            }
        }, 'html');
    }

    loadEditForm(targetItem);
}


/**********************************************Edit operation***************************/

/**********************************************add operation***************************/
/**
 *Add single operations
 **/
generateAddView = function (targetItem) {
    var loadAddForm = function () {
        currentPostRequest = $.post(page_url + 'add_detail', {
            'load_add_entry': 'yes'
        }, function (respData) {
            if (respData != '') {
                $('.index-wrapper').html(respData);
                if ($('.br_add').length == 0)
                    $('.breadcrumb').append('<li class="br_add"><a href="javascript:void(0);">Add Detail</a></li>');
                if (typeof $('.form-actions button.btn-primary').attr('onclick') == 'undefined') {
                    $('.form-actions button.btn-primary').attr('onclick', "saveOperation('add')");
                }
                setTimeout(function () {
                    $('.iphone-toggle').iphoneStyle();
                    $('.chosen-select-deselect').chosen({
                        allow_single_deselect: true
                    });
                    $('[data-rel="chosen"],[rel="chosen"]').chosen();
                    $('.datepicker').each(function () {
                        dateVal = $(this).val();
                        $(this).datepicker();
                        $(this).datepicker("option", "dateFormat", "yy-mm-dd");
                        $(this).datepicker("setDate", dateVal);
                    });
                    $('.datetimepicker').each(function () {
                        $(this).datetimepicker({format: 'Y-m-d H:i:s'});
                    });
                }, 300);
            }
        }, 'html');
    }
    loadAddForm(targetItem);
}

/**********************************************Add operation***************************/



/*save operation
 **/
var saveOperation = function (method) {
    if (validate_form($('#addEditForm'),
            {
                beforeValidation: function (targetObject) {
                    $(targetObject).parent().parent('.control-group').removeClass('error');
                    $(targetObject).parent().parent('.control-group').find('.help-inline').html('');

                },
                onValidationError: function (targetObject, validationType) {
                    $(targetObject).parent().parent('.control-group').addClass('error');
                    switch (validationType) {
                        case 'required':
                            $(targetObject).parent().parent('.control-group').find('.help-inline').html('This is Required!!');
                            break;
                        default:
                            $(targetObject).parent().parent('.control-group').find('.help-inline').html('Please Enter A valid Data');
                    }
                },
                captchaValidator: function (targetObject) {
                    return validate_captcha(targetObject);
                },
                duplicateValidator: function (targetObject) {
                    return duplicate_check(targetObject);
                }

            })) {
        var postUrl = '';
        if (method == 'add') {
            postUrl = page_url + 'add_detail';
        }
        if (method == 'edit') {
            postUrl = page_url + 'edit_detail';
        }
        currentPostRequest = $.post(postUrl, $('#addEditForm').serialize(), function (respData) {
            if (respData.status = 'success') {

                $('.modal-body p').html(respData.message);
                $('#myModal').modal('show');
                $('.modal-footer .btn-primary').removeClass('btn-danger btn-success').addClass('btn-success').attr('onclick', 'goBack();');

                setTimeout(function () {
                    goBack();
                }, 1000);
                //
            }
        }, 'json');
    }

}

/*****/

var reorderTable = function () {

    $(".orderable").sortable({
        update: function (event, ui) {
            var orderElements = [];
            $(".orderable").children().each(function () {
                orderElements.push($(this).attr('id').substring(4));
            });

            currentPostRequest = $.post(page_url + 'order_table', {
                orderElements: orderElements
            }, function (responce) {
                console.log(responce);
            }, 'json');
        }
    });
}
/**QUICK EDIT**/
var quickEdit = function (targetItem) {
    $(targetItem).hide();
    $(targetItem).parent().append('<input type="text" value="' + $.trim($(targetItem).html()) + '">');
    var targetElement = $(targetItem).parent().find('input');
    $(targetElement).blur(function () {
        $(targetItem).html($(targetElement).val());
        currentPostRequest = $.post(page_url + 'quick_edit', {
            targetItem: $(targetItem).attr('relfield') + '-' + $(targetItem).attr('relId'),
            targetValue: $(targetElement).val(),
        }, function (respData) {
            $(targetElement).remove();
            $(targetItem).show();
            console.log(respData);
        }, 'json');
    });
}
/**quickEdit***/
