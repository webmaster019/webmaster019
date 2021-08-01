<?php
header("Content-Type:application/json;charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $DB=new Database();
    $validation=new Validation();
    $User=new Agent($DB);
    $Jwt=new JwtHandler();

    $tanpub = [];
    $tanpub['status'] = 500;
    $tanpub['message'] = "Impossible d'ajouter l'utilisateur";

$donnees=json_decode(file_get_contents("php://input"));

    if (!empty($donnees->nomUtilisateur) && !empty($donnees->postNomUtilisateur) && !empty($donnees->roleUtilisateur) && !empty($donnees->login)  && !empty($donnees->motDePass)  && !empty($donnees->confMotDePass)){

            if (!$User->verif_user_by_login($donnees->login)){
            if ($donnees->motDePass==$donnees->confMotDePass){

                    $add=$User->Add_User(htmlspecialchars($donnees->nomUtilisateur),htmlspecialchars($donnees->postNomUtilisateur),htmlspecialchars($donnees->roleUtilisateur),htmlspecialchars($donnees->login),htmlspecialchars($donnees->motDePass));
                    if ($add){

                            //http_response_code(201);
                            $tanpub['status'] = 201;
                            $tanpub['message'] = 'Ajouter avec succès';




                    }else{

                        //http_response_code(500);
                        $tanpub['status'] = 500;
                        $tanpub['message'] = "Impossible d'ajouter l'utilisateur";


                    }


                echo json_encode($tanpub);
            }else{
                //http_response_code(409);
                echo json_encode([
                    "status"=>409,
                    "message"=>"mot de pass non identique ",


                ]);
            }
            }else{
                //http_response_code(409);
                echo json_encode([
                    "status"=>411,
                    "message"=>"le login existe déjà",


                ]);
            }

    }else{
        //http_response_code(400);
        echo json_encode([
            "status"=>400,
            "message"=>"Requete non valide",


        ]);
    }
}else{
    //http_response_code(405);
    echo json_encode([
        "status"=>405,
        "message"=>"mathod non autorisée",


    ]);
}