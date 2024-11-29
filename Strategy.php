<?php
/**
 * Strategy Interface: Contract that defines the methods all it's implementations should have
 */
interface ProductStrategy {
	public function getPrice(): float;

	public function getDiscount(): float;
}

// Concrete Strategies
class Keyboard implements ProductStrategy {

	public function getPrice(): float {
		return 40.20;
	}

	public function getDiscount(): float {
		return 0.05;
	}
}

class Notebook implements ProductStrategy {

	public function getPrice(): float {
		return 480;
	}

	public function getDiscount(): float {
		return 0;
	}
}

// Context class
class Product {
	private ProductStrategy $productStrategy;

	public function __construct(ProductStrategy $productInterface) {
		$this->productStrategy = $productInterface;
	}

	public function setProduct(ProductStrategy $productInterface): void {
		$this->productStrategy = $productInterface;
	}

	public function getProductPrice(): float {
		return $this->productStrategy->getPrice();
	}

	public function getProductDiscount(): float {
		return $this->productStrategy->getDiscount() * 100;
	}
}

// Client code
$product = new Product(new Notebook());
$notebook_price = $product->getProductPrice();
$notebook_discount = $product->getProductDiscount();

$product->setProduct(new Keyboard());
$keyboard_price = $product->getProductPrice();
$keyboard_discount = $product->getProductDiscount();

echo "<pre>";
echo "Notebook price is {$notebook_price} with {$notebook_discount}% discount\n";
echo "Keyboard price is {$keyboard_price} with {$keyboard_discount}% discount";
