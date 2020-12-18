<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Order</title>
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
            <h1><i class="fa fa-shopping-cart"></i> Add Sales Order</h1>
            <p>control panel</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">add sales orders</a></li>
            </ul>
          </div>
        </div>
		<!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <h3 class="card-title">Add Sales Order details</h3>
              <div class="card-body">
                <form class="form-horizontal" action="<?php echo base_url('Orders/add')."/".$quotId; ?>" method="POST">
                  <div class="form-group">
                    <label class="control-label col-md-3">Quotation Id</label>
                    <div class="col-md-8">
                      <input class="form-control" name="inpQuotId" type="number" value="<?php echo $quotId; ?>" placeholder="Enter Quot ID" required readonly>
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="control-label col-md-3">Status</label>
                    <div class="col-md-8">
						<select class="form-control col-md-8" name="inpStatus" required>
							<option value="1" selected>Open</option>
							<option value="2">Closed</option>
						</select>
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
		/* var states  = [];
		states = <?php echo json_encode($stateList); ?>;
		//console.log(states);
		
		// autocomplete for states
		$(function() {
		  $("#inpStateName").autocomplete({
			source:[states]
		  }); 
		}); */
    </script>
  </body>
</html>