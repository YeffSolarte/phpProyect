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
        $actionget = isset($_GET['id_pro']) ? true : null;
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
        $actionget = isset($_GET['id_pro']) ? true : null;
        if($actionget){
            print_r(json_encode(obtener($fluent, $_GET['id_pro']))); 
        }
        else {
            print_r(json_encode(listar($fluent)));
        }
        break;   
    case 'DELETE':
        $actionget = isset($_GET['id_pro']) ? true : null;
        if($actionget){
            header('Content-Type: application/json');
            print_r(json_encode(eliminar($fluent,$_GET['id_pro'])));
        }        
        break;
    default:
        echo "asdasd"; 
        break;
}


function listar($fluent)
{
    return $fluent
         ->from('proveedores')
         ->fetchAll();
}

function obtener($fluent, $id_pro)
{
    return $fluent->from('proveedores')
                  ->where('id_pro',$id_pro)
                              ->fetch();
}

function eliminar($fluent, $id)
{
    $fluent->deleteFrom('proveedores')
        ->where('id_pro', $id)
             ->execute();
    
    return 'Eliminado Correctamente';
}

function registrar($fluent, $data)
{
    $fluent->insertInto('proveedores', $data)
             ->execute();
    
    return $fluent->from('proveedores')
        ->where('doc_pro',$data['doc_pro'])
            ->fetch();;
}

function modificar($fluent, $data)
{
    $fluent->update('proveedores' )
        ->set($data)->where('id_pro', $data['id_pro'])
            ->execute();
    
    return $fluent->from('proveedores')
                  ->where('id_pro',$data['id_pro'])
                              ->fetch();;
}

?>