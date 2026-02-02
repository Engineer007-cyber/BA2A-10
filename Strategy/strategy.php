<?php

interface PaymentStrategy {
    public function pay($amount);
}

class CreditCardPayment implements PaymentStrategy {
    private $cardNumber;

    public function __construct($cardNumber) {
        $this->cardNumber = $cardNumber;
    }

    public function pay($amount) {
        echo "Paid \${$amount} using Credit Card ({$this->cardNumber}).\n";
    }
}

class PayPalPayment implements PaymentStrategy {
    private $email;

    public function __construct($email) {
        $this->email = $email;
    }

    public function pay($amount) {
        echo "Paid \${$amount} using PayPal account ({$this->email}).\n";
    }
}

class ShoppingCart {
    private $amount;
    private $paymentStrategy;

    public function __construct($amount) {
        $this->amount = $amount;
    }

    public function setPaymentStrategy(PaymentStrategy $paymentStrategy) {
        $this->paymentStrategy = $paymentStrategy;
    }

    public function checkout() {
        if ($this->paymentStrategy === null) {
            echo "Error: No payment strategy set.\n";
            return;
        }
        $this->paymentStrategy->pay($this->amount);
    }
}

$cart = new ShoppingCart(150.75);

$cart->setPaymentStrategy(new CreditCardPayment("1234-5678-9012-3456"));
$cart->checkout();

echo "--------------------------------------------------\n";

$cart->setPaymentStrategy(new PayPalPayment("user@example.com"));
$cart->checkout();

?>