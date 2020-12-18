<script>
$('body').swiperight(function(){
	//$(this).carousel('prev');
	$(this).addClass('sidebar-open');
});
$('body').swipeleft(function(){
	//$(this).carousel('next');
	$(this).removeClass('sidebar-open');
});
</script>

<aside class="main-sidebar hidden-print">
<section class="sidebar">
    <div class="user-panel">
    <div class="pull-left image"><img class="img-circle" src="<?php echo base_url('inc/images/user.png'); ?>" alt="User Image"></div>
    <div class="pull-left info">
        <p><?php echo $_SESSION['name']; ?></p>
        <p class="designation">
		<?php
			if($_SESSION['role']==1){
				echo "Admin";
			}else{
				echo "Employee";
			}
		?>
		</p>
    </div>
    </div>
    <!-- Sidebar Menu-->
    <ul class="sidebar-menu">
    <li class="<?php echo activate_menu('dashboard'); ?>"><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
    <li class="treeview <?php echo activate_menu('quotations'); echo activate_menu('quotations/add'); ?>"><a href="#"><i class="fa fa-files-o"></i><span>Enquiries / Quotations</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
        <li><a href="<?php echo base_url('quotations'); ?>"><i class="fa fa-hand-o-right"></i>Quotations list</a></li>
        <li><a href="<?php echo base_url('quotations/add'); ?>"><i class="fa fa-hand-o-right"></i>Add Quotations</a></li>
        </ul>
    </li>
	<li class="<?php echo activate_menu('orders'); ?>"><a href="<?php echo base_url('orders'); ?>"><i class="fa fa-shopping-cart"></i><span>Sales order</span></a></li>
    <li class="treeview <?php echo activate_menu('customers'); echo activate_menu('customers/add'); ?>"><a href="#"><i class="fa fa-users"></i><span>Customers</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
        <li><a href="<?php echo base_url('customers'); ?>"><i class="fa fa-hand-o-right"></i>Customers list</a></li>
        <li><a href="<?php echo base_url('customers/add'); ?>"><i class="fa fa-hand-o-right"></i>Add Customer</a></li>
        </ul>
    </li>
    <li class="<?php echo activate_menu('reports'); ?>"><a href="<?php echo base_url('reports'); ?>"><i class="fa fa-pie-chart"></i><span>Reports</span></a></li>
	<li class="treeview <?php echo activate_menu('users'); echo activate_menu('users/add'); ?>"><a href="#"><i class="fa fa-user-circle"></i><span>Users</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
        <li><a href="<?php echo base_url('users'); ?>"><i class="fa fa-hand-o-right"></i>Users list</a></li>
        <li><a href="<?php echo base_url('users/add'); ?>"><i class="fa fa-hand-o-right"></i>Add User</a></li>
        </ul>
    </li>
	<?php if($_SESSION['role']==1) { ?>
		<li class="<?php echo activate_menu('controls'); ?>"><a href="<?php echo base_url('controls'); ?>"><i class="fa fa-wrench"></i><span>Control Parameters</span></a></li>
	<?php } ?>
</ul>
</section>
</aside>