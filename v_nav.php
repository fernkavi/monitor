<?php
session_start();
	include "./M/m_autoload.inc.php";
	include "./C/c_login.class.php";
	$c=new c_login();
	include "./C/c_logout.class.php";
	$l=new c_logout();
	include "./C/c_addPlace.class.php";
	$addP=new c_addPlace();
	$d=new m_fetchNode();
	$d->fetchNode();
	$dispNode=$d->getNode();
	include "./C/c_stat.class.php";
	$ch=new c_stat();
	$dataPoints=$ch->get_data();
	// print_r($dataPoints);
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap Example</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <link rel="stylesheet" href="./V/JS/bootstrap-select-1.13.9/dist/css/bootstrap-select.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <script src="./V/JS/bootstrap-select-1.13.9/dist/js/bootstrap-select.js"></script>
	  <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
	    <style>
	    .footer{
			position:fixed;
			left:0;
			bottom:0;
			width:100%;
			background-color: Teal;
			color:black;
			text-align:center;
		}
		.affix {
            top: 0;
            width: 60%;
            z-index: 9999 ;
        }
        .affix + .container-fluid {
            padding-top: 70px;
        }
		</style>

	<script type="text/javascript">
		
		
		function dispSys(sel){
			var selNodeID=sel.value;
			if(selNodeID==""){
				document.getElementById("sysDIV").innerHTML="";
				return;
			}
			else{
				if(window.XMLHttpRequest){
					xmlhttp=new XMLHttpRequest();
				}
				else{
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function(){
					if(this.readyState==4 && this.status==200){
						document.getElementById("sysDIV").innerHTML=this.responseText;
					}
				};
				xmlhttp.open("GET","./sendId.php?q="+selNodeID,true);
				xmlhttp.send();
			}
		}

		// function dispCause(sel){
		// 	var selNodeID=sel.value;
		// 	if(selNodeID==""){
		// 		document.getElementById("selectedCause").innerHTML="";
		// 		return;
		// 	}
		// 	else{
		// 		if(window.XMLHttpRequest){
		// 			xmlhttp=new XMLHttpRequest();
		// 		}
		// 		else{
		// 			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		// 		}
		// 		xmlhttp.onreadystatechange=function(){
		// 			if(this.readyState==4 && this.status==200){
		// 				document.getElementById("selectedCause").innerHTML=this.responseText;
		// 			}
		// 		};
		// 		xmlhttp.open("GET","./sendCause.php?id="+selNodeID,true);
		// 		xmlhttp.send();
		// 	}
		// }
		


		
		
		var node;
		var dsys;
		var downSys=[];
		
		$(document).ready(function(){

			var node="";
			var dsys="";
			var downSys=[];
			var data="";
			$("#dataForAnalyze").submit(function(){

				node=$("#selectedNode").val();
				dsys=document.getElementsByName("dsys[]");
				var i;
				var txt="";
				var downOrder=[];
				// var downSys=[];
				if(node != ""){
					for(i=0;i<dsys.length;i++){
						if(dsys[i].checked){
							txt=txt+dsys[i].value+" ";
							downSys.push(dsys[i].value);
							// downOrder.push('1');
						}
						else{
							downSys.push('0');
							// downOrder.push('0');
						}
					}

					
				}
				else{
					alert("Please select your node first!");
				}

			
				var downsysJSON=JSON.stringify(downSys);
				var retTxt="";
				$.ajax({
					type : "POST",
					url : "./sendQuestion.php",
					data : {id:node,downsys:downsysJSON},
					success : function(res){
						
						$("#analyzeStep").append("<p>"+res+"</p>");
					}
				})
				
			});
			
			

		});



		window.onload = function () {

		var options = {
			animationEnabled: true,
			title: {
				text: "สถิติการชำรุดของ กฟส.ศรีเทพ"
			},
			axisY: {
				title: "จำนวนครั้งที่เกิด",
				includeZero: false
			},
			axisX: {
				title: "สาเหตุการชำรุด"
			},
			data: [{
				type: "column",
				dataPoints: [
					{ label: "สายเคเบิลใยแก้วนำแสงชำรุด", y: 4 },	
					{ label: "Core Fiber เส้นทาง สถานีฯ วิเชียรบุรี – กฟส.อ.บึงสามพัน ไขว้", y: 1 },	
					{ label: "สำนำงาน/สถานีฯ กระแสไฟฟ้าดับ", y: 1 }
					
					
				]
			}]
		};
		$("#chartContainer").CanvasJSChart(options);

		}

	</script>

	

</head>
<body>




	<div class="jumbotron text-center" style="background-color: Teal">
		<h1>System Solution</h1>
		<p></p>
	</div>
	<div class="container">
		<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="350">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#monitorNav">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">System Solution</a>
				</div>
				<div class="collapse navbar-collapse" id="monitorNav">
					<ul class="nav navbar-nav">
						<li class="active"><a href="./home.php"><i class="fa fa-home" style="font-size: 20px"></i></a></li>
						<?php
						if(isset($_SESSION['info']) AND !empty($_SESSION['info'])){
						?>
							<li class="nav-item">
								<a class="nav-link" href="./device.php"><i class='fa fa-plug' style='font-size: 20px'></i> Devices</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link' href='./analyze.php'><i class='fa fa-cogs' style='font-size: 20px'></i> Analyze</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link' href='./stat.php'><i class='fa fa-bar-chart-o' style='font-size: 20px'></i> Stats</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link' href='./input.php'><i class='fa fa-database' style='font-size: 20px'></i> Input Data</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link' href='#'><i class='fa fa-file-word-o' style='font-size: 20px'></i> Document</a>
							</li>
						<?php
						}
						?>
						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php
						if(isset($_SESSION['info']) AND !empty($_SESSION['info'])){
						?>
						<li class='dropdown'>
							<a class='dropdown-toggle' href='#' id='navbardrop' data-toggle='dropdown'><?php echo $_SESSION['info']['fname']." "; ?><i class='fa fa-user-circle' style='font-size: 20px'></i></a>
							<ul class='dropdown-menu'>
								<li><a href='#'>Systems Management</a></li>
								<li><a href='#'>Users Management</a></li>
								<li><a href='#'>View Your Infomation</a></li>
								<li><a href='#' data-toggle='modal' data-target='#logoutModal'>Log Out</a></li>
							</ul>
						</li>
						<?php
						}
						else{
						?>
							<li><a href='#' data-toggle='modal' data-target='#loginModal'><i class='fa fa-lock' style='font-size: 20px'></i></a></li>
						<?php
						}
						?>
						
					</ul>	
				</div>
			</div>
		</nav>
	</div>

	<div class="modal fade" id="loginModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Log-In</h4>
				</div>
				<div class="modal-body">
					<form method="post">
						<div class="form-group">
							<label for="usr">Username :</label>
							<input class="form-control" type="text" id="usr" name="usr">
						</div>
						<div class="form-group">
							<label for="pwd">Password :</label>
							<input class="form-control" type="password" id="pwd" name="pwd">
						</div>
						<div class="form-group">
							<button class="btn btn-success" type="submit" name="loginBTN">Submit</button>
							<button class="btn btn-danger" type="cancel">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="logoutModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Log-Out</h4>
				</div>
				<div class="modal-body">
					<form method="post">
						<div class="form-group">
							<h4>Do you want to log-out?</h4>
						</div>
						<div class="form-group">
							<button class="btn btn-success" type="submit" name="logoutBTN">YES</button>
							<button class="btn btn-danger" type="cancel">NO</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


<!-- </body>
</html> -->
