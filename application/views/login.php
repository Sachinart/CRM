<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(isset($validate)){
		echo "<style>
		#showMsg{
			display: block !important;
		}
		</style>";
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>CRM</h1>
      </div>
      <div class="login-box">
        <form class="login-form" action="<?php echo base_url('login/auth'); ?>" method="POST">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
          <div class="form-group">
            <label class="control-label">USERNAME</label>
            <input class="form-control" type="text" name="username" placeholder="Username" autofocus required>
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" type="password" name="password" placeholder="Password" required>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" type="submit" name="loginBtn"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
		  <div class="alert alert-danger" id="showMsg" style="margin-top:10px; display: none;">
			<?php if(isset($validate)){ echo $validate; }?>
		  </div>
        </form>
      </div>
    </section>
  </body>
</html>