<?php
    require './vendor/autoload.php';  

    class Empleado {
        var $id_emp;
        var $tip_doc;
        var $doc_emp;
        var $nom_emp;
        var $cod_emp;
        var $cargo;
        
        var $table_name;
        var $fluent;
        
        function Empleado() {
            $this->table_name = "empleados";
            $pdo = new PDO('mysql:host=localhost;dbname=ferreymas;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->fluent = new FluentPDO($pdo);
        }
        
        function impor_data($data) {
			
            $result = array(
				'tip_doc' => $data["tip_doc"],
                'doc_emp' => $data["doc_emp"],
                'cod_emp' => $data["cod_emp"],
                'nom_emp' => $data["nom_emp"],
                'cargo' => $data["cargo"]
			);             
			if(array_key_exists('id_emp', $data)) {
				if($data["id_emp"]){
					$result["id_emp"] = $data["id_emp"];
				}				
			}
            return $result;
        }
        
        function export_data($data) {
            return (object) [
                'id_emp' => $data["id_emp"],
                'tip_doc' => $data["tip_doc"],
                'doc_emp' => $data["doc_emp"],
                'cod_emp' => $data["cod_emp"],
                'nom_emp' => $data["nom_emp"],
                'cargo' => $data["cargo"]
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
        function obtener($id_emp)
        {
            try{
                $result = $this->fluent->from($this->table_name)
                              ->where('id_emp',$id_emp)
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
                    ->where('id_emp', $id)
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
                    ->where('cod_emp',$data['cod_emp'])
                        ->fetch();            
            return json_encode($result);
        }

        function modificar($data)
        {
//			return $data;
            $data = $this->impor_data($data); 
            try {                           
				$this->fluent->update($this->table_name)->set($data)->where('id_emp', $data['id_emp'])->execute();
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }            
            $result = $this->fluent->from($this->table_name)
                          ->where('id_emp',$data['id_emp'])
                                      ->fetch();           
            return json_encode($result);
        }
    }
?>