<!DOCTYPE html>
<html>
    <head>      
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="images/favicon.png">
        <title>Mywebgini</title>
<!--        Font Awesome Icon Font
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        Import Google Icon Font
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        Import materialize.css
        <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>owl.carousel.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>owl.theme.default.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>animate.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>nouislider.min.css">
        Custom style.css        
        <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>style.css?ver=1.0"  media="screen,projection"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />-->
        <?php 
        $this->load->view('common/vwCSS');
        ?>
    </head>
    <?php
    $pg = (isset($page) && $page != '') ? $page : 'home';
    ?>
    <?php
    if ($pg == 'home') {
        ?>
        <body class="">
            <div class="navbar navbar-fixed">
                <nav class="main-header">
                    <div class="nav-wrapper">
                        <a href="<?php echo base_url(); ?>" class="brand-logo"><img src="<?php echo HTTP_IMAGES_PATH; ?>logo.png" alt="Mywebgini"></a>
                        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                        <ul class="right mbtn hide-on-med-and-down">
                            <?php if (!$this->session->userdata('is_login')) { ?>
                                <li><a href="<?php echo base_url('/login'); ?>" class="waves-effect waves-light btn btn-login">Login</a></li>
                                <li><a href="<?php echo base_url('/signup'); ?>" class="waves-effect waves-light btn btn-signup">Sign up</a></li>
                            <?php } else { ?> 
                                <li <?php echo $pg == 'edit_profile' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>users/edit_profile/">Edit Profile</a></li>
                                <li <?php echo $pg == 'change_password' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>change_password/">Change Password</a></li>						
                                <li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
                            <?php } ?>
                        </ul>
                        <ul class="m-menu right hide-on-med-and-down">
                            <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li><a href="<?php echo base_url('aboutus'); ?>">What we are</a></li>
                            <li><a href="javascript:void(0);">Website Service Providers</a></li> 
                            <li><a href="javascript:void(0);">Companies</a></li>
                            <li><a href="javascript:void(0);">Freelancers</a></li>
                            <li><a href="javascript:void(0);">Individual Expert</a></li>
                        </ul>
                        <ul class="side-nav" id="mobile-demo">

                        </ul>
                    </div>
                </nav>
            </div>
        <?php } else { ?>
        <body class="inner-page">
            <div class="navbar-fixed">
                <nav class="main-header">
                    <div class="nav-wrapper">
                        <a href="<?php echo base_url(); ?>" class="brand-logo"><img src="<?php echo base_url(); ?>assets/images/logo-white.png" alt="Company Name"></a>
                        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                        <ul class="right mbtn hide-on-med-and-down">
                            <li><a href="<?php echo base_url(); ?>" class="waves-effect waves-light btn btn-home"><i class="material-icons">home</i></a></li>
                            <?php if (!$this->session->userdata('is_login')) { ?>
                                <li><a href="<?php echo base_url('login'); ?>" class="waves-effect waves-light btn btn-login">Login</a></li>
                                <li><a href="<?php echo base_url('signup'); ?>" class="waves-effect waves-light btn btn-signup">Sign up</a></li>
                            <?php } else { ?> 
                                <li <?php echo $pg == 'edit_profile' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>users/edit_profile/">Edit Profile</a></li>
                                <li <?php echo $pg == 'change_password' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>change_password/">Change Password</a></li>
                                <li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
                            <?php } ?>
                        </ul>
                        <div class="search-bx">
                            <div class="search-chips"></div>
                            <a href="javascript:void(0)" class="btn-slink"><i class="fa fa-search" aria-hidden="true"></i></a>
                        </div>
                        <ul class="side-nav" id="mobile-demo"></ul>
                    </div>
                </nav>
            </div>
        <?php } ?>
        <!----------Header End--------->