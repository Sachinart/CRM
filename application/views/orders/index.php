<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Orders</title>
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
            <h1><i class="fa fa-shopping-cart"></i> Sales Orders</h1>
            <p>Start a beautiful journey here</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Sales orders</a></li>
            </ul>
          </div>
        </div>
		<!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
		<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
				<table class="table table-hover table-striped table-bordered" id="orderTable">
                  <thead>
                    <tr>
                      <th>Quotation Id</th>
                      <th>Status</th>
                      <th>Creation time</th>
                      <th>Creation date</th>
                      <th width="75px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    foreach($results as $order){
                    ?>
                    <tr>
                        <td><?php echo $order['quotId']; ?></td> 
                        <td><?php 
							if($order['status']==1){
								echo "Open";
							}else{
								echo "Closed";
							}
						?></td>    
                        <td><?php echo getLocalTime($order['creationDate'],'h:i:sa'); ?></td>
                        <td><?php echo getLocalTime($order['creationDate'],'d-m-Y'); ?></td>
                        <td class="text-center"><div class="btn-group">
                            <form action="customers" method="POST">
                              <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                              <a title="View Quotation" class="btn btn-primary" href="<?php echo base_url('quotations'); ?>/edit/<?php echo $order['quotId']; ?>"><i class="fa fa-lg fa-eye"></i></a>
                              <a title="Edit order" class="btn btn-info" href="<?php echo base_url('orders'); ?>/edit/<?php echo $order['id']; ?>"><i class="fa fa-lg fa-edit"></i></a>
                              <a title="Remove order" class="btn btn-warning" onclick="removeOrder(<?php echo $order['id']; ?>)"><i class="fa fa-lg fa-trash"></i></a>
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
	$('#orderTable').DataTable({
		sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>'
	});
	
	
	function removeOrder(orderId){
   
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
                 window.location.href = "<?php echo base_url('orders'); ?>/remove/" + orderId;
       			//swal("Deleted!", "Customer has been deleted.", "success");
           } else {
     			swal("Cancelled", "Order is safe :)", "error");
       		}
       	});
   }
	
  </script>
  </body>
</html>