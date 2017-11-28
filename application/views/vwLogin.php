<?php
$this->load->view('vwHeader');
?>
<div class="signup-box">
    <div class="container" >
        <div class="section"></div>
        <main >
            <?php if (isset($error) && $error != '') { ?>
                <label for="error" data-error="wrong" data-success="right"><?php echo $error; ?></label>
            <?php } ?>
            <center>    
                <div class="" style="width: 50%">
                    <form class="col s12" method="post" action="<?php echo base_url('login/do_login'); ?>"  id="front-end-login"  name="login">
                        <div class='row form-group'>
                            <div class='input-field col s12 '>
                                <input data-rule-required="true" placeholder="Enter your email" data-msg-required="Please enter email address." validEmail="true"  id="email" name="username" type="text" class="">

                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='input-field col s12 '>
                                <input id="password" placeholder="Enter your password"  name="password" data-rule-required="true" data-msg-required="Please enter password." type="password" class="">

                            </div>

                        </div>
                        
                        <div class=" row form-group box-radio">
                            <input class="with-gap" data-rule-required="true"  name="is_provider_utilizer" type="radio" value="provider" id="provider"  checked/>
                            <label for="provider"><span class="ic"><i class="fa fa-building-o" aria-hidden="true"></i></span> Work</label>
                            <input class="with-gap" data-rule-required="true"  name="is_provider_utilizer" type="radio" value="utilizer" id="utilizer"  />
                            <label for="utilizer"><span class="ic"><i class="fa fa-user" aria-hidden="true"></i></span> Hire</label>
                        </div>
                        <div class="section"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>  
                    </form>
                </div>
            </center>
            <div class="section"></div>

        </main>
    </div> 
    <div class="section"></div>
</div>  
<!--<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                                <div class="panel-heading">
                                <h3 class="panel-title">Please sign in</h3>
                                </div>
                                <div class="panel-body">
                                <form accept-charset="UTF-8" role="form">
                    <fieldset>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="E-mail" name="email" type="text">
                                        </div>
                                        <div class="form-group">
                                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                        </div>
                                        <div class="checkbox">
                                        <label>
                                                <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                                        </label>
                                    </div>
                                        <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                                </fieldset>
                                </form>
                            </div>
                        </div>
                </div>
        </div>
</div>-->
<!--
<div class="section"></div>
<main>
    <center>
        <div class="section"></div>

        <div class="section"></div>

        <div class="container">
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                <form class="col s12" method="post" action="<?php echo base_url('login/do_login'); ?>"  id="front-end-login"  name="login">
                    <div class='row'>
                        <div class='col s12'>
                        </div>
                    </div>

                    <div class='row form-group'>
                        <div class='input-field col s12 input-group'>
                            <input data-rule-required="true" data-msg-required="Please enter email address." validEmail="true"  id="email" name="username" type="text" class="">
                            <label for='email'>Enter your email</label>
                        </div>
                    </div>

                    <div class='row form-group'>
                        <div class='input-field col s12 input-group'>
                            <input class='validate' type='password' name='password' id='password' />
                            <input id="password" name="password" data-rule-required="true" data-msg-required="Please enter password." type="password" class="validate">
                            <label for='password'>Enter your password</label>
                        </div>
                        
                    </div>
                    <div class='row form-group'>
                        <label style='float: right;'>
                            <a class='pink-text' href='#!'><b>Forgot Password?</b></a>
                        </label>
                    </div>
                    <div class="section"></div>
                    <center>
                        <div class='row'>
                            <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect'>Login</button>
                        </div>
                    </center>
                    <div class="section"></div>

                </form>
            </div>
        </div>
        <div class="section"></div>
    </center>

    <div class="section"></div>
    <div class="section"></div>
</main>-->

</style>
<?php
$this->load->view('vwFooter');
?>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>front-end/auth.js"></script>
<script>
//    function validate_form() {
//        var email = $("#email").val();
//        var password = $("#password").val();
//        if (email == '') {
//            $("#email_error_message").html("Email is required!!!");
//            $("#email").focus();
//            return false;
//        } else {
//            $("#email_error_message").html("");
//        }
//        if (password == '') {
//            $("#password_error_message").html("Password is required!!!");
//            $("#password").focus();
//            return false;
//        } else {
//            $("#password_error_message").html("");
//        }
//
//        return true;
//    }

    //Wait for the DOM to be ready
    $(function () {
        // siteObjJs.frontend.authJs.init();
    });
</script>


<!--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>-->



