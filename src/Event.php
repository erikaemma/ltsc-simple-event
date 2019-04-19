<?php


namespace LTSC\Event;


use \RuntimeException;

final class Event
{
    static private $_instance = null;

    private function __construct() {}

    static public function getInstance() {
        if(is_null(self::$_instance))
            self::$_instance = new Event();
        return self::$_instance;
    }

    private $events = [];

    public function on(string $event, callable $handle) {
        $this->events[$event] = $handle;
    }

    public function trigger(string $event, $arguments = null) {
        if(key_exists($event, $this->events)) {
            if(!is_array($arguments))
                $arguments = [$arguments];
            return call_user_func_array($this->events[$event], $arguments);
        } else {
            throw new RuntimeException("trigger, $event is not exists");
        }
    }
}