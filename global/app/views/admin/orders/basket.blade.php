<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fontello-icon-basket"></i> Basket <small>Management</small></h2>
</div>
<!-- // page head -->

<div id="page-content" class="page-content">
    <section>
        <div class="row-fluid">
            <div class="span12">

                <div class="clearfix margin-xx"></div>
                <div class="well well-box well-black">
                    <div class="navbar navbar-inverse">
                        <div class="navbar-inner">
                            <h4 class="title"><i class="fontello-icon-basket"></i>Your Basket <small>Ready for your order</small></h4>
                            <ul class="nav pull-right">
                                @if(count(Basket::contents()) > 0)
                                <li><a href="#">Cancel</a></li>
                                <li class="divider-vertical"></li>
                                <li><a id="make_order" href="#">Order Now</a></li>
                                @endif
                            </ul>
                            <!-- // nav -->
                        </div>
                    </div>
                    <!-- // navbar -->
                    <table class="table boo-table table-condensed table-content table-hover">
                        <caption>
                            You have <span>{{Basket::totalItems()}} items</span> in basket
                        </caption>
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="hidden-phone">Quantity</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(count(Basket::contents()) > 0)

                        @foreach (Basket::contents() as $item)

                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td><a href="{{ URL::to("admin/orders/basket/delete/$item->id") }}"> <i class="fontello-icon-cancel-2"></i> Delete</a></td>
                        </tr>

                        @endforeach

                        @else

                        <tr>
                            <td colspan="4">No Items in your basket</td>
                        </tr>

                        @endif


                        </tbody>
                    </table>
                    @if(count(Basket::contents()) > 0)
                    <form method="post" action="{{ URL::route("make_order") }}" id="make_order_process">
                            <div class="widget-footer padding15 well-black">
                                <label for="accountNotes">Attach a Note:</label>
                                <textarea rows="4" name="note" class="input-block-level" id="accountNotes"></textarea>

                            </div>
                            @foreach (Basket::contents() as $item)
                            <input type="hidden" name="basket_items[]" value="{{ $item->id }},{{ $item->quantity }}">
                            @endforeach
                    </form>
                    @endif
                    <!-- // table -->
                </div>


            </div>
        </div>
        <!-- // Example row -->
    </section>
</div>
<!-- // page content -->

<script>
    $(document).ready(function() {

        $("a#make_order").on('click', function (e) {
            //var item_id = $(this).attr('rel');
            $("#make_order_process").submit();
        });

    } );
</script>