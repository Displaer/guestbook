<?php
namespace homepage;

use lib\System;

class HomepageLayer
{
    public function ShowMenu()
    {
        $manager = HomepageManager::getInstance();
        
        $list = $manager->getList();

        if ($list !== null) {

            echo '<ul class="ci-homepage-list">';

            foreach ($list as $item) {
                $url = $item['url'];
                if (
                        $url!='system'
                        and $url!='cont'
                        and $url!='account'
                        and $url!='homepage'
                        and (stripos(System::getSession('upostcomponents','global'), $url)!==FALSE)) {
                    echo '<li>';
                        echo '<a class="btn btn-info" href="index.php?control='.$url.'">';
                        echo '<i class="glyphicon glyphicon-asterisk"></i>';
                        echo '<span class="label-info">'.$item['name'].'</span>';
                        echo '</a>';
                    echo '</li>';
                }
            }
            echo '</ul>';
        } else {
            echo '<h5>Empty list</h5>';
        }
    }

}