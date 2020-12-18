<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update User</title>
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
            <h1><i class="fa fa-user-circle"></i> Update User</h1>
            <p>Start a beautiful journey here</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Update User</a></li>
            </ul>
          </div>
        </div>
		<!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <h3 class="card-title">Update user details</h3>
              <div class="card-body">
                <form class="form-horizontal" action="<?php echo base_url('Users/update/'.$fields->id); ?>" method="POST">
                  <div class="form-group">
                    <label class="control-label col-md-3">First Name</label>
                    <div class="col-md-8">
                      <input class="form-control" name="inpFirstName" value="<?php echo $fields->firstName; ?>" type="text" placeholder="Enter first name" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Last Name</label>
                    <div class="col-md-8">
                      <input class="form-control" name="inpLastName" value="<?php echo $fields->lastName; ?>" type="text" placeholder="Enter last name" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Email</label>
                    <div class="col-md-8">
                      <input class="form-control col-md-8" name="inpEmail" value="<?php echo $fields->email; ?>" type="email" placeholder="Enter email address" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Role</label>
                    <div class="col-md-8">
						<select class="form-control col-md-8" name="inpRole">
						<?php if($fields->role == "1") {?>
							<option value="1" selected>Admin</option>
							<option value="2">Employee</option>
						<?php } else { ?>
							<option value="1">Admin</option>
							<option value="2" selected>Employee</option>
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
  </body>
</html>