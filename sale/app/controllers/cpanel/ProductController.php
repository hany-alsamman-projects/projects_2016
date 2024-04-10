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

namespace Controllers\Cpanel;

use CpanelController;

use Input;
use Maatwebsite\Excel\Facades\Excel;
use Redirect;
use Sentry;
use View;
use DB;
use Debugbar;
use Request;
use ScubaClick\Pages\Models\Category;
use Product;
use Validator;
use Basket;

class ProductController extends CpanelController {

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

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        $data['products'] = Product::all();
        $data['depts'] = Category::all();

        $this->layout->content = View::make('admin/products/index',$data);

    }


    public function getProductsByDEPT($dept)
    {

        $data['products'] = Product::where('dept_id', '=', $dept)->get();
        $data['depts'] = Category::all();
        $data['dept_id'] = $dept;

        $this->layout->content = View::make('admin/products/index_by_dept',$data);

    }

    public function getAddProduct()
    {

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        $data['depts'] = Category::all();
        $this->layout->content = View::make('admin/products/add',$data);
    }

    public function postAddProduct()
    {

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        if (Input::has('title') && Input::has('subject')) {

            $cover_name = false;

            if (Input::hasFile('upload_file'))
            {
                //Debugbar::info($filename);

                $file = Input::file('upload_file'); // your file upload input field in the form should be named 'file'

                $extension = Input::file('upload_file')->getClientOriginalExtension();
                $filename = Input::file('upload_file')->getClientOriginalName();
                $cover_name = uniqid() . '.' . $extension;

                $dest = base_path() .'/' . 'upload/covers';

                Input::file('upload_file')->move($dest,$cover_name);
            }

            $product =  array(
                'title' => Input::get('title'),
                'subject' =>  Input::get('subject'),
                'content' => Input::get('content'),
                'photo' => $cover_name,
                'dept_id' => Input::get('dept_id'),
                'user_id' => Input::get('user_id'));;

            $affected = Product::insert($product);

            if ($affected != false)  $this->message = 'The Product was added successfully!';
            return Redirect::back()->with('flash_error', $this->message);
        }else{
            return Redirect::back()->with('flash_error', 'all fields is required!');
        }

    }

    public function getEditProduct($id)
    {
        $data['product'] = Product::where('id', '=', $id)->first();

        $data['depts'] = Category::all()->lists('title','id');

        $this->layout->content = View::make('admin/products/edit', $data);
    }

    public function postEditProduct($id)
    {
        $cover_name = false;

        if (Input::hasFile('upload_file'))
        {
            //Debugbar::info($filename);

            $file = Input::file('upload_file'); // your file upload input field in the form should be named 'file'

            $extension = Input::file('upload_file')->getClientOriginalExtension();
            $filename = Input::file('upload_file')->getClientOriginalName();
            $cover_name = uniqid() . '.' . $extension;

            $dest = base_path() .'/' . 'assets/data/covers';

            Input::file('upload_file')->move($dest,$cover_name);

            if(file_exists($dest . $filename))
                return Redirect::back()->with('flash_error', 'System has imported: '.$affected . ' Products of the file');
        }

        $product =  array(
                          'title' => Input::get('title'),
                          'subject' =>  Input::get('subject'),
                          'content' => Input::get('content'),
                          'photo' => $cover_name,
                          'dept_id' => Input::get('dept_id'),
                          'user_id' => Input::get('user_id'));

        Product::where('id',$id)->update($product);

        return Redirect::back()->with('flash_error', 'The Product was edited successfully!');

    }

    public function DeleteProduct($id){

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        Product::find($id)->ForceDelete();
        return Redirect::back()->with('flash_error', 'the Product was deleted successfully');

    }

    public function getImportProducts(){

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        $data['depts'] = Category::all();


        $this->layout->content = View::make('admin/products/import', $data);
    }


    public function postImportProducts(){

        //$hany = Excel::load('/home/hany/public_html/gate/assets/admin/data/cardiology.xls')->calculate()->toArray();

        //Debugbar::info($filename);


        if (Input::hasFile('upload_file'))
        {

            $extension = Input::file('upload_file')->getClientOriginalExtension();
            $filename = Input::file('upload_file')->getClientOriginalName();
            $limit = Input::has('limit') ? (Input::get('limit')+2) : false;

            if ($extension != 'xls')
            {
                return Redirect::back()->with('flash_error', 'system is allowed xls files only!');
            }

            $dest = base_path() .'/' . 'assets/admin/data/';

            $user_id = Input::get('user_id');

            $dept_id = Input::get('dept_id');

            Input::file('upload_file')->move($dest,$filename);

            if(file_exists($dest . $filename)){

                chmod($dest . $filename, 0777);

                if(!$limit)
                    $get_file = Excel::load($dest.$filename)->calculate()->toArray();
                else
                    $get_file = Excel::load($dest.$filename)->calculate()->limit($limit)->toArray();

                // skip the first and second line
                unset( $get_file[0],  $get_file[1]);

                foreach($get_file as $lines){

                    static $affected=0;

                    $id = $lines[1];
                    $title = $lines[2];
                    $author = $lines[3];
                    $ref_id = $lines[4];
                    $subject = $lines[5];

                    $is_affected = DB::insert('insert into products
                        ( `id`, `title`, `author`, `ref_id`, `subject`, `dept_id` , `user_id`) values (?,?,?,?,?,?,?)',
                        array(NULL, $title, $author, $ref_id, $subject,$dept_id,$user_id));

                   if($is_affected) $affected++;
                }

                return Redirect::back()->with('flash_error', 'System has imported: '.$affected . ' Products of the file');
            }

        }
    }

}