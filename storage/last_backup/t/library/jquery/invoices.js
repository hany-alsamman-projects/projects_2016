$(function() {

    $('#show_invoices').click( function(e) {
        e.preventDefault();

        /* get the data */
        var posting = $.get( "inc/ajax/loadInvoices.php");

        posting.done(function( data ) {

            //var empty = $("#work_area .box-body").html().trim().length == 0;

                $( "#work_area .box-body").empty();

                /* Put the results in a div */
                $( "#work_area .box-body" ).append( data );
                /* enable table crazy functions */
                $('#ShowInvoices').dataTable({
                    "sPaginationType": "full_numbers","bStateSave":"true", "bAutoWidth" : "true", "aLengthMenu": [5, 10, 25], "iDisplayLength": 5,
                    "fnDrawCallback": function() {
                        $.fn.makeSelect();
                    }
                });

                toastr.options.positionClass = 'toast-top-right';
                toastr.success('Invoices page loaded!');

        });

    });

    function close_invoice(){

        $('#new-invoice-form').trigger("reset"); // reset form values after hide
        $('#new-invoice-form').find("input[type=hidden]").val(""); // reset form hidden values
        $('#smp-form #box_customer_name h2 span').html('Select Customer'); //reset box title
        $( "#t_invoice table tbody").empty(); // reset invoice content
        $('#board_list').removeClass('g8');// remove half of full screen
        $('#board_list').addClass('g16');// set full screen
        $('.invoice_form').addClass('hidden-desktop');
        $('#sort-boxes #process_type').val('0'); //disable add invoice functions
        $('#new-invoice-form #total_bill').html(''); // reset total bill of invoice
    }


    $('#add_invoice').click( function(e) {
        e.preventDefault();

        if (!$('.order_form').hasClass('hidden-desktop')) {
            toastr.options.positionClass = 'toast-top-right';
            toastr.warning('please close order area before open an invoice');
            return false;
        }

        $(".item_row").css('background-color','transparent'); //reset all selected items
        $(".customer_row").css('background-color','transparent'); //reset all selected customers

        if ($('.invoice_form').hasClass('hidden-desktop')) {
            $('#board_list').removeClass('g16'); // remove full screen
            $('#board_list').addClass('g8'); // set half of full screen
            //$('.invoice_form .box-ttl').html('Add New Invoice'); //set box title
            //$('.invoice_form .box-body h2 span').html('Select Customer'); //set form title
            $('.invoice_form').fadeIn(1000).delay(100).removeClass('hidden-desktop');
            $('#sort-boxes #process_type').val('1'); //enable add invoice functions
            $('.invoice_form button').attr("disabled","true"); //disable invoice save buttons
        }
        else {
            close_invoice();
        }

    });

    $('#save_invoice, #save_print, #save_customized').live('click', function(){


        var data = $('#new-invoice-form').serialize();
        var invoice_key = $(this);
        // now add some additional stuff


        $.fn.inputs();
        $('#new-invoice-form').validate();


        if($('#new-invoice-form').find('.error').length == 0){

            /* Send the data using post */
            var posting = $.post( "inc/ajax/save_inv.php", data);
            /* Put the results in a div */
            posting.done(function( data ) {

                if(data != false){

                    toastr.options.positionClass = 'toast-top-full';
                    toastr.success('the invoice! has been saved','Done!');

                    //check if this key for save and print
                    if(invoice_key.hasClass('print')){
                        window.open("./print.php?v="+data);
                    }

                    //check if this key for save and customized print
                    if(invoice_key.hasClass('customized')){
                        window.open("./print.php?action=customized&v="+data);
                    }

                    close_invoice();

                }else{

                    toastr.options.positionClass = 'toast-top-full';
                    toastr.error('check required filed','Error!');
                    return false;
                }

            });

        }

    });

    $(".check_quantity").live('keyup', function(){

        //get price for this item
        var row_id = $(this).attr('id'); // its have item id _ price

        var row_value = $(this).attr('value'); // input value quantity

        var get_value = row_id.split('_'); // its have itemid _ price

        var getval_id = get_value[0]; // get id only

        //live price
        var row_price = $('#price_'+getval_id+' input').attr('value');
        //real price
        //var row_price = get_value[1];

        var getindex = $('#order_'+getval_id+' :selected').text().match(/\[(.*?)\]/);
        /* Send the data using post */
        var posting = $.post( "inc/ajax/check_qunt.php",{quantity:row_value,item_id:getval_id,lots:getindex[1]});
        /* Put the results in a div */
        posting.done(function( data ) {
            if(data == 0){
                toastr.options.positionClass = 'toast-top-right';
                toastr.error('cannot set quantity not available in this container!');
                $('#'+row_id).attr('value','');
                return false;
            }else{
                $('#total_'+getval_id).html(row_price*row_value); // set value to filed
                update_total_bill(true);
            }
        });

    });

    function update_total_bill(sum){

        var row_total = 0;
        var td_ids = 0;

        $('#t_invoice table tr td').each(function () {
            td_ids = $(this).attr('id');

            // alert(td_ids);
            if (/total/i.test(td_ids)){
                //alert(td_ids)
                row_total += parseFloat($('#'+td_ids).text());
            }
        });

        $('#total_bill').html('<h2>Total bill : <strong>$'+row_total+'</strong></h2><input type="hidden" name="total_bill" value="'+row_total+'">');
    }


    function createEl(options)
    {
        $input = $('<input>');
        $input.attr('value',options.value);
        $input.attr('id',options.id);
    }

    $.fn.add_invoice = function(th) {

        var item_id = 'in_'+th.id;
        var get_customer_id = $('#smp-form #box_customer_id').val();
        var get_item_id = item_id.split('_'); // id = get_item_id[2]

        //check if customer selected
        if (get_customer_id.length == 0){
            toastr.options.positionClass = 'toast-top-right';
            toastr.warning('please select an customer before add items !');
            return false;
        }

        //check if the user add Exist item b4 to same invoice :P
        if($('#t_invoice #row_'+get_item_id[2]).length){
            toastr.options.positionClass = 'toast-top-right';
            toastr.warning('you try to add exist item before in this invoice!');
            //return false;
        }

        //create row on the fly
        var $t_invoice = $('<div id="'+item_id+'" class="cont g16"></div>');
        //append to t_invoice div
        $t_invoice.appendTo('#t_invoice');

        //check selected items and set right bg
        if($(this).css('background-color') == 'transparent'){
            $(this).css('background-color','#2365a7');
            $("#item_"+this.id).css('background-color','transparent');//reset selected items
        }else{
            //$(this).css('background-color','transparent');//reset all selected items
        }

        /* Send the data using post */
        var posting = $.post( "inc/ajax/counatList.php",{id:get_item_id[2],c:get_customer_id});
        /* Put the results in a div */
        posting.done(function( data ) {


            $( "#t_invoice table tbody" ).append( data );

            $.fn.inputs();
            $('#new-invoice-form').validate();

            toastr.options.positionClass = 'toast-top-right';
            toastr.success('new item was added to this invoice!');

        });

    }


    $('.remove_item').live('click', function(e) {
        e.preventDefault();

        //$( "#t_invoice table tbody #row_"+this.id).remove(); // remove item from invoice
        $(this).closest('tr').remove();
        $("#item_"+this.id).css('background-color','transparent');
        toastr.options.positionClass = 'toast-top-right';
        toastr.success('selected item has been removed from current invoice');

        update_total_bill(true);

    });

    $('.delete_invoice').live('click', function(e) {
        e.preventDefault();
        /* Send the data using post */
        var posting = $.post( "inc/ajax/delInvoices.php",{id:this.id}, data);
        /* Put the results in a div */
        posting.done(function( data ) {
            if(data){
                toastr.options.positionClass = 'toast-top-right';
                toastr.success('selected invoice has been deleted');
                $('#show_invoices').click();
            }
        });
    });

    $('.deliver_invoice').live('click', function(e) {
        e.preventDefault();
        /* Send the data using post t=operation v=set fin */
        var posting = $.post( "inc/ajax/deliver.php",{id:this.id,t:'v',v:'1'}, data);
        /* Put the results in a div */
        posting.done(function( data ) {
            if(data){
                toastr.options.positionClass = 'toast-top-right';
                toastr.success('selected invoice has been delivered');
                $('#show_invoices').click();
            }
        });
    });

    $(".fetch_included_invoice").live('click', function(e) {
        e.preventDefault();
        var invoice_id = $(this).attr('id');

        /* Send the data using post */
        var posting = $.post('inc/ajax/veiwInvoice.php',{id:invoice_id}).done(function( data ) {
            //jQuery(document).trigger('close.facebox');
            jQuery.facebox(data);
        });
    });

    $(".edit_invoice").live('click', function(e) {
        e.preventDefault();
        var invoice_id = $(this).attr('id');


        $.ajax({
            type: "POST",
            cache: false,
            data: {id:invoice_id,"_": $.now()},
            url: 'inc/ajax/editInvoice.php',
            success: function(data){
                $('img.clear_area').click();
                //$( "#sort-boxes").append( data );
                $('.edit_invoice_form').remove();
                $( data ).insertBefore( $( ".invoice_form" ) );
                $('#board_list').removeClass('g16'); // remove full screen
                $('#board_list').addClass('g8'); // set half of full screen
                $('#sort-boxes #process_type').val('3'); //enable add invoice functions
                $('.edit_invoice_form button').removeAttr("disabled"); //disable invoice save buttons
                $.fn.boxColl();
                $.fn.contNav();
                $.fn.inputs();
                $.fn.btnfns();
            }
        });

    });

    $('.invoice_status').live('click', function(){
        $( ".invoice_status" ).removeClass( "pressed");
        $(this).addClass('pressed');
        $('#invoice_status').val($(this).attr('id'));
    });

    $.fn.edit_invoice = function(th) {

        var item_id = 'in_'+th.id;
        var get_customer_id = $('#smp-form #box_customer_id').val();
        var get_item_id = item_id.split('_'); // id = get_item_id[2]


        //check if customer selected
        if (get_customer_id.length == 0){
            toastr.options.positionClass = 'toast-top-right';
            toastr.warning('please select an customer before add items !');
            return false;
        }

        //check if the user add Exist item b4 to same invoice :P
        if($('#edit-invoice-form #t_invoice #row_'+get_item_id[2]).length){
            toastr.options.positionClass = 'toast-top-right';
            toastr.warning('you try to add exist item before in this invoice!');
        }

        //create row on the fly
        var $t_invoice = $('<div id="'+item_id+'" class="cont g16"></div>');
        //append to t_invoice div
        $t_invoice.appendTo('#edit-invoice-form #t_invoice');

        /* Send the data using post */
        var posting = $.post( "inc/ajax/counatList.php",{id:get_item_id[2],c:get_customer_id});
        /* Put the results in a div */
        posting.done(function( data ) {


            $( "#t_invoice table tbody" ).append( data );

            $.fn.inputs();
            $('#edit-invoice-form').validate();

            toastr.options.positionClass = 'toast-top-right';
            toastr.success('new item was added to this invoice!');

        });

    }

    $('.save_modified_invoice, .save_modified_print').live('click', function(){

        var data = $('#edit-invoice-form').serialize();
        var invoice_key = $(this);
        // now add some additional stuff

        $.fn.inputs();
        $('#edit-invoice-form').validate();

        //if($('#edit-invoice-form').find('.error').length == 0){

            data += "&invoice_id=" + encodeURIComponent(invoice_key.attr('id'));

            /* Send the data using post */
            var posting = $.post( "inc/ajax/save_modified_invoice.php", data);
            /* Put the results in a div */
            posting.done(function( data ) {

                if(data != false){
                    toastr.options.positionClass = 'toast-top-full';
                    toastr.success('the invoice! has been saved','Done!');
                    //check if this key for save and print
                    if(invoice_key.hasClass('print')){
                        window.open("./print.php?v="+data);
                    }
                    $('.edit_invoice_form').remove();
                }else{

                    toastr.options.positionClass = 'toast-top-full';
                    toastr.error('check required filed','Error!');
                    return false;
                }
            });
        //}
    });

    $('.close_edit_invoice').live('click', function(e) {
        e.preventDefault();

        $(".edit_invoice_form").remove(); // remove item from invoice
        $('#board_list').removeClass('g8');// remove half of full screen
        $('#board_list').addClass('g16');// set full screen
        $('#sort-boxes #process_type').val('0'); //disable edit invoice functions

    });



});
