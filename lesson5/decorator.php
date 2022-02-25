<?php

interface Component
{
    public function send(string $message) : string;
}

class Notifier implements Component
{
    public function send($message) : string
    {
        return "Notifier ".$message;
    }
}

class Decorator implements Component
{
    protected $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function send($message) : string
    {
        return $this->component->send($message);
    }
}

class EmailNotifier extends Decorator
{
    public function send($message) : string
    {
        return "EmailNotifier(" . parent::send($message) . ")";
    }
}

class SlackNotifier extends Decorator
{
    public function send($message) : string
    {
        return "SlackNotifier(" . parent::send($message) . ")";
    }
}

function clientCode(Component $component)
{
    $message = "MESSAGE";
    echo "RESULT: " . $component->send($message);
}

$simple = new Notifier();
echo "Client: I've got a simple component:</br>";
clientCode($simple);
echo "<hr>";

$decorator1 = new EmailNotifier($simple);
$decorator2 = new SlackNotifier($decorator1);
echo "Client: Now I've got a decorated component:\n";
clientCode($decorator2);
