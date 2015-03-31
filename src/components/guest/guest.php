<?php
namespace components;

use components\guest\GuestLayer;
use lib\DI;
use lib\System;

/////////////////////////////// M A I N /////////////////////////////////////////

            /**
             * @var GuestLayer $main_controller
             */
            $main_controller = DI::getInstanceByKey('guest_layer');

            $action = $main_controller->senseFirsAction($_GET, $_POST);

            if (isset($action)){
                    switch($action){
                        case "saveform":{
                            $result = $main_controller->NewAction($_POST);
                            if ($result === true) {
                                echo 'success';
                            } else {
                                echo 'Error: '. $result;
                            }
                        }
                        break;
                        case "getpagecount":{
                            echo $main_controller->getMessageCount();
                        }
                        break;
                        case "getform":{
                            echo System::getTemplate("gb_feedback_form");
                        }
                        break;
                        case "getlist":{
                            echo $main_controller->getMessageList($_GET);
                        }
                        break;


                        case "flist":
                        {
                            // Edit action
                            if (isset($_POST['edit'])) {
                                $main_controller->EditView($_POST['id']);
                            }

                            // Remove action
                            if (isset($_POST['delete'])) {

                                $result = $main_controller->RemoveAction($_POST['id']);
                                if ($result === true) {
                                    echo 'Success!';
                                } else {
                                    echo 'Error: '. $result;
                                }
                                $main_controller->ListView();
                            }
                        }
                        break;
                        case "add":
                        {
                            $main_controller->AddView();
                        }
                        break;
                        case "insert":
                        {
                            $result = $main_controller->NewAction($_POST);
                            if ($result === true) {
                                echo 'Success!';
                            } else {
                                echo 'Error: '. $result;
                            }
                            $main_controller->ListView();
                        }
                        break;
                        case "update":
                        {
                            $result = $main_controller->SaveAction($_POST);
                            if ($result === true) {
                                echo 'Success!';
                            } else {
                                echo 'Error: '. $result;
                            }
                            $main_controller->ListView();
                        }
                        break;
                        case "show":
                        {
                            $main_controller->ShowBaseView();
                        }
                        break;
                        default:
                        {
                            $main_controller->ShowBaseView();
                        }
                        break;
                    }
                }

    /////////////////////////////// M A I N /////////////////////////////////////////
