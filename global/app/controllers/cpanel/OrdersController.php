<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Copyright © 2013 CODEXC.COM
 * @version 4.0 RC1
 * @access private
 * @filename OrdersController.php
 * @lastupdate 2/8/14 17
 * @license http://www.binpress.com/license/view/l/9f75712c904c6fae3ed66dc3d620f19f license for commercial use
 */


namespace Controllers\Cpanel;

use CpanelController;

use Input;
use View;
use Debugbar;
use Redirect;
use Product;
use Basket;
use Response;
use DB;
use Orders;
use Sentry;

class OrdersController extends CpanelController {

    public function __construct(){

    }

    public function getIndex(){

        $data['orders'] = Orders::where("user_id",Sentry::getUser()->id)->get();

        $this->layout->content = View::make('admin/orders/index',$data);

    }

    public function postMakeOrder(){

        $basket_items = Input::get("basket_items");
        $order_note =  Input::get('note');

        if(count($basket_items) == false ) die();

        $order = new Orders;
        $order->user_id = Sentry::getUser()->id;
        $order->status = 'pending';
        $order->note = $order_note;
        $order->save();

        if( $order ){
            foreach($basket_items as $item){
                list($id, $quantity) = explode(',',$item);
                DB::table('order_items')->insert(
                    array('prodcut_id' => $id,
                          'quantity' => $quantity,
                          'order_id' => $order->id) //the id of the $order we just inserted
                );
            }
            //trash the basket :)
            Basket::destroy();
            return Redirect::route('orders')->with('flash_error', "your have new submitted order ID #$order->id");
        }
    }

    public function getBasket(){

        //Basket::destroy();

        $this->layout->content = View::make('admin/orders/basket');
    }

    public function AddToBasket(){

        $item_id = Input::get('item_id');

        //Format array of required info for item to be added to basket...
        $items = Product::where('id','=',$item_id)->select('id', 'title as name')->first()->toArray();

        $items['quantity'] = 1;
        $items['price'] = 0;
        $items['weight'] = 0;

        //Make the insert...
        Basket::insert($items);

        return Response::json(array('name' => \Str::limit($items['name'], 50),
                                    'count' => Basket::totalItems()));
    }

    public function DestroyBasket($id = false){

        if($id){
            foreach (Basket::contents() as $item) {
                if($item->id == $id) {
                    $item->remove();
                    return Redirect::back()->with('flash_error', 'the select item deleted successfully');
                }
            }
        }else{
            Basket::destroy();
            return Redirect::back()->with('flash_error', 'your basket is empty now');
        }

    }


    public function getManageOrder($id){

        $data['order'] = Orders::where("id",$id)->get();

        $this->layout->content = View::make('admin/orders/manage',$data);

    }

}