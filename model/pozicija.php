<?php

class Pozicija
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
        $query = "SELECT * FROM pozicija";
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM pozicija WHERE idPozicija = $id";
        return $conn->query($query);
    }

    public static function getByName($name, mysqli $conn)
    {
        $query = "SELECT * FROM pozicija WHERE naziv ='$name'";
        return $conn->query($query);
    }
}
