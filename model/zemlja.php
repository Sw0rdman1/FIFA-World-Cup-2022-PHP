<?php

class Zemlja
{
    public $id;
    public $naziv;

    public function __construct($id = null, $naziv = null)
    {
        $this->id = $id;
        $this->naziv = $naziv;
    }

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM Zemlja";
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM zemlja WHERE idZemlje = $id";
        return $conn->query($query);
    }

    public static function getByName($name, mysqli $conn)
    {
        $query = "SELECT * FROM zemlja WHERE naziv ='$name'";
        return $conn->query($query);
    }
}
