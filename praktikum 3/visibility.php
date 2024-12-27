<?php

//visibility.php

class visibility{

    public $public = 'public';
    private $private = 'private';
    protected $protected = 'protected';

    function tampilkanData(){
        echo "Akses didalam kelas <br>";
        echo "Public :" . $this->public . "<br>";
        echo "Private :" . $this->private . "<br>";
        echo "Protected :" . $this->protected . "<br>";
    }

}