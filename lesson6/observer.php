<?php

class Subject implements \SplSubject
{
    private $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function attach(\SplObserver $observer) : void
    {
        echo "Subject: Attached an observer</br>";
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer) : void
    {
        $this->observers->detach($observer);
        echo "Subject: Detached an observer.</br>";
    }

    public function notify() : void
    {
        echo "Subject: Notifying observers...</br>";
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getData() : void
    {
        echo "Subject: Receive data</br>";
    }
}

class ObserverA implements \SplObserver
{
    public function __construct($name, $email, $experience)
    {
        $this->name = $name;
        $this->email = $email;
        $this->experience = $experience;
    }

    public function update(\SplSubject $subject) : void
    {
        echo __CLASS__ . ": Reacted to the event: " . $this->name . ", you have new message" . "</br>";
    }
}

class ObserverB implements \SplObserver
{
    public function __construct($name, $email, $experience)
    {
        $this->name = $name;
        $this->email = $email;
        $this->experience = $experience;
    }

    public function update(\SplSubject $subject) : void
    {
        echo __CLASS__ . ": Reacted to the event: " . $this->name . ", you have new message" . "</br>";
    }
}

$subject = new Subject();

$observerA = new ObserverA('Kate', 'kate@ya.ru', '1 year');
$subject->attach($observerA);

$observerB = new ObserverB('Ivan', 'gavr@ya.ru', '3 years');
$subject->attach($observerB);

$subject->getData();

$subject->detach($observerB);

$subject->notify();
