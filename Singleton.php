<?php

/**
 * Singleton Class
 */
class Singleton {
	// Hold the single instance of the class
	private static ?Singleton $instance = null;

	// Private constructor to prevent direct instantiation
	private function __construct() {}

	public static function getInstance(): Singleton {
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	// Example method
	public function doSomething() {
		echo "Doing something...\n";
	}
}


// Usage
$singleton1 = Singleton::getInstance();
$singleton2 = Singleton::getInstance();

$singleton1->doSomething();

// Verify that both variables hold the same instance
var_dump($singleton1 === $singleton2); // bool(true)