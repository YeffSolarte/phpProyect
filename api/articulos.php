<?php
// Cargamos Vendor
	require __DIR__ . '/vendor/autoload.php';
    require '/app.php';
    require './models/articulo.php';

    $articulo = new Articulo();

    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1)); 

	switch ($method) {        
		case 'PUT':
			$actionget = isset($_GET['id_art']) ? true : null;
			if($actionget){
				header('Content-Type: application/json');
				$data = json_decode(utf8_encode(file_get_contents("php://input")), true);
				print_r($articulo->modificar($data));
			}        
			break;
			
		case 'POST':       
			header('Access-Control-Allow-Origin: *');
			header('Content-Type: application/json');
			$data = json_decode(utf8_encode(file_get_contents("php://input")), true);
			print_r($articulo->registrar($data));
			break;
			
		case 'GET': 
			header('Content-Type: application/json');
			$actionget = isset($_GET['id_art']) ? true : null;
			if($actionget){
				print_r($articulo->obtener($_GET['id_art']));
			}
			else {
				print_r($articulo->listar());
			}
			break;   
			
		case 'DELETE':
			$actionget = isset($_GET['id_art']) ? true : null;
			if($actionget){
				header('Content-Type: application/json');
				print_r($articulo->eliminar($_GET['id_art']));
			}        
			break;
			
		default:
			echo "asdasd"; 
			break;
	}

?>