<?php
namespace components\guest;

use lib\BaseManager;
use lib\Connector;
use lib\System;
use \PDOException;

class GuestManager extends BaseManager
{

    public function getList()
    {
        $dbh = Connector::getInstance()->getPDO();
        $query = "SELECT `fID`, `fNameTaj`, `fNameRus` FROM `tbl_res_oblast` WHERE `sy_deleted` = 0 ";

        $order = '';
        $orderField = System::getSession('orderField', $this->currentControl());
        $orderDirection = System::getSession('orderDirection', $this->currentControl());
        if ($orderField !== null and $orderDirection !== null and $orderDirection != 0 ) {
            $order = ($orderDirection==1)?'ASC':'';
            $order = ($orderDirection==2)?'DESC':'';
            $query .= " ORDER BY " . $orderField . " " . $order . ";";
        } else {
            $query .= " ORDER BY `fID` ASC;";
        }

        $statement = $dbh->prepare($query);
        try {
            $statement->execute();
            return $statement->fetchAll();
        }catch(PDOException $e){
            return null;
        }
    }

    public function getById($id)
    {
        $dbh = Connector::getInstance()->getPDO();
        $query = "SELECT `fID`, `fNameTaj`, `fNameRus` FROM `tbl_res_oblast` WHERE `sy_deleted` = 0 and `fID` = ? ;";
        $statement = $dbh->prepare($query);
        try {
            if ($statement->execute([$id]))
                return $statement->fetch();
            else
                return null; //$statement->errorInfo();
        }catch(PDOException $e){
            return null; //$e->getMessage();
        }
    }

    public function insert($dataArray)
    {
        $dbh = Connector::getInstance()->getPDO();
        // (`id`, `pid`, `name`, `email`, `message`, `date`, `moderated`, `deleted`)
        $query = "INSERT INTO `tbl_messages`  VALUES (NULL, '0', :name, :email, :message, CURRENT_TIMESTAMP, '1', '0');";
        $statement = $dbh->prepare($query);
        foreach ($dataArray as $key=>$value) {
            $statement->bindValue(":" . $key,$value);
        }
        try {
            if ($statement->execute())
                return true;
            else
                return $statement->errorInfo();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function update($id, $dataArray)
    {
        $dbh = Connector::getInstance()->getPDO();
        $query = "UPDATE  `tbl_res_oblast` SET  `fNameTaj` = :name_tj,
`fNameRus` = :name_ru WHERE `tbl_res_oblast`.`fID` = :id;";
        $statement = $dbh->prepare($query);
        $statement->bindValue(":name_tj",$dataArray['name_tj']);
        $statement->bindValue(":name_ru",$dataArray['name_ru']);
        $statement->bindValue(":id",$id);
        try {
            if ($statement->execute())
                return true;
            else
                return $statement->errorInfo();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function remove($id)
    {
        $dbh = Connector::getInstance()->getPDO();
        $query = "UPDATE `tbl_res_oblast` SET `sy_deleted` = 1  WHERE `fID` = ?;";
        $statement = $dbh->prepare($query);
        try {
            if ($statement->execute([$id]))
                return true;
            else
                return $statement->errorInfo();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getMessageCount()
    {
        $dbh = Connector::getInstance()->getPDO();
        $query = "SELECT COUNT(`id`) AS CNT FROM `tbl_messages` WHERE `deleted` = 0  and `moderated` = 1";
        $statement = $dbh->prepare($query);
        try {
            if ($statement->execute())
                return $statement->fetch();
            else
                return $statement->errorInfo();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getMessageList(
            $page   =   1,
            $onPage =   10,
            $pid    =   0,
            $moderate   =   1,
            $includeAnswers = false
        )
    {
        $dbh = Connector::getInstance()->getPDO();
        $query = "SELECT m0.`id`, m0.`pid`, m0.`name`, m0.`email`, m0.`message`, m0.`date`, m0.`moderated`, (SELECT COUNT(m1.`id`) FROM `tbl_messages` m1 WHERE m1.`deleted` = 0 and m1.`moderated` = 1 and m1.`pid` = m0.`id`) AS ANSWCNT FROM `tbl_messages` m0 WHERE m0.`deleted` = 0 and m0.`moderated` = 1 and m0.`pid` = :pid ORDER BY m0.`date` DESC LIMIT " . (($page>0) ? (($page-1) * $onPage) : 0) . "," . $onPage . " ;";
        $statement = $dbh->prepare($query);
        $statement->bindValue(":pid",$pid);
        try {
            if ($statement->execute())
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            else
                return $statement->errorInfo();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }



}
