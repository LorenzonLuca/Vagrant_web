<?php
class Management
{
    public function index(){
        session_start();
        if ($_SESSION['is_admin']){
            require_once 'application/models/author.php';
            require_once 'application/models/publisher.php';
            $authors = Author::fetchAuthors();
            $publishers = Publisher::fetchPublishers();

            require 'application/views/templates/header.php';
            require 'application/views/templates/nav.php';
            require 'application/views/management/index.php';
            require 'application/views/templates/footer.php';
        }else{
            header('location: /dashboard');
        }

    }

    public function create(){
        $this->openPage();
    }

    public function createBook(){
        require_once 'application/models/author.php';
        require_once 'application/models/publisher.php';
        require_once 'application/models/book.php';
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["title"]) && !empty($_POST["title"])){
                $title = $this->testInput($_POST["title"]);
            }else{
                $this->openPage("Please insert all values");
                return;
            }
            if(isset($_POST["summary"]) && !empty($_POST["summary"])){
                $summary = $this->testInput($_POST["summary"]);
            }else{
                $this->openPage("Please insert all values");
                return;
            }
            if(isset($_POST["isbn"]) && !empty($_POST["isbn"])){
                $isbn = $this->testInput($_POST["isbn"]);
            }else{
                $this->openPage("Please insert all values");
                return;
            }
            if(isset($_POST["release-year"]) && !empty($_POST["release-year"])){
                $releaseYear = $this->testInput($_POST["release-year"]);
            }else{
                $this->openPage("Please insert all values");
                return;
            }
            if(isset($_POST["price"]) && !empty($_POST["price"])){
                $price = $this->testInput($_POST["price"]);
            }else{
                $this->openPage("Please insert all values");
                return;
            }
            if(isset($_POST["copies"]) && !empty($_POST["copies"])){
                $copies = $this->testInput($_POST["copies"]);
            }else{
                $this->openPage("Please insert all values");
                return;
            }
            if(isset($_POST["authors"]) && !empty($_POST["authors"])){
                $author_id  = $this->testInput($_POST["authors"]);
                if($author_id == -1){
                    if(isset($_POST["author-name"]) && !empty($_POST["author-name"])){
                        $author_name = $this->testInput($_POST["author-name"]);
                    }else{
                        $this->openPage("Please insert author values or select an existing author");
                        return;
                    }
                    if(isset($_POST["author-surname"]) && !empty($_POST["author-surname"])){
                        $author_surname = $this->testInput($_POST["author-surname"]);
                    }else{
                        $this->openPage("Please insert author values or select an existing author");
                        return;
                    }
                    if(isset($_POST["author-year"]) && !empty($_POST["author-year"])){
                        $author_year = $this->testInput($_POST["author-year"]);
                    }else{
                        $this->openPage("Please insert author values or select an existing author");
                        return;
                    }
                    $author = Author::createAuthor($author_name, $author_surname, $author_year);
                }else{
                    $author = Author::getAuthor($author_id);
                }
            }else{
                $this->openPage("Please insert all values");
                return;
            }
            if(isset($_POST["publishers"]) && !empty($_POST["publishers"])){
                $publisher_id  = $this->testInput($_POST["publishers"]);
                if($publisher_id == -1){
                    if(isset($_POST["publisher-name"]) && !empty($_POST["publisher-name"])){
                        $publisher_name = $this->testInput($_POST["publisher-name"]);
                    }else{
                        $this->openPage("Please insert author values or select an existing publisher");
                        return;
                    }
                    if(isset($_POST["publisher-country"]) && !empty($_POST["publisher-country"])){
                        $publisher_country = $this->testInput($_POST["publisher-country"]);
                    }else{
                        $this->openPage("Please insert author values or select an existing publisher");
                        return;
                    }
                    if(isset($_POST["publisher-year"]) && !empty($_POST["publisher-year"])){
                        $publisher_year = $this->testInput($_POST["publisher-year"]);
                    }else{
                        $this->openPage("Please insert author values or select an existing publisher");
                        return;
                    }
                    $publisher = Publisher::createPublisher($publisher_name, $publisher_country, $publisher_year);
                }else{
                    $publisher = Publisher::getPublisher($publisher_id);
                }
            }else{
                $this->openPage("Please insert all values");
                return;
            }

            if(isset($_FILES["cover-image"]) && !empty($_FILES["cover-image"])){
                $imagetemp = $_FILES['cover-image']['tmp_name'];
                $imagename = $this->guidv4();

                Book::createBook($title, $summary, $releaseYear, $isbn, $price, $imagename, $copies, $author->getId(), $publisher->getId());
                $imagePath = "application/img/";


                if(is_uploaded_file($imagetemp)) {
                    if(!move_uploaded_file($imagetemp, $imagePath . $imagename)) {
                        $this->openPage("Error while upload the image");
                    }
                }
                else {
                    $this->openPage("Error while upload the image");
                }
            }
            $this->openPage(null,"All OK");
        }
    }

    public function edit($id){
        session_start();
        if(!$_SESSION['is_admin']){
            header("Location: " . URL . "login");
            exit();
        }
        require_once 'application/models/author.php';
        require_once 'application/models/publisher.php';
        require_once 'application/models/book.php';
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["title"]) && !empty($_POST["title"])){
                $title = $this->testInput($_POST["title"]);
            }else{
                $this->openPageEdit($id,"Please insert all values");
                return;
            }
            if(isset($_POST["summary"]) && !empty($_POST["summary"])){
                $summary = $this->testInput($_POST["summary"]);
            }else{
                $this->openPageEdit($id,"Please insert all values");
                return;
            }
            if(isset($_POST["isbn"]) && !empty($_POST["isbn"])){
                $isbn = $this->testInput($_POST["isbn"]);
            }else{
                $this->openPageEdit($id,"Please insert all values");
                return;
            }
            if(isset($_POST["release-year"]) && !empty($_POST["release-year"])){
                $releaseYear = $this->testInput($_POST["release-year"]);
            }else{
                $this->openPageEdit($id,"Please insert all values");
                return;
            }
            if(isset($_POST["price"]) && !empty($_POST["price"])){
                $price = $this->testInput($_POST["price"]);
            }else{
                $this->openPageEdit($id,"Please insert all values");
                return;
            }
            if(isset($_POST["copies"]) && !empty($_POST["copies"])){
                $copies = $this->testInput($_POST["copies"]);
            }else{
                $this->openPageEdit($id,"Please insert all values");
                return;
            }
            if(isset($_POST["authors"]) && !empty($_POST["authors"])){
                $author_id  = $this->testInput($_POST["authors"]);
                if($author_id == -1){
                    if(isset($_POST["author-name"]) && !empty($_POST["author-name"])){
                        $author_name = $this->testInput($_POST["author-name"]);
                    }else{
                        $this->openPageEdit($id,"Please insert author values or select an existing author");
                        return;
                    }
                    if(isset($_POST["author-surname"]) && !empty($_POST["author-surname"])){
                        $author_surname = $this->testInput($_POST["author-surname"]);
                    }else{
                        $this->openPageEdit($id,"Please insert author values or select an existing author");
                        return;
                    }
                    if(isset($_POST["author-year"]) && !empty($_POST["author-year"])){
                        $author_year = $this->testInput($_POST["author-year"]);
                    }else{
                        $this->openPageEdit($id,"Please insert author values or select an existing author");
                        return;
                    }
                    $author = Author::createAuthor($author_name, $author_surname, $author_year);
                }else{
                    $author = Author::getAuthor($author_id);
                }
            }else{
                $this->openPageEdit($id,"Please insert all values");
                return;
            }
            if(isset($_POST["publishers"]) && !empty($_POST["publishers"])){
                $publisher_id  = $this->testInput($_POST["publishers"]);
                if($publisher_id == -1){
                    if(isset($_POST["publisher-name"]) && !empty($_POST["publisher-name"])){
                        $publisher_name = $this->testInput($_POST["publisher-name"]);
                    }else{
                        $this->openPageEdit($id,"Please insert author values or select an existing publisher");
                        return;
                    }
                    if(isset($_POST["publisher-country"]) && !empty($_POST["publisher-country"])){
                        $publisher_country = $this->testInput($_POST["publisher-country"]);
                    }else{
                        $this->openPageEdit($id,"Please insert author values or select an existing publisher");
                        return;
                    }
                    if(isset($_POST["publisher-year"]) && !empty($_POST["publisher-year"])){
                        $publisher_year = $this->testInput($_POST["publisher-year"]);
                    }else{
                        $this->openPageEdit($id,"Please insert author values or select an existing publisher");
                        return;
                    }
                    $publisher = Publisher::createPublisher($publisher_name, $publisher_country, $publisher_year);
                }else{
                    $publisher = Publisher::getPublisher($publisher_id);
                }
            }else{
                $this->openPageEdit($id,"Please insert all values");
                return;
            }

            if(isset($_FILES["cover-image"]) && !empty($_FILES["cover-image"])){
                $imagetemp = $_FILES['cover-image']['tmp_name'];
                if(!empty($imagetemp)){
                    $imagename = $this->guidv4();

                    $imagePath = "application/img/";

                    $book = Book::getBook($id);
                    if(file_exists($imagePath.$book->getCoverImage())){
                        unlink($imagePath.$book->getCoverImage());
                    }
                    $book->editBook($title, $summary, $releaseYear, $isbn, $price, $imagename, $copies, $author->getId(), $publisher->getId());

                    if(is_uploaded_file($imagetemp)) {
                        if(!move_uploaded_file($imagetemp, $imagePath . $imagename)) {
                            $this->openPageEdit($id,"Error while upload the image");
                        }
                    }
                    else {
                        $this->openPageEdit($id,"Error while upload the image");
                    }
                }else{
                    $book = Book::getBook($id);
                    $imagename = $book->getCoverImage();
                    $book->editBook($title, $summary, $releaseYear, $isbn, $price, $imagename, $copies, $author->getId(), $publisher->getId());
                }

            }
            if(!headers_sent()){
                header('location: /dashboard');
                exit();
            }
        }
    }

    private function openPage($error = null, $created = null){
        require_once 'application/models/author.php';
        require_once 'application/models/publisher.php';
        $authors = Author::fetchAuthors();
        $publishers = Publisher::fetchPublishers();

        session_start();
        require 'application/views/templates/header.php';
        require 'application/views/templates/nav.php';
        require 'application/views/management/index.php';
        require 'application/views/templates/footer.php';
    }

    private function openPageEdit($id, $error = null, $created = null){
        require_once 'application/models/author.php';
        require_once 'application/models/publisher.php';
        require_once 'application/models/book.php';
        $authors = Author::fetchAuthors();
        $publishers = Publisher::fetchPublishers();
        $book = Book::getBook($id);

        require 'application/views/templates/header.php';
        require 'application/views/templates/nav.php';
        require 'application/views/book/edit.php';
        require 'application/views/templates/footer.php';
    }

    private function testInput($value){
        $value = trim($value);
        $value = stripcslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }

    function guidv4($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}