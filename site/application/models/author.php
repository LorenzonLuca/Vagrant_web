<?php

class Author
{
    private $id;
    private $name;
    private $surname;
    private $year;

    public function __construct($obj)
    {
        $this->id = $obj->id;
        $this->name = $obj->name;
        $this->surname = $obj->surname;
        $this->year = $obj->birth_year;
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    public function getFullName(){
        return $this->name." ".$this->surname;
    }

    public static function getAuthor($id){
        $statement = 'SELECT * FROM author WHERE id = :id;';
        $result = DB_CONNECTION->prepare($statement);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $author = $result->fetch(PDO::FETCH_OBJ);

        $a = new Author($author);

        return $a;
    }
    public static function fetchAuthors(){
        $statement = 'SELECT * FROM author;';
        $result = DB_CONNECTION->prepare($statement);
        $result->execute();
        $authors = $result->fetchAll(PDO::FETCH_OBJ);

        $all = array();

        foreach ($authors as $a){
            $all[] = new Author($a);
        }

        return $all;
    }
    public static function createAuthor($name, $surname, $year){
        $statement = 'INSERT INTO author (name, surname, birth_year) VALUES (:name, :surname, :year);';
        $result = DB_CONNECTION->prepare($statement);
        $result->bindParam(":name", $name, PDO::PARAM_STR);
        $result->bindParam(":surname", $surname, PDO::PARAM_STR);
        $result->bindParam(":year", $year, PDO::PARAM_INT);
        $result->execute();

        $author_id = DB_CONNECTION->lastInsertId();
        $author = self::getAuthor($author_id);

        return $author;
    }
}