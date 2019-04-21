<?php


namespace LTSC\Event\Helper;


use LTSC\Event\Exception\CEHelperException;

final class CEStruct
{
    private $file = '';
    private $class = '';

    public function __construct($file = null, $class = null) {
        if(!is_null($file))
            $this->setFile($file);
        if(!is_null($file) && !is_null($class))
            $this->setClass($class);
    }

    public function setFile(string $file) {
        if(file_exists($file))
            $this->file = $file;
        else
            throw new CEHelperException('CEStruct setFile', "$file not exists", 'NULL');
    }

    public function getFile() :string {
        return $this->file;
    }

    public function setClass($class) {
        require_once $this->file;
        if(class_exists($class))
            $this->class = $class;
        else
            throw new CEHelperException('CEStruct setClass', "$class not exists", 'NULL');
    }

    public function getClass() {
        return $this->class;
    }
}