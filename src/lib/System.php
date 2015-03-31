<?php

namespace lib;

use \PDOException;

class System
{
    /** * Protected function for work with PDO * * @return \PDO */
    protected static function getDBH()
    {
        return Connector::getInstance()->getPDO();
    }

    public static function getSession($key, $components)
    {
        if (isset($_COOKIE['PHPSESSID']) and isset($_SESSION[$_COOKIE['PHPSESSID']]) and isset($_SESSION[$_COOKIE['PHPSESSID']][$components]) and isset($_SESSION[$_COOKIE['PHPSESSID']][$components][$key])) {
            return $_SESSION[$_COOKIE['PHPSESSID']][$components][$key];
        } else {
            return null;
        }
    }

    public static function setSession($key, $value, $components)
    {
        try {
            $_SESSION[$_COOKIE['PHPSESSID']][$components][$key] = $value;

            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function disSession($key, $components)
    {
        try {
            unset($_SESSION[$_COOKIE['PHPSESSID']][$components][$key]);

            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function closeSession()
    {
        try {
            unset($_SESSION[$_COOKIE['PHPSESSID']]);

            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function insertZeroLeft($digit, $length)
    {
        return str_repeat('0', $length - strlen(strval($digit))) . $digit;
    }

    public static function getControlList()
    {
        try {
            $dbh = self::getDBH();
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $query = "SELECT `id`, `name`, `url`, `position`, `help`, `active` FROM `sys_control` where (`url`!='help' and `url`!='exit' and `url`!='wellcome') and `deleted`=0 order by `position` ASC;";
        $statement = $dbh->prepare($query);
        try {
            $statement->execute();

            return $statement->fetchAll();
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getLoginLink($action)
    {
        if (self::getSession('logedin', 'global') == null) {
            $_class = ($action == 'login') ? 'class="active"' : '';

            return '<li ' . $_class . '><a href="?control=login">' . System::getStorage('login_enter') . '</a></li>';
        } else {
            $_class = ($action == 'logout') ? 'class="active"' : '';

            return '<li ' . $_class . '><a href="?control=logout">' . System::getStorage('logout_exit') . '</a></li>';
        }
    }

    public static function getLoginForm()
    {
        $fields = ['login_please', 'login_enter', 'login_password', 'login_login'];
        $template = self::getTemplate('login_form');
        foreach ($fields as $field) {
            $template = str_replace('#' . $field . '#', self::getStorage($field), $template);
        }
        $template = str_replace('#formTokenKey#', md5(time()), $template);

        return $template;
    }

    public static function enter($login, $password)
    {
        $password = md5($login . $password);
        $query = "SELECT `sy_id`, `name`, `post` FROM `sys_user` WHERE `login` =:login and `password` = :password and `sy_active` =1 and `sy_deleted` = 0";
        $statement = self::getDBH()->prepare($query);
        $statement->bindValue(':login', $login);
        $statement->bindValue(':password', $password);
        try {
            $statement->execute();
            $row = $statement->fetch();
            if (!empty($row)) {

                self::setSession('logedin', date("H:i:s"), 'global');
                self::setSession('uid', $row['sy_id'], 'global');
                self::setSession('uname', $row['name'], 'global');
                self::setSession('post', $row['post'], 'global');
                self::obtainPrivelegy();

                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function obtainPrivelegy()
    {
        if (System::getSession('logedin', 'global') !== null) {
            $post_id = System::getSession('post', 'global');
            $query = "SELECT `name`, `components` FROM `sys_posts` p WHERE p.`active` = 1 and p.`sy_deleted` = 0 and p.`sy_id` = ?";
            $statement = self::getDBH()->prepare($query);
            try {
                $statement->execute([$post_id]);
                $row = $statement->fetch();
                if (!empty($row)) {
                    self::setSession('upost', $row['name'], 'global');
                    self::setSession('upostcomponents', $row['components'], 'global');
                    self::componentsObtain();

                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function componentsObtain()
    {
        $resultArr = [];
        $components = self::getSession('upostcomponents', 'global');
        $componentsArr = explode(' ', $components);
        foreach ($componentsArr as $component) {
            if (stripos($component, '-') === false) {
                $resultArr[$component] = 0;
            } else {
                $componentDev = explode('-', $component);
                $resultArr[$componentDev[0]] = $componentDev[1];
            }
        }
        self::setSession('obtainedComponents', $resultArr, 'global');
    }

    public static function errcap($tx, $w)
    {
        $tg = ($w == 'r') ? 'label label-important' : 'label label-success';
        echo '<div id="err_div2"><span class="' . $tg . '">' . $tx . '</span></div>';
    }

    public static function getMenuLine($action)
    {
        $list = self::getControlListById(0);
        $result = '';
        if ($list !== null) {
            foreach ($list as $row) {
                if ((stripos(System::getSession('upostcomponents', 'global'), $row['url']) !== false)) {
                    $list2 = self::getControlListById($row['id']);
                    if ($list2 !== null) {
                        $result2 = '';
                        foreach ($list2 as $row2) {
                            if ((stripos(System::getSession('upostcomponents', 'global'), $row2['url']) !== false)) {
                                if (System::getSession('BlockMenu', 'global') == 1) {
                                    $_class = ($row2['url'] == $action) ? 'class="active"' : '';
                                    $result2 .= '<li ' . $_class . '><a href="#" class="ci_menu_blocked">' . $row2['name'] . '</a></li>';
                                } else {
                                    $_class = ($row2['url'] == $action) ? 'class="active"' : '';
                                    $result2 .= '<li ' . $_class . '><a href="?control=' . $row2['url'] . '">' . $row2['name'] . '</a></li>';
                                }
                            }
                        }
                        if ($result2 != '') {
                            $result2 = '<ul class="dropdown-menu">' . $result2 . '</ul>';
                            $_class = ($row['url'] == $action) ? 'active' : '';
                            $result .= '<li class="dropdown ' . $_class . '"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">' . $row['name'] . ' <b class="caret"></b></a>' . $result2 . '</li>';
                        } else {
                            if (System::getSession('BlockMenu', 'global') == 1) {
                                $_class = ($row['url'] == $action) ? 'class="active"' : '';
                                $result .= '<li ' . $_class . '><a href="#" class="ci_menu_blocked">' . $row['name'] . '</a></li>';
                            } else {
                                $_class = ($row['url'] == $action) ? 'class="active"' : '';
                                $result .= '<li ' . $_class . '><a href="?control=' . $row['url'] . '">' . $row['name'] . '</a></li>';
                            }
                        }
                    } else {
                        if (System::getSession('BlockMenu', 'global') == 1) {
                            $_class = ($row['url'] == $action) ? 'class="active"' : '';
                            $result .= '<li ' . $_class . '><a href="#" class="ci_menu_blocked">' . $row['name'] . '</a></li>';
                        } else {
                            $_class = ($row['url'] == $action) ? 'class="active"' : '';
                            $result .= '<li ' . $_class . '><a href="?control=' . $row['url'] . '">' . $row['name'] . '</a></li>';
                        }
                    }
                }
            }
        }

        return $result;
    }

    public static function getHomeMenuLine()
    {
        return '<li><a href="http://www.itt.tj/">ITT.TJ</a></li>';
    }

    public static function getTemplate($key)
    {
        $q = "SELECT `templ` FROM `tbl_GLOB_templates` where `name`=? and `deleted`=0 limit 0,  1;";
        $statement = self::getDBH()->prepare($q);
        try {
            $statement->execute([$key]);
            $row = $statement->fetch();

            return $row[0];
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getStorage($key)
    {
        $q = "SELECT `value` FROM `tbl_GLOB_storage` where `name`=? limit 0,1;";
        $statement = self::getDBH()->prepare($q);
        try {
            $statement->execute([$key]);
            $row = $statement->fetch();

            return $row[0];
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function saveStorage($key, $value)
    {
        $q = "UPDATE `tbl_GLOB_storage` SET `value` = '" . $value . "' where `name`='$key' limit 1;";
        $res = mysql_query($q);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public static function prepareControl($get)
    {
        if (isset($get['control']) && $get['control'] != '') {
            System::setSession('control', trim($get['control']), 'global');
        } else {
            if (System::getSession('control', 'global') == null) {
                System::setSession('control', 'homepage', 'global');
            }
        }
    }

    public static function editCheckedItem($control, $id, $operating = true)
    {
        $x = System::getSession('checkedArray', $control);
        if (empty($x)) {
            $checkedArray = [];
        } else {
            $checkedArray = System::getSession('checkedArray', $control);
        }
        if ($operating) {
            array_push($checkedArray, $id);
        } else {
            $newCheckedArray = [];
            foreach ($checkedArray as $item) {
                if ($id != $item) {
                    $newCheckedArray[] = $item;
                }
            }
            $checkedArray = $newCheckedArray;
        }

        return System::setSession('checkedArray', $checkedArray, $control);
    }

    public static function checkCheckedItem($control, $id)
    {
        $x = System::getSession('checkedArray', $control);
        if (!empty($x)) {
            $checkedArray = System::getSession('checkedArray', $control);

            return in_array($id, $checkedArray);
        } else {
            return false;
        }
    }

    private static function getControlListById($id)
    {
        $dbh = Connector::getInstance()->getPDO();
        $query = "SELECT `id`, `pid`, `name`, `url`, `position`, `help`, `active` FROM `sys_control` where (`url`!='help' and `url`!='exit' and `url`!='wellcome') and `deleted`=0 and `pid` = ? order by `position` ASC;";
        $statement = $dbh->prepare($query);
        try {
            $statement->execute([$id]);

            return $statement->fetchAll();
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getImageExtension($type)
    {
        switch ($type) {
            case "image/jpeg":
                return "jpg";
                break;
            case "2":
                return "";
                break;
            case "3":
                return "";
                break;
            case "4":
                return "";
                break;
            case "5":
                return "";
                break;
            default:
                return "img";
                break;
        }
    }

    public static function reDate($date)
    {
        $sDate = new \DateTime($date);
        $date = $sDate->format("d/m/Y");
        $sDate = null;

        return $date;
    }
}