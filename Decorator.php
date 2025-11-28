<?php

interface ProductInterface {
    public function getPrice(): float;
    public function getDescription(): string;
}

class BasicProduct implements ProductInterface {
    public function getPrice(): float {
        return 50.00;
    }

    public function getDescription(): string {
        return "Basic Product";
    }
}

/**
 * The Base Decorator 
 */
abstract class ProductDecorator implements ProductInterface {
    protected ProductInterface $product;

    public function __construct(ProductInterface $product) {
        $this->product = $product;
    }

    public function getPrice(): float {
        return $this->product->getPrice();
    }

    public function getDescription(): string {
        return $this->product->getDescription();
    }
}

/**
 * Concrete Decorators
 */
class GiftWrapDecorator extends ProductDecorator {
    private float $wrapCost = 5.00;

    public function getPrice(): float {
        return $this->product->getPrice() + $this->wrapCost;
    }

    public function getDescription(): string {
        return $this->product->getDescription() . " + Gift Wrap";
    }
}

class ExpressDeliveryDecorator extends ProductDecorator {
    private float $deliveryCost = 10.00;

    public function getPrice(): float {
        return $this->product->getPrice() + $this->deliveryCost;
    }

    public function getDescription(): string {
        return $this->product->getDescription() . " + Express Delivery";
    }
}

// Client Code
echo "Client: I've got a simple product component:\n";
$simple = new BasicProduct();
echo "Description: " . $simple->getDescription() . "\n";
echo "Price: $" . $simple->getPrice() . "\n\n";

echo "Client: Now I've got a decorated component (Gift Wrapped):\n";
$giftWrapped = new GiftWrapDecorator($simple);
echo "Description: " . $giftWrapped->getDescription() . "\n";
echo "Price: $" . $giftWrapped->getPrice() . "\n\n";

echo "Client: Now I've got a double decorated component (Gift Wrapped + Express Delivery):\n";
$fullyDecorated = new ExpressDeliveryDecorator($giftWrapped);
echo "Description: " . $fullyDecorated->getDescription() . "\n";
echo "Price: $" . $fullyDecorated->getPrice() . "\n";
