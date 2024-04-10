<?php

class CONTROLLERS extends FUNCTIONS
{

    var $ACTION;
    var $CODE;
    var $ProfileData;
    var $MyDept;
    var $countries;
    var $Picture;
    var $lang;
    var $APIuserID;
    var $APIkeyID;

    /**
     * CONTROLLERS::__construct()
     *
     * @return
     */
    public function __construct()
    {
        global $INFO, $_countries, $SiteLang;


        /**
         * initialization the security system
         * parsing all incoming data [get,post,cookie,request]
         * cleaning  all values and keys by wonderful ways
         */
        $secure = new SECURITY();
        $secure->parse_incoming();

        $secure2 = new SECURITY2();
        $secure2->parse_incoming();
    }
}
?>
