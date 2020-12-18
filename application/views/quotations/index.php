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
            <h1><i class="fa fa-files-o"></i> Enquiries / Quotations</h1>
            <p>control panel</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">quotations</a></li>
            </ul>
          </div>
        </div>
		<!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
				<table class="table table-hover table-striped table-bordered" id="quotationTable">
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
                        <td><?php 
							if($quote['status']==1){
								echo "Open";
							}else{
								echo "Closed";
							}
						?></td> 
                        <td class="text-center">
                          <div class="btn-group">
                            <form action="<?php echo base_url('quotations'); ?>" method="POST">
                              <input type="hidden" name="id" value="<?php echo $quote['id']; ?>">
                              <?php if($quote['status']!=1){ ?>
								<a title="Convert to Sales" class="btn btn-default disabled" href="<?php echo base_url('orders'); ?>/add/<?php echo $quote['id']; ?>"><i class="fa fa-lg fa-exchange"></i></a>
							  <?php }else{ ?>
								<a title="Convert to Sales" class="btn btn-default" href="<?php echo base_url('orders'); ?>/add/<?php echo $quote['id']; ?>"><i class="fa fa-lg fa-exchange"></i></a>
							  <?php } ?>
							  <a title="Comments" class="btn btn-primary" href="<?php echo base_url('quotations'); ?>/comments/<?php echo $quote['id']; ?>"><i class="fa fa-lg fa-comments"></i></a>
                              <a title="Edit Quotation" class="btn btn-info" href="<?php echo base_url('quotations'); ?>/edit/<?php echo $quote['id']; ?>"><i class="fa fa-lg fa-edit"></i></a>
                              <a title="Remove Quotation" class="btn btn-warning" onclick="deleteQuotation(<?php echo $quote['id']; ?>)"><i class="fa fa-lg fa-trash"></i></a>
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