$(function() {

    $('#show_invoices').click( function(e) {
        e.preventDefault();

        /* get the data */
        var posting = $.get( "inc/ajax/loadInvoices.php");

        posting.done(function( data ) {

            var empty = $("#work_area .box-body").html().trim().length == 0;

            if(empty) {
                /* Put the results in a div */
                $( "#work_area .box-body" ).append( data );
                /* enable table crazy functions */
                $('#ShowInvoices').dataTable({
                    "sPaginationType": "full_numbers", "aLengthMenu": [5, 10, 25], "iDisplayLength": 5,
                    "fnDrawCallback": function() {
                        $.fn.makeSelect();
                    }
                });

                toastr.options.positionClass = 'toast-top-right';
                toastr.success('Invoices page loaded!');
            }else{
                /* fuck me, i want to sleep */
                $( "#work_area .box-body").empty();
            }

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
        //data['wordlist'] = wordlist

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


    $('.customer_row').live('click', function(e) {
        //e.preventDefault();
        //add_cus(<?=$r['id']?>,'<?=$r['company']?>',this);

        customer_id = this.id;
        customer_name = $('#'+this.id+' #customer_company_name').text();

        $('#smp-form #box_customer_name h2 span').text(customer_name);

        $('#smp-form #box_customer_id').val(customer_id);

        //add_cus(<?=$r['id']?>,'<?=$r['company']?>',this)
        //alert( customer_name );

    });

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
            return false;
        }

        //create row on the fly
        var $t_invoice = $('<div id="'+item_id+'" class="cont g16"></div>');
        //append to t_invoice div
        $t_invoice.appendTo('#t_invoice');

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

        $( "#t_invoice table tbody #row_"+this.id).remove(); // remove item from invoice
        toastr.options.positionClass = 'toast-top-right';
        toastr.success('selected item has been removed from current invoice');

        update_total_bill(true);

    });


});