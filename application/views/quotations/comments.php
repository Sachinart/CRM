<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// cust is associative array that contain key as customer ID and value as customer name
$cust = array();
$customerName = '';
$customerId = $comments['quotation']->customerId;
foreach($comments['customers'] as $customer){
	if($customer['id']==$customerId)
		$customerName = $customer['firstName'] . ' ' . $customer['lastName'];
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font-icon css-->
    <title>Comments</title>
    
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
            <h1><i class="fa fa-files-o"></i> Quote Comments</h1>
            <p>control panel</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Comments</a></li>
            </ul>
          </div>
		</div>
        <!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
				<div class="row">
					<label class="control-label col-md-12">Quotation name: <?php echo $comments['quotation']->item; ?></label>
					<label class="control-label col-md-12">Customer name: <?php echo $customerName; ?></label>
				</div>
				<hr>
				<?php if(isset($quotCmt)) { ?>
					<form class="form-horizontal" action="<?php echo base_url('quotations/updateComment/'.$comments['quotation']->id.'/'.$quotCmt->id); ?>" method="POST">
					  <div class="form-group">
						<label class="control-label col-md-2">Update Comment</label>
						<div class="col-md-8">
						  <textarea class="form-control" name="inpQuotComment" maxlength="1000" rows="4" placeholder="Enter Comment" required><?php echo $quotCmt->comments; ?></textarea>
						</div>
					  </div>
					  <div class="row">
						  <div class="col-md-10 col-md-offset-2">
							  <input type="hidden" name="quotId" value="<?php echo $comments['quotation']->id; ?>">
							  <input type="hidden" name="quotCmtId" value="<?php echo $quotCmt->id; ?>">
							  <button class="btn btn-primary icon-btn" name="update" value="update" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
						  </div>
					  </div>
					</form>
				<?php } else { ?>
					<form class="form-horizontal" action="<?php echo base_url('quotations/addComment'); ?>" method="POST">
					  <div class="form-group">
						<label class="control-label col-md-2">Add Comment</label>
						<div class="col-md-8">
						  <textarea class="form-control" name="inpQuotComment" maxlength="1000" rows="4" placeholder="Enter Comment" required></textarea>
						</div>
					  </div>
					  <div class="row">
						  <div class="col-md-10 col-md-offset-2">
							  <input type="hidden" name="quotId" value="<?php echo $comments['quotation']->id; ?>">
							  <button class="btn btn-primary icon-btn" name="save" value="save" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
						  </div>
					  </div>
					</form>
				<?php } ?>
				<hr>
				<div class="row">
				<label class="control-label col-md-3"><h3>Comments</h3></label>
				<div class="col-md-12">
					<table id="commentTable" class="table table-hover table-striped table-bordered">
					  <thead>
						<tr>
						  <th>Comment</th>
						  <th>Time</th>
						  <th>Date</th>
						  <th>Actions</th> 
						</tr>
					  </thead>
					  <tbody>
					<?php
						foreach($comments['quotCmts'] as $comment){
					?>
						<tr>
							<td><?php echo $comment->comments; ?></td>
							<td><?php echo getLocalTime($comment->creationDate,'h:i:sA'); ?></td>
							<!--<td>< ?php echo getLocalTime($comment->creationDate,'h:i:s.uA'); ?></td>-->
							<td><?php echo getLocalTime($comment->creationDate,'d-m-Y'); ?></td>
							<td class="text-center">
							  <div class="btn-group">
								<form action="<?php echo base_url('Quotations'); ?>" method="POST">
								  <input type="hidden" name="id" value="<?php echo $comment->id; ?>">
								  <a title="Edit Comment" class="btn btn-info" href="<?php echo base_url('quotations'); ?>/editComment/<?php echo $comment->quotId; ?>/<?php echo $comment->id; ?>"><i class="fa fa-lg fa-edit"></i></a>
								  <a title="Delete Comment" class="btn btn-warning" onclick="deleteComment(<?php echo $comment->quotId; ?>,<?php echo $comment->id; ?>)"><i class="fa fa-lg fa-trash"></i></a>
								  <!--<a class="btn btn-warning" onclick="deleteCustomer(this); return false;" name="delete"><i class="fa fa-lg fa-trash"></i></a>-->
								</form>
							  </div>
							</td>
						</tr>
					<?php 
						}
					?>
					  </tbody>
					</table>
					</div>
				</div>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	<script type="text/javascript">
	$('#commentTable').DataTable({
		sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>'
	});
	
	function deleteComment(QuotId,QuotCmtId){
     //a.preventDefault();
       	swal({
       		title: "Are you sure?",
       		text: "You will not be able to recover this data!",
       		type: "warning",
       		showCancelButton: true,
       		confirmButtonText: "Yes, delete it!",
       		cancelButtonText: "No, cancel!",
       		closeOnConfirm: false,
       		closeOnCancel: false
       	}, function(isConfirm) {
       		if (isConfirm) {
             
		   //console.log("isConfirm" + isConfirm);
                 			window.location.href = "<?php echo base_url('quotations'); ?>/deleteComment/" + QuotId + "/" + QuotCmtId;
       			//swal("Deleted!", "Customer has been deleted.", "success");
           } else {
     			swal("Cancelled", "Comment is safe :)", "error");
       		}
       	});
   }
	</script>
	
  </body>
</html>