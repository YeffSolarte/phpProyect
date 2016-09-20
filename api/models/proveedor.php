<?php
    require './vendor/autoload.php';  

    class Proveedor {
        var $id_pro;
        var $tip_doc;
        var $doc_emp;
        var $nom_emp;
        var $cod_emp;
        var $cargo;
        
        var $table_name;
        var $fluent;
        
        function Proveedor() {
            $this->table_name = "proveedores";
            $pdo = new PDO('mysql:host=localhost;dbname=ferreymas;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->fluent = new FluentPDO($pdo);
        }
        
        function impor_data($data) {
			
            $result = array(
				'tip_doc' => $data["tip_doc"],
                'doc_pro' => $data["doc_pro"],
                'tel_pro' => $data["tel_pro"],
                'nom_pro' => $data["nom_pro"],
                'dir_pro' => $data["dir_pro"],
                'ciu_pro' => $data["ciu_pro"]
			);             
			if(array_key_exists('id_pro', $data)) {
				if($data["id_pro"]){
					$result["id_pro"] = $data["id_pro"];
				}				
			}
            return $result;
        }
        
        function export_data($data) {
            return (object) [
                'id_pro' => $data["id_pro"],
                'tip_doc' => $data["tip_doc"],
                'doc_pro' => $data["doc_pro"],
                'tel_pro' => $data["tel_pro"],
                'nom_pro' => $data["nom_pro"],
                'dir_pro' => $data["dir_pro"],
                'ciu_pro' => $data["ciu_pro"]
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
        function obtener($id_pro)
        {
            try{
                $result = $this->fluent->from($this->table_name)
                              ->where('id_pro',$id_pro)
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
                    ->where('id_pro', $id)
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
                    ->where('doc_pro',$data['doc_pro'])
                        ->fetch();            
            return json_encode($result);
        }

        function modificar($data)
        {
//			return $data;
            $data = $this->impor_data($data); 
            try {                           
				$this->fluent->update($this->table_name)->set($data)->where('id_pro', $data['id_pro'])->execute();
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }            
            $result = $this->fluent->from($this->table_name)
                          ->where('id_pro',$data['id_pro'])
                                      ->fetch();           
            return json_encode($result);
        }
    }
?>