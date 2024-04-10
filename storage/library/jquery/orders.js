$(function () {
    $('#show_orders').click(function (e) {
        e.preventDefault();

        /* get the data */
        var posting = $.get("inc/ajax/loadOrders.php");

        posting.done(function (data) {

            //var empty = $("#work_area .box-body").html().trim().length == 0;

            $("#work_area .box-body").empty();

            /* Put the results in a div */
            $("#work_area .box-body").append(data);
            /* enable table crazy functions */
            $('#ShowOrders').dataTable({
                "sPaginationType": "full_numbers",
                "bStateSave": "true",
                "bAutoWidth": "true",
                "aLengthMenu": [5, 10, 25],
                "iDisplayLength": 5,
                "fnDrawCallback": function () {
                    $.fn.makeSelect();
                }
            });

            toastr.options.positionClass = 'toast-top-right';
            toastr.success('Orders page loaded!');

        });

    });

    $('.close_order').live('click', function (e) {
        e.preventDefault();
        close_order();
    });

    function close_order() {
        $('#new-order-form').trigger("reset"); // reset form values after hide
        $('#new-order-form').find("input[type=hidden]").val(""); // reset form hidden values
        $('#smp-form #box_customer_name h2 span').html('Select Customer'); //reset box title
        $("#t_order table tbody").empty(); // reset order content
        $("#new-order-form #supplier_dd").remove(); // reset order content
        $('#board_list').removeClass('g8'); // remove half of full screen
        //$('#board_list').addClass('g16');// set full screen
        $('.order_form').addClass('hidden-desktop');
        $('#sort-boxes #process_type').val('0'); //disable add order functions
	$('#new-order-form #total_order_bill').html(''); // reset total bill of invoice
    }

    $('#add_order').click(function (e) {
        e.preventDefault();

        if (!$('.invoice_form').hasClass('hidden-desktop')) {
            toastr.options.positionClass = 'toast-top-right';
            toastr.warning('please close invoice area before open an order');
            return false;
        }

        $(".item_row").css('background-color', 'transparent'); //reset all selected items
        $(".customer_row").css('background-color', 'transparent'); //reset all selected customers

        if ($('.order_form').hasClass('hidden-desktop')) {
            $('#board_list').removeClass('g16'); // remove full screen
            $('#board_list').addClass('g8'); // set half of full screen
            $('.order_form').fadeIn(1000).delay(100).removeClass('hidden-desktop');
            $('#sort-boxes #process_type').val('2'); //enable add order functions
            $('.order_form button').attr("disabled", "true"); //disable invoice save buttons

            /* Send the data using post */
            var posting = $.post("inc/ajax/get_suppliers.php");
            /* Put the results in a div */
            posting.done(function (data) {
                $("#new-order-form .insert_dd").append(data);
            });
        } else {
            close_order();
        }

    });

    $('#save_order').click(function (e) {
        e.preventDefault();

        var data = $('#new-order-form').serialize();
        var order_key = $(this);

        var validation = $('#new-order-form').validationEngine('validate');

        if (validation == 1) {
            /* Send the data using post*/
            var posting = $.post("inc/ajax/save_ord.php", data);
            posting.done(function (data) {
                toastr.options.positionClass = 'toast-top-full';
                toastr.success('the order! has been saved', 'Done!');

                close_order();
            });
        }

    });

    $(".check_order_price_changes").live('keyup', function () {

        var get_parent = $(this).closest('tr').attr('id'); // get id only

        var id = $(this).attr('id'); // its have item id _ price

        var row_id = $("#"+get_parent+" #qun_" + id).find(".check_order_quantity").attr('id'); // its have item id _ price

        var row_value = $("#"+get_parent+" #qun_" + id).find(".check_order_quantity").val(); // its have item id _ price

        var get_value = row_id.split('_'); // its have item id_ price
        var getval_id = get_value[0]; // get id only

        //live price
        var row_price = $('#'+get_parent+' #price_' + getval_id + ' input').attr('value');

        $('#'+get_parent+' #total_' + getval_id).html(row_price * row_value); // set value to filed

        update_order_total_bill(true);

    });

    $(".check_order_quantity").live('keyup', function () {

        var get_parent = $(this).closest('tr').attr('id'); // get id only

        //get price for this item
        var row_id = $(this).attr('id'); // its have item id _ price

        var row_value = $(this).attr('value'); // input value

        var get_value = row_id.split('_'); // its have itemid _ price

        var getval_id = get_value[0]; // get id only

        //live price
        var row_price = $('#'+get_parent).find('#price_' + getval_id + ' input').attr('value');

        //real price
        //var row_price = get_value[1];

        $('#' + get_parent).find('#total_' + getval_id).html(row_price * row_value); // set value to filed

        update_order_total_bill(true);

    });

    function update_order_total_bill(sum) {

        var row_total = 0;

        $('#t_order table tbody tr').each(function () {
            var get_parent = $(this).attr('id').split('_');
            var total_id = get_parent[1]; //get fucking id

            row_total += parseFloat($(this).find('#total_' + total_id).text());
        });

        $('#total_order_bill').html('<h2>Total in the container : <strong>$' + row_total + '</strong></h2><input type="hidden" name="total_bill" value="' + row_total + '">');
    }

    $.fn.add_order = function (th) {
        var item_id = 'in_' + th.id;
        var get_item_id = item_id.split('_'); // id = get_item_id[2]

        //check if the user add Exist item b4 to same order :P

        if ($('#t_order #row_' + get_item_id[2]).length) {
            toastr.options.positionClass = 'toast-top-right';
            toastr.warning('you try to add exist item before in this order!');
            //return false;
        }

        //create row on the fly
        var $t_order = $('<div id="' + item_id + '" class="cont g16"></div>');
        //append to t_order div
        $t_order.appendTo('#t_order');

        /* Send the data using post */
        var posting = $.post("inc/ajax/counatList_order.php", {
            id: get_item_id[2]
        });
        /* Put the results in a div */
        posting.done(function (data) {
            $("#t_order table tbody").append(data);

            toastr.options.positionClass = 'toast-top-right';
            toastr.success('new item was added to this order!');

        });
    }



    $('.remove_order_item').live('click', function (e) {
        e.preventDefault();

        //$( "#t_order table tbody #row_"+this.id).remove(); // remove item from order
        $(this).closest('tr').remove();
        toastr.options.positionClass = 'toast-top-right';
        toastr.success('selected item has been removed from current order');

        update_order_total_bill(true);

    });


    $('.delete_order').live('click', function (e) {
        e.preventDefault();
        /* Send the data using post */
        var posting = $.post("inc/ajax/delOrder.php", {
            id: this.id
        }, data);
        /* Put the results in a div */
        posting.done(function (data) {
            if (data) {
                toastr.options.positionClass = 'toast-top-right';
                toastr.success('selected invoice has been deleted');
                $('#show_orders').click();
            }
        });
    });

    $('.deliver_order').live('click', function (e) {
        e.preventDefault();
        /* Send the data using post t=operation v=set fin */
        var posting = $.post("inc/ajax/deliver.php", {
            id: this.id,
            t: 'o',
            v: '1'
        }, data);
        /* Put the results in a div */
        posting.done(function (data) {
            if (data) {
                toastr.options.positionClass = 'toast-top-right';
                toastr.success('selected order has been delivered');
                $('#show_orders').click();
            }
        });
    });

    $(".fetch_included_order").live('click', function (e) {
        e.preventDefault();
        var order_id = $(this).attr('id');

        /* Send the data using post */
        var posting = $.post('inc/ajax/veiwOrder.php', {
            id: order_id
        }).done(function (data) {
                //jQuery(document).trigger('close.facebox');
                jQuery.facebox(data);
            });
    });


    $(".edit_order").live('click', function (e) {
        e.preventDefault();
        var order_id = $(this).attr('id');

            $.ajax({
                type: "POST",
                cache: false,
                data: {
                    id: order_id,
                    "_": $.now()
                },
                url: 'inc/ajax/editOrder.php',
                success: function (data) {
                    $('img.clear_area').click();
                    //$( "#sort-boxes").append( data );
                    $('.edit_order_form').remove();
                    $(data).insertBefore($(".invoice_form"));
                    $('#board_list').removeClass('g16'); // remove full screen
                    $('#board_list').addClass('g8'); // set half of full screen
                    $('#sort-boxes #process_type').val('4'); //enable edit order functions
                    $('.edit_order_form button').removeAttr("disabled"); //disable invoice save buttons
                    $.fn.inputs();
                    $.fn.btnfns();
                    $('.ttip').tooltip();
                }
            });

    });

    $('.order_status').live('click', function () {
        $(".order_status").removeClass("pressed");
        $(this).addClass('pressed');
        $('#order_status').val($(this).attr('id'));
    });

    $.fn.edit_order = function (th) {

        var item_id = 'in_' + th.id;
        var get_customer_id = null;
        var get_item_id = item_id.split('_'); // id = get_item_id[2]

        //check if the user add Exist item b4 to same order :P

        if ($('#t_order #row_' + get_item_id[2]).length) {
            toastr.options.positionClass = 'toast-top-right';
            toastr.warning('you try to add exist item before in this order!');
            //return false;
        }

        //create row on the fly
        var $t_order = $('<div id="' + item_id + '" class="cont g16"></div>');
        //append to t_order div
        $t_order.appendTo('#t_order');

        /* Send the data using post */
        var posting = $.post("inc/ajax/counatList_order.php", {
            id: get_item_id[2],
            c: get_customer_id
        });
        /* Put the results in a div */
        posting.done(function (data) {
            $("#t_order table tbody").append(data);

            toastr.options.positionClass = 'toast-top-right';
            toastr.success('new item was added to this order!');

        });

    }


    $('.save_modified_order').live('click', function (e) {
        e.preventDefault();

        var data = $('#edit-order-form').serialize();
        var order_key = $(this);
        // now add some additional stuff


        var validation = $('#edit-order-form').validationEngine('validate');

        if (validation == 1) {
            data += "&opr_id=" + encodeURIComponent(order_key.attr('id'));

            /* Send the data using post */
            var posting = $.post("inc/ajax/save_modified_order.php", data);
            /* Put the results in a div */
            posting.done(function (data) {

                if (data != false) {
                    toastr.options.positionClass = 'toast-top-full';
                    toastr.success('the order! has been saved', 'Done!');
                    $('.edit_order_form').remove();
                } else {

                    toastr.options.positionClass = 'toast-top-full';
                    toastr.error('check required filed', 'Error!');
                    return false;
                }
            });
        }
    });

    $('.close_edit_order').live('click', function (e) {
        e.preventDefault();
        $(".edit_order_form").remove(); // remove item from order
        $('#board_list').removeClass('g8'); // remove half of full screen
        $('#board_list').addClass('g16'); // set full screen
        $('#sort-boxes #process_type').val('0'); //disable edit order functions
    });
});
