<?php

require_once('./app/models/User.php');
require_once('./app/models/Address.php');
require_once('./app/models/Order.php');
require_once('./app/models/Order_Detail.php');
require_once('./app/models/Rating.php');
require_once('./app/models/Book.php');
class Customer
{
    public function account()
    {
        if (isset($_SESSION['id'])) {
            $orders = Order::getByUserID($_SESSION['id']);
            $ratings = Rating::getByUserID($_SESSION['id']);
            require("./app/views/user/customer/account.php");
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function accountEdit()
    {
        if (isset($_SESSION['id'])) {
            $user = User::getByID($_SESSION['id']);
            require("./app/views/user/customer/account_edit.php");
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function accountEditPost()
    {
        if (isset($_SESSION['id'])) {
            User::updateInformation(
                $_SESSION['id'],
                $_POST['name'],
                $_POST['phone_number'],
                $_POST['gender'],
                $_POST['birthday']
            );
            $_SESSION['name'] = $_POST['name'];
            header("Location:" . $_ENV['DOMAIN'] . "/customer/account/edit");
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function accountUpdatePaswword()
    {
        if (
            isset($_SESSION['id']) &&
            $_POST['password'] == $_POST['confirmation'] &&
            User::checkPassword($_POST['current_password'])
        ) {
            User::updatePassword($_SESSION['id'], $_POST['password']);
            header("Location:" . $_ENV['DOMAIN'] . "/customer/account/edit");
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function address()
    {
        if (isset($_SESSION['id'])) {
            $addresses = Address::getByUserID($_SESSION['id']);
            require("./app/views/user/customer/address.php");
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function addressNew()
    {
        if (isset($_SESSION['id'])) {
            require("./app/views/user/customer/address_new.php");
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function addressNewPost()
    {
        if (isset($_SESSION['id'])) {
            Address::store(
                $_POST['name'],
                $_POST['phone_number'],
                $_POST['address'],
                $_POST['city'],
                $_POST['district'],
                $_POST['ward'],
                isset($_POST['default']) ? 1 : 0,
            );
            header("Location:" . $_ENV['DOMAIN'] . "/customer/address");
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function addressEdit($id)
    {
        if (isset($_SESSION['id'])) {
            $address = Address::getByID($id);
            if ($address['user_id'] == $_SESSION['id']) {
                require("./app/views/user/customer/address_edit.php");
            } else {
                header("Location:" . $_ENV['DOMAIN'] . "/");
            }
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function addressEditPost($id)
    {
        if (isset($_SESSION['id'])) {
            Address::update(
                $id,
                $_POST['name'],
                $_POST['phone_number'],
                $_POST['address'],
                $_POST['city'],
                $_POST['district'],
                $_POST['ward'],
                isset($_POST['default']) ? 1 : 0,
            );
            header("Location:" . $_ENV['DOMAIN'] . "/customer/address");
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function addressDelete($id)
    {
        if (isset($_SESSION['id'])) {
            Address::destroy($id);
            header("Location:" . $_ENV['DOMAIN'] . "/customer/address");
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function rating()
    {
        if (isset($_SESSION['id'])) {
            $ratings = Rating::getByUserID($_SESSION['id']);
            require('./app/views/user/customer/rating.php');
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function order()
    {
        if (isset($_SESSION['id'])) {
            $orders = Order::getByUserID($_SESSION['id']);
            require('./app/views/user/customer/order.php');
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }

    public function orderDetail($id)
    {
        if (isset($_SESSION['id'])) {
            $order = Order::getByID($id);

            if ($order['user_id'] == $_SESSION['id']) {
                $order_details = Order_Detail::getByOrderID($id);

                $order_quantity = 0;

                foreach ($order_details as $order_detail) {
                    $order_quantity += $order_detail['quantity'];
                }

                require('./app/views/user/customer/order_detail.php');
            } else {
                header("Location:" . $_ENV['DOMAIN'] . "/");
            }
        } else {
            header("Location:" . $_ENV['DOMAIN'] . "/");
        }
    }
}
