<?php

use \Firebase\JWT\JWT;

class JwtHandler {
    protected $jwt_secrect;
    protected $token;
    protected $issuedAt;
    protected $expire;
    protected $jwt;
    protected $exp=true;

    /**
     * @param bool $exp
     */
    public function setExp($exp)
    {
        $this->exp = $exp;
    }

    public function __construct()
    {
        // set your default time-zone
        $this->issuedAt = time();

        // Token Validity (3600 second = 1hr)
        $this->expire = $this->issuedAt + 120;

        // Set your secret or signature
        $this->jwt_secrect = $_ENV["secret"];
    }

    // ENCODING THE TOKEN
    public function _jwt_encode_data($iss,$data){
        $param=array(
            //Adding the identifier to the token (who issue the token)
            "iss" => $iss,
            "aud" => $iss,
            // Adding the current timestamp to the token, for identifying that when the token was issued.
            "iat" => $this->issuedAt,
            // Token expiration
            "exp" => $this->expire,
            // Payload
            "data"=> $data
        );


        $this->token = $param;


        $this->jwt = JWT::encode($this->token, $this->jwt_secrect);
        return $this->jwt;

    }
    public function login_jwt_encode_data($iss,$data){
        $param=array(
            //Adding the identifier to the token (who issue the token)
            "iss" => $iss,
            "aud" => $iss,
            // Adding the current timestamp to the token, for identifying that when the token was issued.
            "iat" => $this->issuedAt,
            // Payload
            "data"=> $data
        );
        if ($this->exp==false){
            unset($param->exp);
        }

        $this->token = $param;


        $this->jwt = JWT::encode($this->token, $this->jwt_secrect);
        return $this->jwt;

    }

    //DECODING THE TOKEN
    public function _jwt_decode_data($jwt_token){
        try{
            $decode = JWT::decode($jwt_token, $this->jwt_secrect, array('HS256'));
            return $decode;
        }
        catch(\Firebase\JWT\ExpiredException $e){
            return $e->getMessage();
        }
        catch(\Firebase\JWT\SignatureInvalidException $e){
            return $e->getMessage();
        }
        catch(\Firebase\JWT\BeforeValidException $e){
            return $e->getMessage();
        }
        catch(\DomainException $e){
            return $e->getMessage();
        }
        catch(\InvalidArgumentException $e){
            return $e->getMessage();
        }
        catch(\UnexpectedValueException $e){
            return $e->getMessage();
        }

    }

    public function getToken()
    {
        $Header=getallheaders();
        $Authorization=null;
        $Token=null;
        if ( isset($Header["Authorization"]) &&!empty($Header["Authorization"])){
            $Authorization=$Header["Authorization"];
            $Authorization=explode(" ",$Authorization);
            if (isset($Authorization[1]) && !empty($Authorization[1])){
                if (isset($Authorization[0]) && !empty($Authorization[0]) && ($Authorization[0]=="Bearer" || $Authorization[0]=="JWT") ) {
                    $Token = $Authorization[1];
                }

            }
            return $Token;
        }else return null;

    }
}