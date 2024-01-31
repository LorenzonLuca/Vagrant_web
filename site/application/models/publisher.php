<?php

class Publisher
{
    private $id;
    private $name;
    private $country;
    private $year;

    public function __construct($obj)
    {
        $this->id = $obj->id;
        $this->name = $obj->name;
        $this->country = $obj->country;
        $this->year = $obj->foundation_year;
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
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }


    public static function getPublisher($id){
        $statement = 'SELECT * FROM publisher WHERE id = :id;';
        $result = DB_CONNECTION->prepare($statement);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $publisher = $result->fetch(PDO::FETCH_OBJ);

        $p = new Publisher($publisher);

        return $p;
    }
    public static function fetchPublishers(){
        $statement = 'SELECT * FROM publisher;';
        $result = DB_CONNECTION->prepare($statement);
        $result->execute();
        $publishers = $result->fetchAll(PDO::FETCH_OBJ);

        $all = array();

        foreach ($publishers as $p){
            $all[] = new Publisher($p);
        }

        return $all;
    }
    public static function createPublisher($name, $country, $year){
        $statement = 'INSERT INTO publisher (name, country, foundation_year) VALUES (:name, :country, :year)';
        $result = DB_CONNECTION->prepare($statement);
        $result->bindParam(":name", $name, PDO::PARAM_STR);
        $result->bindParam(":country", $country, PDO::PARAM_STR);
        $result->bindParam(":year", $year, PDO::PARAM_INT);
        $result->execute();

        $publisher_id = DB_CONNECTION->lastInsertId();
        $publisher = self::getPublisher($publisher_id);

        return $publisher;
    }
}