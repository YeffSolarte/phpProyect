<?php
// Cargamos Vendor
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


require __DIR__ . '/vendor/autoload.php';

$pdo = new PDO('mysql:host=localhost;dbname=ferreymas;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$fluent = new FluentPDO($pdo);


$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

switch ($method) {        
    case 'PUT':
        $actionget = isset($_GET['id_tip']) ? true : null;
        if($actionget){
            header('Content-Type: application/json');
            $data = json_decode(utf8_encode(file_get_contents("php://input")), true);
            print_r(json_encode(modificar($fluent, $data)));
        }        
        break;
    case 'GET': 
        header('Content-Type: application/json');
        $actionget = isset($_GET['id_tip']) ? true : null;
        if($actionget){
            print_r(json_encode(obtener($fluent, $_GET['id_tip']))); 
        }
        else {
            print_r(json_encode(listar($fluent)));
        }
        break;   
    default:
        echo "asdasd"; 
        break;
}


function listar($fluent)
{
    return $fluent
         ->from('consecutivos')
         ->fetchAll();
}

function obtener($fluent, $id_tip)
{
    return $fluent->from('consecutivos')
                  ->where('id_tip',$id_tip)
                              ->fetch();
}

function modificar($fluent, $data)
{
    $fluent->update('consecutivos' )
        ->set($data)->where('id_tip', $data['id_tip'])
            ->execute();
    
    return $fluent->from('consecutivos')
                  ->where('id_tip',$data['id_tip'])
                              ->fetch();;
}

?>