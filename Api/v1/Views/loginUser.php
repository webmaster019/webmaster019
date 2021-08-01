<?php
header("Acces-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
header("Acces-Control-Allow-Methods:POST");
header("Acces-Control-max-Age:3600");
header("Acces-Control-Allow-Header:Content-Type,Acces-Control-Allow-Header,Authorization,X-Requested-with");


if ($_SERVER['REQUEST_METHOD']=='POST') {
    $DB=new Database();
    $validation=new Validation();
    $User=new Agent($DB);
    $Jwt=new JwtHandler();
    $donnees=json_decode(file_get_contents("php://input"));
    $tanpub = [];
    $tanpub['status'] = 401;
    $tanpub['message'] = "Imposible de se connecter";


    if (isset($donnees->login) && !empty($donnees->login) && isset($donnees->password) && !empty($donnees->password) && isset($donnees->iss) && !empty($donnees->iss)  ){


        if ($login=$User->loginUser($donnees->login,$donnees->password)) {

            http_response_code(200);
            $tanpub['status'] = 200;
            $tanpub['message'] = 'Connexion avec succès';
            $user = $login;
            unset($user->motDePass);
            $Jwt->setExp(false);
            $tanpub['data'] = [
                "user" => $user,
                "Token" => $Jwt->login_jwt_encode_data($donnees->iss, $user),

            ];

        }else{

            http_response_code(401);
            $tanpub['status'] = 401;
            $tanpub['message'] = "Numéro ou mot de passe incorrect ";

        }




        echo json_encode($tanpub);



    }else {
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "message" => "Requete non valide",


        ]);
    }



}else{
    http_response_code(405);
    echo json_encode([
        "status"=>405,
        "message"=>"mathod non autorisée",


    ]);
}