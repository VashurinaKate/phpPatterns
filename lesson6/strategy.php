<?php

class Checkout
{
    private $checkout;

    public function __construct(Strategy $checkout)
    {
        $this->checkout = $checkout;
    }

    public function setStrategy(Strategy $checkout)
    {
        $this->checkout = $checkout;
    }

    public function doSomeBusinessLogic() : void
    {
        echo "Checkout: makes payment<br>";
        $sum = 1230;
        $phone = '89211856088';
        $result = $this->checkout->pay($sum, $phone);
        echo $result;
    }
}

interface Strategy
{
    public function pay(int $sum, string $phone) : string;
}

class Qiwi implements Strategy
{
    public function pay(int $sum, string $phone) : string
    {
        return "The response from Qiwi payment system";
    }
}

class Yandex implements Strategy
{
    public function pay(int $sum, string $phone) : string
    {
        return "The response from Yandex payment system";
    }
}

class WebMoney implements Strategy
{
    public function pay(int $sum, string $phone) : string
    {
        return "The response from WebMoney payment system";
    }
}

$checkout = new Checkout(new Qiwi());
echo "Client: Strategy is set</br>";
$checkout->doSomeBusinessLogic();

echo "<hr>";

echo "Client: Strategy is set</br>";
$checkout->setStrategy(new Yandex());
$checkout->doSomeBusinessLogic();

echo "<hr>";

echo "Client: Strategy is set</br>";
$checkout->setStrategy(new WebMoney());
$checkout->doSomeBusinessLogic();
