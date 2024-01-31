<?php


class Dashboard
{

    public function index()
    {
        session_start();
        if(!$_SESSION['logged']){
            header("Location: " . URL . "login");
            exit();
        }
        require 'application/models/book.php';
        $books = Book::fetchBooks();
        require 'application/views/templates/header.php';
        require 'application/views/templates/nav.php';
        require 'application/views/dashboard/index.php';
        require 'application/views/templates/footer.php';
    }
}
