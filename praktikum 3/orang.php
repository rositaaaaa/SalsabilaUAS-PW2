<?php
    class Orang{
        public $nama;

        public function __construct($nama)
        {
            $this->nama = $nama;
        }
        public function ucapSalam(){
            echo "Halo nama saya" . $this->nama . "<br>";
        }
    }

?>