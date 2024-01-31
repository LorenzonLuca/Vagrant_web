<?php

class BookInfo
{
    public function book($id)
    {
        session_start();
        if(!$_SESSION['logged']){
            header("Location: " . URL . "login");
            exit();
        }
        require 'application/models/book.php';
        $book = Book::getBook($id);
        if(!$book){
            header("Location: " . URL . "dashboard");
        }
        require 'application/views/templates/header.php';
        require 'application/views/templates/nav.php';
        require 'application/views/book/index.php';
        require 'application/views/templates/footer.php';
    }
    public function update($id){
        session_start();
        if(!$_SESSION['logged']){
            header("Location: " . URL . "login");
            exit();
        }
        require 'application/models/book.php';
        $book = Book::getBook($id);
        if(!$book){
            header("Location: " . URL . "dashboard");
        }
        if(!isset($_POST['copies'])){
            exit();
        }
        $ordered = null;
        if(isset($_POST['ordered'])){
           $ordered = $_POST['ordered'] == 'on';
        }
        $book->editCopies($_POST['copies'], $ordered);
        header("Location: " . URL . "dashboard");
    }

    public function delete($id){
        session_start();
        if(!$_SESSION['logged']){
            header("Location: " . URL . "login");
            exit();
        }
        require 'application/models/book.php';
        $book = Book::getBook($id);
        if(!$book){
            header("Location: " . URL . "dashboard");
        }
        $book->removeBook();
        header("Location: " . URL . "dashboard");
    }

    public function edit($id){
        session_start();
        if(!$_SESSION['is_admin']){
            header("Location: " . URL . "login");
            exit();
        }
        require 'application/models/book.php';
        require_once 'application/models/author.php';
        require_once 'application/models/publisher.php';
        $book = Book::getBook($id);
        if(!$book){
            header("Location: " . URL . "dashboard");
        }
        $authors = Author::fetchAuthors();
        $publishers = Publisher::fetchPublishers();
        require 'application/views/templates/header.php';
        require 'application/views/templates/nav.php';
        require 'application/views/book/edit.php';
        require 'application/views/templates/footer.php';
    }
}