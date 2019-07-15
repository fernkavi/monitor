<?php

if(isset($_SESSION['info']) AND !empty($_SESSION['info'])){
	
?>

<div class="container">
	<h2>Analyze</h2>
	
	<form class="form-inline" method="post" id="dataForAnalyze">
		<div class="row">
			<div class="col-sm-5">
				<div class="form-group">
					<label>Node : </label>
				</div>
				<div class="form-group">
					<select id="selectedNode" name="selectedNode" class="selectpicker" data-live-search="true" title="Please select node..." onchange="dispSys(this);">
						<?php
							for($i=0;$i<count($dispNode['name']);$i++){
								echo "<option value='".$dispNode['id'][$i]."'>".$dispNode['name'][$i]."</option>";
							}
						?>
							
					</select>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="form-group">
					<label> Down System : </label>
				</div>
				<div class="form-group" id="sysDIV">
						
				</div>
			</div>
			
		</div>
		<br/>
		<div class="row">
			
			<div class="col-sm-8">
				<div class="form-group">
					<button type="submit" class="btn btn-success" name="analyzeBtn" value="submit">Submit</button>
					<button type="cancel" class="btn btn-danger">Cancel</button>
				</div>
			</div>
			<div class="col-sm-4"></div>
			
		</div>	
					
	</form>
		


</div>
<br/>
<div class="container" id="analyzeStep">

</div>	


<?php
}
?>
