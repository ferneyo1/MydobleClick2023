
<?php

		function _ver($st1,$st2){
			$st3="";
			foreach($st1 as $key => $value){
				if($value["id"]==$st2){
					$st3.="<option value=".$value["id"]." selected>".$value["nombre"]."</option>";
				}$st3.="<option value=".$value["id"].">".$value["nombre"]."</option>";
			}
			return $st3;
		}
		function _ver2($st1,$st2){
			foreach($st1 as $key => $value){
				if($value["id"]==$st2){
					$st3=$value["id"];
				}$st3=$value["id"];
			}
			return $st3;
		}
		function _ver_mas($st1,$st2,$st3){
		foreach($st1 as $key => $value){
		if($value["id"]==$st2){
			return $value[$st3];
			}
		}
		}
		function _cuenta1($st1,$st2){
		$cant=0;
		foreach($st1 as $key => $value){
		if($value["equipopadre_id"]==$st2){
			$cant++;
			}
		}
		return $cant;
		}
		function _cuenta2($st1,$st2,$st3){
		$cant=0;
		foreach($st1 as $key => $value){
		if($value[$st3]==$st2){
			$cant++;
			}
		}
		return $cant;
		}
?>
