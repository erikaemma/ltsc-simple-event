<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Event.php';


class TestEvent extends \PHPUnit\Framework\TestCase
{
    public function testEventTrigger() {
        $event = \LTSC\Event\Event::getInstance();
        $event->on('click', function($msg){
            return $msg;
        });
        $msg = "Click Here.\n";
        $this->assertEquals($msg, $event->trigger('click', [$msg]));
        return $event;
    }

    /**
     * @depends testEventTrigger
     */
    public function testCounts(\LTSC\Event\Event $event) {
        $this->assertEquals(1, $event->counts());
    }

    /**
     * @depends testEventTrigger
     */
    public function testRemove(\LTSC\Event\Event $event) {
        $event->remove('click');
        $this->assertEquals(0, $event->counts());
        $this->assertEquals(false, $event->exists('click'));
    }
}