<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo HTTP_CSS_PATH; ?>favicon.png">
    <title>Mywebgini</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
	<link href="<?php echo HTTP_CSS_PATH; ?>multiple-select.css" rel="stylesheet">
	<link href="<?php echo HTTP_CSS_PATH; ?>sweetalert.css" rel="stylesheet">
	<link href="<?php echo HTTP_CSS_PATH; ?>style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
  </head>
<body>
    <?php
    $pg = isset($page) && $page != '' ?  $page :'home'  ;    
    ?>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">My Web Gini</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php echo  $pg =='home' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>">Home</a></li>
            <li <?php echo  $pg =='about' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>aboutus">About</a></li>
            <li <?php echo  $pg =='contact' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>contactus">Contact</a></li>
            <?php if(!$this->session->userdata('is_login')){ ?>
			<li <?php echo  $pg =='signup' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>signup">SignUp</a></li>
			<?php }else{ ?> 
			<li <?php echo  $pg =='edit_profile' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>users/edit_profile/">Edit Profile</a></li>
			<li <?php echo  $pg =='change_password' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>change_password/">Change Password</a></li>
			<?php } ?>

          </ul>
		  <?php if(!$this->session->userdata('is_login')){ ?>
          <form class="navbar-form navbar-right" action="<?php echo base_url('login/do_login');?>" method="POST">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control" name="username" id="username" required >
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password" id="password" required > 
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
		  <?php }else{ ?>
			<div class="navbar-form navbar-right">
				<span style="color:#fff;">Welcome <?php echo $this->session->userdata('company_name'); ?></span>
				<a href="<?php echo base_url('login/logout');?>" class="btn btn-success">Logout</a>
			</div>  
			  
		  <?php } ?>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
