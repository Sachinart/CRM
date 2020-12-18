<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Customer</title>
  </head>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
      <!-- Navbar-->
      <?php $this->load->view('common/header');  ?>
      <!-- Side-Nav-->
      <?php $this->load->view('common/sidebar');  ?>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-users"></i> Add Customer</h1>
            <p>Start a beautiful journey here</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">add customers</a></li>
            </ul>
          </div>
        </div>
		<!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
		<div class="row">
			<div id="gstErrMSG" class="col-xs-12 alert"></div>
        </div>
		<div class="row">
			<div id="panErrMSG" class="col-xs-12 alert"></div>
        </div>
		<div class="row">
          <div class="col-md-12">
            <div class="card">
              <h3 class="card-title">Add customer details</h3>
              <div class="card-body">
                <form class="form-horizontal" action="<?php echo base_url('Customers/add'); ?>" method="POST">
                  <div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-md-3">First Name</label>
							<div class="col-md-9">
							  <input class="form-control" name="inpFirstName" type="text" placeholder="Enter first name" required>
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-md-3">Last Name</label>
							<div class="col-md-9">
							  <input class="form-control" name="inpLastName" type="text" placeholder="Enter last name" required>
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-md-3">Email</label>
							<div class="col-md-9">
							  <input class="form-control col-md-8" name="inpEmail" type="email" placeholder="Enter email address" required>
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-md-3">Mobile Number</label>
							<div class="col-md-9">
							  <input class="form-control col-md-8" name="inpMobNo" type="text" pattern=".{10}" placeholder="Enter Mobile Number" required>
							</div>
						  </div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
						<label class="control-label col-md-3">State</label>
						<div class="col-md-9">
						  <select class="form-control col-md-8" name="inpStateId" required>
							<?php foreach($states as $state){ 
								if($state->id == 20){ ?>
									<option value="<?php echo $state->id; ?>" selected><?php echo $state->name; ?></option>
							<?php	} else { ?>	
									<option value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
							<?php } }?>
						  </select>
						  <!-- <input class="form-control col-md-8" name="inpStateName" id="inpStateName" type="text" placeholder="Enter state" required> -->
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3">GST Number</label>
						<div class="col-md-9">
						  <input class="form-control col-md-8" name="inpGST" id="inpGST" style="text-transform:uppercase" type="text" pattern=".{15}" placeholder="Enter GST Number" onfocusout="chkGST()">
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3">PAN</label>
						<div class="col-md-9">
						  <input class="form-control col-md-8" name="inpPAN" id="inpPAN" style="text-transform:uppercase" type="text" pattern=".{10}" placeholder="Enter PAN" onfocusout="chkPAN()">
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3">Delivery Address</label>
						<div class="col-md-9">
						  <textarea class="form-control" name="inpDeliveryAddr" rows="4" placeholder="Enter your delivery address" required></textarea>
						</div>
					  </div>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-md-12 col-md-offset-5">
								<button class="btn btn-primary icon-btn" name="save" value="save" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
							</div>
						</div>
					</div>
				</div>  
              </form>
            </div>
          </div> <!-- col-md end -->
        </div> <!-- end row -->
      </div>
    </div>
    <script>     
		// check whether GST number is valid or not
		function chkGST(){
			var reggst = /^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([0-9]){1}([a-zA-Z]){1}([0-9]){1}?$/;
			var gst = $("#inpGST").val();
			if(gst==''){
				$("#gstErrMSG").css("display","none");
			}
			else if(!reggst.test(gst) && gst!=''){
				$("#gstErrMSG").css("display","block");
				$("#gstErrMSG").addClass("alert-danger");
				$("#gstErrMSG").text('GST Identification Number is not valid. It should be in this "11AAAAA1111Z1A1" format');
			}else{
				$("#gstErrMSG").css("display","block");
				$("#gstErrMSG").removeClass("alert-danger");
				$("#gstErrMSG").addClass("alert-success");
				$("#gstErrMSG").text('GST Identification Number is valid.');
			}
		}
		
		// check whether PAN number is valid or not
		function chkPAN(){
			var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
			var pan = $("#inpPAN").val();
			if(pan==''){
				$("#panErrMSG").css("display","none");
			}
			else if(!regpan.test(pan) && pan!=''){
				$("#panErrMSG").css("display","block");
				$("#panErrMSG").addClass("alert-danger");
				$("#panErrMSG").text('PAN Number is not valid. It should be in this "AAAAA1111A" format');
			}else{
				$("#panErrMSG").css("display","block");
				$("#panErrMSG").removeClass("alert-danger");
				$("#panErrMSG").addClass("alert-success");
				$("#panErrMSG").text('PAN Number is valid.');
			}
		}
    </script>
  </body>
</html>