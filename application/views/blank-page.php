<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// cust is associative array that contain key as customer ID and value as customer name
$cust = array();
foreach($customers as $customer){
	$cust[$customer->id] = $customer->firstName .' '. $customer->lastName;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font-icon css-->
    <title>Quotations</title>
    
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
            <h1><i class="fa fa-dashboard"></i>Enquiries / Quotations</h1>
            <p>control panel</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">quotations</a></li>
            </ul>
          </div>
        </div>
		<?php 
		if(isset($rtnMsg)&&$rtnMsg!=""&!empty($rtnMsg)){
		?>
		<div class="row">
		<div class="col-xs-12 alert alert-<?php if($success){ echo "success";} else { echo "danger"; }?> padding-right" style="margin-left: 15px;"><strong><?php echo $rtnMsg; ?></strong></div>
		</div>
		<?php } ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
				<table class="table table-hover table-bordered" id="quotationTable">
                  <thead>
                    <tr>
                      <th>Item</th>
                      <th>Quantity</th>
                      <th>Customer Name</th>
                      <th>Rate</th>
                      <th>Delivery Time</th>
					  <th>Status</th>
                      <th width="75px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    foreach($results as $quote){
                    ?>
                    <tr>
                        <td><?php echo $quote['item']; ?></td> 
                        <td><?php echo $quote['quantity']; ?></td>    
                        <td>
						<?php // fetch customer name from quote['customerId']
							foreach($cust as $key => $value) {
								  if($key==$quote['customerId'])
									  echo $value;
							}						
						?>
						</td> 
                        <td><?php echo $quote['rate']; ?></td> 
                        <td><?php echo $quote['deliveryTime']; ?></td> 
                        <td><?php echo $quote['status']; ?></td> 
                        <td>
                          <div class="btn-group text-center">
                            <form action="<?php echo base_url('Quotations'); ?>" method="POST">
                              <input type="hidden" name="id" value="<?php echo $quote['id']; ?>">
                              <!-- <button class="btn btn-info" type="submit" name="update" value="update"><i class="fa fa-lg fa-edit"></i></button> -->
                              <a title="Edit Quotation" class="btn btn-info" href="<?php echo base_url('quotations'); ?>/edit/<?php echo $quote['id']; ?>"><i class="fa fa-lg fa-edit"></i></a>
                              <a title="Remove Quotation" class="btn btn-warning" onclick="deleteQuotation(<?php echo $quote['id']; ?>)"><i class="fa fa-lg fa-trash"></i></a>
                              <!-- <button class="btn btn-warning" type="submit" name="delete" value="delete"><i class="fa fa-lg fa-trash"></i></button> -->
                              <!--<a class="btn btn-warning" onclick="deleteCustomer(this); return false;" name="delete"><i class="fa fa-lg fa-trash"></i></a>-->
                            </form>
                          </div>
                        </td>
                    </tr>
                    <?php } ?> <!-- end of loop -->
                  </tbody>
                </table>
			  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	<script type="text/javascript">
	$('#quotationTable').DataTable({
		sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>'
	});
	</script>
	<script>
  
   function deleteQuotation(quotationId){
     //a.preventDefault();

         //var form = $(a).closest('form')[0];
         //console.log(form);

       	swal({
       		title: "Are you sure?",
       		text: "You will not be able to recover this data!",
       		type: "warning",
       		showCancelButton: true,
       		confirmButtonText: "Yes, remove it!",
       		cancelButtonText: "No, cancel!",
       		closeOnConfirm: false,
       		closeOnCancel: false
       	}, function(isConfirm) {
       		if (isConfirm) {
               
		   //console.log("isConfirm" + isConfirm);
                 			window.location.href = "quotations/remove/" + quotationId;
       			//swal("Deleted!", "Customer has been deleted.", "success");
           } else {
     			swal("Cancelled", "Quotation is safe :)", "error");
       		}
       	});
   }
  </script>
  </body>
</html>