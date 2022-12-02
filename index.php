<?php
require_once('core/router.php');

$conn = mysqli_connect("localhost", "root", "", "Fahasa");
mysqli_set_charset($conn, 'utf8');
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


$router = new Router();

// Home
$router->add("", ['controller' => 'Home', 'action' => 'index']);
$router->add('product/{id:\d+}', ['controller' => 'Home', 'action' => 'product']);
$router->add('category', ['controller' => 'Home', 'action' => 'category']);

// Cart
$router->add('checkout/cart', ['controller' => 'CartController', 'action' => 'index']);
$router->add('cart/addtocart', ['controller' => 'CartController', 'action' => 'addToCart']);
$router->add('cart/check', ['controller' => 'CartController', 'action' => 'toggleCheckBook']);
$router->add('cart/checkall', ['controller' => 'CartController', 'action' => 'checkAll']);
$router->add('cart/add', ['controller' => 'CartController', 'action' => 'addQuantity']);
$router->add('cart/subtract', ['controller' => 'CartController', 'action' => 'subtractQuantity']);
$router->add('cart/delete', ['controller' => 'CartController', 'action' => 'deleteItem']);

// Checkout
$router->add('onestepcheckout', ['controller' => 'CartController', 'action' => 'checkout']);
$router->add('checkout/confirm', ['controller' => 'CartController', 'action' => 'confirm']);
// Login

$router->add('login', ['controller' => 'Login', 'action' => 'index']);
$router->add('login/login_process', ['controller' => 'Login', 'action' => 'login']);
$router->add('login/logout_process', ['controller' => 'Login', 'action' => 'logout']);

// Customer
$router->add('customer/account', ['controller' => 'Customer', 'action' => 'account']);
$router->add('customer/account/edit', ['controller' => 'Customer', 'action' => 'accountEdit']);
$router->add('customer/account/editPost', ['controller' => 'Customer', 'action' => 'accountEditPost']);
$router->add('customer/account/updatePassword', ['controller' => 'Customer', 'action' => 'accountUpdatePaswword']);

$router->add('customer/address', ['controller' => 'Customer', 'action' => 'address']);
$router->add('customer/address/new', ['controller' => 'Customer', 'action' => 'addressNew']);
$router->add('customer/address/newPost', ['controller' => 'Customer', 'action' => 'addressNewPost']);
$router->add('customer/address/edit/{id:\d+}', ['controller' => 'Customer', 'action' => 'addressEdit']);
$router->add('customer/address/editPost/{id:\d+}', ['controller' => 'Customer', 'action' => 'addressEditPost']);
$router->add('customer/address/delete/{id:\d+}', ['controller' => 'Customer', 'action' => 'addressDelete']);
// Rating
$router->add('product/rating', ['controller' => 'Home', 'action' => 'rating']);

// Admin
$router->add('dashboard', ['controller' => 'Admin', 'action' => 'index']);
$router->add('dashboard/books', ['controller' => 'Admin', 'action' => 'books']);
$router->add('dashboard/books/store', ['controller' => 'BookController', 'action' => 'store']);
$router->add('dashboard/books/update/{id:\d+}', ['controller' => 'BookController', 'action' => 'update']);
$router->add('dashboard/books/destroy/{id:\d+}', ['controller' => 'BookController', 'action' => 'destroy']);

$router->dispatch($_SERVER['QUERY_STRING']);
