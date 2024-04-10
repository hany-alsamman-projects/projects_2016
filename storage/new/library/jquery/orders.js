$(function() {
    $('#show_orders').click( function(e) {
        e.preventDefault();

        /* get the data */
        var posting = $.get( "inc/ajax/loadOrders.php");

        posting.done(function( data ) {

            var empty = $("#work_area .box-body").html().trim().length == 0;

            if(empty) {
                /* Put the results in a div */
                $( "#work_area .box-body" ).append( data );
                /* enable table crazy functions */
                $('#ShowOrders').dataTable({
                    "sPaginationType": "full_numbers", "aLengthMenu": [5, 10, 25], "iDisplayLength": 5,
                    "fnDrawCallback": function() {
                        $.fn.makeSelect();
                    }
                });

                toastr.options.positionClass = 'toast-top-right';
                toastr.success('Orders page loaded!');
            }else{
                /* fuck me, i want to sleep */
                $( "#work_area .box-body").empty();
            }

        });

    });

    function close_order(){
        $('#new-order-form').trigger("reset"); // reset form values after hide
        $('#new-order-form').find("input[type=hidden]").val(""); // reset form hidden values
        $('#smp-form #box_customer_name h2 span').html('Select Customer'); //reset box title
        $( "#t_order table tbody").empty(); // reset order content
        //$('#board_list').removeClass('g8');// remove half of full screen
        //$('#board_list').addClass('g16');// set full screen
        $('.order_form').addClass('hidden-desktop');
        $('#sort-boxes #process_type').val('0'); //disable add order functions
    }

    $('#add_order').click( function(e) {
        e.preventDefault();

        if ($('.order_form').hasClass('hidden-desktop')) {
            $('#board_list').removeClass('g16'); // remove full screen
            $('#board_list').addClass('g8'); // set half of full screen
            $('.order_form').fadeIn(1000).delay(100).removeClass('hidden-desktop');
            $('#sort-boxes #process_type').val('2'); //enable add order functions
            $('.order_form button').attr("disabled","true"); //disable invoice save buttons
        }
        else {
            close_order();
        }

    });

    $('#save_order').click( function(e) {
        e.preventDefault();

        var data = $('#new-order-form').serialize();
        var order_key = $(this);

        /* Send the data using post */
        var posting = $.post( "inc/ajax/save_ord.php", data);
        /* Put the results in a div */
        posting.done(function( data ) {
            toastr.options.positionClass = 'toast-top-full';
            toastr.success('the order! has been saved','Done!');

            close_order();
        });

    });

    $(".check_order_quantity").live('keyup', function(){

        //get price for this item
        var row_id = $(this).attr('id'); // its have item id _ price

        var row_value = $(this).attr('value'); // input value

        var get_value = row_id.split('_'); // its have itemid _ price

        var getval_id = get_value[0]; // get id only

        //live price
        var row_price = $('#price_'+getval_id+' input').attr('value');

        //real price
        //var row_price = get_value[1];

        $('#total_'+getval_id).html(row_price*row_value); // set value to filed

        update_order_total_bill(true);

    });

    function update_order_total_bill(sum){

        var row_total = 0;
        var td_ids = 0;

        $('#t_order table tr td').each(function () {
            td_ids = $(this).attr('id');

            // alert(td_ids);
            if (/total/i.test(td_ids)){
                //alert(td_ids)
                row_total += parseFloat($('#'+td_ids).text());
            }
        });

        $('#total_order_bill').html('<h2>Total in the container : <strong>$'+row_total+'</strong></h2><input type="hidden" name="total_bill" value="'+row_total+'">');
    }

    $.fn.add_order = function(th) {
        var item_id = 'in_'+th.id;
        var get_customer_id = null;
        var get_item_id = item_id.split('_'); // id = get_item_id[2]

        //check if the user add Exist item b4 to same order :P
        if($('#t_order #row_'+get_item_id[2]).length){
            toastr.options.positionClass = 'toast-top-right';
            toastr.error('you try to add exist item before in this order!');
            return false;
        }

        //create row on the fly
        var $t_order = $('<div id="'+item_id+'" class="cont g16"></div>');
        //append to t_order div
        $t_order.appendTo('#t_order');

        /* Send the data using post */
        var posting = $.post( "inc/ajax/counatList_order.php",{id:get_item_id[2],c:get_customer_id});
        /* Put the results in a div */
        posting.done(function( data ) {
            $( "#t_order table tbody" ).append( data );

            toastr.options.positionClass = 'toast-top-right';
            toastr.success('new item was added to this order!');

        });
    }


    $('.remove_order_item').live('click', function(e) {
        e.preventDefault();

        $( "#t_order table tbody #row_"+this.id).remove(); // remove item from order
        toastr.options.positionClass = 'toast-top-right';
        toastr.success('selected item has been removed from current order');

        update_order_total_bill(true);

    });


});