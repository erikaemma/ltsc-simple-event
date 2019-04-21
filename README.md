# Simple Event Library

## Usage

### normal

```php
$event = LTSC\Event\Event::getInstance();
$event->on('click', function($msg) {
    echo $msg;
});
$event->trigger('click', 'Hello');
```

### events with order

```php
$events = LTSC\Event\Events::getInstance();
$events->add('click', 99, function($msg) {
    echo "My order is 99, argument is $msg";
});
$event->emit('click', 'Hello');
```

### events like plugins

```php

$events = LTSC\Event\CustomEvents::getInstance(
    new \LTSC\Event\Helper\CEConfigure(
        Parent_Class::class,
        'call_method',
        ['arguments_for_construct']
    )
);
$list = $events->getEventList(); //all event names which allowed is add here
$list->add('click', 0); //max events for click, 0 is no limit
$events->addEvents('click', MyEvents::class);
$events->call('click', 'Hello');

```