<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo HTTP_CSS_PATH; ?>favicon.png">
    <title></title>
    <!-- Bootstrap core CSS -->
    <!--<link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">-->
	<link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	
	<link href="<?php echo HTTP_CSS_PATH; ?>jquery.dataTables.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
     <link href="<?php echo HTTP_CSS_PATH; ?>fam-icons.css" rel="stylesheet">
  </head>
<body>
    <?php
    $pg = isset($page) && $page != '' ?  $page :'dash'  ;    
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
            <li <?php echo  $pg =='dash' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
            <li <?php echo  $pg =='user' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/users">Users</a></li>
            <li <?php echo  $pg =='skillset' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/skillset">Skillset</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Location<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>admin/countries">Country</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>admin/states">State</a></li>
				<li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>admin/cities">City</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url();?>admin/change_password">Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>admin/home/logout">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
