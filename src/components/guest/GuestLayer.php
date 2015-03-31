<?php
namespace components\guest;

use lib\BaseLayer;
use lib\DI;
use lib\System;

class GuestLayer extends BaseLayer
{

    /**
     * @var GuestManager
     */
    protected $guestManager;

    /**
     * @param $guestManager
     */
    public function __construct($guestManager)
    {
        $this->guestManager = $guestManager;
    }


    /**
     * Show statistic html page for loading data.
     */
    public function ShowBaseView(){
        echo System::getTemplate("gb_main");
        //print System::getTemplate("gb_main_init");
    }

    /**
     * Show count of messages.
     */
    public function getMessageCount()
    {
        $count = $this->guestManager->getMessageCount();
        return $count['CNT'];
    }


    public function getMessageList($postData)
    {

        $list = $this->guestManager->getMessageList(
            $postData['page'],
            $postData['onPage'],
            $postData['pid'],
            $postData['moderate'],
            $postData['includeAnswers']
        );
        foreach($list as &$item){
            $date1 = new \DateTime($item['date']);
            $item['date'] = $date1->format("<b>H:i</b> d/m/Y");
        }
        return json_encode($list);
    }

    public function NewAction($postData)
    {
        $dataArray =[];
        $dataArray['name'] = $postData['name'];
        $dataArray['email'] = $postData['email'];
        $dataArray['message'] = mysql_real_escape_string(strip_tags($postData['message']));

        return $this->guestManager->insert($dataArray);
    }

}