<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Event.php';


class TestEvents extends \PHPUnit\Framework\TestCase
{
    public function testEventsEmit() {
        $events = \LTSC\Event\Events::getInstance();
        $events->add('load', 99, function(){
            echo "Loading icons...\n";
            return true;
        });
        $events->add('load', 1, function(){
            echo "Loading caches...\n";
            return false;
        });
        $events->add('load', 25, function($file){
            echo "Loading $file...\n";
            return $file;
        });
        $result = $events->emit('load', "data");
        $this->assertSame([99 => true, 25 => 'data', 1 => false], $result);

        return $events;
    }

    /**
     * @depends testEventsEmit
     */
    public function testEventsCount(\LTSC\Event\Events $events) {
        $this->assertEquals(1, $events->counts());
        $this->assertEquals(3, $events->counts('load'));
    }

    /**
     * @depends testEventsEmit
     */
    public function testEventsRemove(\LTSC\Event\Events $events) {
        $events->remove('load', 25);
        $this->assertEquals(2, $events->counts('load'));
        $events->remove('load');
        $this->assertEquals(0, $events->counts());
    }
}