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
    }
}