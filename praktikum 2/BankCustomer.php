<?php

class BankCustomer{
    private $customerName;
    private string $address;
    private string $email;
    private string $card;
    protected string $acc;

    // consttruktor
    public function _construct(){
        $this->email= "ini_email_default_@gmail.com";
    }

    // destruct
    public function _destruct()
        {
            echo "koneksi sudah selesai";
        }
    
    public function setCustomerName($customerName){
        $this->customerName = $customerName;
    }

    public function setAddress($address){
        $this->address = $address;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setCard($card){
        $this->card = $card;
    }

    public function setAcc($acc){
        $this->acc = $acc;
    }

    public function insertCard(){
        echo "kartu dimasukkan : <br>";
        echo "nama customer: " . $this->customerName . '<br>';
        echo "alamat :" . $this->address . '<br>';
        echo "email :" . $this->email . '<br>';
        echo "card :" . $this->card . '<br>';
        echo "acc :" . $this->acc . '<br>';
    }

    public function selectTransaction(){

    }

    public function enterPIN(int $number){
        echo "PIN telah di enter: " . $number;
    }

    public function changePIN(){

    }

    public function withDrawCash(){

    }


    public function requestTransactionSummary(){

    }

    public function acceptAmount(){

    }
}
?>