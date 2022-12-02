<?php
require_once('./app/models/Book.php');
require_once('./app/models/Publisher.php');
require_once('./app/models/Supplier.php');
class Admin
{
    public function index()
    {
        if (isset($_SESSION['level']) && $_SESSION['level'] == 0) {
            require("./app/views/admin/index.php");
        } else {
            header("Location:/Fahasa/");
        }
    }

    public function books()
    {
        if (isset($_SESSION['level']) && $_SESSION['level'] == 0) {
            $books = Book::getAll();
            $publishers = Publisher::getAll();
            $suppliers = Supplier::getAll();
            require("./app/views/admin/book/index.php");
        } else {
            header("Location:/Fahasa/");
        }
    }
}