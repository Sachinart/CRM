<?php 
	if(isset($rtnMsg)&&$rtnMsg!=""&!empty($rtnMsg)){
?>
	<div class="row">
		<div class="col-sm-12">
			<div id="errMsg" class="col-xs-12 alert alert-<?php if($success){ echo "success";} else { echo "danger"; }?>"><?php echo $rtnMsg; ?></div>
		</div>
	</div>
<?php
	}
?>