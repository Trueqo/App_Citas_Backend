<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET,POST");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $service = "localhost"; $user = "root"; $password = ""; $nameDatabase = "appcitas";
    $connectionBD = new mysqli($service, $user, $password, $nameDatabase);


    // Consulta todos los registros de la tabla empleados
    $sqlApointment = mysqli_query($connectionBD,"SELECT * FROM citas ");
    if(mysqli_num_rows($sqlApointment) > 0){
        $dataApointment = mysqli_fetch_all($sqlApointment,MYSQLI_ASSOC);
        echo json_encode($dataApointment);
    }
    else{ echo json_encode([["success"=>0]]); 
    }

    // //Crea un Registro
    // if(isset($_GET["insertar"])){
    //     $data = json_decode(file_get_contents("php://input"));
    //     $nombre=$data->nombre;
    //     $correo=$data->correo;
    //         if(($correo!="")&&($nombre!="")){
                
    //     $sqlEmpleaados = mysqli_query($conexionBD,"INSERT INTO empleados(nombre,correo) VALUES('$nombre','$correo') ");
    //     echo json_encode(["success"=>1]);
    //         }
    //     exit();
    // }
?>