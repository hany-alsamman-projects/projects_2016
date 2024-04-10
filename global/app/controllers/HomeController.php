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
 **/


class HomeController extends BaseController {

    public function __construct(){

        parent::__construct();
    }

    /**
     * get index @getIndex
     * @return view
     */
    public function getIndex($lang)
    {
        $data['lang'] = $lang;

        //lang in session
        Session::put('lang', $lang);

        return View::make('index', $data);
    }

    public function getPage($lang, $slug)
    {

        $data['getPage'] = Page::where('slug', '=', $slug)->first();

        $data['lang'] = $lang;

        $data['search_mode'] = false;

        if ( is_null($data['getPage']) )
            return Redirect::route('home');

        return View::make('index' , $data);
    }

    public function getSearch($lang)
    {

        $search = \Input::get('search_word');
        $data['matched'] = Page::where('content', 'LIKE', "%$search%")->OrWhere('title', 'LIKE', "%$search%")->get();

        $data['search_mode'] = true;

        $data['lang'] = $lang;

        return View::make('index' , $data);
    }


    static function checkStaticPage($view){
        try
        {
            View::getFinder()->find('static.'.$view);
            return true;
        }
        catch (InvalidArgumentException $error)
        {
            // View does not exist...
            return false;
        }
    }

    static function MainPages(){
        return Page::where("category_id",'=',0)->orWhereNull("category_id")->get();
    }

    static function hasPage($slug){

        $hasPage = Page::where("slug",'=',$slug)->first();

        if(!empty($hasPage)){
            return ($hasPage->category_id) ? $hasPage->category_id : false;
        }else{
            return false;
        }
    }

    static function SubPages($id){

        $pages = Page::where("category_id",'=',$id)->get();

        if(!$pages->isEmpty()){
            return $pages;
        }else{
            return false;
        }
    }

    static function GetPageIntro($id){

        $page = Page::where("category_id",'=',0)->where("slug",'=',$id)->take(1)->get();

        if(!$page->isEmpty()){
            foreach($page as $item){
                $check = Page::where("category_id",'=',$item->id)->first();
                if(!empty($check))
                    return $check->content;
            }
        }else{
            return false;
        }
    }

    static function SubProducts(){
        return Category::where("parent",'=',0)->orWhereNull("parent")->get();
    }

    function postContact(){

        $data = Input::all();

        //Debugbar::info($data);

        //Mail::pretend();

        $body = View::make('emails.welcome_body')->with($data)->render();

        $mydata = array('content' => $body);

        Mail::send('emails.welcome', $mydata, function($message)
        {
            $message->from('no-replay@sale-co.com', 'Sale Contact Form');
            $message->to('info@sale-co.com', 'Sale Advanced CO')->subject("You've been contacted");
        });

        return Redirect::back()->with('flash_error', 'message sent');

    }

}