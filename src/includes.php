<?php
/**
 * @author Dilshod Sanginov (DELL) <prodilshod@gmail.com>
 * Created 1/23/14, 12:08 PM
 * Copyright dit
 */

$controls = \lib\System::getControlList();
$userPostComponents = \lib\System::getSession('upostcomponents','global');


foreach ($controls as $control) {

        //if ((stripos($userPostComponents, $control['url'])!==FALSE)) {

        $path = 'components/' . $control['url'] . '/' . ucfirst($control['url'])  . 'Manager.php';
        @include_once($path);

        //echo $path.'<br>';
        //if (file_exists($path)) echo 'Correct<br>'; else  echo 'inCorrect<br>';

        $path = 'components/' . $control['url'] . '/' . ucfirst($control['url'])  . 'Layer.php';
        @include_once($path);

        //echo $path.'<br>';
        //if (file_exists($path)) echo 'Correct<br>'; else  echo 'inCorrect<br>';
    //}
}
