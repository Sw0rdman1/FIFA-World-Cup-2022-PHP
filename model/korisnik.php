<?php

class Korisnik
{
    public $username;
    public $password;
    public $imePrezime;

    public function __construct($username = null, $password = null, $imePrezime = null,)
    {
        $this->username = $username;
        $this->password = $password;
        $this->imePrezime = $imePrezime;
    }

    public  function prijaviSe(mysqli $conn)
    {
        $query = "SELECT * FROM korisnik WHERE username='$this->username' and password='$this->password'";
        return $conn->query($query);
    }
}
