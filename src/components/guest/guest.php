<?php
namespace components;

use components\guest\GuestLayer;
use lib\DI;
use lib\System;

/**
 * Main controller For get static content and dynamics.
 */
/////////////////////////////// M A I N /////////////////////////////////////////

/**
             * @var GuestLayer $main_controller
             */
            $main_controller = DI::getInstanceByKey('guest_layer');

            $action = $main_controller->senseFirsAction($_GET, $_POST);

            if (isset($action)){
                    switch($action){
                        case "saveform":{
                            // saves data sent by form
                            $result = $main_controller->NewAction($_POST);
                            if ($result === true) {
                                echo 'success';
                            } else {
                                echo 'Error: '. $result;
                            }
                        }
                        break;
                        case "getpagecount":{
                            // return count of messages in guestbook
                            echo $main_controller->getMessageCount();
                        }
                        break;
                        case "getform":{
                            // return form
                            echo System::getTemplate("gb_feedback_form");
                        }
                        break;
                        case "getlist":{
                            // return list of messages as JSON
                            echo $main_controller->getMessageList($_GET);
                        }
                        break;
                        case "show":
                        {
                            // return static content
                            $main_controller->ShowBaseView();
                        }
                        break;
                        default:
                        {
                            // return static content
                            $main_controller->ShowBaseView();
                        }
                        break;
                    }
                }

    /////////////////////////////// M A I N /////////////////////////////////////////
