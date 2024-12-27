<?php

require_once "OrangBiasa.php";

class OrangInggris extends Orang{

    // Override
    public function ucapSalam()
    {
        echo "Hello my name is " . $this->nama . "<br>";
    }
}