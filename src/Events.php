<?php


namespace LTSC\Event;


use \RuntimeException;

final class Events
{
    static private $_instance = null;

    private function __construct() {}

    static public function getInstance() {
        if(is_null(self::$_instance))
            self::$_instance = new Events();
        return self::$_instance;
    }

    private $events = [];

    public function add(string $name, int $order, callable $handle) {
        if(key_exists($name, $this->events) && key_exists($order, $this->events[$name]))
            throw new RuntimeException("Add $name, the order $order is repetitive.");
        $this->events[$name][$order] = $handle;
    }

    public function remove(string $name, int $order = null) {
        if(is_null($order)) {
            if(key_exists($name, $this->events))
                unset($this->events[$name]);
        } else {
            if(key_exists($name, $this->events) && key_exists($order, $this->events[$name]))
                unset($this->events[$name][$order]);
        }
    }

    public function counts(string $name = null) {
        if(is_null($name)) {
            return count($this->events);
        } else {
            if(key_exists($name, $this->events))
                return count($this->events[$name]);
            else
                return 0;
        }
    }

    public function emit(string $name, ...$args) {
        //$args = func_get_args();
        if(key_exists($name, $this->events)) {
            $result = [];
            $handles = $this->events[$name];
            krsort($handles);
            foreach($handles as $order => $handle)
                $result[$order] = call_user_func_array($handle, $args);
            return $result;
        } else {
            return false;
        }
    }
}