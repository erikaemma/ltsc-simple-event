# Simple Event Library

## Usage

```php
$event = LTSC\Event\Event::getInstance();
$event->on('click', function($msg) {
    echo $msg;
});
$event->trigger('click', 'Hello');
```