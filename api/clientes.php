<?php
    require __DIR__ . '/vendor/autoload.php';
    require '/app.php';
    require './models/client.php';

    $client = new Client();

    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));    

    switch ($method) {
        case 'PUT':
            $actionget = isset($_GET['id_cli']) ? true : null;
            if ($actionget){
				
                $data = json_decode(utf8_encode(file_get_contents("php://input")), true);
//				print_r($data);
                print_r($client->modificar($data));
            }        
            break;
            
        case 'POST':       
            $data = json_decode(utf8_encode(file_get_contents("php://input")), true);
            print_r($client->registrar($data));
            break;
            
        case 'GET': 
            header('Content-Type: application/json');
            $actionget = isset($_GET['id_cli']) ? true : null;
            if ($actionget){
                print_r($client->obtener($_GET['id_cli'])); 
            } else {
                print_r($client->listar());
            }
            break;   
            
        case 'DELETE':
            $actionget = isset($_GET['id_cli']) ? true : null;
            if ($actionget){
                header('Content-Type: application/json');
                print_r($client->eliminar($_GET['id_cli']));
            }        
            break;
            
        default:
            echo "asdasd"; 
            break;
    }

?>