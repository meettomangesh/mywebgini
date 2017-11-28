<?php
$this->load->view('admin/vwHeader');
?>
<link href="<?php echo HTTP_CSS_PATH; ?>starter-template.css" rel="stylesheet">
 <style>
/*     .panel{
       margin-left: 55px;
       float: left;
    width: 500px;}
     */
     </style>
<div class="page-header container">
  <h1><small>Users</small></h1>
</div>
    <div class="container">
 
 <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">User List <span style='float:right; margin-top: -7px; margin-right:450px;color:#3cb102;' id="error_message"><?php if(isset($message)&& $message!=''){ echo $message; } ?></span></div>
		<?php //echo "<pre>";print_r($users);?>
        <!-- Table -->
        <table id="example" class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
			  <th>Is a company/individual</th>
              <th>Email</th>
              <th>Registration Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
			<?php 
			if(isset($users) && !empty($users)){
				$i=1;
			foreach($users as $user){ ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $user->company_name; ?></td>
			  <td><?php echo $user->is_company_individual; ?></td>
              <td><?php echo $user->email; ?></td>
              <td><?php echo date('d-m-Y h:i:sa', strtotime($user->registration_date));?></td>
              <td id="status_id_<?php echo $user->id;?>"><?php echo $user->status;?></td>
              <td>
                  <a href='<?php echo base_url('admin/users/view_user/'.$user->id);?>' title='View'> <i class="fam-zoom"></i></a>
                 <!--<a href='<?php echo base_url('admin/users/edit_user/'.$user->id);?>' title='Edit'><i class="fam-user-edit"></i></a>-->
                 <!--<a href='#' title='Block'><i class="fam-user-gray"></i></a>-->
                 <a href='javascript:void();' title='Delete' onclick="delete_user('<?php echo $user->id; ?>');"><i class="fam-user-delete"></i></a>
              </td>
            </tr>
			<?php } } ?>				
          </tbody>
        </table>
      </div>
     </div><!-- /.container -->
     <hr>
<?php
$this->load->view('admin/vwFooter');
?>
<script>
function delete_user(user_id){
	var conform = confirm("Do you want to delete user?");
	if(conform){
		$.ajax({
			url:"<?php echo base_url('admin/users/delete_user');?>",
			type:"post",
			data:{
				user_id:user_id
			},
			success: function(data){
				if(data=='1'){
					$("#error_message").html("Record deleted successfully!!!");
					$("#status_id_"+user_id).text("deleted");
				}else{
					$("#error_message").css("color","#F00");
					$("#error_message").html("Record deleted successfully!!!");
				}
			}
		});
	}
}
</script>