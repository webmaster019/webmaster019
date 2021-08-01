<?php
/**
 * Cette classe contient toutes les requete possible a la base des donnés
 * les information de conviguration ses trouve dans le fichier .env se trouvent dans le repertoir config
 * et accessible dans la variable $ENV
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
    public function select($sql , $data =array()){
        $req=$this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);

    }
    public function insert($sql , $data =array()){
        $req=$this->db->prepare($sql);
        $req->execute($data);
        return $req;

    }   public function delete($sql , $data =array()){
        $req=$this->db->prepare($sql);
        $req->execute($data);
        return $req;

    }
    public function update($sql , $data =array()){
        $req=$this->db->prepare($sql);
        $req->execute($data);
        return $req;

    }

    /**
     * @param int $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @param string $nomUtilisateur
     * @param string $postNomUtilisateur
     * @param string $roleUtilisateur
     * @param string $login
     * @param string $motDePass
     * @return bool
     */
    public function Add_User(string $nomUtilisateur,string $postNomUtilisateur,string $roleUtilisateur,string $login,string $motDePass)
    {
        if (!empty($nomUtilisateur) && !empty($postNomUtilisateur) && !empty($roleUtilisateur) && !empty($login) && !empty($motDePass)){
            $req=$this->insert("INSERT INTO Utilisateurs(nomUtilisateur,postNomUtilisateur,roleUtilisateur,login,motDePass) VALUES (:nomUtilisateur,:postNomUtilisateur,:roleUtilisateur,:login,:motDePass)",array(
                "nomUtilisateur"=>$nomUtilisateur,
                "postNomUtilisateur"=>$postNomUtilisateur,
                "roleUtilisateur"=>$roleUtilisateur,
                "login"=>$login,
                "motDePass"=>$motDePass
            ));
            if ($req){
                return true;
            }else return false;

        }else return false;
        
    }

    /**
     * @param $login
     * @return false|object
     */
    public function verif_user_by_login($login)
    {
        if (!empty($login)){
            $req=$this->select("SELECT * FROM Utilisateurs WHERE  login=:login",array(
                "login"=>$login
            ));
            if ($req){
                return $req[0];
            }else return false;
        }else return false;

    }

    /**
     * @param int $login
     * @param int $password
     * @return false|object
     */
    public function loginUser(string $login,string $password)
    {
        if (!empty($login) && !empty($password)){
                $req=$this->select("SELECT * FROM Utilisateurs WHERE  login=:login AND motDePass=:motDePass",array(
                    "login"=>$login,
                    "motDePass"=>$password
                ));
                if ($req){
                    return $req[0];
                }else return false;

        }else return false;

    }

    /**
     * @param int $idUtilisateur
     * @return bool
     */
    public function delete_user(int $idUtilisateur)
    {
        if ($idUtilisateur){
            $raq=$this->delete("DELETE FROM Utilisateurs WHERE idUtilisateur=:idUtilisateur ",array(
                "idUtilisateur"=>$idUtilisateur
            ));
            if ($raq){
                return true;
            }else return false;
        }else return false;


    }


    





}
