<?php
$this->load->view('vwHeader');
?>
 <style>
/*     .panel{
       margin-left: 55px;
       float: left;
    width: 500px;}
     */
	 form-signin{
		max-width: 330px;
		padding: 15px;
		margin: 0 auto;
	 }
     </style>
<div class="container" style="margin-top:100px;">	
		
        <form class="form-signin panel" method="post" action="<?php echo base_url(); ?>change_password/update_password" style="max-width: 330px;padding: 15px;margin: 0 auto;" onsubmit="return check_validation();">
        <h2 class="form-signin-heading">Change password</h2>
		<?php if(isset($error) && $error!=''){ ?>
		<label class="alert alert-danger" style="width:300px;">
			 <?php echo $error; ?>
        </label>
		<?php } ?>
		<?php if(isset($error_message) && $error_message!=''){ ?>
		<label class="alert alert-success" style="width:300px;">
			 <?php echo $error_message; ?>
        </label>
		<?php } ?>
		<label class="alert alert-danger" id="valid_password" style="display:none;width:300px;"></label>
        <input type="password" class="form-control" placeholder="New password" name="new_password" id="new_password" autofocus required>
        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required>  
		<div>&nbsp;</div>
        <button class="btn btn-primary" type="submit">Change Password</button>
      </form>
    </div> <!-- /container -->

<?php
$this->load->view('vwFooter');
?>
<script>
function check_validation(){
	var new_password = $("#new_password").val();
	var confirm_password = $("#confirm_password").val();
	if(new_password==confirm_password){
		return true;
	}else{
		$("#valid_password").show();
		$("#valid_password").html("New password & confirm password not match!!!");;
		return false;
	}	
}
</script>
