// FORM DEMO - Account Form
// ------------------------------------------------------------------------------------------------ * -->
$(document).ready(function ($) {

    // Bootstrap Hack for button radio to hidden input 
    // ------------------------------------------------------------------------------------------------ * -->
    var _old_toggle = $.fn.button.prototype.constructor.Constructor.prototype.toggle;
    $.fn.button.prototype.constructor.Constructor.prototype.toggle = function () {
        _old_toggle.apply(this);
        var $parent = this.$element.parent('[data-toggle="buttons-radio"]')
        var target = $parent ? $parent.data('target') : undefined;
        var value = this.$element.attr('value');
        if (target && value) {
            $('#' + target).val(value);
        }
    };

    $("[rel=popover-info]")
        .popover({
            placement: 'right',
            trigger: 'hover',
            delay: {
                hide: 100
            }
     });

    $("input.maskDate").inputmask("99/99/9999", {
        placeholder: "__/__/____"
    });

    $("input.maskYear").inputmask("9999", {
        placeholder: "____"
    });

    $("input.maskPhoneInt").inputmask("+999 999 999 999");

    $("input.maskAcid").inputmask("999-999-999");

    $("input.checkbox, input.radio, input:file.input-file").uniform({
        radioClass: 'radios' // edited class - the original radio
    });

    $(".EmailTags").select2({
        tags: true,
        placeholder: "Enter valid email address"
    });

    $(function (accForm) {
        //Tell the validator not to ignore hidden items
        //var validator = $('#form').validate({ignore: null});
        //Tell the validator to only ignore inputs of type 'hidden'
        //var validator = $('#...').validate({ignore: 'input[type=hidden]'});

        // selectpicker
        $('select.selectpicker').selectpicker();
        // datepicker
        $('#accountDob').datepicker({
            format: 'mm-dd-yyyy'
        });
        // daterangepicker
        $('#accountForce').daterangepicker({
            opens: 'left'
        });
        // select 2
        $(".selecttwo").select2({
            minimumResultsForSearch: 6,
            width: "100%"
        });
        $("#accountAddressState, #accountAddressCountry").select2();
        //width: "copy"
        // select2 tag
        var accountGroupData = [{
            id: "wholesaler",
            text: "Wholesaler"
        }, {
            id: "retailer",
            text: "Retailer"
        }, {
            id: "suppliers",
            text: "Suppliers"
        }, {
            id: "manager",
            text: "Manager"
        }, {
            id: "wholesalecustomer",
            text: "Wholesale Customer"
        }, {
            id: "powers",
            text: "Powers"
        }];
        $("#accountGroup").select2({
            tags: accountGroupData,
            createSearchChoice: function (term, data) {
                if ($(data).filter(function () {
                        return this.text.localeCompare(term) === 0;
                }).length === 0) {
                    return {
                        id: term,
                        text: term
                    };
                }
            },
            width: "100%",
            multiple: true,
            placeholder: "Choose or enter group for account...",
            tokenSeparators: [",", " "]
        });
        // uniform - checkbox, radio style
        $("input.checkbox, input.radio").uniform({
            radioClass: 'radios' // edited class - the original radio
        });
        // bootstrap toggle - change color
        $('.btn-group > .btn, .btn[data-toggle="button"]').click(function () {

            if ($(this).attr('class-toggle') != undefined && !$(this).hasClass('disabled')) {
                var btnGroup = $(this).parent('.btn-group');

                if (btnGroup.attr('data-toggle') == 'buttons-radio') {
                    btnGroup.find('.btn').each(function () {
                        $(this).removeClass($(this).attr('class-toggle'));
                    });
                    $(this).addClass($(this).attr('class-toggle'));
                }

                if (btnGroup.attr('data-toggle') == 'buttons-checkbox' || $(this).attr('data-toggle') == 'button') {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass($(this).attr('class-toggle'));
                    } else {
                        $(this).addClass($(this).attr('class-toggle'));
                    }
                }
            }
        });

        // form validate
        $('#accounForm').validate({
            //ignore: "#accountAddressState input[type=hidden], #accountAddressCountry input[type=hidden]",
            ignore: "",
            rules: {
                accountFirstName: {
                    required: true,
                    minlength: 4,
                    maxlength: 20
                },
                accountLastName: {
                    required: true,
                    minlength: 4,
                    maxlength: 20
                },
                accountGender: {
                    required: true,
                    minlength: 1
                },
                accountDob: {
                    required: true,
                    minlength: 1
                },
                accountEmail: {
                    required: true,
                    email: true,
                    maxlength: 100
                },
                accountPhoneNumber: {
                    required: true
                },
                accountAddressStreet: {
                    required: true
                },
                accountAddressDestination: {
                    required: true
                },
                accountAddressCity: {
                    required: true,
                    minlength: 2,
                    maxlength: 20
                },
                accountAddressState: {
                    required: true
                },
                accountAddressZip: {
                    required: true
                },
                accountAddressCountry: {
                    required: true
                },
                accountGroup: {
                    required: true
                },
                accountAddressCountryVal: {
                    required: true
                }
            },
            messages: {
                accountFirstName: {
                    required: "Please enter a First Name",
                    minlength: "First Name must be at least 4 characters",
                    maxlength: "First Name must be no more than 20 characters"
                },
                accountLastName: {
                    required: "Please enter a Last Name",
                    minlength: "Last Name must be at least 4 characters",
                    maxlength: "Last Name must be no more than 20 characters"
                },
                accountGenderInput: {
                    required: "Please select a Geder",
                },
                accountDob: {
                    required: "Please select Date",
                },
                accountEmail: {
                    required: "Please enter a Email Address",
                    email: "Please enter a valid Email Address - you@example.com",
                    maxlength: "Email Address must be no more than 100 characters"
                },
                accountPhoneNumber: {
                    required: "Please enter a Telephone Number"
                },
                accountAddressStreet: {
                    required: "Please enter a Address",
                },
                accountAddressDestination: {
                    required: "Please enter a Destination",
                },
                accountAddressCity: {
                    required: "Please enter a City",
                    minlength: "City must be at least 2 characters",
                    maxlength: "City must be no more than 20 characters"
                },
                accountAddressState: {
                    required: "Please select a State",
                },
                accountAddressZip: {
                    required: "Please enter a ZipCode"
                },
                accountAddressCountry: {
                    required: "Please select a Country",
                }
            },

            highlight: function (label) {
                $(label).closest('.control-group').addClass('error');
            },
            success: function (label) {
                $(label).text('OK!').addClass('valid')
                        .closest('.control-group').addClass('success');
            },
            errorPlacement: function (error, label) {
                $(label).closest('.controls').append(error);
            }
        })
    });

    $(function (itemForm) {
        // selec2 tagging support demo	
        $("#articleTags, #metaArticleKeywords").select2({
            tags: [{
                'id': 1,
                'text': 'Design'
            }, {
                'id': 16,
                'text': 'Css'
            }, {
                'id': 23,
                'text': 'Bootstrap'
            }, {
                'id': 7,
                'text': 'Framework'
            }],
            tokenSeparators: [",", " "]
        });

        // datepicker
        $('#datePicker, #articleCreatedDate, #articlePublishingStart, #articlePublishingFinish').datepicker();

        // daterangepicker
        $('#articlePostFromTo').daterangepicker({
            opens: 'right',
            format: 'dd/MM/yyyy',
            ranges: {
                'Next 7 Days': ['today', Date.today().add({
                    days: +6
                })],
                'Next 15 Days': ['today', Date.today().add({
                    days: +14
                })],
                'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
            }
        });

        // elastic
        $('textarea.auto').elastic();
        $('textarea.auto').trigger('update');

        // form validate
        $('#itemForm').validate({
            ignore: "#articleCategory input[type=hidden]",
            rules: {
                articleTitle: {
                    required: true,
                    minlength: 3
                },
                articleAlias: {
                    required: true,
                    minlength: 3
                },
                articleCategory: {
                    required: true,
                    minlength: 1
                },
                articleTags: {
                    required: true
                },
                articleAuthor: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                articleAuthorAlias: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                }
            },
            messages: {
                articleTitle: {
                    required: "Please enter a Title for Article",
                    minlength: "Title must be at least 3 characters"
                },
                articleAlias: {
                    required: "Please enter a Alias for Article",
                    minlength: "Alias must be at least 3 characters and must not contain spaces"
                },
                articleCategory: {
                    required: "Please select a Category",
                },
                articleTags: {
                    required: "Please enter Autor name",
                    maxlength: "Only 50 characters"
                },
                articleAuthor: {
                    required: "Please enter Autor name",
                    maxlength: "Only 50 characters"
                },
                articleAuthorAlias: {
                    required: "Please enter Autor alias",
                    maxlength: "Only 50 characters"
                }
            },

            highlight: function (label) {
                $(label).closest('.control-group').addClass('error');
            },
            unhighlight: function (element) {
                $(label).closest('.control-group').removeClass("error");
            },
            success: function (label) {
                $(label).text('OK!').addClass('valid')
                        .closest('.control-group').removeClass("error")
                        .closest('.control-group').addClass('success');
            },
            errorPlacement: function (error, label) {
                $(label).closest('.controls').append(error);
            }

            /* error display in popovers
            ,
            showErrors: function(errorMap, errorList) {
                    $.each( this.successList , function(index, value) {
                            $(value).popover('hide');
                    });
                    $.each( errorList , function(index, value) { 
                            console.log(value.message);
                            var _popover = $(value.element).popover({
                                    trigger: 'manual',
                                    placement: 'right',
                                    content: value.message,
                                    template: '<div class="popover popover-error"><div class="arrow"></div><div class="popover-inner"><div class="popover-content"><p></p></div></div></div>'
                            });
                            _popover.data('popover').options.content = value.message;
                            $(value.element).popover('show');
                    });
            }*/

        });
    });


});
