<?php
namespace homepage;

use lib\Connector;
use \PDOException;

class HomepageManager
{
    // object instance
    protected static $instance;

    public function getList()
    {
        $dbh = Connector::getInstance()->getPDO();
        $query = "SELECT `id`, `name`, `url`, `help` FROM `sys_control` WHERE `active`=1 AND `deleted`=0 ORDER BY `position` ASC;";

        $statement = $dbh->prepare($query);
        try {
            $statement->execute();
            return $statement->fetchAll();
        }catch(PDOException $e){
            return null;
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    private function __construct(){ /* ... @return Singleton */ }
    private function __clone()    { /* ... @return Singleton */ }
    private function __wakeup()   { /* ... @return Singleton */ }

}
