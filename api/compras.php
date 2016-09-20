<?php
	require __DIR__ . '/vendor/autoload.php';
    require '/app.php';
    require './models/compra.php';

    $compra = new Compra();

    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1)); 

	switch ($method) {        
	//    case 'PUT':
	//        $actionget = isset($_GET['id_fac']) ? true : null;
	//        if($actionget){
	//            header('Content-Type: application/json');
	//            $data = json_decode(utf8_encode(file_get_contents("php://input")), true);
	//            print_r(json_encode(modificar($fluent, $data)));
	//        }        
	//        break;
		case 'POST':       
			$data = json_decode(utf8_encode(file_get_contents("php://input")), true);
			print_r($compra->registrar($data));
			break;
			
	    case 'GET': 
	        $actionGet = isset($_GET['id_fac']) ? true : null;
			$actionGet2 = isset($_GET['consecutivo']) ? true : null;
	        if ($actionGet){
	            print_r($compra->obtener_por_id($_GET['id_fac'])); 
	        } elseif ($actionGet2){
	            print_r($compra->obtener_por_consecutivo($_GET['consecutivo']));
	        } else {
				print_r(json_encode((object)[ 'message' => "Bad Request" , 'status' => 400]));
			}
	        break;   
	//    case 'DELETE':
	//        $actionget = isset($_GET['id_fac']) ? true : null;
	//        if($actionget){
	//            header('Content-Type: application/json');
	//            print_r(json_encode(eliminar($fluent,$_GET['id_fac'])));
	//        }        
	//        break;
	//    default:
	//        echo "asdasd"; 
	//        break;
	}

?>