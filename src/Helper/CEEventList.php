<?php


namespace LTSC\Event\Helper;


use LTSC\Event\Exception\CEHelperException;

final class CEEventList
{
    private $list = [];

    public function add(string $eventName, int $max = 0) {
        if(key_exists($eventName, $this->list))
            throw new CEHelperException('CEEventList add', "$eventName already exists", '');
        $this->list[$eventName] = $max;
    }

    public function set(string $eventName, int $max) {
        if(!key_exists($eventName, $this->list))
            throw new CEHelperException('CEEventList set', "$eventName not exists", '');
        $this->list[$eventName] = $max;
    }

    public function get(string $eventName) {
        if(!key_exists($eventName, $this->list))
            throw new CEHelperException('CEEventList get', "$eventName not exists", '');
        return $this->list[$eventName];
    }

    public function has(string $eventName, bool $needThrow = false, string $where = '') {
        $result = key_exists($eventName, $this->list);
        if($result) {
            return true;
        } else {
            if($needThrow)
                throw new CEHelperException("$where has", "\$needThrow=false and the $eventName not exists", '');
            else
                return false;
        }
    }

    public function remove(string $eventName) {
        if(!key_exists($eventName, $this->list))
            throw new CEHelperException('CEEventList remove', "$eventName not exists", '');
        unset($this->list[$eventName]);
    }
}