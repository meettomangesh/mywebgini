<?php
$this->load->view('vwHeader');
?>
<div class="page-header container">
    <h1><small>Dashboard</small></h1>
</div>

<?php
if (isset($users) && !empty($users)) {
    foreach ($users as $user) {
        //echo "<pre>";print_r($user);print_r($members);print_r($skills);die;
        ?>

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
                                                    <img src="<?php echo HTTP_IMAGES_PATH . (!empty($user->photo) ? $user->photo : 'no-pre.png'); ?>" height="100" width="100"style="border-radius: 50%;" >
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
                                    <div class="section"></div>
                                    <div class="shead mb5"><span><i class="fa fa-file-image-o" aria-hidden="true"></i> Portfolio</span></div>
                                    <ul class="collapsible collapsible-accordion collection with-header" data-collapsible="accordion">
                                        
                                        <?php
                                        foreach ($enquiry as $val) {
                                            ?>
                                                    
                                            <li class="">
                                                <div class="collapsible-header"><?php echo $val->enquiry_title; ?>
                                                    
                                                    <a href="#" class="secondary-content"><i class="mdi-action-launch"></i></a>
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
            <?php }
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
            </div><div class="section"></div>
        </div>

        <?php
    }
}
?>

<?php
$this->load->view('vwFooter');
?>