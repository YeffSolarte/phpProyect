<?php
    // Cargamos Vendor

    require './vendor/autoload.php';  

    class Consecutivo {
        var $id_tip;
        var $consecutivo;
        var $fec_act;
		var $table_name;
		var $fluent;
        
        function Consecutivo() {
            $this->table_name = "consecutivos";
            $pdo = new PDO('mysql:host=localhost;dbname=ferreymas;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->fluent = new FluentPDO($pdo);
        }
        
        function impor_data($data) {
			
            $result = array(
                'consecutivo' => $data["consecutivo"],
                'fec_act' => $data["fec_act"]
			);  
			if(array_key_exists('id_tip', $data)) {
				if($data["id_tip"]){
					$result["id_tip"] = $data["id_tip"];
				}				
			}
            return $result;
        }
        
        function export_data($data) {
            return (object) [
                'id_tip' => $data->id_tip,
                'consecutivo' => $data->consecutivo,
                'fec_act' => $data->fec_act
            ];   
        }
        
        function obtener($id_tip)
        {
            try{
                $result = $this->fluent->from($this->table_name)
                              ->where('id_tip',$id_tip)
                                          ->fetch();
                $result = $this->export_data($result);
                return json_encode($result);
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }
            
        }

        function modificar($data)
        {
            $data = $this->impor_data($data); 
            try {                           
				$this->fluent->update($this->table_name)->set($data)->where('id_tip', $data['id_tip'])->execute();
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }           
            return true;
        }
	}
?>