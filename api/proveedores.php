<?php
	require __DIR__ . '/vendor/autoload.php';
    require '/app.php';
    require './models/proveedor.php';

    $proveedor = new Proveedor();

    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1)); 

	switch ($method) {        
		case 'PUT':
			$actionget = isset($_GET['id_pro']) ? true : null;
			if($actionget){
				header('Content-Type: application/json');
				$data = json_decode(utf8_encode(file_get_contents("php://input")), true);
				print_r($proveedor->modificar($data));
			}        
			break;
			
		case 'POST':       
			header('Content-Type: application/json');
			$data = json_decode(utf8_encode(file_get_contents("php://input")), true);
			print_r($proveedor->registrar($data));
			break;
			
		case 'GET': 
			header('Content-Type: application/json');
			$actionget = isset($_GET['id_pro']) ? true : null;
			if($actionget){
				print_r($proveedor->obtener($_GET['id_pro'])); 
			}
			else {
				print_r($proveedor->listar());
			}
			break;  
			
		case 'DELETE':
			$actionget = isset($_GET['id_pro']) ? true : null;
			if($actionget){
				header('Content-Type: application/json');
				print_r($proveedor->eliminar($_GET['id_pro']));
			}        
			break;
			
		default:
			echo "asdasd"; 
			break;
	}

?>