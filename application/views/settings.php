<?php 
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    
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
            <h1><i class="fa fa-cog"></i> Settings</h1>
            <p>control panel</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">settings</a></li>
            </ul>
          </div>
        </div>
		<!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
				  <div class="form-group">
					<div class="col-md-12">
					  <label class="control-label col-md-12">
					  <h3>Change Password</h3>
					  <hr style="padding:1px;">
					  </label>
					</div>
				  </div>
				<form autocomplete="off" class="form-horizontal" action="<?php echo base_url('Settings/changePass'); ?>" method="POST">
                  <div class="form-group">
                    <label class="control-label col-md-3">Password</label>
                    <div class="col-md-8">
                      <input class="form-control" name="inpPassword" type="password" placeholder="Enter password" autocomplete="new-password" minlength=8 required>
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="control-label col-md-3">Confirm Password</label>
                    <div class="col-md-8">
                      <input class="form-control" name="inpConfirmPassword" type="password" placeholder="Enter confirm password" minlength=8 required>
                    </div>
                  </div>
				  <div class="row">
                    <div class="col-md-8 col-md-offset-3">
						<input type="hidden" name="id" value="<?php echo $id; ?>"/>
						<button class="btn btn-primary icon-btn" name="save" value="save" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                    </div>
                  </div>
				</form>
			  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>