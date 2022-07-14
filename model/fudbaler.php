<?php

class Fudbaler
{
    public $id;
    public $ime;
    public $prezime;
    public $brojDresa;
    public $pozicija;
    public $zemlja;


    public function __construct($id = null, $ime = null, $prezime = null, $brojDresa =null, $pozicija = null, $zemlja = null)
    {
        $this->id = $id;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->brojDresa = $brojDresa;
        $this->pozicija = $pozicija;
        $this->zemlja = $zemlja;
    }

    public static function add($fudbaler, mysqli $conn)
    {
        $query = 
        "INSERT INTO fudbaler (Ime,Prezime,BrojDresa,Pozicija,Zemlja) VALUES 
        ('$fudbaler->ime','$fudbaler->prezime',$fudbaler->brojDresa,$fudbaler->pozicija,$fudbaler->zemlja)";
        return $conn->query($query);
    }

    public static function update($fudbaler, mysqli $conn)
    {
        $query = 
        "UPDATE fudbaler 
        SET ime = '$fudbaler->ime', prezime = '$fudbaler->prezime',
        brojDresa = $fudbaler->brojDresa, zemlja = $fudbaler->zemlja,
        pozicija = $fudbaler->pozicija  WHERE idFudbaler = $fudbaler->id";
        return $conn->query($query);
    }

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM fudbaler";
        return $conn->query($query);
    }

    public static function getByPosition($positionName, $conn)
    {
        $position = Pozicija::getByName($positionName, $conn)->fetch_array();
        $idPosition = $position['idPosition'];
        $query = "SELECT * FROM fudbaler WHERE Position = $idPosition";
        return $conn->query($query);
    }

    public  function delete($conn)
    {
        $query = "DELETE FROM fudbaler WHERE idFudbaler = $this->id";
        return $conn->query($query);
    }
}
