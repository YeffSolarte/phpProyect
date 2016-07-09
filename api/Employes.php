<?php
// Cargamos Vendor
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header('Access-Control-Allow-Credentials: true');  
header("Access-Control-Allow-Headers: Authorizations, Content-Type");


require __DIR__ . '/vendor/autoload.php';

$pdo = new PDO('mysql:host=localhost;dbname=ferreymas;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$fluent = new FluentPDO($pdo);


$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

switch ($method) {        
    case 'PUT':
        $actionget = isset($_GET['id_emp']) ? true : null;
        if($actionget){
            header('Content-Type: application/json');
            $data = json_decode(utf8_encode(file_get_contents("php://input")), true);
            print_r(json_encode(modificar($fluent, $data)));
        }        
        break;
    case 'POST':       
        header('Content-Type: application/json');
        $data = json_decode(utf8_encode(file_get_contents("php://input")), true);
        print_r(json_encode(registrar($fluent, $data)));
        break;
    case 'GET': 
        header('Content-Type: application/json');
        $actionget = isset($_GET['id_emp']) ? true : null;
        if($actionget){
            print_r(json_encode(obtener($fluent, $_GET['id_emp']))); 
        }
        else {
            print_r(json_encode(listar($fluent)));
        }
        break;   
    case 'DELETE':
        $actionget = isset($_GET['id_emp']) ? true : null;
        if($actionget){
            header('Content-Type: application/json');
            print_r(json_encode(eliminar($fluent,$_GET['id_emp'])));
        }        
        break;
    case 'OPTIONS':
        echo "OPTIONS";    
        break;
    default:
        echo "asdasd"; 
        break;
}


function listar($fluent)
{
    return $fluent
         ->from('empleados')
         ->fetchAll();
}

function obtener($fluent, $id_art)
{
    return $fluent->from('empleados')
                  ->where('id_emp',$id_art)
                              ->fetch();
}

function eliminar($fluent, $id)
{
    $fluent->deleteFrom('empleados')
        ->where('id_emp', $id)
             ->execute();
    
    return 'Eliminado Correctamente';
}

function registrar($fluent, $data)
{
    $fluent->insertInto('empleados', $data)
             ->execute();
    
    return $fluent->from('empleados')
        ->where('cod_emp',$data['cod_emp'])
            ->fetch();;
}

function modificar($fluent, $data)
{
    $fluent->update('empleados' )
        ->set($data)->where('id_emp', $data['id_emp'])
            ->execute();
    
    return $fluent->from('empleados')
                  ->where('id_emp',$data['id_emp'])
                              ->fetch();;
}
