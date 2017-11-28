<?php
$this->load->view('vwHeader');
?>
<form action="<?php echo base_url('users/register'); ?>" method="post" name="registration_form" id="registration_form" >
    <div class="signup-box">
        <div class="container">
            <div id="signup-company">                    
                <div class="sign-form">
                    <div class="fstep step1 center-align">    
                        <div class="fs-label">
                            Is a Service Provider / Service Utilizer
                        </div>
                        <div class="box-radio">
                            <input class="with-gap" name="is_provider_utilizer" type="radio" value="provider" id="provider"  />
                            <label for="provider"><span class="ic"><i class="fa fa-building-o" aria-hidden="true"></i></span> Provider</label>
                            <input class="with-gap" name="is_provider_utilizer" type="radio" value="utilizer" id="utilizer"  />
                            <label for="utilizer"><span class="ic"><i class="fa fa-user" aria-hidden="true"></i></span> Utilizer</label>
                        </div>					
                        <div><span style="color:red;" id="is_provider_utilizer_error_message"></span></div>
                        <div class="save-button center-align">
                            <!--<button type="button" class="btn">Previous</button>--> <button type="button" class="btn step1_next" >Next</button></div>
                    </div>
                    <div class="fstep step2 center-align" style="display:none;">    
                        <div class="fs-label">
                            Is a company/individual
                        </div>
                        <div class="box-radio">
                            <input class="with-gap" name="is_company_individual" type="radio" value="company" id="company"  />
                            <label for="company"><span class="ic"><i class="fa fa-building-o" aria-hidden="true"></i></span> Company</label>
                            <input class="with-gap" name="is_company_individual" type="radio" value="individual" id="individual"  />
                            <label for="individual"><span class="ic"><i class="fa fa-user" aria-hidden="true"></i></span> Individual</label>
                        </div>					
                        <div><span style="color:red;" id="is_company_individual_error_message"></span></div>	
                        <div class="save-button center-align"><button type="button" class="btn step2_previous">Previous</button> <button type="button" class="btn step2_next">Next</button></div>
                    </div>
                    <div class="fstep step3 center-align" style="display:none;">
                        <div class="fs-label">
                            Name of the Company
                        </div>
                        <div class="row">
                            <div class="input-field col s6 offset-s3">
                                <input id="company_name" name="company_name" type="text" class="winp nr">
                                <label for="company_name">Name of the Company</label>
                            </div>
                            <div class="input-field col s6 offset-s3">
                                <span style="color:red;" id="company_name_error_message"></span>
                            </div>
                        </div>
                        <div class="save-button center-align"><button type="button" class="btn step3_previous">Previous</button> <button type="button" class="btn step3_next">Next</button></div>
                    </div>
                    <div class="fstep step4 center-align" style="display:none;">
                        <div class="fs-label">
                            Company Address
                        </div>
                        <div class="row">
                            <div class="col m8 offset-m2">
                                <div class="row">
                                    <div class="input-field s-winp col s6">
                                        <select id="country_name" name="country_name" onChange="get_states(this.value);">
                                            <option value="">Select Country</option>
                                            <?php foreach ($countries as $country) { ?>
                                                <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span style="color:red;" id="country_name_error_message"></span>
                                    </div>
                                    <div class="input-field s-winp col s6">
                                        <select name="state_name" id="state_name" class="form-control" onchange="get_cities(this.value);">
                                            <option value="">Select State</option>
                                        </select>
                                        <span style="color:red;" id="state_name_error_message"></span>
                                    </div>
                                    <div class="input-field s-winp col s6">
                                        <select name="city_name" id="city_name" class="form-control">
                                            <option value="">Select City</option>
                                        </select>
                                        <span style="color:red;" id="city_name_error_message"></span>
                                    </div>								
                                </div>
                            </div>
                            <div><span style="color:red;" id="country_name_error_message"></span></div>
                        </div>
                        <div class="save-button center-align"><button type="button" class="btn step4_previous">Previous</button> <button type="button" class="btn step4_next">Next</button></div>
                    </div>
                    <div class="fstep step5 center-align" style="display:none;">
                        <div class="fs-label">
                            Phone Number & Skill Set
                        </div>
                        <div class="row">
                            <div class="input-field col s6 offset-s3">
                                <input id="phone" name="phone" type="text" class="winp nr">
                                <label for="company_name">Phone Number</label>
                                <span style="color:red;" id="phone_error_message"></span>
                            </div>
                        </div>					
                        <div class="input-field s-winp col s6">
                            <select id="roles_of_company" name="roles_of_company[]" multiple>
                                <option value="">Select Roles Of Company</option>
                                <?php foreach ($skillsets as $skill) { ?>
                                    <option value="<?php echo $skill->id; ?>"><?php echo $skill->skill; ?></option>
                                <?php } ?>
                            </select>
                            <span style="color:red;" id="roles_of_company_error_message"></span>
                        </div>
                        <div class="save-button center-align"><button type="button" class="btn step5_previous">Previous</button> <button type="button" class="btn step5_next">Next</button></div>
                    </div>
                    <div class="fstep step6 center-align" style="display:none;">
                        <div class="fs-label">
                            Set Username & Password
                        </div>					
                        <div class="row">
                            <div class="input-field col s6 offset-s3">
                                <input id="email" name="email" type="text" class="winp nr" onChange="check_email(this.value);">
                                <label for="email">Email Id (Username)</label>
                            </div>
                            <div class="input-field col s6 offset-s3">			
                                <input id="password" name="password" type="password" class="winp nr">
                                <span style="color:red;" id="password_error_message"></span>
                                <label for="first_name2">Password</label>
                            </div>
                            <div class="input-field col s6 offset-s3">
                                <input id="repassword" name="repassword" type="password" class="winp nr">
                                <span style="color:red;" id="repassword_error_message"></span>
                                <label for="first_name2">Re Enter Password</label>
                                <span style="color:red;" id="email_error_message"></span>					
                            </div>
                        </div>
                        <div class="save-button center-align"><button type="button" class="btn step6_previous">Previous</button> <button type="button" class="btn step6_next" id="step6_next">Next</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>		
</form>

<?php
$this->load->view('vwFooter');
?>

<script>

    function check_email(emailid) {
        $.ajax({
            url: "<?php echo base_url('signup/check_email'); ?>",
            type: "post",
            data: {
                emailid: emailid
            },
            success: function (data) {
                //console.log(data);
                if (data != '') {
                    $("#email_error_message").html(data);
                    $("#email").val('')
                } else {
                    $("#email_error_message").html('');
                }
            }
        });
    }
    function validate_form() {
        var company_name = $("#company_name").val();
        var country_name = $("#country_name").val();
        var state_name = $("#state_name").val();
        var city_name = $("#city_name").val();
        var phone = $("#phone").val();
        var roles_of_company = $("#roles_of_company").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var repassword = $("#repassword").val();

        if (company_name == '') {
            $("#company_name_error_message").html("Company name is required!!!");
            $("#company_name").focus();
            return false;
        } else {
            $("#company_name_error_message").html("");
        }
        if (country_name == '') {
            $("#country_name_error_message").html("Country name is required!!!");
            $("#country_name").focus();
            return false;
        } else {
            $("#country_name_error_message").html("");
        }
        if (state_name == '') {
            $("#state_name_error_message").html("State name is required!!!");
            $("#state_name").focus();
            return false;
        } else {
            $("#state_name_error_message").html("");
        }
        if (city_name == '') {
            $("#city_name_error_message").html("City name is required!!!");
            $("#city_name").focus();
            return false;
        } else {
            $("#city_name_error_message").html("");
        }
        if (phone == '') {
            $("#phone_error_message").html("Phone number is required!!!");
            $("#phone").focus();
            return false;
        } else {
            $("#phone_error_message").html("");
        }
        if (roles_of_company == '') {
            $("#roles_of_company_error_message").html("Roles of company is required!!!");
            $("#roles_of_company").focus();
            return false;
        } else {
            $("#roles_of_company_error_message").html("");
        }
        if (email == '') {
            $("#email_error_message").html("Email is required!!!");
            $("#email").focus();
            return false;
        } else {
            $("#email_error_message").html("");
        }
        if (password == '') {
            $("#password_error_message").html("Password is required!!!");
            $("#password").focus();
            return false;
        } else {
            $("#password_error_message").html("");
        }
        if (repassword == '') {
            $("#repassword_error_message").html("Re enter password is required!!!");
            $("#repassword").focus();
            return false;
        } else {
            $("#repassword_error_message").html("");
        }
        if (password != repassword) {
            $("#repassword_error_message").html("Password and Re-Enter Password not match!!!");
            $("#repassword").focus();
            return false;
        } else {
            $("#repassword_error_message").html("");
        }

        return true;
    }
</script>

<script>
    $(".step1_next").click(function () {
        if ($('#utilizer').is(':checked') || $('#provider').is(':checked')) {
            $("#is_provider_utilizer_error_message").html("");
            $(".step1").hide();
            $(".step2").show();
        } else {
            $("#is_provider_utilizer_error_message").html("Please select at least one option!!!");
        }
    });

    $('input:radio[name="is_provider_utilizer"]').change(
            function () {
                $("#is_provider_utilizer_error_message").html("");
                $(".step1").hide();
                $(".step2").show();
            });

    $(".step2_next").click(function () {
        if ($('#company').is(':checked') || $('#individual').is(':checked')) {
            $("#is_company_individual_error_message").html("");
            $(".step2").hide();
            $(".step3").show();
        } else {
            $("#is_company_individual_error_message").html("Please select at least one option!!!");
        }
    });

    $('input:radio[name="is_company_individual"]').change(
            function () {
                $("#is_company_individual_error_message").html("");
                $(".step2").hide();
                $(".step3").show();
            });
    $(".step3_next").click(function () {
        var company_name = $("#company_name").val();
        if (company_name == '') {
            $("#company_name_error_message").html("Please enter company name!!!");
        } else {
            $("#company_name_error_message").html("");
            $(".step3").hide();
            $(".step4").show();
        }
    });
    $(".step4_next").click(function () {
        var country_name = $("#country_name").val();
        var state_name = $("#state_name").val();
        var city_name = $("#city_name").val();
        if (country_name == '') {
            $("#country_name_error_message").html("Please select country!!!");
        } else if (state_name == '') {
            $("#country_name_error_message").html("Please select state!!!");
        } else if (city_name == '') {
            $("#country_name_error_message").html("Please select city!!!");
        } else {
            $("#country_name_error_message").html("");
            $(".step4").hide();
            $(".step5").show();
        }
    });
    $(".step5_next").click(function () {
        var phone = $("#phone").val();
        var roles_of_company = $("#roles_of_company").val();
        if (phone == '') {
            $("#roles_of_company_error_message").html("Please enter phone number!!!");
        } else if (roles_of_company == '') {
            $("#roles_of_company_error_message").html("Please select roles of company!!!");
        } else {
            $("#roles_of_company_error_message").html("");
            $(".step5").hide();
            $(".step6").show();
        }
    });

    $(".step6_next").click(function () {

        var email = $("#email").val();
        var password = $("#password").val();
        var repassword = $("#repassword").val();
        if (email == '') {
            $("#email_error_message").html("Email is required!!!");
        } else if (password == '') {
            $("#password_error_message").html("Password is required!!!");
        } else if (repassword == '') {
            $("#email_error_message").html("Re enter password is required!!!");
        } else if (password != repassword) {
            $("#email_error_message").html("Password and Re-Enter Password not match!!!");
        } else {
            $("#email_error_message").html("");
            $("#registration_form").submit();
        }
    });
    $(".step2_previous").click(function () {
        $(".step1").show();
        $(".step2").hide();
    });
    $(".step3_previous").click(function () {
        $(".step2").show();
        $(".step3").hide();
    });
    $(".step4_previous").click(function () {
        $(".step3").show();
        $(".step4").hide();
    });
    $(".step5_previous").click(function () {
        $(".step4").show();
        $(".step5").hide();
    });
    $(".step6_previous").click(function () {
        $(".step5").show();
        $(".step6").hide();
    });
</script>	

