<?php

class Product {
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly float $price
    ) {}
}

class ProductRepository {
  
  /**
   * @param int $id
   * @return Product|null
   */  
  public function findById(int $id): ?Product {
    // fetch from database
  }

  /**
   * @return Product[]\
   */
  public function findAll(): array {
    // fetch from database
  }

  /**
   * @param Product $product
   * @return void
   */
  public function save(Product $product): void {
    // save to database
  }
}

// Creating and saving a product
$product = new Product(1, 'Notebook', 3500);
$productRepository = new ProductRepository();
$productRepository->save($product);

// Fetching a single product
$product = $productRepository->findById(1);
echo $product->name;

// Fetching all products
$products = $productRepository->findAll();
foreach ($products as $product) {
    echo $product->name;
}

