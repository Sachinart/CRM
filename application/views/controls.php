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
            <h1><i class="fa fa-wrench"></i> Controls</h1>
            <p>control panel</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">controls</a></li>
            </ul>
          </div>
        </div>
		<!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
					<form class="form-horizontal" action="<?php echo base_url('controls/addEmails'); ?>" method="POST">
					  <div class="form-group">
						<label class="control-label col-md-2">Quotation Emails</label>
						<div class="col-md-8">
						  <textarea class="form-control" name="inpQuotEmails" maxlength="500" rows="2" placeholder="Enter Email id's seperated by comma (,)" required></textarea>
						</div>
					  </div>
					  <div class="row">
						  <div class="col-md-10 col-md-offset-2">
							  <!--<input type="hidden" name="quotId" value="< ?php echo $comments['quotation']->id; ?>">-->
							  <button class="btn btn-primary icon-btn" name="save" value="save" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
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