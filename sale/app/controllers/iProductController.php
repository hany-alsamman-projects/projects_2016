<?php
/*
.---------------------------------------------------------------------------.
| License does not expire.                                                  |
| Can be used on 1 site, 1 server                                           |
| Source-code or binary products cannot be resold or distributed            |
| Commercial/none use only                                                  |
| Unauthorized copying of this file, via any medium is strictly prohibited  |
| ------------------------------------------------------------------------- |
| Cannot modify source-code for any purpose (cannot create derivative works)|
'---------------------------------------------------------------------------'
*/

/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Copyright © 2013 CODEXC.COM
 * @version 4.1 RC1
 * @access private
 * @license http://www.binpress.com/license/view/l/9f75712c904c6fae3ed66dc3d620f19f license for commercial use
 */


use ScubaClick\Pages\Models\Category;

class iProductController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {

        $data['products'] = Product::paginate(5);
        $data['depts'] = Category::all();

        $this->layout->content = View::make('products/index',$data);

    }


    public function getProductsByDEPT()
    {

        $slug = Request::segment(3);

        $data['DeptID'] = Category::where('slug',$slug)->first();

        $data['products'] = Product::where('dept_id',$data['DeptID']->id)->paginate(5);

        $this->layout->content = View::make('products/index',$data);

    }

    public function ViewProduct()
    {
        $id = Request::segment(4);

        $data['product'] = Product::where('id',$id)->first();

        $data['DeptID'] = Category::where('id',$data['product']->dept_id)->first();

        $this->layout->content = View::make('products/view',$data);
    }

    static  function ProductsIntro()
    {
        return Product::orderBy('id','DESC')->limit(4)->get();
    }

}