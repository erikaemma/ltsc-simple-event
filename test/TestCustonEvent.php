<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Event.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'customs' . DIRECTORY_SEPARATOR . 'Plugin.php';


class TestCustonEvent extends \PHPUnit\Framework\TestCase
{
    public function testCustom() {
        $events = \LTSC\Event\CustomEvent::getInstance(new \LTSC\Event\Helper\CEConfigure(
            \Test\Customs\Plugin::class,
            'run',
            []
        ));
        $list = $events->getEventList();
        $list->add('load', 2);
        $events->addEvents('load', new \LTSC\Event\Helper\CEStruct(__DIR__ . DIRECTORY_SEPARATOR . 'customs' . DIRECTORY_SEPARATOR . 'SayHello.php', \Test\Customs\SayHello::class));
        $events->addEvents('load', new \LTSC\Event\Helper\CEStruct(__DIR__ . DIRECTORY_SEPARATOR . 'customs' . DIRECTORY_SEPARATOR . 'SayHello.php', \Test\Customs\SayHello::class));
        //$events->addEvents('load', new \LTSC\Event\Helper\CEStruct(__DIR__ . DIRECTORY_SEPARATOR . 'customs' . DIRECTORY_SEPARATOR . 'SayHello.php', \Test\Customs\SayHello::class));
        $events->call('load', 'HELLO');
    }
}