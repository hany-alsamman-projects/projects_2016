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
        //$url = $this->domain.$section;

        $contents = file_get_contents($this->sections->politic);
        $xml = simplexml_load_string($contents);
        return $xml->channel;
    }

    function RUN(){
        $items = $this->GET_XML_NEWS($this->sections->politic);
        $this->XML_PROCESS($items);
    }

    function XML_PROCESS($channel){

        $title = $channel->title;
        $description = $channel->description;
        $pubDate = $channel->pubDate;
        $logo = $channel->image->url;

        foreach($channel->item as $item){

        $title = $item->title;
        $pubDate = $item->pubDate;
        //$description = $item->description;
        //$link = $item->link;

        $child = $item->children();

        //<media:hash algo="md5">...
        //$device_hash = $item->children('media', true);
        //<media:content> ....
        //$device_content = $item->children('media', true)->content->attributes();

        print $child->link. '<br>';
        print $pubDate. '<br>';
        print $child->title. '<br>';
        print $child->description->content.'<br><br>';

        }

    }

}

$a = new SYN_XML();

header('Content-Type: text/html; charset=utf-8');

print $a->RUN();
