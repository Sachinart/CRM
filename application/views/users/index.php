<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
            <h1><i class="fa fa-user-circle"></i> <?php echo $title; ?></h1>
            <p>Start a beautiful journey here</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">users</a></li>
            </ul>
          </div>
        </div>
		<!-- Error Msg -->
		<?php $this->load->view('common/errmsg');  ?>
        <div class="row">
          <div class="col-md-12">
          <div class="card">
              <div class="card-body">
                <table class="table table-hover table-bordered" id="customerTable">
                  <thead>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Username</th>
                      <th>role</th>
                      <th width="75px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    foreach($results as $user){
                    ?>
                    <tr>
                        <td><?php echo $user['firstName']; ?></td> 
                        <td><?php echo $user['lastName']; ?></td>    
                        <td><?php echo $user['email']; ?></td> 
                        <td><?php echo $user['username']; ?></td> 
                        <td><?php
							if($user['role']==1)
								echo "Admin";
							else
								echo "Employee";
						?></td>
                        <td>
                          <div class="btn-group text-center">
                            <form action="<?php echo base_url('Users'); ?>" method="POST">
                              <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                              <!-- <button class="btn btn-info" type="submit" name="update" value="update"><i class="fa fa-lg fa-edit"></i></button> -->
                              <a title="Edit user" class="btn btn-info" href="<?php echo base_url('users'); ?>/edit/<?php echo $user['id']; ?>"><i class="fa fa-lg fa-edit"></i></a>
                              <!--<a title="Delete customer" class="btn btn-warning" href="< ?php echo base_url('customers'); ?>/delete/< ?php echo $user['id']; ?>"><i class="fa fa-lg fa-trash"></i></a> -->
                              <a title="Remove user" class="btn btn-warning" onclick="deleteUser(<?php echo $user['id']; ?>)"><i class="fa fa-lg fa-trash"></i></a>
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
	$('#customerTable').DataTable({
		sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>'
	});
  </script>
  <script>
  
   function deleteUser(userId){
     //a.preventDefault();

         //var form = $(a).closest('form')[0];
         //console.log(form);

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
                 			window.location.href = "<?php echo base_url('users'); ?>/delete/" + userId;
       			//swal("Deleted!", "Customer has been deleted.", "success");
           } else {
     			swal("Cancelled", "User is safe :)", "error");
       		}
       	});
   }
    

  </script>
  </body>
</html>