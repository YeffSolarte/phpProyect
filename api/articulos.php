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
        $actionget = isset($_GET['id_art']) ? true : null;
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
        $actionget = isset($_GET['id_art']) ? true : null;
        if($actionget){
            print_r(json_encode(obtener($fluent, $_GET['id_art']))); 
        }
        else {
            print_r(json_encode(listar($fluent)));
        }
        break;   
    case 'DELETE':
        $actionget = isset($_GET['id_art']) ? true : null;
        if($actionget){
            header('Content-Type: application/json');
            print_r(json_encode(eliminar($fluent,$_GET['id_art'])));
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
         ->from('articulos')
         ->fetchAll();
}

function obtener($fluent, $id_art)
{
    return $fluent->from('articulos')
                  ->where('id_art',$id_art)
                              ->fetch();
}

function eliminar($fluent, $id)
{
    $fluent->deleteFrom('articulos')
        ->where('id_art', $id)
             ->execute();
    
    return 'Eliminado Correctamente';
}

function registrar($fluent, $data)
{
    $fluent->insertInto('articulos', $data)
             ->execute();
    
    return $fluent->from('articulos')
        ->where('cod_art',$data['cod_art'])
            ->fetch();;
}

function modificar($fluent, $data)
{
    $fluent->update('articulos' )
        ->set($data)->where('id_art', $data['id_art'])
            ->execute();
    
    return $fluent->from('articulos')
                  ->where('id_art',$data['id_art'])
                              ->fetch();;
}