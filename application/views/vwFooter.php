<div id="search-overlay-loader"></div>
<div id='loading-box'>            
    <div id="search-loader"></div>
</div>
<!-----Footer Start----->
<div class="signup-strip">
    <div class="container">
        <div class="row">
            <a class="btn-flat wow right zoomIn" data-wow-delay="0.4s">Join Us Today!</a>
            <div class="su-txt wow fadeIn" data-wow-delay="0.2s">Are you a professional freelancer looking for better Projects?</div>
        </div>
    </div>
</div>
<div class="pad-box skdir-box">
    <div class="container">
        <h4 class="gr-head">Skills Directory</h4>
        <div class="skdir-links">
            <?php
            
           // pre($footer_skills);
            if (isset($footer_skills) && !empty($footer_skills)) {
                foreach ($footer_skills as $footer_skill) {
                   
             ?>
            <a href="javascript:getRedirectParam('skills','<?php echo $footer_skill['skill'];?>')"><?php echo $footer_skill['skill'];?></a>
            <?php
                }
            }
            ?>
           
        </div>
    </div>
</div>        
<footer class="page-footer">
    <div class="pad-box footer-link">
        <div class="container">
            <div class="row">
                <div class="col s5">
                    <h5 class="t-up">FIND FREELANCERS BY LOCATION</h5>
                    <ul class="row">
                        <li class="col s6"><a href="javascript:getRedirectParam('country','India');">Freelancers In India</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('state','Noida');">Freelancers in Noida</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('city','Mumbai');">Freelancers in Mumbai</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('city','Kolkata');">Freelancers in Kolkata</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('city','Bangalore');">Freelancers in Bangalore</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('city','Ahmedabad');">Freelancers In Ahmedabad</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('city','New Delhi');">Freelancers In New Delhi</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('city','Jaipur');">Freelancers in Jaipur</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('city','Bhopal');">Freelancers in Bhopal</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('city','Punjab');">Freelancers in Punjab</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('city','Chennai');">Freelancers In Chennai</a></li>
                    </ul>
                    <div class="see-more"><a href="javascript:void(0);">See more!</a></div>
                </div>
                <div class="col s5">
                    <h5 class="t-up">FIND COMPANIES BY EXPERTISE</h5>
                    <ul class="row">
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','Developers & Programmers');">Developers &amp; Programmers</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','PHP Programmers');">PHP Developers</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','Graphic Designers');">Graphic Designers</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','Photoshop Designers');">Photoshop Experts</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','Article Writing');">Article Writers</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','Creative Writing');">Creative Writing</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','Data Entry');">Data Entry &amp; Admin</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','MS Excel Consultants');">MS Excel Consultants</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','Sales & Marketing');">Sales &amp; Marketing</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','Internet Marketing');">Internet Marketing</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','Accountants & Legal');">Accountants &amp; Legal</a></li>
                        <li class="col s6"><a href="javascript:getRedirectParam('skills','Finance Consultant');">Finance Consultant</a></li>
                    </ul>
                    <div class="see-more"><a href="javascript:void(0);">See more!</a></div>
                </div>
                <div class="col s2">
                    <h5>Need Help?</h5>
                    <ul>
                        <li><a href="javascript:void(0);">Write a Review</a></li>
                        <li><a href="<?php echo base_url(); ?>contactus">Contact Us</a></li>
                        <li><a href="javascript:void(0);">How we work?</a></li>
                        <li><a href="javascript:void(0);">Complaints</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Copyright © 2017 Your Company Name.com.. All Rights Reserved.
        </div>
    </div>
</footer>

<!--Import jQuery before materialize.js-->
<!--<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>siteobj.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>materialize.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>wow.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>custom.js"></script>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>custom-validation.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>-->
<?php
$this->load->view('common/vwJS');
?>
<script>
    $("#advance_search_btn").on("click", function () {
        //$("#simple_search_form").hide();
        //$("#advance_search_btn").hide();
        //$("#advance_search_form").show();
        //$("#simple_search_btn").show();
        $("#simple_search_form").addClass('hide');
        $("#advance_search_form").removeClass('hide');
        $("#simple_search_btn").removeClass('hide');
        $("#advance_search_btn").addClass('hide');
        $('#search_form')[0].reset();
        activeSearchForm = 'advance_search_form';
    });
    $("#simple_search_btn").on("click", function () {
//        $("#advance_search_form").hide();
//        $("#simple_search_btn").hide();
//        $("#simple_search_form").show();
//        $("#advance_search_btn").show();
        $("#advance_search_form").addClass('hide');
        $("#simple_search_form").removeClass('hide');
        $("#simple_search_btn").addClass('hide');
        $("#advance_search_btn").removeClass('hide');

        $('#search_form')[0].reset();
        activeSearchForm = 'simple_search_form';
    });
    function get_states(country_id) {
        $.ajax({
            url: "<?php echo base_url('states/get_states'); ?>",
            type: "post",
            data: {
                country_id: country_id
            },
            success: function (data) {
                $("#state_name").empty().html('');
                $("#state_name").append(data);
                $('#state_name').material_select();
            }
        });
    }
    function get_states_by_name(country_name) {
        $.ajax({
            url: "<?php echo base_url('states/get_states_by_name'); ?>",
            type: "post",
            data: {
                country_name: country_name
            },
            success: function (data) {
                $("#state_name").empty().html('');
                $("#state_name").append(data);
                $('#state_name').material_select();
            }
        });
    }

    function get_cities(state_name) {
        $.ajax({
            url: "<?php echo base_url('cities/get_cities_by_name'); ?>",
            type: "post",
            data: {
                state_name: state_name
            },
            success: function (data) {
                $("#city_name").empty().html('');
                $("#city_name").append(data);
                $('#city_name').material_select();
            }
        });
    }
</script>
</body>
</html>