<?php
function show_array($data){
	if(!empty($data)){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}
?>