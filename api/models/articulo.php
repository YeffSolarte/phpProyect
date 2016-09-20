

<?php
    // Cargamos Vendor

    require './vendor/autoload.php';  

    class Articulo {
        var $id_art;
        var $cod_art;
        var $nom_art;
        var $pre_com;
        var $pre_ven;
        var $img_art;
        var $exi_art;
        var $des_art;
        
        function Articulo() {
            $this->table_name = "articulos";
            $pdo = new PDO('mysql:host=localhost;dbname=ferreymas;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->fluent = new FluentPDO($pdo);
        }
        
        function impor_data($data) {
			
            $result = array(
				'cod_art' => $data["cod_art"],
                'nom_art' => $data["nom_art"],
                'pre_com' => $data["pre_com"],
                'pre_ven' => $data["pre_ven"],
                'des_art' => $data["des_art"],
                'exi_art' => $data["exi_art"]
			);  
			if(array_key_exists('img_art', $data)) {
				if($data["img_art"]){
					$result["img_art"] = $data["img_art"];
				}				
			}
			if(array_key_exists('id_art', $data)) {
				if($data["id_art"]){
					$result["id_art"] = $data["id_art"];
				}				
			}
            return $result;
        }
        
        function export_data($data) {
            return (object) [
                'id_art' => $data["id_art"],
                'cod_art' => $data["cod_art"],
                'nom_art' => $data["nom_art"],
                'pre_com' => $data["pre_com"],
                'pre_ven' => $data["pre_ven"],
                'des_art' => $data["des_art"],
                'exi_art' => $data["exi_art"]
            ];   
        }
        

        function listar()
        {
            try{
                $result = $this->fluent->from($this->table_name)->fetchAll();      
                return json_encode($result);
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }
            
        }
        function obtener($id_art)
        {
            try{
                $result = $this->fluent->from($this->table_name)
                              ->where('id_art',$id_art)
                                          ->fetch();
                $result = $this->export_data($result);
                return json_encode($result);
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }
            
        }

        function eliminar($id)
        {
            try{
                $this->fluent->deleteFrom($this->table_name)
                    ->where('id_art', $id)
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
            $result = $this->fluent->from($this->table_name)
                    ->where('cod_art',$data['cod_art'])
                        ->fetch();            
            return json_encode($result);
        }

        function modificar($data)
        {
            $data = $this->impor_data($data); 
            try {                           
				$this->fluent->update($this->table_name)->set($data)->where('id_art', $data['id_art'])->execute();
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }            
            $result = $this->fluent->from($this->table_name)
                          ->where('id_art',$data['id_art'])
                                      ->fetch();           
            return json_encode($result);
        }
	}
?>