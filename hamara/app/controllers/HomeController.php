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

    public function postRequest(){

        $type = Input::get('form_action');
        $data = array();

        // security check

        $data['page'] = Page::where('slug', $type)->first();
        $data['type'] = str_replace('-', ' ', $type);

        $input = \Input::except(array('form_action'));
        $subject = 'request about '.$data['type'];
        $body = 'emails.static.'.$type;

        switch($type){

            case 'request':

                $data['Name'] = $input['Name'];
                $data['Tel_Off'] = $input['Tel_Off'];

                $data['Address'] = $input['Address'];
                $data['E_mail'] = $input['E_mail'];
                $data['Nationality'] = $input['Nationality'];

                $data['SponsorName'] = $input['SponsorName'];
                $data['SponsorTel'] = $input['SponsorTel'];
                $data['Type_of'] = $input['Type_of'];

                if(!empty($Depname) && is_array($Depname) ){
                    $data['Depname'] = $input['Depname'];
                    $data['Depspouse'] = $input['Depspouse'];
                    $data['gender'] = $input['gender'];
                    $data['age'] = $input['age'];
                    $data['school'] = $input['school'];
                }

                $data['Status'] = $input['Status'];

                break;

        }

        // send email please :P
        $this->deliver($body, $data,$subject);

        return View::make('frontend/account/process', compact('form'));
    }

    public function deliver($body, $data, $subject)
    {

        //Mail::pretend(true);

        return Mail::send($body, $data, function($message) use ($data, $body, $subject)
        {
            $message->from(\config::get('settings.mailer.senderfrom') , \config::get('settings.mailer.sendername'));

            $email_to = explode(',', $data['page']->email_to);
            $email_cc = explode(',', $data['page']->email_cc);

            if(count($email_to) > 0){
                foreach($email_to as $email)
                    if(!empty($email)) $message->to($email);
            }

            if(count($email_cc) > 0){
                foreach($email_cc as $email)
                    if(!empty($email)) $message->cc($email);
            }

            $message->subject($subject);
        });
    }

}