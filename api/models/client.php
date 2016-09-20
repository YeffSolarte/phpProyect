

<?php
    // Cargamos Vendor

    require './vendor/autoload.php';  

    class Client {
        var $id_cli;
        var $tip_doc;
        var $doc_cli;
        var $nom_cli;
        var $dir_cli;
        var $tel_cli;
        var $ciu_cli;
        var $table_name;
        var $fluent;
        
        function Client() {
            $this->table_name = "clientes";
            $pdo = new PDO('mysql:host=localhost;dbname=ferreymas;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->fluent = new FluentPDO($pdo);
        }
        
        function impor_data($data) {
			
            $result = array(
				'tip_doc' => $data["tip_doc"],
                'doc_cli' => $data["doc_cli"],
                'nom_cli' => $data["nom_cli"],
                'dir_cli' => $data["dir_cli"],
                'tel_cli' => $data["tel_cli"],
                'ciu_cli' => $data["ciu_cli"]
			);             
			if(array_key_exists('id_cli', $data)) {
				if($data["id_cli"]){
					$result["id_cli"] = $data["id_cli"];
				}				
			}
            return $result;
        }
        
        function export_data($data) {
            return (object) [
                'id_cli' => $data["id_cli"],
                'tip_doc' => $data["tip_doc"],
                'doc_cli' => $data["doc_cli"],
                'nom_cli' => $data["nom_cli"],
                'dir_cli' => $data["dir_cli"],
                'tel_cli' => $data["tel_cli"],
                'ciu_cli' => $data["ciu_cli"]
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
        function obtener($id_cli)
        {
            try{
                $result = $this->fluent->from($this->table_name)
                              ->where('id_cli',$id_cli)
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
                    ->where('id_cli', $id)
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
                    ->where('doc_cli',$data['doc_cli'])
                        ->fetch();            
            return json_encode($result);
        }

        function modificar($data)
        {
//			return $data;
            $data = $this->impor_data($data); 
            try {                           
				$this->fluent->update($this->table_name)->set($data)->where('id_cli', $data['id_cli'])->execute();
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }            
            $result = $this->fluent->from($this->table_name)
                          ->where('id_cli',$data['id_cli'])
                                      ->fetch();           
            return json_encode($result);
        }
    }
?>