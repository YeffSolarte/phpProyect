

<?php
    // Cargamos Vendor

    require './vendor/autoload.php';  
	require '/detalle_factura.php';
	require '/consecutivo.php';

    class Compra {
        var $id_fac;
        var $fec_fac;
        var $id_emp;
        var $id_pro;
        var $id_tip;
        var $tot_des;
        var $tot_fac;
        var $table_name;
        var $fluent;
		var $detalle;
		var $consecutivo;
        
        function Compra() {
            $this->table_name = "factura";
            $pdo = new PDO('mysql:host=localhost;dbname=ferreymas;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->fluent = new FluentPDO($pdo);
			$this->detalle = new DetalleFactura();
			$this->consecutivo = new Consecutivo();
        }
        
        function impor_data($data) {
			
            $result = array(
				//        'id_fac' => $data["id_fac"], 
				'consecutivo' => $data["consecutivo"],
				'fec_fac' => $data["fec_fac"], 
				'id_tip' => $data["id_tip"], 
				'tot_des' => $data["tot_des"], 
				'tot_fac' => $data["tot_fac"]
			);             
			if(array_key_exists('id_fac', $data)) {
				if($data["id_fac"]){
					$result["id_fac"] = $data["id_fac"];
				}				
			}
			if(array_key_exists('id_emp', $data)) {
				if($data["id_emp"]){
					$result["id_emp"] = $data["id_emp"];
				}				
			}
			if(array_key_exists('id_pro', $data)) {
				if($data["id_pro"]){
					$result["id_pro"] = $data["id_pro"];
				}				
			}
            return $result;
        }
        
        function export_data($data) {
            return (object) [
                'id_fac' => $data["id_fac"], 
                'consecutivo' => $data["consecutivo"],
				'fec_fac' => $data["fec_fac"], 
				'id_emp' => $data["id_emp"], 		
				'id_pro' => $data["id_pro"], 
				'id_tip' => $data["id_tip"], 
				'tot_des' => $data["tot_des"], 
				'tot_fac' => $data["tot_fac"],
				'documentDetailList' => $this->detalle->obtener($data["id_fac"], true)
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
        function obtener($id_fac)
        {
            try{
                $result = $this->fluent->from($this->table_name)
                              ->where('id_fac',$id_fac)
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
			try {
				$fluent->insertInto('factura')->values($data)->execute();
			} catch (Exception $e) {
				return $e->getMessage();
			}

			$factura = $fluent->from('factura')
				->where('consecutivo', $data['consecutivo'])
					->fetch();  


			foreach ($data["documentDetailList"] as $val){
				$this->detalle->registrar($val);
			} 
			
			$set = array('consecutivo' => ($data["consecutivo"] + 1), 'fec_act' => $data["fec_fac"]);
			$this->consecutivo->modificar($set);
			
			return $factura;
        }

        function modificar($data)
        {
//			return $data;
            $data = $this->impor_data($data); 
            try {                           
				$this->fluent->update($this->table_name)->set($data)->where('id_fac', $data['id_fac'])->execute();
            } catch (Exception $e) {
                return json_encode($e->getMessage());

            }            
            $result = $this->fluent->from($this->table_name)
                          ->where('id_fac',$data['id_fac'])
                                      ->fetch();           
            return json_encode($result);
        }
    }
?>