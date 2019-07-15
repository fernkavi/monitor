<?php
include "./M/conDB.class.php";
include "./M/m_analyze.class.php";

$in1=$_POST["id"];
// $in2=$_POST["downsys"];
$in2=json_decode(stripslashes($_POST["downsys"]));

for($i=0;$i<count($in2);$i++){
	if($in2[$i]=="WRI"){
		$q=new m_analyze(2);
		$data=$q->getData();
	
	}
}

// if($in1!="" && $in2!=""){
	// 	echo "<div class='panel panel-primary'>
	// 	<div class='panel-heading'>".$data['mes']."</div>
	// 	<div class='panel-body'>
	// 		<button class='btn btn-success'>YES</button>
	// 		<button class='btn btn-success'>NO</button>
	// 	</div>
	// </div>";

	echo $data['mes'];

// }


?>
