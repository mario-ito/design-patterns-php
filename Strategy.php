<?php

/**
 * Strategy Interface: Contract that defines the methods all it's implementations should have
 */
interface ProductInterface {
	public function getPrice(): float;

	public function getDiscount(): float;
}

// Concrete Strategies
class Keyboard implements ProductInterface {

	public function getPrice(): float {
		return 40.20;
	}

	public function getDiscount(): float {
		return 0.05;
	}
}

class Notebook implements ProductInterface {

	public function getPrice(): float {
		return 480;
	}

	public function getDiscount(): float {
		return 0;
	}
}

// Context class
class Product {
	private ProductInterface $productInterface;

	public function __construct(ProductInterface $productInterface) {
		$this->productInterface = $productInterface;
	}

	public function setProduct(ProductInterface $productInterface): void {
		$this->productInterface = $productInterface;
	}

	public function getProductPrice(): float {
		return $this->productInterface->getPrice();
	}

	public function getProductDiscount(): float {
		return $this->productInterface->getDiscount() * 100;
	}
}

$product = new Product(new Notebook());
$notebook_price = $product->getProductPrice();
$notebook_discount = $product->getProductDiscount();

$product->setProduct(new Keyboard());
$keyboard_price = $product->getProductPrice();
$keyboard_discount = $product->getProductDiscount();

echo "<pre>";
echo "Notebook price is {$notebook_price} with {$notebook_discount}% discount\n";
echo "Keyboard price is {$keyboard_price} with {$keyboard_discount}% discount";
