<?php
// Cargamos Vendor
	require __DIR__ . '/vendor/autoload.php';
    require '/app.php';
    require './models/empleado.php';

    $empleado = new Empleado();

    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1)); 

	switch ($method) {        
		case 'PUT':
			$actionget = isset($_GET['id_emp']) ? true : null;
			if ($actionget){
				header('Content-Type: application/json');
				$data = json_decode(utf8_encode(file_get_contents("php://input")), true);
				print_r($empleado->modificar($data));
			}        
			break;
			
		case 'POST':       
			header('Content-Type: application/json');
			$data = json_decode(utf8_encode(file_get_contents("php://input")), true);
			print_r($empleado->registrar($data));
			break;
			
		case 'GET': 
			header('Content-Type: application/json');
			$actionget = isset($_GET['id_emp']) ? true : null;
			if ($actionget){
				print_r($empleado->obtener($_GET['id_emp']));
			} else {
				print_r($empleado->listar());
			}
			break;   
			
		case 'DELETE':
			$actionget = isset($_GET['id_emp']) ? true : null;
			if($actionget){
				header('Content-Type: application/json');
				print_r($empleado->eliminar($_GET['id_emp']));
			}        
			break;
			
		default:
			echo "asdasd"; 
			break;
	}
?>