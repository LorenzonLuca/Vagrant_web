<?php

class Book
{
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return mixed
     */
    public function getReleaseYear()
    {
        return $this->releaseYear;
    }

    /**
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getCoverImage()
    {
        return $this->coverImage;
    }

    /**
     * @return mixed
     */
    public function getCopies()
    {
        return $this->copies;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }
    /**
     * @return mixed
     */
    public function getOrdered()
    {
        return $this->ordered;
    }
    public function getStatus(){
        if($this->copies > 3){
            return 'Disponibile';
        }
        if($this->ordered){
            return 'In ordinazione';
        }
        return $this->copies == 0 ? 'Non disponibile' : 'Da ordinare';
    }
    private $id;
    private $title;
    private $summary;
    private $releaseYear;
    private $isbn;
    private $price;
    private $coverImage;
    private $copies;
    private $author;
    private $publisher;
    private $ordered;

    public function __construct($book)
    {
        require_once 'application/models/author.php';
        require_once 'application/models/publisher.php';
        $this->id = $book->id;
        $this->title = $book->title;
        $this->summary = $book->summary;
        $this->releaseYear = $book->release_year;
        $this->isbn = $book->ISBN;
        $this->price = $book->price;
        $this->coverImage = $book->cover_image;
        $this->copies = $book->copies;
        $this->ordered = $book->ordered == 1;
        $this->author = Author::getAuthor($book->author_id);
        $this->publisher = Publisher::getPublisher($book->publisher_id);
    }

    public static function addBook(){

    }
    public function removeBook(){
        $path = "application/img/".$this->getCoverImage();
        if(file_exists($path)){
            unlink($path);
        }

        $statement = 'DELETE FROM book WHERE id = :id';
        $result = DB_CONNECTION->prepare($statement);
        $id = $this->getId();
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->execute();
    }
    public function editBook($title, $summary, $year, $isbn, $price, $cover, $copies, $author_id, $publisher_id){
        $statement = 'UPDATE book SET title = :title,
                summary = :summary,
                release_year = :release_year,
                ISBN = :ISBN,
                price = :price,
                cover_image = :cover,
                copies = :copies,
                author_id = :author_id,
                publisher_id = :publisher_id
                WHERE id = :id';
        $result = DB_CONNECTION->prepare($statement);
        $id = $this->getId();
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->bindParam(":title", $title, PDO::PARAM_STR);
        $result->bindParam(":summary", $summary, PDO::PARAM_STR);
        $result->bindParam(":release_year", $year, PDO::PARAM_INT);
        $result->bindParam(":ISBN", $isbn, PDO::PARAM_STR);
        $result->bindParam(":price", $price, PDO::PARAM_STR);
        $result->bindParam(":cover", $cover, PDO::PARAM_STR);
        $result->bindParam(":copies", $copies, PDO::PARAM_INT);
        $result->bindParam(":author_id", $author_id, PDO::PARAM_INT);
        $result->bindParam(":publisher_id", $publisher_id, PDO::PARAM_INT);

        $result->execute();
    }
    public function editCopies($copies, $ordered = null){
        if(empty($copies) && $copies != "0"){
            exit();
        }
        $copies = intval($copies);

        $statement = 'UPDATE book SET copies = :copies, ordered = :ordered WHERE id = :id';
        if(is_null($ordered)){
            $statement = 'UPDATE book SET copies = :copies WHERE id = :id';
        }
        $result = DB_CONNECTION->prepare($statement);
        $id = $this->getId();
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->bindParam(":copies", $copies, PDO::PARAM_INT);

        if(!is_null($ordered)) {
            $ordered = $ordered ? 1 : 0;
            $result->bindParam(":ordered", $ordered, PDO::PARAM_INT);
        }
        $successful = $result->execute();
        if($successful){
            $this->copies = $copies;
        }
    }

    public static function fetchBooks(){
        $statement = 'SELECT * FROM book;';
        $result = DB_CONNECTION->prepare($statement);
        $result->execute();
        $books = $result->fetchAll(PDO::FETCH_OBJ);

        $all = array();

        foreach ($books as $b){
            $all[] = new Book($b);
        }

        return $all;
    }
    public static function getBook($id){
        $statement = 'SELECT * FROM book WHERE id = :id;';
        $result = DB_CONNECTION->prepare($statement);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->execute();
        $book = $result->fetch(PDO::FETCH_OBJ);
        $b = new Book($book);
        return $b;
    }
    public static function createBook($title, $summary, $year, $isbn, $price, $cover, $copies, $author_id, $publisher_id){
        $statement = 'INSERT INTO book (title, summary, release_year, ISBN, price, cover_image, copies, author_id, publisher_id) 
            VALUES (:title, :summary, :release_year, :ISBN, :price, :cover, :copies, :author_id, :publisher_id)';
        $result = DB_CONNECTION->prepare($statement);
        $result->bindParam(":title", $title, PDO::PARAM_STR);
        $result->bindParam(":summary", $summary, PDO::PARAM_STR);
        $result->bindParam(":release_year", $year, PDO::PARAM_INT);
        $result->bindParam(":ISBN", $isbn, PDO::PARAM_STR);
        $result->bindParam(":price", $price, PDO::PARAM_STR);
        $result->bindParam(":cover", $cover, PDO::PARAM_STR);
        $result->bindParam(":copies", $copies, PDO::PARAM_INT);
        $result->bindParam(":author_id", $author_id, PDO::PARAM_INT);
        $result->bindParam(":publisher_id", $publisher_id, PDO::PARAM_INT);
        $result->execute();
    }
}