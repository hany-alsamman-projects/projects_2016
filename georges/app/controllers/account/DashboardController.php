<?php

namespace Controllers\Account;

use AuthorizedController;
use Redirect;

use ScubaClick\Pages\Models\Page;
use View;
use Input;
use Request;
use Mail;

class DashboardController extends AuthorizedController {

	/**
	 * Redirect to the profile page.
	 *
	 * @return Redirect
	 */
	public function getIndex()
	{
        // Check user if approve the policy
        if(!\Sentry::getUser()->approved)
            return Redirect::route('userApprove');

        $board = Page::where('front',1)->get();

		// Redirect to the profile page
        return View::make('frontend/account/dashboard', compact('board'));
	}

    public function postProcess(){

        $type = Input::get('form_action');
        $data = array();

        // security check
        if(!Request::isMethod('post') && !Input::has('form_action')) return Redirect::route('signin');

        $data['user'] = \User::with('data')->find(\Sentry::getUser()->getId());
        $data['page'] = Page::where('slug', $type)->first();
        $data['type'] = str_replace('-', ' ', $type);

        $input = \Input::except(array('form_action'));
        $subject = 'request about '.$data['type'];
        $body = 'emails.static.'.$type;

        switch($type){

            case 'teenage-visitor':

                $data['villa_apt'] = $input['villa_apt'];
                $data['date_time'] = $input['date_time_of_visit'];
                //array fields
                $data['name_of_guest'] = $input['name_of_guest'];
                $data['age_of_guest'] = $input['age_of_guest'];

            break;

            case 'extended-visit-request':

                $data['date_from'] = $input['date_from'];
                $data['date_till'] = $input['date_till'];
                $data['resident_note'] = $input['resident_note'];
                //array fields
                $data['guest_full_name'] = $input['guest_full_name'];
                $data['relation_to_resident'] = $input['relation_to_resident'];
                $data['age'] = $input['age'];
            break;

            case 'maintenance-service':

                $data['function_date'] = $input['function_date'];
                $data['time'] = $input['time'];
                if(!empty($input['permission'])) $data['permission'] = $input['permission'];
                $data['available_date'] = $input['available_date'];
                $data['available_time'] = $input['available_time'];
                $data['location'] = $input['location'];
                //array fields
                $data['service'] = $input['service'];
            break;

            case 'aovc-school-bus':

                $data['invite_on'] = $input['invite_on'];
                $data['guest_full_name'] = $input['guest_full_name'];
                $data['age'] = $input['age'];
                $data['date'] = $input['date'];
                $data['resident_note'] = $input['resident_note'];
            break;

            case 'room-reservation':

                $data['host'] = $input['host'];
                $data['mobile'] = $input['mobile'];
                $data['function_date'] = $input['function_date'];
                $data['function_type'] = $input['function_type'];

                $data['day'] = $input['day'];
                $data['starting'] = $input['starting'];
                $data['till'] = $input['till'];

                $data['food_catering_company'] = $input['food_catering_company'];
                $data['mobile_number'] = $input['mobile_number'];

                $data['tables_num'] = $input['tables_num'];
                $data['chairs_num'] = $input['chairs_num'];
                $data['lamp_num'] = $input['lamp_num'];

                $data['special'] = $input['special'];
                if(!empty($input['maintenance']))
                $data['maintenance'] = $input['maintenance'];

                $data['first_name'] = $input['first_name'];
                $data['family_name'] = $input['family_name'];
                $data['nationality'] = $input['nationality'];

                $data['residents'] = $input['residents'];
                $data['non_residents'] = $input['non_residents'];
                $data['total'] = $input['total'];

            break;

            case 'indoor-cleaning':

                $data['villa_apt'] = $input['villa_apt'];

                if(!empty($input['cleaning'])) $data['cleaning'] = $input['cleaning'];

                if(!empty($input['carpet'])) $data['carpet'] = $input['carpet'];

                if(!empty($input['other'])) $data['other'] = $input['other'];

                if(!empty($input['permission'])) $data['permission'] = $input['permission'];

                $data['day'] = $input['day'];
                $data['date'] = $input['date'];
                $data['time'] = $input['time'];

            break;

            case 'function-request':

                $data['host'] = $input['host'];
                $data['mobile'] = $input['mobile'];
                $data['function_date'] = $input['function_date'];
                $data['function_type'] = $input['function_type'];

                if(!empty($input['function_type_msg'])) $data['function_type_msg'] = $input['function_type_msg'];


                $data['day'] = $input['day'];
                $data['starting'] = $input['starting'];
                $data['till'] = $input['till'];

                $data['food_catering_company'] = $input['food_catering_company'];
                $data['mobile_number'] = $input['mobile_number'];

                $data['round_tables_num'] = $input['round_tables_num'];
                $data['rect_tables_num'] = $input['rect_tables_num'];
                $data['chairs_num'] = $input['chairs_num'];

                $data['special'] = $input['special'];
                if(!empty($input['maintenance']))
                    $data['maintenance'] = $input['maintenance'];

                $data['lights'] = $input['lights'];
                $data['electrical'] = $input['electrical'];

                $data['first_name'] = $input['first_name'];
                $data['family_name'] = $input['family_name'];
                $data['nationality'] = $input['nationality'];

                $data['residents'] = $input['residents'];
                $data['non_residents'] = $input['non_residents'];
                $data['total'] = $input['total'];

                break;

            case 'property-department-service':

                $data['function_date'] = $input['function_date'];
                $data['time'] = $input['time'];
                if(!empty($input['permission'])) $data['permission'] = $input['permission'];
                $data['available_date'] = $input['available_date'];
                $data['available_time'] = $input['available_time'];
                $data['description'] = $input['description'];

                break;

            case 'request':

                $data['Name'] = $input['Name'];
                $data['Tel_Off'] = $input['Tel_Off'];

                $data['Address'] = $input['Address'];
                $data['E_mail'] = $input['E_mail'];
                $data['Nationality'] = $input['Nationality'];

                $data['SponsorName'] = $input['SponsorName'];
                $data['SponsorTel'] = $input['SponsorTel'];
                $data['Type_of'] = $input['Type_of'];

                if(!empty($input['Depname'])) $data['Depname'] = $input['Depname'];
                $data['Depspouse'] = $input['Depspouse'];
                $data['gender'] = $input['gender'];
                $data['age'] = $input['age'];
                $data['school'] = $input['school'];

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
            $user = \User::find(\Sentry::getUser()->getId());

            if(isset($user->email) && isset($user->first_name)){
                $message->from($user->email, $user->first_name);
            }else{
                $message->from(\config::get('settings.mailer.senderfrom') , \config::get('settings.mailer.sendername'));
            }

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

    // helper function for get field without _ and make it uppercase
    static function ucname($string) {
        $string =ucwords(strtolower($string));
        foreach (array('_') as $delimiter) {
            if (strpos($string, $delimiter)!==false) {
                $string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));

            }
        }
        return str_replace('-', ' ', $string);
    }

}
