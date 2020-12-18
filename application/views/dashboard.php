<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
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
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            <p>control panel</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Dashboard</a></li>
            </ul>
          </div>
        </div>
		<!--< ?php  $list = $this->controllerlist->getControllers();
			print_r($list); 
		?> -->
		<div class="row">
          <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="widget-small secondary"><a href="<?php echo base_url('quotations'); ?>"><i class="icon fa fa-files-o fa-3x"></i></a>
              <div class="info">
                <h4>Enquiries / Quotations</h4>
                <p><b><?php echo $rowsCount['quotations']; ?></b></p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="widget-small info"><a href="<?php echo base_url('orders'); ?>"><i class="icon fa fa-shopping-cart fa-3x"></i></a>
              <div class="info">
                <h4>Sales orders</h4>
                <p><b><?php echo $rowsCount['orders']; ?></b></p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="widget-small primary"><a href="<?php echo base_url('customers'); ?>"><i class="icon fa fa-users fa-3x"></i></a>
              <div class="info">
                <h4>Customers</h4>
                <p><b><?php echo $rowsCount['customers']; ?></b></p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="widget-small warning"><a href="<?php echo base_url('reports'); ?>"><i class="icon fa fa-pie-chart fa-3x"></i></a>
              <div class="info">
                <h4>Reports</h4>
                <p><b></b></p>
              </div>
            </div>
          </div>
		  <?php /*if($_SESSION['role']==1){ */ ?>
		  <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="widget-small danger"><a href="<?php echo base_url('users'); ?>"><i class="icon fa fa-user-circle fa-3x"></i></a>
              <div class="info">
                <h4>Users</h4>
                <p><b><?php echo $rowsCount['users']; ?></b></p>
              </div>
            </div>
          </div>
		  <?php //} ?>
        </div>
      </div>
    </div>
  </body>
</html>