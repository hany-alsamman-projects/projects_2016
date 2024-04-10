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
    public function getIndex()
    {
        return View::make('index');
    }

    public function getPortfolio()
    {
        return View::make('static.portfolio');
    }

    public function getPage($slug)
    {
        $data['getPage'] = Page::where('slug', '=', $slug)->first();

        $data['search_mode'] = false;

        if (Sentry::check())
        $data['user'] = User::with('data')->find(Sentry::getUser()->getId());

        // if page is an form and user not logged in please redirect to sign-in
        if($data['getPage']->front == 1){
            if (!Sentry::check())
                return Redirect::route('signin');
        }
        // if page not found redirect to home page
        if ( is_null($data['getPage']) )
            return Redirect::route('home');

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

    static function MainPages($lang='en'){

        $mypage = Page::where("category_id",'=',0);

        $mypage->where("lang_id",2);

        $mypage->where("front",'!=',1);

        $mypage->orWhereNull("category_id");

        return $mypage->get();
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

    function postContact(){

        $data = Input::all();

        //Mail::pretend();

        $body = 'emails.welcome_body';

        $data['page'] = Page::where('slug', 'contact-us')->first();

        $this->deliver($body, $data, "You've been contacted");

        return Redirect::back()->with('flash_error', 'message sent');
    }

    static function GetSlides(){

        $slides = Slides::orderBy('position')->get();

        if(!$slides->isEmpty()){
            return $slides;
        }else{
            return false;
        }
    }
}