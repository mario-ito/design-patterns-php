<?php

interface ProductInterface
{
	public function getPrice(): float;

	public function getDiscount(): float;
}

// Concrete Products
class KeyboardProduct implements ProductInterface {

	public function getPrice(): float {
		return 40.20;
	}

	public function getDiscount(): float {
		return 0.05;
	}
}

class NotebookProduct implements ProductInterface {

	public function getPrice(): float {
		return 480;
	}

	public function getDiscount(): float {
		return 0;
	}
}

/**
 * Factory Class
 */
class ProductFactory {
	/**
	 * @throws Exception
	 */
	public static function createProduct(string $product): ProductInterface {
		return match ( $product ) {
			'keyboard' => new KeyboardProduct(),
			'notebook' => new NotebookProduct(),
			default => throw new Exception( 'Product not found' ),
		};
	}
}

// Client code
try {
	$notebook = ProductFactory::createProduct( 'notebook' );
	$keyboard = ProductFactory::createProduct( 'keyboard' );

	echo "<pre>";
	echo "Notebook price is {$notebook->getPrice()} with {$notebook->getDiscount()}% discount\n";
	echo "Keyboard price is {$keyboard->getPrice()} with {$keyboard->getDiscount()}% discount";
} catch ( Exception $e ) {
	echo "Error - Invalid product: " . $e->getMessage();
}
