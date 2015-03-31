<?php
/**
 * @author Dilshod Sanginov (DELL) <prodilshod@gmail.com>
 * @licenced: (CC) (BY) (NC)
 */

use lib\System;

$post = $_POST;
if (isset($post['go']) and isset($post['sLogin']) and isset($post['sPassword'])) {
    if (System::getSession('formTokenKey', 'login') != $post['formTokenKey'] or true) {
        System::setSession('formTokenKey', $post['formTokenKey'], 'login');
        $login = trim($post['sLogin']);
        $password = trim($post['sPassword']);
        $result = System::enter($login, $password);
        if ($result === true) {
            System::obtainPrivelegy();
            echo '<meta http-equiv="refresh" content="0;url=index.php?control=homepage" />';
        } else {
            echo System::getLoginForm();
        }
    } else {
        echo System::getLoginForm();
    }
} else {
    echo System::getLoginForm();
}