<?php
    include "Orang.php";

    class Mahasiswa extends Orang{
        public $nim;
        public $prodi;

        public function getNilaiSemester(){

        }
    }


    class MahasiswaAsing extends Mahasiswa{

        // override
        public function ucapSalam(){
            echo "Hello My Name" . $this->nama;
        }
    }

?>