<?php


namespace LTSC\Event\Handle;


use Throwable;

abstract class ExceptionAbstract extends \RuntimeException
{
    private $what;
    private $why;

    public function __construct($what, $why, $message = "", $code = 0, Throwable $previous = null) {
        $this->what = $what;
        $this->why = $why;
        parent::__construct("$what happened, because $why, with message: $message.", $code, $previous);
    }

    public function getWhat() {
        return $this->what;
    }

    public function getWhy() {
        return $this->why;
    }


}