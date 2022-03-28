<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET,POST");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $service = "localhost"; $user = "root"; $password = ""; $nameDatabase = "appcitas";
    $connectionBD = new mysqli($service, $user, $password, $nameDatabase);


    //Buscar
    if (isset($_GET["search"])){
        $sqlApointment = mysqli_query($connectionBD,"SELECT * FROM citas WHERE id=".$_GET["search"]);
        if(mysqli_num_rows($sqlApointment) > 0){
            $dataApointment = mysqli_fetch_all($sqlApointment,MYSQLI_ASSOC);
            echo json_encode($dataApointment);
            exit();
        }
        else{  echo json_encode(["success"=>0]); }
    }

    //Crear
    if(isset($_GET["create"])){
        $data = json_decode(file_get_contents("php://input"));
        $name=$data->name;
        $topic=$data->topic;
        $date=$data->date;
        $hour=$data->hour;
        $currentTime=$data->currentTime;


        if(($name!="")&&($topic!="")&&($date!="")&&($hour!="")&&($currentTime!="")){
                
            $sqlApointment = mysqli_query($connectionBD,"INSERT INTO citas(name,topic,date,hour,currentTime) VALUES('$name','$topic','$date','$hour','$currentTime') ");
            echo json_encode(["success"=>1]);
            }
        exit();
    }

    //borrar
    if (isset($_GET["delete"])){
        $sqlApointment = mysqli_query($connectionBD,"DELETE FROM citas WHERE id=".$_GET["delete"]);
        if($sqlApointment){
            echo json_encode(["success"=>1]);
            exit();
        }
        else{  echo json_encode(["success"=>0]); }
    }

    //Actualizar
    if(isset($_GET["update"])){
    
        $data = json_decode(file_get_contents("php://input"));
    
        $id=(isset($data->id))?$data->id:$_GET["update"];
        $name=$data->name;
        $topic=$data->topic;
        $date=$data->date;
        $hour=$data->hour;
        $currentTime=$data->currentTime;
        
        $sqlApointment = mysqli_query($connectionBD,"UPDATE citas SET name='$name',topic='$topic', date='$date', hour='$hour', currentTime='$currentTime' WHERE id='$id'");
        echo json_encode(["success"=>1]);
        exit();
    }

     // Consulta todos los registros de la tabla citas
     $sqlApointment = mysqli_query($connectionBD,"SELECT * FROM citas ");
     if(mysqli_num_rows($sqlApointment) > 0){
         $dataApointment = mysqli_fetch_all($sqlApointment,MYSQLI_ASSOC);
         echo json_encode($dataApointment);
     }
     else{ echo json_encode([["success"=>0]]); 
     }
?>