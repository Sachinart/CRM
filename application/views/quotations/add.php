<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* // fetch all states and put it in array
$customerList = array();
foreach($customers as $customer){
	array_push($customerList,$customer->firstName . ' ' . $customer->lastName . ' | id=' . $customer->id );
}
 */

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Quotation</title>
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
            <h1><i class="fa fa-files-o"></i> Add Quotation</h1>
            <p>Start a beautiful journey here</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">add quotation</a></li>
            </ul>
          </div>
        </div>
		<!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <h3 class="card-title">Add Quotation details</h3>
              <div class="card-body">
                <form class="form-horizontal" action="<?php echo base_url('Quotations/add'); ?>" method="POST">
                  <div class="form-group">
                    <label class="control-label col-md-3">Item</label>
                    <div class="col-md-8">
                      <input class="form-control" name="inpItem" type="text" maxlength="100" placeholder="Enter Item name" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Item Description</label>
                    <div class="col-md-8">
                      <textarea class="form-control" name="inpItemDesc" rows="4" maxlength="500" placeholder="Enter item description" required></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Quantity</label>
                    <div class="col-md-8">
                      <input class="form-control col-md-8" name="inpQuantity" id="inpQuantity" min="1" value="1" type="number" placeholder="Enter Quantity" onkeyup="setValue()" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Customer Id</label>
                    <div class="col-md-8">
						<label class="control-label"><a id="selectCustomer" onclick="showCustomerTable()">Select a customer</a></label>
						<table class="table table-hover table-striped table-bordered" id="customerTableInsideQuote">
						  <thead>
							<tr>
							  <th>Customer Name</th>
							  <th>Phone Number</th>
							  <th>Email Id</th>
							  <th width="75px">Actions</th>
							</tr>
						  </thead>
						  <tbody>
						   <?php
							foreach($customers as $customer){
							?>
							<tr>
								<td><?php echo $customer->firstName. ' ' . $customer->lastName; ?></td> 
								<td><?php echo $customer->mobNo; ?></td>    
								<td><?php echo $customer->email; ?></td>    
								<td class="text-center">
									<a title="Select Customer" class="btn btn-primary" onclick="inputCustomer(<?php echo $customer->id; ?>)">Select</a>
								</td>
							</tr>
							<?php } ?> <!-- end of loop -->
						  </tbody>
						</table>
                      <input class="form-control" name="inpCustomerId" id="inpCustomerId" type="text" required readonly>
                      <label class="control-label"><a id="changeCustomer" onclick="showCustomerTable()">Change Customer</a></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Rate</label>
                    <div class="col-md-8">
                      <input class="form-control col-md-8" name="inpRate" id="inpRate" type="number" min="0" value="0" placeholder="Enter rate" onkeyup="setValue()" required>
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="control-label col-md-3">Terms and Conditions</label>
                    <div class="col-md-8">
                      <textarea class="form-control" name="inptnc" rows="4" placeholder="Enter terms and conditions" required></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Delivery Time</label>
                    <div class="col-md-8">
                      <input class="form-control col-md-8" name="inpDeliveryTime" type="number" min="1" placeholder="Enter days" required>
                    </div>
                  </div>
				  <div class="form-group" id="cgstRow">
                    <label class="control-label col-md-3">CGST</label>
                    <div class="col-md-8">
						<div class="input-group">
						  <input class="form-control col-md-8" name="inpcgst" id="inpcgst" type="number" value="9" placeholder="Enter CGST">
						  <span class="input-group-addon">%</span>
					  </div>
                    </div>
                  </div>
				  <div class="form-group" id="sgstRow">
                    <label class="control-label col-md-3">SGST</label>
                    <div class="col-md-8">
						<div class="input-group">
						  <input class="form-control col-md-8" name="inpsgst" id="inpsgst" type="number" value="9" placeholder="Enter SGST">
						  <span class="input-group-addon">%</span>
						</div>
                    </div>
                  </div>
				  <div class="form-group" id="igstRow">
                    <label class="control-label col-md-3">IGST</label>
                    <div class="col-md-8">
						<div class="input-group">
							<input class="form-control col-md-8" name="inpigst" id="inpigst" type="number" value="9" placeholder="Enter IGST">
							<span class="input-group-addon">%</span>
						</div>
					</div>
                  </div>
				  <div class="form-group">
                    <label class="control-label col-md-3">Value</label>
                    <div class="col-md-8">
                      <input class="form-control col-md-8" name="inpOrderValue" id="inpOrderValue" min="0" value="0" type="number" placeholder="Enter value">
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="control-label col-md-3">Status</label>
                    <div class="col-md-8">
						<select class="form-control col-md-8" name="inpStatus" required>
							<option value="1" selected>Open</option>
							<option value="2">Closed</option>
						</select>
                      <!-- <input class="form-control col-md-8" name="inpStateName" id="inpStateName" type="text" placeholder="Enter state" required> -->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8 col-md-offset-3">
                      <button class="btn btn-primary icon-btn" name="save" value="save" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
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
		
		// add datatables
		$('#customerTableInsideQuote').DataTable({
			sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
			"pageLength": 5,
			"lengthChange": false
		});
		
		// Handling customer
		function showCustomerTable(){
			$("#customerTableInsideQuote_wrapper").show();
			$("#selectCustomer").hide();
		}
		
		function inputCustomer(id){
			$("#inpCustomerId").css("display","block");
			$("#inpCustomerId").val(id);
			$("#changeCustomer").show();
			$(".xdsoft_autocomplete").show();
			$("#customerTableInsideQuote_wrapper").hide();
			showGST();
		}

		
		// get all customers data in javascript var
		var customerData = <?php echo json_encode($customers); ?>;
		//console.log(customerData);
		
		// Check id and stateId of customer
		function showGST(){
			var customerId = document.getElementById('inpCustomerId').value;
			
			if($.isNumeric(customerId)){
				var found = false;
				for(var i = 0; i < customerData.length; i++) {
					if (customerData[i].id == customerId && customerData[i].stateId == 20) {
						found = true;
						break;
					}
				}
				if(found == true){ // if the customer belonged to MP, show CGST and SGST only
					$("#inpigst").val(0);
					$("#igstRow").hide();
					$("#inpcgst").val(9);
					$("#cgstRow").show();
					$("#inpsgst").val(9);
					$("#sgstRow").show();
				}else{										
					$("#inpcgst").val(0);
					$("#cgstRow").hide();					
					$("#inpsgst").val(0);
					$("#sgstRow").hide();
					$("#inpigst").val(9);
					$("#igstRow").show();					
				}
			}
			else{
				// Code to handle invalid customer name
				//document.getElementById('inpCustomerId').focus();
			}
		}
		
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