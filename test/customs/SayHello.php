<?php


namespace Test\Customs;


class SayHello extends Plugin
{
    public function __construct()
    {
    }

    public function run(string $title) {
        echo "SayHello: $title\n";
    }
}