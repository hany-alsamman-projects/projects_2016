<div class="box nav-box g8">
    <ul class="nav">
        <li data-nav="#tab1" class="sel">Add item</li>
        <li data-nav="#tab2">Add customer</li>
        <li data-nav="#tab3">Add supplier</li>
    </ul>
    <div class="nav-body">
        <div id="tab1" class="nav-item show">
            <form id="quick_additem">

                <div id="box_customer_name" class="g16">
                    <input type="text" name="item_title" placeholder="item title" class="required g5">
                </div>
                <div id="box_customer_name" class="g16">
                    <input type="text" name="item_price" placeholder="item price" class="required g5">
                </div>

                <input type="hidden" name="operation" value="add_item">

                <br class="clear">

                <button type="submit" id="save_order" class="green btn-m flt-l g3 normal">Add</button>

            </form>
        </div>
        <div id="tab2" class="nav-item">
            <form id="quick_addcustomer">

                <div id="box_customer_name" class="g16">
                    <input type="text" name="contact_name" placeholder="Contact name" class="required g5">
                    <input type="text" name="company" placeholder="Company" class="required g5">
                </div>
                <div id="box_customer_name" class="g16">
                    <input type="text" name="phone" placeholder="Phone" class="required g5">
                    <input type="text" name="mobile" placeholder="Mobile" class="required g5">
                </div>

                <div id="box_customer_name" class="g16">
                    <textarea name="address" placeholder="Address" class="required g10"></textarea>
                </div>

                <input type="hidden" name="operation" value="add_customer">

                <br class="clear">

                <button type="submit" id="save_order" class="green btn-m flt-l g3 normal">Add</button>

            </form>
        </div>
        <div id="tab3" class="nav-item">
            <form id="quick_addsupplier">

                <div id="box_customer_name" class="g16">
                    <input type="text" name="contact_name" placeholder="Supplier name" class="required g5">
                    <input type="text" name="company" placeholder="Company" class="required g5">
                </div>
                <div id="box_customer_name" class="g16">
                    <input type="text" name="phone" placeholder="Phone" class="required g5">
                    <input type="text" name="mobile" placeholder="Mobile" class="required g5">
                </div>

                <div id="box_customer_name" class="g16">
                    <textarea name="address" placeholder="Address" class="required g10"></textarea>
                </div>

            <input type="hidden" name="operation" value="add_supplier">

            <br class="clear">

            <button type="submit" id="save_order" class="green btn-m flt-l g3 normal">Add</button>
            </form>
        </div>
    </div>
</div>