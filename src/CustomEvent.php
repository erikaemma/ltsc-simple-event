<?php


namespace LTSC\Event;


use LTSC\Event\Exception\CEHelperException;
use LTSC\Event\Exception\CustomEventException;
use LTSC\Event\Helper\CEConfigure;
use LTSC\Event\Helper\CEEventList;
use LTSC\Event\Helper\CEEvents;
use LTSC\Event\Helper\CEStruct;
use Test\Customs\Plugin;

final class CustomEvent
{
    static private $_instance = null;

    private function __construct(CEConfigure $configure) {
        $this->configure = $configure;
        $this->list = new CEEventList();
        $this->events = new CEEvents();
    }

    static public function getInstance(CEConfigure $configure) :CustomEvent {
        if(is_null($configure))
            throw new CustomEventException('Construct', 'it is null', 'must set');
        if(is_null(self::$_instance))
            self::$_instance = new CustomEvent($configure);
        return self::$_instance;
    }

    /**
     * @var CEConfigure
     */
    private $configure = null;

    /**
     * @var CEEventList
     */
    private $list = null;

    /**
     * @var CEEvents
     */
    private $events = null;

    public function getEventList() :CEEventList {
        return $this->list;
    }

    public function addEvents(string $event, CEStruct $handle) {
        $this->list->has($event, true, 'addEvents');
        if($this->list->get($event) != 0 && $this->events->count($event) >= $this->list->get($event))
            throw new CEHelperException('addEvent', "full at $event", "max is {$this->list->get($event)}");
        $this->events->add($event, $handle);
    }

    public function call(string $event, ...$args) {
        $this->list->has($event, true, 'call');
        $events = $this->events->get($event);
        /** @var $e CEStruct */
        foreach($events as $e) {
            require_once $e->getFile();

            $classname = $e->getClass();
            $refClass = new \ReflectionClass($classname);
            if(is_null($refClass->getConstructor())) {
                $object = $refClass->newInstance();
            } else {
                $cargs = $this->configure->constructArgs;
                $object = $refClass->newInstanceArgs(is_string($cargs) ? [$cargs] : $cargs);
            }

            $instance = $this->configure->parentClass;
            if(!is_null($instance)) {
                if(!($object instanceof $instance))
                    throw new CustomEventException('call', "$classname is not valid", "$classname must instance of $instance");
            }

            if($refClass->hasMethod($this->configure->callMethod))
                ($refClass->getMethod($this->configure->callMethod))->invokeArgs($object, $args);
            else
                throw new CustomEventException('call', "{$this->configure->callMethod} not exists in $classname", "NULL");
        }
    }
}