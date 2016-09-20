<?php
    require './vendor/autoload.php';
	require '/articulo.php';

    class DetalleFactura {
        var $id_det_fac;
        var $id_fac;
        var $id_art;
        var $cantidad;
        
        var $table_name;
        var $fluent;
		var $articulo;
        
        function DetalleFactura() {
            $this->table_name = "detalle_factura";
            $pdo = new PDO('mysql:host=localhost;dbname=ferreymas;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->fluent = new FluentPDO($pdo);
            $this->articulo = new Articulo();
        }
        
        function impor_data($data) {
			
            $result = array(
				'id_fac' => $data["id_fac"],
                'id_art' => $data["id_art"],
                'cantidad' => $data["cantidad"]
			);             
			if(array_key_exists('id_det_fac', $data)) {
				if($data["id_det_fac"]){
					$result["id_det_fac"] = $data["id_det_fac"];
				}				
			}
            return $result;
        }
        
        function export_data($data) {
//			return false;
            return (object) [
                'id_det_fac' => $data["id_det_fac"],
                'id_fac' => $data["id_fac"],
                'id_art' => $data["id_art"],
				'articulo' => $this->articulo->obtener($data["id_art"], true)
            ];   
        }
        
        function obtener($id_fac, $decode)
        {
            try{
                $result = $this->fluent->from($this->table_name)
                              ->where('id_fac',$id_fac)
                                          ->fetchAll();
//				$result = (array) $result;
				$result2 = (array)[];
				foreach ($result as $val){
					$val = (array) $val;
					array_push($result2, $this->export_data($val)); 
				}  				
//                
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }
			if ($decode){
				return $result2;					
			} else {
				return json_encode($result2);
			}
            
        }

        function eliminar($id)
        {
            try{
                $this->fluent->deleteFrom($this->table_name)
                    ->where('id_fac', $id)
                         ->execute();

                return json_encode((object)[ 'message' => "Eliminado Correctamente" , 'status' => 200]);
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }
            
        }

        function registrar($data)
        {
            $data = $this->impor_data($data);
            try{
                        
                $this->fluent->insertInto($this->table_name, $data)
                     ->execute();  	
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }                  
            return true;
        }
        
    }
?>