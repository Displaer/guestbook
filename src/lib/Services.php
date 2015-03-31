<?php
namespace lib;

class Services
{
    protected static $instance;  // object instance
    private $services;
    private $serviceClasses;
    private function __construct()
    {
        $this->services = [];
        $this->serviceClasses = [
            'control_manager'=>'components\control\ControlManager'
        ];
    }
    private function __clone()    { /* ... @return Singleton */ }
    private function __wakeup()   { /* ... @return Singleton */ }


    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function get($service_name)
    {

        return $this->obtain($service_name);
    }

    private function obtain($service_name)
    {
        if (!isset($this->services[$service_name])) {
            $this->services[$service_name] = new $this->serviceClasses[$service_name]();
            return $this->services[$service_name];
        }

        return null;
    }


}
