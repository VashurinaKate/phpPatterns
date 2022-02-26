<?php

interface Command
{
    public function execute($file) : void;
}

class Copy implements Command
{
    public function __construct(int $start, int $length)
    {
        $this->start = $start;
        $this->length = $length;
    }

    public function execute($file) : void
    {
        $content = $file->state[count($file->state) - 1];
        $file->buffer = mb_substr($content, $this->start, $this->length);
    }
}

class Paste implements Command
{
    public function __construct(int $place)
    {
        $this-> place = $place;
    }

    public function execute($file) : void
    {
        $content = $file->state[count($file->state) - 1];
        $newContent = substr_replace($content, $file->buffer, $this->place, 0);
        $file->state[] = $newContent;
    }
}

class Cut implements Command
{
    public function __construct(int $start, int $length)
    {
        $this->start = $start;
        $this->length = $length;
    }

    public function execute($file) : void
    {
        $content = $file->state[count($file->state) - 1];
        $cut = mb_substr($content, $this->start, $this->length);
        $file->buffer = $cut;
        $newContent = substr_replace($content, '', $this->start, $this->length);
        $file->state[] = $newContent;
    }
}

class Cancell implements Command
{
    public function execute($file) : void
    {
        array_pop($file->state);
    }
}

class Save implements Command
{
    public function execute($file) : void
    {
        file_put_contents($file->path, $file->state[count($file->state) - 1]);
    }
}

class MacrosoftWorld {
    public $path;
    public $text;
    public $state = [];
    public $buffer = '';

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->text = file_get_contents($path);
        $this->state[] = $this->text;
    }

    public function execute(Command $command) : void
    {
        $command->execute($this);
    }
}

$file = new MacrosoftWorld('file.txt');
$file->execute(new Copy(12, 26)); // dolor sit amet consectetur
$file->execute(new Paste(116));
print_r($file->state);

echo "<hr>";
$file->execute(new Cut(0, 17)); // Lorem ipsum dolor
print_r($file->state);

echo "<hr>";
$file->execute(new Cancell());
print_r($file->state);

echo "<hr>";
$file->execute(new Save());
print_r($file->state);
