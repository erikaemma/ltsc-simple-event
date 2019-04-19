<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Event.php';


class TestEvent extends \PHPUnit\Framework\TestCase
{
    public function testLtscEvent() {
        $event = \LTSC\Event\Event::getInstance();
        $event->on('click', function($msg){
            return $msg;
        });
        $msg = "Click Here.\n";
        $this->assertEquals($msg, $event->trigger('click', [$msg]));
    }
}