<?php
$this->load->view('vwHeader');
?>

<link href="http://demo.geekslabs.com/materialize/v2.2/layout03/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
<link href="http://demo.geekslabs.com/materialize/v2.2/layout03/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
<link href="http://demo.geekslabs.com/materialize/v2.2/layout03/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
<link href="http://demo.geekslabs.com/materialize/v2.2/layout03/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">

<!--  <link href="<?php echo HTTP_CSS_PATH; ?>_grid.css" type="text/css" rel="stylesheet" media="screen,projection">
 
  <link href="<?php echo HTTP_CSS_PATH; ?>_icons-material-design.css" type="text/css" rel="stylesheet" media="screen,projection">-->
<!--  <link href="http://demo.geekslabs.com/materialize/v2.2/layout03/sass/components/_grid.scss" type="text/css" rel="stylesheet/scss" media="screen,projection">
 
  <link href="http://demo.geekslabs.com/materialize/v2.2/layout03/sass/components/_icons-material-design.scss" type="text/css" rel="stylesheet/scss" media="screen,projection">
-->
<!--<div class="page-header container">
    <h1><small>Dashboard</small></h1>
</div>-->

<?php
if (isset($users) && !empty($users)) {
    foreach ($users as $user) {
        //echo "<pre>";print_r($user);print_r($members);print_r($skills);
        //$skills
        // die;

        /* Dashboard
          stdClass Object
          (
          [id] => 7
          [is_provider_utilizer] => provider
          [is_company_individual] => company
          [company_name] => Infosys
          [email] => info@infosys.com
          [phone] => 020676767
          [years_of_experience] => 0
          [turn_over] =>
          [website] => http://google.com
          [about_company] => Established in 1981, Infosys is a NYSE listed global consulting and IT services company with more than 198,000 employees. ... We pioneered the Global Delivery Model and became the first IT Company from India to be listed on NASDAQ
          [no_of_employee] => 0
          [photo] => img1.jpg
          [password] => f478c486ac5f4d0443bca5a13c83f8be
          [referral_code] => XR8MGL
          [status] => active
          [registration_date] => 2017-09-11 21:44:19
          [extra_emailid] =>
          [extra_phone] =>
          [landmark] =>
          [address] =>
          [country] =>
          [state] =>
          [city] =>
          [country_ids] =>
          [state_ids] =>
          [city_ids] =>
          [latitude] =>
          [longitude] =>
          [as_head_office] =>
          [address_id] =>
          ) */
        ?>
        <!--
                <div class="signup-box">
                    <div class="container">
                        <div id="signup-company">
                            <div class="top-head">
                                <h3><i class="fa fa-briefcase" aria-hidden="true"></i> <?php if ($user->is_company_individual == 'company') { ?>Company <?php } else { ?> Individual<?php } ?> Profile</h3>
                                <p>Hey, it's easier than it looks. Take a deeep breath and complete the fields below. You'll have a beautiful page!</p>
                            </div>
                            <div class="sign-form">
                                <div class="row">
                                    <div class="col s6">
                                        <div class="row">
                                            <div class=" col s12">
                                                <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                                                <label for="first_name2">Name of the Company :</label>
                                                <label><?php echo $user->company_name; ?></label>
                                            </div>
                                            <div class=" col s12">
                                                <label for="first_name2">Website :</label>
                                                <label><?php echo $user->website; ?></label>
                                            </div>									
                                            <div class=" col s6">
                                                <label for="emailid">Email :</label>
                                                <label><?php echo $user->email; ?></label>
                                            </div>
                                            <div class=" col s6">
                                                <label for="extra_phone">Phone :</label>
                                                <label><?php echo $user->phone; ?></label>
                                            </div>
                                            <div class=" s-winp col s6">
                                                <label for="no_of_employee">No of employee : </label>
                                                <label><?php echo $user->no_of_employee; ?></label>
                                            </div>
                                            <div class=" s-winp col s6">
                                                <label for="years_of_experience">Year Established :</label>
                                                <label><?php echo $user->years_of_experience; ?></label>
                                            </div>
                                            <div class="col s4">
                                                <div class="up-logo">
                                                    <label>Company Logo</label>
                                                    <div class="logo-box">									
        <?php if (isset($user->photo) && $user->photo != '') { ?>
                                                                            <img src="<?php echo base_url('images/' . $user->photo); ?>" height="100" width="100"style="border-radius: 50%;" >
        <?php } ?>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col s8">
                                                <div class=" ab-comp">
                                                    <label for="textarea1">About your company :</label>
                                                    <label><?php echo $user->about_company; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s6">
                                        <div>
        <?php
        $extra_emailid = explode("|", $user->extra_emailid);
        $extra_phone = explode("|", $user->extra_phone);
        $landmark = explode("|", $user->landmark);
        $address = explode("|", $user->address);
        $ctry = explode("|", $user->country);
        $ste = explode("|", $user->state);
        $cty = explode("|", $user->city);
        $ctry_ids = explode("|", $user->country_ids);
        $ste_ids = explode("|", $user->state_ids);
        $cty_ids = explode("|", $user->city_ids);
        $latitude = explode("|", $user->latitude);
        $longitude = explode("|", $user->longitude);
        $as_head_office = explode("|", $user->as_head_office);
        $address_id = explode("|", $user->address_id);

        if (isset($ctry) && count($ctry) > 0) {
            for ($i = 0; $i < count($ctry); $i++) {
                ?>
                                                                                    <div class="add-box locationRow" id="locationRow_<?php echo ($i + 1); ?>">
                                                                                        <input type="checkbox" class="filled-in" id="as_head_office_<?php echo ($i + 1); ?>" name="as_head_office[]" <?php
                if ($as_head_office[$i] == 'yes') {
                    echo "checked";
                }
                ?> />
                                                                                        <label for="as_head_office">Headoffice</label>
                                                                                        <div class="row">
                                                                                            <div class=" col s12">
                                                                                                <label for="address">Address :</label>
                                                                                                <label><?php echo $address[$i]; ?></label>
                                                                                            </div>
                                                                                            <div class=" s-winp col s6">

                                                                                                <label for="country_name">Country :</label>
                <?php foreach ($countries as $country) { ?>
                                                                                                                    <label>
                    <?php
                    if ($ctry_ids[$i] == $country->id) {
                        echo $country->name;
                    }
                    ?>
                                                                                                                    </label>
                <?php } ?>                        
                                                                                            </div>
                                                                                            <div class=" s-winp col s6">
                                                                                                <label for="state_name">State :</label> 
                                                                                                <label><?php echo $ste[$i]; ?></label>
                                                                                            </div>										
                                                                                            <div id="city_<?php echo ($i + 1); ?>" class=" s-winp col s6">
                                                                                                <label for="city_name">City :</label> 
                                                                                                <label><?php echo $cty[$i]; ?></label>
                                                                                            </div>
                                                                                            <div class=" col s6">
                                                                                                <label for="landmark">Landmark :</label>
                                                                                                <label><?php echo $landmark[$i]; ?></label>
                                                                                            </div>
                                                                                            <div class=" col s6">
                                                                                                <label for="extra_emailid">Email :</label>
                                                                                                <label><?php echo $extra_emailid[$i]; ?></label>
                                                                                            </div>
                                                                                            <div class=" col s6">
                                                                                                <label for="extra_phone">Phone :</label>
                                                                                                <label><?php echo $extra_phone[$i]; ?></label>
                                                                                            </div>
                                                                                        </div>						

                                                                                    </div>
                <?php
            }
        }
        ?>
                                        </div>                               
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s6 mt20">
                                        <div class="shead mb5"><span><i class="fa fa-user" aria-hidden="true"></i> Key Members </span></div>
        <?php
        if (isset($members) && count($members) > 0) {
            for ($i = 0; $i < count($members); $i++) {
                ?>
                                                                                <div class="memberRow" id="memberRow_<?php echo ($i + 1); ?>">
                                                                                    <div class="row key-mem">
                                                                                        <div class="col s4">
                                                                                            <div class="up-logo">
                                                                                                <label>Photo</label>
                                                                                                <div class="logo-box">
                <?php if ($members[$i]->member_image != '') { ?>
                                                                                                                        <img src="<?php echo base_url('images/members/' . $this->session->userdata('member_id') . '/' . $members[$i]->member_image); ?>" alt="<?php echo $members[$i]->member_name; ?>">
                <?php } else { ?>
                                                                                                                        <img src="<?php echo base_url('images/members/default-member.jpg'); ?>" alt="">
                <?php } ?>
                                                                                                </div>									
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col s8">
                                                                                            <div class="">
                                                                                                <label for="member_name">Name :</label>
                                                                                                <label><?php echo $members[$i]->member_name; ?></label>
                                                                                            </div>
                                                                                            <div class="">
                                                                                                <label for="member_designation">Designation :</label>
                                                                                                <label><?php echo $members[$i]->member_designation; ?></label>
                                                                                            </div>
                                                                                            <div class=" ab-brif">
                                                                                                <label for="member_description">About your company :</label>
                                                                                                <label><?php echo $members[$i]->member_description; ?></label>
                                                                                            </div>
                                                                                        </div>  
                                                                                    </div>
                                                                                </div>
                <?php
            }
        }
        ?>		

                                    </div>
                                    <div class="col s6 mt20">
                                        <div class="shead mb5"><span><i class="fa fa-file-image-o" aria-hidden="true"></i> Portfolio</span></div>
        <?php
        if (isset($portfolios) && count($portfolios) > 0) {
            for ($i = 0; $i < count($portfolios); $i++) {
                ?>
                                                                                <div class="row key-portfolio portfolioRow" id="portfolioRow_<?php echo ($i + 1); ?>">
                                                                                    <div class="col s12">
                                                                                        <div class="">
                                                                                            <label for="portfolio_url">Project URL :</label>
                                                                                            <label><?php echo $portfolios[$i]->portfolio_url; ?></label>
                                                                                        </div>
                                                                                        <div class="">
                                                                                            <label for="portfolio_features">Features / Functions You Deployed : </label>
                                                                                            <label><?php echo $portfolios[$i]->portfolio_features; ?></label>
                                                                                        </div>
                                                                                        <div class=" ab-brif">
                                                                                            <label for="portfolio_description[]">Project description :</label>
                                                                                            <label><?php echo $portfolios[$i]->portfolio_description; ?></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                <?php
            }
        }
        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s6 mt20">
                                        <div class="shead"><span><i class="fa fa-cog" aria-hidden="true"></i> Services Offered  </span></div>
                                        <div class="service-list">
        <?php
        $user_skill = array_column($skills, 'roles_of_company');
        $no_of_projects = array_column($skills, 'no_of_projects');
        $rates_to_role = array_column($skills, 'rates_to_role');
        $role_ids = array_column($skills, 'id');
        $rates_to_role_combine = array_combine($user_skill, $rates_to_role);
        $no_of_projects_combine = array_combine($user_skill, $no_of_projects);
        ?>

        <?php foreach ($skillsets as $skill) { ?>						
            <?php if (in_array($skill->id, $user_skill)) { ?>
                                                                                    <label><?php echo $skill->skill; ?></label>
            <?php } ?>						
        <?php } ?>

                                        </div>
                                    </div>
                                    <div class="col s6 mt20">                               
                                        <div class="shead"><span><i class="fa fa-globe" aria-hidden="true"></i> Service Proficiency </span>	
                                            <div class="website-pro2">
                                                <table class="responsive-table" id="skill_table">
                                                    <thead>
                                                        <tr>
                                                            <th width="44%">Select Languages</th>
                                                            <th width="28%">Competency Level Out of 10</th>
                                                            <th width="28%">Number of Projects Executed</th>
                                                        </tr>
                                                    </thead>                            
                                                    <tbody>

        <?php
        if (isset($skillsets) && count($skillsets) > 0) {
            for ($i = 0; $i < count($skillsets); $i++) {
                ?>

                <?php if (in_array($skillsets[$i]->id, $user_skill)) { ?>  
                                                                                                                    <tr><td><?php echo $skillsets[$i]->skill; ?></td>
                <?php } ?>
                <?php for ($k = 1; $k <= 10; $k++) { ?>
                    <?php if (in_array($skillsets[$i]->id, $user_skill)) { ?><?php if ($k == $rates_to_role_combine[$skillsets[$i]->id]) { ?> 
                                                                                                                                                                <td><?php echo $k; ?></td>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>

                <?php for ($k = 1; $k <= 10; $k++) { ?>
                    <?php if (in_array($skillsets[$i]->id, $user_skill)) { ?>
                        <?php if ($k == $no_of_projects_combine[$skillsets[$i]->id]) { ?>
                                                                                                                                                                <td><?php echo $k; ?></td>
                        <?php } ?>	
                    <?php } ?>
                <?php } ?>									  
                <?php if (isset($no_of_projects_combine[$skillsets[$i]->id]) && '11' == $no_of_projects_combine[$skillsets[$i]->id]) { ?>
                                                                                                                        <td><?php echo "More than 10"; ?></td></tr>
                <?php } ?>

                <?php
            }
        }
        ?>		
                                                    </tbody>
                                                </table>			  
                                            </div>

                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section"></div>
                </div>

        <?php
    }
}
?>
-->
<!-- START CONTENT -->
<section id="content">        

    <!--start container-->
    <div class="container">

        <div id="profile-page" class="section">
            <!-- profile-page-header -->
            <div id="profile-page-header" class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="http://demo.geekslabs.com/materialize/v2.2/layout03/images/user-profile-bg.jpg" alt="user background">                    
                </div>
                <figure class="card-profile-image">
                    <img src="<?php echo HTTP_IMAGES_PATH . (!empty($user->photo) ? $user->photo : 'no-pre.png'); ?>" alt="profile image" class="circle z-depth-2 responsive-img activator">
                </figure>
                <div class="card-content">
                    <div class="row">                    
                        <div class="col s3 offset-s2">                        
                            <h4 class="card-title grey-text text-darken-4"><?php echo $user->utilizer_name; ?></h4>
                            <p class="medium-small grey-text"></p>                        
                        </div>
                        <div class="col s2 center-align">
                            <h4 class="card-title grey-text text-darken-4"><?php echo 'N/A' ?>+</h4>
                            <p class="medium-small grey-text">Work Experience</p>                        
                        </div>
                        <div class="col s2 center-align">
                            <h4 class="card-title grey-text text-darken-4"><?php echo 'N/A' ?></h4>
                            <p class="medium-small grey-text">Completed Projects</p>                        
                        </div>                    
                        <div class="col s2 center-align">
                            <h4 class="card-title grey-text text-darken-4"><?php echo 'N/A'; ?> </h4>
                            <p class="medium-small grey-text">Business Profit</p>                        
                        </div>                    
                        <div class="col s1 right-align">
                            <a class="btn-floating activator waves-effect waves-light darken-2 right">
                                <i class="fa mdi-action-perm-identity"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-reveal">
                    <p>
                        <span class="card-title grey-text text-darken-4"><?php echo $user->utilizer_name; ?> <i class="mdi-navigation-close right"></i></span>
                        <span><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Project Manager</span>
                    </p>

                    <p><?php echo 'N/A' ?></p>

                    <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> <?php echo $user->phone; ?></p>
                    <p><i class="mdi-communication-email cyan-text text-darken-2"></i> <?php echo $user->email; ?></p>
                    <p><i class="mdi-social-cake cyan-text text-darken-2"></i> 18th June 1990</p>
                    <p><i class="mdi-device-airplanemode-on cyan-text text-darken-2"></i> BAR - AUS</p>
                </div>
            </div>
            <!--/ profile-page-header -->

            <!-- profile-page-content -->
            <div id="profile-page-content" class="row">
                <!-- profile-page-sidebar-->
                <div id="profile-page-sidebar" class="col s12 m4">
                    <!-- Profile About  -->
                    <div class="card light-blue">
                        <div class="card-content white-text">
                            <span class="card-title">About Me!</span>
                            <p><?php echo 'N /A'; ?></p>
                        </div>                  
                    </div>
                    <!-- Profile About  -->

                    <!-- Profile About Details  -->
                    <ul id="profile-page-about-details" class="collection z-depth-1">
                        <li class="collection-item">
                            <div class="row">
                                <div class="col s5 grey-text darken-1"><i class="mdi-action-wallet-travel"></i> Project</div>
                                <div class="col s7 grey-text text-darken-4 right-align">ABC Name</div>
                            </div>
                        </li>
                        <li class="collection-item">
                            <div class="row">
                                <div class="col s5 grey-text darken-1"><i class="mdi-social-poll"></i> Skills</div>
                                <div class="col s7 grey-text text-darken-4 right-align">HTML, CSS</div>
                            </div>
                        </li>
                        <li class="collection-item">
                            <div class="row">
                                <div class="col s5 grey-text darken-1"><i class="mdi-social-domain"></i> Lives in</div>
                                <div class="col s7 grey-text text-darken-4 right-align">NY, USA</div>
                            </div>
                        </li>
                        <li class="collection-item">
                            <div class="row">
                                <div class="col s5 grey-text darken-1"><i class="mdi-social-cake"></i> Birth date</div>
                                <div class="col s7 grey-text text-darken-4 right-align">18th June, 1991</div>
                            </div>
                        </li>
                    </ul>
                    <!--/ Profile About Details  -->

                    <!-- Profile About  -->
                    <div class="card amber darken-2">
                        <div class="card-content white-text center-align">
                            <p class="card-title"><i class="mdi-social-group-add"></i> 3685</p>
                            <p>Followers</p>
                        </div>                  
                    </div>
                    <!-- Profile About  -->

                    <!-- Profile feed  -->
                    <ul id="profile-page-about-feed" class="collection z-depth-1">
                        <li class="collection-item avatar">
                            <img src="http://demo.geekslabs.com/materialize/v2.2/layout03/images/avatar.jpg" alt="" class="circle">
                            <span class="title">Project Title</span>
                            <p>Task assigned to new changes.
                                <br> <span class="ultra-small">Second Line</span>
                            </p>
                            <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-file-folder circle"></i>
                            <span class="title">New Project</span>
                            <p>First Line of Project Work 
                                <br> <span class="ultra-small">Second Line</span>
                            </p>
                            <a href="#!" class="secondary-content"><i class="mdi-social-domain"></i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-action-assessment circle green"></i>
                            <span class="title">New Payment</span>
                            <p>Last UK Project Payment
                                <br> <span class="ultra-small">$ 3,684.00</span>
                            </p>
                            <a href="#!" class="secondary-content"><i class="mdi-editor-attach-money"></i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-av-play-arrow circle red"></i>
                            <span class="title">Latest News</span>
                            <p>company management news
                                <br> <span class="ultra-small">Second Line</span>
                            </p>
                            <a href="#!" class="secondary-content"><i class="mdi-action-track-changes"></i></a>
                        </li>
                    </ul>
                    <!-- Profile feed  -->

                    <!-- task-card -->
                    <!--                    <ul id="task-card" class="collection with-header">
                                            <li class="collection-header cyan">
                                                <h4 class="task-card-title">My Task</h4>
                                                <p class="task-card-date">March 26, 2015</p>
                                            </li>
                                            <li class="collection-item dismissable">
                                                <input type="checkbox" id="task1" />
                                                <label for="task1">Create Mobile App UI. <a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                                                </label>
                                                <span class="task-cat teal">Mobile App</span>
                                            </li>
                                            <li class="collection-item dismissable">
                                                <input type="checkbox" id="task2" />
                                                <label for="task2">Check the new API standerds. <a href="#" class="secondary-content"><span class="ultra-small">Monday</span></a>
                                                </label>
                                                <span class="task-cat purple">Web API</span>
                                            </li>
                                            <li class="collection-item dismissable">
                                                <input type="checkbox" id="task3" checked="checked" />
                                                <label for="task3">Check the new Mockup of ABC. <a href="#" class="secondary-content"><span class="ultra-small">Wednesday</span></a>
                                                </label>
                                                <span class="task-cat pink">Mockup</span>
                                            </li>
                                            <li class="collection-item dismissable">
                                                <input type="checkbox" id="task4" checked="checked" disabled="disabled" />
                                                <label for="task4">I did it !</label>
                                                <span class="task-cat cyan">Mobile App</span>
                                            </li>
                                        </ul>-->
                    <!-- task-card -->

                    <!-- Profile Total sell -->
                    <div class="card center-align">
                        <div class="card-content purple white-text">
                            <p class="card-stats-title"><i class="mdi-editor-attach-money"></i>Your Profit</p>
                            <h4 class="card-stats-number">$8990.63</h4>
                            <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 70% <span class="purple-text text-lighten-5">last month</span>
                            </p>
                        </div>
                        <div class="card-action purple darken-2">
                            <div id="sales-compositebar"></div>
                        </div>
                    </div>

                    <!-- flight-card -->
                    <div id="flight-card" class="card">
                        <div class="card-header amber darken-2">
                            <div class="card-title">
                                <h4 class="flight-card-title">Your Next Flight</h4>
                                <p class="flight-card-date">June 18, Thu 04:50</p>
                            </div>
                        </div>
                        <div class="card-content-bg white-text">
                            <div class="card-content">
                                <div class="row flight-state-wrapper">
                                    <div class="col s5 m5 l5 center-align">
                                        <div class="flight-state">
                                            <h4 class="margin">LDN</h4>
                                            <p class="ultra-small">London</p>
                                        </div>
                                    </div>
                                    <div class="col s2 m2 l2 center-align">
                                        <i class="mdi-device-airplanemode-on flight-icon"></i>
                                    </div>
                                    <div class="col s5 m5 l5 center-align">
                                        <div class="flight-state">
                                            <h4 class="margin">SFO</h4>
                                            <p class="ultra-small">San Francisco</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s6 m6 l6 center-align">
                                        <div class="flight-info">
                                            <p class="small"><span class="grey-text text-lighten-4">Depart:</span> 04.50</p>
                                            <p class="small"><span class="grey-text text-lighten-4">Flight:</span> IB 5786</p>
                                            <p class="small"><span class="grey-text text-lighten-4">Terminal:</span> B</p>
                                        </div>
                                    </div>
                                    <div class="col s6 m6 l6 center-align flight-state-two">
                                        <div class="flight-info">
                                            <p class="small"><span class="grey-text text-lighten-4">Arrive:</span> 08.50</p>
                                            <p class="small"><span class="grey-text text-lighten-4">Flight:</span> IB 5786</p>
                                            <p class="small"><span class="grey-text text-lighten-4">Terminal:</span> C</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- flight-card -->
                    <!-- Map Card -->
                    <div class="map-card">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <div id="map-canvas" data-lat="40.747688" data-lng="-74.004142"></div>
                            </div>
                            <div class="card-content">                    
                                <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                                    <i class="mdi-maps-pin-drop"></i>
                                </a>
                                <h4 class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Company Name LLC</a>
                                </h4>
                                <p class="blog-post-content">Some more information about this company.</p>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">Company Name LLC <i class="mdi-navigation-close right"></i></span>                   
                                <p>Here is some more information about this company. As a creative studio we believe no client is too big nor too small to work with us to obtain good advantage.By combining the creativity of artists with the precision of engineers we develop custom solutions that achieve results.Some more information about this company.</p>
                                <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Manager Name</p>
                                <p><i class="mdi-communication-business cyan-text text-darken-2"></i> 125, ABC Street, New Yourk, USA</p>
                                <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +1 (612) 222 8989</p>
                                <p><i class="mdi-communication-email cyan-text text-darken-2"></i> support@geekslabs.com</p>                    
                            </div>
                        </div>
                    </div>
                    <!-- Map Card -->

                </div>
                <!-- profile-page-sidebar-->

                <!-- profile-page-wall -->
                <div id="profile-page-wall" class="col s12 m8">
                    <!-- profile-page-wall-share -->
                    <div id="profile-page-wall-share" class="row">
                        <div class="col s12">
                            <ul class="tabs tab-profile z-depth-1 light-blue">
                                <li class="tab col s3">
                                    <a class="white-text waves-effect waves-light" href="#addEnquiryDiv"><i class="mdi-editor-border-color"></i> Add Enquiry</a>
                                </li>
                                <li id="edit-enquiry" class="tab col s3 hide" >
                                    <a class="white-text waves-effect waves-light" href="#editEnquiryDiv"><i class="mdi-editor-border-color"></i> Edit Enquiry</a>
                                </li>
                            </ul>

                            <!-- UpdateStatus-->
                            <div id="addEnquiryDiv" class="tab-content col s12 z-depth-1">
                                <form class="col s12" name="add-enquiry" id="add-enquiry" action="<?php echo base_url('dashboard/addEnquiry'); ?>" method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                                    <div class="row">
                                        <div class="col s2">
                                            <img src="<?php echo HTTP_IMAGES_PATH . (!empty($user->photo) ? $user->photo : 'no-pre.png'); ?>" alt="" class="circle responsive-img valign profile-image-post">
                                        </div>
                                        <div class="input-field col s10">
                                            <input id="enquiry_title" data-rule-required="true" name="enquiry_title" type="text"  class="validate">
                                            <label for="enquiry_title">What's on your mind?</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s2"></div>
                                        <div class="input-field col s10">
                                            <select id="skill" data-rule-required="true" name="skill[]" class="validate" multiple>
                                                <option value="0">Select Skill</option>
                                                <?php foreach ($skillsets as $skill) { ?>
                                                    <option value="<?php echo $skill->id; ?>"><?php echo $skill->skill; ?></option>
                                                <?php } ?>
                                            </select>
                                            <label for="skill">Select Skill</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s2"></div>
                                        <div class="input-field col s10">
                                            <textarea id="description" data-rule-required="true" name="description" class="materialize-textarea" length="250"></textarea>
                                            <label for="description">Descriptions</label>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 right-align">
                                        <!-- Dropdown Trigger -->
                                        <button class="btn waves-effect waves-light " type="submit" name="action"><i class="mdi-maps-rate-review left"></i>Post
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div id="editEnquiryDiv" class="tab-content col s12 z-depth-1">
                                
                            </div>
                        </div>
                    </div>
                    <!--/ profile-page-wall-share -->

                    <!-- profile-page-wall-posts -->
                    <div id="profile-page-wall-posts"class="row">
                        <div id='replacableEnquiryUl' class="col s12">
                            <!-- small -->
                            <!-- #enquiry -->
                            <ul class="collapsible collapsible-accordion collection with-header" data-collapsible="accordion">
                                <li class="collection-header cyan">
                                    <h4 class="task-card-title">My Task</h4>
                                    <p class="task-card-date"><?php echo date('F d, Y'); ?></p>
                                </li>

                                <?php
                                foreach ($enquiry as $val) {
                                    ?>
                                    <li class="">
                                        <div class="collapsible-header"><?php echo $val->enquiry_title . ' ' . (($val->status == 1) ? '<span class="task-cat teal">Open</span>' : '<span class="task-cat pink">Closed</span>'); ?>
                                            <a href="javascript:void(0)" data-is-provider-utilizer="utilizer" data-enquiry-id="<?php echo $val->id;?>" data-utilizer-id ="<?php echo $user->id; ?>" class="secondary-content edit-enquiry"><i class="mdi-editor-border-color"></i></a>
                                            <a data-enquiry-id="<?php echo $val->id;?>" data-is-provider-utilizer="utilizer" data-utilizer-id ="<?php echo $user->id; ?>" href="javascript:void(0);" class="secondary-content view-enquiry"><i class="mdi-action-launch"></i></a>
                                        </div>
                                        <div class="collapsible-body" style="display: none;">
                                            <p><?php echo $val->enquiry_text; ?></p>
                                        </div
                                    </li>

                                    <?php
                                }
                                ?>
                            </ul>

                        </div>                  
                    </div>
                    <!--/ profile-page-wall-posts -->

                </div>
                <!--/ profile-page-wall -->

            </div>
        </div>
    </div>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <nav class="red">
                <div class="nav-wrapper">
                    <div class="left col s12 m5 l5">
                        <ul>
                            <li><a href="#!" class="email-menu"><i class="modal-action modal-close  mdi-hardware-keyboard-backspace"></i></a>
                            </li>
                            <li><a href="#!" class="email-type">Compose</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col s12 m7 l7 hide-on-med-and-down">
                        <ul class="right">
                            <li><a href="javascript:void(0);"><i class="modal-action modal-close  mdi-content-send"></i></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>
        </div>
        <div class="model-email-content">
            <div class="row">
                <form class="col s12" name="add-enquiry" id="add-enquiry" action="<?php echo base_url('dashboard/addEnquiry'); ?>" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="enquiry_title" data-rule-required="true" name="enquiry_title" type="text"  class="validate">
                            <label for="enquiry_title">To</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select id="skill" data-rule-required="true" name="skill" class="validate" multiple>
                                <option value="0">Select Skill</option>
                                <?php foreach ($skillsets as $skill) { ?>
                                    <option value="<?php echo $skill->id; ?>"><?php echo $skill->skill; ?></option>
                                <?php } ?>
                            </select>
                            <label for="skill">Select Skill</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="description" data-rule-required="true" name="description" class="materialize-textarea" length="250"></textarea>
                            <label for="description">Descriptions</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--end container-->
</section>
<!-- END CONTENT -->

<?php
$this->load->view('vwFooter');
?>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>front-end/dashboard.js"></script>
<script>
    $(function () {
        siteObjJs.frontend.dashboardJS.init();
    });
</script>
