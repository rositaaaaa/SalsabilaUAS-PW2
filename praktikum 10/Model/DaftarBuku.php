[13.25, 17/12/2024] Salsabila: <?php

class Database{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $databaseName = 'perpustakaan';
    private $koneksi;

    public function __construct(){
        $this->koneksi = new mysqli($this->host, $this->username, $this->password, $this->databaseName);
    }

    public function __destruct()
    {
        $this->koneksi->close();
    }

    public function getKoneksi(){
        return $this->koneksi;
    }
}
[13.26, 17/12/2024] Salsabila: <?php

class Buku{
    protected $id;
    protected $judul ;
    protected $pengarang ;
    protected $penerbit ;
    protected $tahun ;

    public function __construct($judul , $pengarang , $penerbit , $tahun )
    {

        $this->judul = $judul ;
        $this->pengarang = $pengarang ;
        $this->penerbit = $penerbit ;
        $this->tahun = $tahun ;
    }

    public function setId($id){
        $this->id = $id ;
        
    }
    public function getId(){
        return $this->id;
    }

    public function getJudul(){
        return $this->judul ;
    }

    public function getPengarang(){
        return $this->pengarang ;
    }

    public function getPenerbit(){
        return $this->penerbit ;
    }

    public function getTahun(){
        return $this->tahun ;
    }
}
[13.28, 17/12/2024] Salsabila: <?php

require_once "Buku.php";
require_once "Database/Database.php";

class DaftarBuku{

    private $koneksi;

    public function __construct()
    {
        $db = new Database();
        $this->koneksi = $db->getKoneksi();
    }

    public function getData(){
        $db = new Database();
        $koneksi =  $db->getKoneksi();
  
        $daftar_Buku = [];
  
        $sql = "SELECT * FROM buku";
        $query =$koneksi->query($sql);
  
        if ($query->num_rows  > 0 ){
          while ($row = $query->fetch_assoc()){
              $buku = new buku ($row['judul'], $row['pengarang'], $row['penerbit'], $row['tahun']);
              $buku->setId ($row ['id']);
              array_push ($daftar_Buku, $buku);
         }
        }
        
        return $daftar_Buku;
      } 
  
      public function getKolomTabel(){
          return array('No', 'Judul', 'Pengarang', 'Penerbit','Tahun');
      }

      public function simpan ($buku){
        $db = new Database();
        $koneksi = $db->getKoneksi();

        $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun)
        VALUES ('".$buku->getJudul()."', '".$buku->getPengarang()."', 
        '".$buku->getPenerbit()."', '".$buku->getTahun()."')";

        $query = $koneksi->query ($sql);
        return $query;
      }

        public function hapus ($id){
            $db = new database();
            $koneksi = $db->getKoneksi();
            $sql = "DELETE FROM  buku WHERE id = " . $id;
            
            $query = $koneksi->query($sql);

            return $query;
        }

        public function update ($buku){
            $db = new Database();
            $koneksi = $db->getKoneksi();

            $sql = "UPDATE buku SET judul = '". $buku->getJudul()."', 
            pengarang = '".$buku->getPengarang()."', penerbit  = '".
            $buku->getPenerbit()."', tahun = '". $buku->getTahun()."' 
            WHERE id ='" . $buku->getId(). "'";

            $query = $koneksi->query($sql);

            return $query;
        }

        public function getBukuById($id){
            $db = new Database();
            $koneksi = $db->getKoneksi();

            $sql = "SELECT * FROM buku WHERE id = " . $id;

        $query =  $koneksi->query($sql);

        if($query->num_rows > 0){
            $data  = $query->fetch_assoc();

            $buku = new Buku($data['judul'], $data['pengarang'], $data['penerbit'], $data['tahun']);
            $buku->setId($data['id']);

            return $buku;
        }

    return false;
    }
}