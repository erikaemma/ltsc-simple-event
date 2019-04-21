<?php


namespace LTSC\Event\Helper;


use LTSC\Event\Exception\CEHelperException;

final class CEEvents
{
    private $list = [];

    public function add(string $event, CEStruct $handle) {
        $this->list[$event][] = $handle;
    }

    public function count(string $event) {
        if(key_exists($event, $this->list))
            return count($this->list[$event]);
        return 0;
    }

    public function get(string $event) :array {
        if(key_exists($event, $this->list))
            return $this->list[$event];
        throw new CEHelperException('CEEvents get', "$event not exists", '');
    }
}