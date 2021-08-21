<?php


class Validation
{
    public function ValidatePhone($phone)
    {
        if ($phone){
            if (preg_match("^\+(?:[0-9]?){6,14}[0-9]$^",$phone)){
                return true;
            }else return false;
        }else{
            return false;
        }

    }

    public function ValidateName($name)
    {
        if ($name){
            if (preg_match("/^[a-zéèçàëêôöîïûü\-\s']{3,}$/i",$name) && strlen($name)>=4){
                return true;

            }else return false;
            
        }return false;
        
    }
    public function ValidateEmail($email)
    {
        if ($email){
            if (filter_var($email, FILTER_VALIDATE_EMAIL)){
                return true;

            }else return false;

        }return false;


    }
    public function ValidateURL($Url)
    {
        if ($Url){
            if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$Url)){
                return true;

            }else return false;

        }return false;


    }

    public function ValidatePassword($password)
    {
        if ($password){
            if (strlen($password)>=6){
                return true;
            }else return false;
        }else return false;

    }

    public function getRoleAgent()
    {
        $r="Administrateur, gérant, Agent_commercial, Agent_Marketing , comptable, Agent_Ressouces_humaines, Agent_technique, Agent_d_approvisionnement";

    }

}