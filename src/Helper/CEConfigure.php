<?php


namespace LTSC\Event\Helper;


class CEConfigure
{
    public $parentClass = null;
    public $callMethod = '';
    public $constructArgs = [];

    public function __construct($parentClass, string $callMethod, array $constructArgs) {
        $this->parentClass = $parentClass;
        $this->callMethod = $callMethod;
        $this->constructArgs = $constructArgs;
    }


}