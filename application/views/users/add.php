<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add User</title>
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
            <h1><i class="fa fa-user-circle"></i> Add User</h1>
            <p>Start a beautiful journey here</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">add User</a></li>
            </ul>
          </div>
        </div>
		<!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <h3 class="card-title">Add user details</h3>
              <div class="card-body">
                <form class="form-horizontal" action="<?php echo base_url('Users/add'); ?>" method="POST">
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
							<label class="control-label col-md-3">Username</label>
							<div class="col-md-9">
							  <input class="form-control col-md-8" name="inpUserName" type="text" minlength=8 placeholder="Enter Username" required>
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-md-3">Role</label>
							<div class="col-md-9">
							  <select class="form-control col-md-8" name="inpRole" required>
									<option value="1">Admin</option>
									<option value="2">Employee</option>
							  </select>
							  <!-- <input class="form-control col-md-8" name="inpStateName" id="inpStateName" type="text" placeholder="Enter state" required> -->
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-md-3">Password</label>
							<div class="col-md-9">
							  <input class="form-control col-md-8" name="inpPassword" type="password" minlength=8 placeholder="Enter Password" required>
							</div>
						  </div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<label class="control-label col-md-12" style="text-align:left">Priviledges</label>
							</div>
							<div class="container-fluid marginer">
								<label class="col-md-3">Customer</label>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-3">
											<input name="inpCustAdd" type="checkbox" checked> Add
										</div>
										<div class="col-md-3">
											<input name="inpCustEdit" type="checkbox" checked> Edit
										</div>
										<div class="col-md-3">
											<input name="inpCustDel" type="checkbox" checked> Delete
										</div>
									</div>
								</div>
							</div>
							<div class="container-fluid marginer">
								<label class="col-md-3">Quotation</label>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-3">
											<input name="inpQuotAdd" type="checkbox" checked> Add
										</div>
										<div class="col-md-3">
											<input name="inpQuotEdit" type="checkbox" checked> Edit
										</div>
										<div class="col-md-3">
											<input name="inpQuotDel" type="checkbox" checked> Delete
										</div>
									</div>
								</div>
							</div>
							<div class="container-fluid marginer">
								<label class="col-md-3">Quotation Comment</label>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-3">
											<input name="inpQuotCmtAdd" type="checkbox" checked> Add
										</div>
										<div class="col-md-3">
											<input name="inpQuotCmtEdit" type="checkbox" checked> Edit
										</div>
										<div class="col-md-3">
											<input name="inpQuotCmtDel" type="checkbox" checked> Delete
										</div>
									</div>
								</div>
							</div>
							<div class="container-fluid marginer">
								<label class="col-md-3">Sales Order</label>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-3">
											<input name="inpOrderAdd" type="checkbox" checked> Add
										</div>
										<div class="col-md-3">
											<input name="inpOrderEdit" type="checkbox" checked> Edit
										</div>
										<div class="col-md-3">
											<input name="inpOrderDel" type="checkbox" checked> Delete
										</div>
									</div>
								</div>
							</div>
							<div class="container-fluid marginer">
								<label class="col-md-3">User</label>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-3">
											<input name="inpUserAdd" type="checkbox"> Add
										</div>
										<div class="col-md-3">
											<input name="inpUserEdit" type="checkbox"> Edit
										</div>
										<div class="col-md-3">
											<input name="inpUserDel" type="checkbox"> Delete
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12 col-md-offset-5">
								  <button class="btn btn-primary icon-btn" name="save" value="save" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
								</div>
							</div>
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
		
    </script>
  </body>
</html>