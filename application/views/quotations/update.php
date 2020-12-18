<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Took data from customers table in quotation_model

//$customerName = $fields['customer']->firstName . " " .$fields['customer']->lastName. " | id=".$fields['customer']->id;

$customerName = $customer->firstName . " " .$customer->lastName. " | id=".$customer->id;

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Quotation</title>
	<style>
		#inpCustomerId{
			display: block;
		}
	</style>
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
            <h1><i class="fa fa-files-o"></i> Update Quotation</h1>
            <p>Start a beautiful journey here</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Update Quotation</a></li>
            </ul>
          </div>
        </div>
		<!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <h3 class="card-title">Update Quotation details</h3>
              <div class="card-body">
				<form class="form-horizontal" action="<?php echo base_url('quotations/update/'.$fields->id); ?>" method="POST">
                  <div class="form-group">
                    <label class="control-label col-md-3">Item</label>
                    <div class="col-md-8">
                      <input class="form-control" name="inpItem" type="text" value="<?php echo $fields->item; ?>" placeholder="Enter Item name" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Item Description</label>
                    <div class="col-md-8">
                      <textarea class="form-control" name="inpItemDesc" rows="4" placeholder="Enter item description" required><?php echo $fields->itemDesc; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Quantity</label>
                    <div class="col-md-8">
                      <input class="form-control col-md-8" name="inpQuantity" id="inpQuantity" type="number" min="1" value="<?php echo $fields->quantity; ?>" onkeyup="setValue()" placeholder="Enter Quantity" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Customer Name</label>
                    <div class="col-md-8">
					  <input class="form-control col-md-8" name="inpCustomerId" id="inpCustomerId" value="<?php echo $customer->id; ?>" type="text" required readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Rate</label>
                    <div class="col-md-8">
                      <input class="form-control col-md-8" name="inpRate" id="inpRate" style="text-transform:uppercase" min="0" type="number" value="<?php echo $fields->rate; ?>" onkeyup="setValue()" placeholder="Enter rate">
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="control-label col-md-3">Terms and Conditions</label>
                    <div class="col-md-8">
                      <textarea class="form-control" name="inptnc" rows="4" placeholder="Enter terms and conditions" required><?php echo $fields->tnc; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Delivery Time</label>
                    <div class="col-md-8">
                      <input class="form-control col-md-8" name="inpDeliveryTime" type="number" min="1" value="<?php echo $fields->deliveryTime; ?>" placeholder="Enter days">
                    </div>
                  </div>
				  <?php if($customer->stateId == 20) { ?>
					  <div class="form-group">
						<label class="control-label col-md-3">CGST</label>
						<div class="col-md-8">
						  <input class="form-control col-md-8" name="inpcgst" type="number" value="<?php echo $fields->cgst; ?>" placeholder="Enter CGST">
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3">SGST</label>
						<div class="col-md-8">
						  <input class="form-control col-md-8" name="inpsgst" type="number" value="<?php echo $fields->sgst; ?>" placeholder="Enter SGST">
						</div>
					  </div>
				  <?php } else { ?>
					  <div class="form-group">
						<label class="control-label col-md-3">IGST</label>
						<div class="col-md-8">
						  <input class="form-control col-md-8" name="inpigst" type="number" value="<?php echo $fields->igst; ?>" placeholder="Enter IGST">
						</div>
					  </div>
				  <?php } ?>
				  <div class="form-group">
                    <label class="control-label col-md-3">Value</label>
                    <div class="col-md-8">
                      <input class="form-control col-md-8" name="inpOrderValue" id="inpOrderValue" type="number" value="<?php echo $fields->orderValue; ?>" placeholder="Enter IGST">
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="control-label col-md-3">Status</label>
                    <div class="col-md-8">
						<select class="form-control col-md-8" name="inpStatus" required>
						<?php if($fields->status == "1"){ ?>
							<option value="1" selected>Open</option>
							<option value="2">Closed</option>
						<?php } else { ?>
							<option value="1">Open</option>
							<option value="2" selected>Closed</option>
						<?php } ?>
						</select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8 col-md-offset-3">
					  <input type="hidden" name="id" value="<?php echo $fields->id; ?>"/>
                      <button class="btn btn-primary icon-btn" name="update" value="update" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                    </div>
                  </div>
                </form>  
              </div>
            </div>

          </div> <!-- col-md end -->
        </div> <!-- end row -->
      </div>
    </div>
	<script>
	// to calculate value
		function setValue(){
			var quantity = $("#inpQuantity").val();
			var rate	 = $("#inpRate").val();
			var value	 = parseInt(quantity)*parseInt(rate);
			$("#inpOrderValue").val(value);	
		}
	
	</script>	
  </body>
</html>