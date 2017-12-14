<div class="search-con">
    <div class="container">
        <div class="search-hbox">
            <h4 class="center-align wow zoomIn">Your world of website development companies & service providers</h4>
            <form action="<?php echo base_url('search'); ?>" method="post" name="search_form" id="search_form">
                <div>
                    <div class="search-inb wow fadeInUp" data-wow-delay="0.6s">
                        <div id="simple_search_form">
                            <div class="row mb-0">
                                <div class="input-field col s7">
                                    <div class="rel">
                                        <div placeholder="Graphic, UI, Mobile, UX" type="text" class="chips chips-autocomplete"></div>
                                    </div>
                                </div>
                                <div class="input-field col s5">
                                    <input id="country" name="country_name[]" type="text" placeholder="Location" class="blackPlaceHolder winp">
                                </div>
                            </div>	
                        </div>	
                        <div id="advance_search_form" class="hide">
                            <div class="row mb-0">
                                <div class="input-field col s7">
                                    <div class="rel">
                                        <div placeholder="Graphic, UI, Mobile, UX" type="text" class="chips chips-autocomplete"></div>
                                    </div>
                                </div>
                                <div class="input-field col s5">
                                    <select id="country_name" name="country_name[]" onChange="get_states(this.value);">
                                        <option value="">Select Country</option>
                                        <?php foreach ($countries as $country) { ?>
                                            <option value="<?php echo $country->name; ?>"><?php echo $country->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="input-field col s7">
                                    <select name="state_name" id="state_name" class="form-control" onchange="get_cities(this.value);">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                <div class="input-field col s5">
                                    <select name="city_name" id="city_name" class="form-control">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="input-field col s4">
                                    <select name="is_company_individual" id="is_company_individual" class="form-control" >
                                        <option value="">Who want to search</option>
                                        <option value="company">Company</option>
                                        <option value="individual">Individual</option>
                                        <option value="both">Both</option>
                                    </select>
                                </div>
                                <div class="input-field col s4">
                                    <input id="no_of_employee" name="no_of_employee" type="text" placeholder="Number of employee" class="blackPlaceHolder winp">
                                </div>
                                <div class="input-field col s4">
                                    <input id="no_of_year_expericance" name="no_of_year_expericance" type="text" placeholder="Number of year experiance" class="blackPlaceHolder winp">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-slink"><i class="fa fa-search" aria-hidden="true" onclick="submit_search_form();"></i></button>

                    </div>

                </div>

                <input type="hidden" value="" name="skills" id="skills">
            </form>
            <div class="advance-search wow fadeInUp" data-wow-delay="0.6s">                  	
                <a id="advance_search_btn" class="btn right btn-large waves-effect">Advance Search</a>
                <a id="simple_search_btn" class="btn right btn-large waves-effect hide" >Simple Search</a>
                <ul>
                    <li>Browse All Freelancers by Experience</li>
                    <li>Browse All Freelancers by Rates</li>
                    <li>Browse All Freelancers by Skills</li>
                </ul>
            </div>
        </div>
    </div>
    <!--<div class="parallax"><img src="<?php echo HTTP_IMAGES_PATH; ?>search-bg.jpg"></div>-->

</div>