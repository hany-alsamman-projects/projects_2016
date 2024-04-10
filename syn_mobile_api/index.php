<?php

/**
 * @author Hany
 * @copyright Syria News
 * @version 1.0 RC1
 * @access private
 */

class SYN_XML{

    var $domain;
    var $sections;

    public function __construct()
    {
        $this->domain = 'http://www.syria-news.com/';

        $this->sections = (object) array('politic' => 'politicnews.xml',
                                         'economic'=> 'economicnews.xml',
                                         'local'=> 'localnews.xml',
                                         'sport'=> 'sportnews.xml',
                                         'zaman'=> 'zaman.xml',
                                         'techno'=> 'techno.xml',
                                         'mosahamat'=> 'mosahamat.xml',
                                         'makalat'=> 'makalat.xml',
                                         'investications'=> 'investications.xml',
                                         'halap'=> 'halap.xml',
                                         'world'=> 'world.xml');
    }

    function GET_XML_NEWS($section){
        print $this->domain.$this->sections->$section;
        $contents = file_get_contents($this->domain.$this->sections->$section);
        //file_put_contents($this->sections->$section, $contents);
        return $contents;
    }

    function RUN(){
        $topic = $_GET['topic'];
        $items = $this->GET_XML_NEWS($topic);
        return $items;
        //$this->XML_PROCESS($items);
    }

    function XML_PROCESS($items){
        //print_r($items);
    }

}

$a = new SYN_XML();

header('Content-Type: text/html; charset=utf-8');

print $a->RUN();
