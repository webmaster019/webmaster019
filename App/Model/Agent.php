<?php

/**
 * Class Agent
 * @author :webmaster019
 * @contact:+243972673616
 * @email:kingbestd030@gmail.com
 */
class Agent
{
    private $DB;
    public function __construct(Database $db)
    {
        $this->DB=$db;

    }

    public  function pass_cript($pass)
    {

        $key=$_ENV['secret'];
        $arg=md5(sha1($key));
        if (!empty($pass)){
            return sha1($key.$pass.$arg);
        }else return false;

    }

    /**
     * @param string $nomUtilisateur
     * @param string $postNomUtilisateur
     * @param string $roleUtilisateur
     * @param string $login
     * @param string $motDePass
     * @return bool|object
     * @throws Exception
     */
    public function Add_User( string $nomUtilisateur,string $postNomUtilisateur,string $roleUtilisateur,string $login,string $motDePass)
    {
        if (!empty($nomUtilisateur) && !empty($postNomUtilisateur) && !empty($roleUtilisateur) && !empty($login) && !empty($motDePass)) {
            return  $this->DB->Add_User($nomUtilisateur,$postNomUtilisateur,$roleUtilisateur,$login,$this->pass_cript($motDePass));

        }else return false;
    }
    public function Edit_User(int $idUtilisateur,string $nomUtilisateur,string $postNomUtilisateur,string $roleUtilisateur,string $login)
    {
        if (!empty($nomUtilisateur) && !empty($postNomUtilisateur) && !empty($roleUtilisateur) && !empty($login) && !empty($idUtilisateur)) {
            return $this->DB->Edit_User( $idUtilisateur, $nomUtilisateur, $postNomUtilisateur, $roleUtilisateur, $login);

        }else return false;
    }

    /**
     * @return false|object
     */
    public function getAllUsers()
    {
        return $this->DB->getAllUsers();

    }

    /**
     * @param string $login
     * @return false|object
     */
    public function verif_user_by_login(string $login)
    {
        if (!empty($login)){
            return $this->DB->verif_user_by_login($login);
        }else return false;

    }

    /**
     * @param int $idUtilisateur
     * @return false|object
     */
    public function verif_user_by_id(int $idUtilisateur)
    {
        if (!empty($idUtilisateur)) {
            return $this->DB->verif_user_by_id( $idUtilisateur);

        }else return false;
    }

    /**
     * @param string $login
     * @param string $password
     * @return false|object
     */

    public function loginUser(string $login,string $password)
    {
        if (!empty($login) && !empty($password)) {
            return  $this->DB->loginUser($login,$this->pass_cript($password));

        } else return false;
    }


}

