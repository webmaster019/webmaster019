<?php
/**
 * Cette classe contient toutes les requete possible a la base des donnés
 * les information de configuration ses trouve dans le fichier .env se trouvent dans le repertoir config
 * et accessible dans la variable $_ENV
 *
 * @author :webmaster019
 * @contact:+243972673616
 * @email:kingbestd030@gmail.com
 **/

class Database
{
    private $host =null;
    private $username=null;
    private $password =null;
    private $database= null;
    private $db;
    private $offset=9;

    public function __construct(){

        try{
            $this->host=$_ENV["host_local"];
            $this->username=$_ENV['username_local'];
            $this->password= $_ENV['password_local'];
            $this->database=$_ENV['database_local'];

            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database,$this->username,$this->password, array(
                PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8',
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING

            ));
            $_ENV["db"]=$this->db;
        }
        catch (PDOException $e){
            die("Impossible d'acceder aux données");


        }

    }
    /*
     * Methode principale de requete 
     */
    /**
     * @param string $sql
     * @param array $data
     * @return array|false
     */
    public function select(string $sql ,array $data =array()){
        $req=$this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);

    }

    /**
     * @param string $sql
     * @param array $data
     * @return false|PDOStatement
     */
    public function insert(string $sql ,array $data =array()){
        $req=$this->db->prepare($sql);
        $req->execute($data);
        return $req;

    }

    /**
     * @param string $sql
     * @param array $data
     * @return false|PDOStatement
     */
    public function delete(string $sql ,array $data =array()){
        $req=$this->db->prepare($sql);
        $req->execute($data);
        return $req;

    }

    /**
     * @param string $sql
     * @param array $data
     * @return false|PDOStatement
     */
    public function update(string $sql , array $data =array()){
        $req=$this->db->prepare($sql);
        $req->execute($data);
        return $req;

    }

    /**
     * exemple requete de la base des donnees
     * entre vos requetes ici
     */







}
