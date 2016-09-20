<?php
	require __DIR__ . '/vendor/autoload.php';
    require '/app.php';
    require './models/consecutivo.php';

    $consecutive = new Consecutivo();

    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1)); 

	switch ($method) {        
		case 'PUT':
			$actionget = isset($_GET['id_tip']) ? true : null;
			if($actionget){
				header('Content-Type: application/json');
				$data = json_decode(utf8_encode(file_get_contents("php://input")), true);
				print_r($consecutive->modificar($data));
			}        
			break;
			
		case 'GET': 
			header('Content-Type: application/json');
			$actionget = isset($_GET['id_tip']) ? true : null;
			if($actionget){
				print_r($consecutive->obtener($_GET['id_tip'])); 
			}
			break;   
			
		default:
			echo "asdasd"; 
			break;
	}

?>