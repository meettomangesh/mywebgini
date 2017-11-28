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
  <h1><small>Skillsets</small></h1>
</div>
    <div class="container">
 
 <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Skillset List <span style='margin-top: -7px; margin-right:450px;color:#3cb102;margin-left: 280px;' id="error_message"><?php if(isset($message)&& $message!=''){ echo $message; } ?></span>
		<span style="float:right; margin-top: -7px;"><a href="<?php echo base_url('admin/skillset/add_skillset');?>" class="btn btn-default" >Add Skillset</a></span>
		</div>
		<?php //echo "<pre>";print_r($skillsets);?>
        <!-- Table -->
        <table id="example" class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Skillset</th>
			  <th>Parent Skillset</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
			<?php 
			if(isset($skillsets) && !empty($skillsets)){
				$i=1;
			foreach($skillsets as $skillset){ ?>
            <tr id="row_id_<?php echo $skillset->id; ?>">
              <td><?php echo $i++; ?></td>
              <td><?php echo $skillset->skill; ?></td>
			  <td><?php echo $skillset->parent_id; ?></td>
              <td>
                 <a href='<?php echo base_url('admin/skillset/edit_skillset/'.$skillset->id);?>' title='Edit'><i class="fam-user-edit"></i></a>
                 <!--<a href='#' title='Block'><i class="fam-skillset-gray"></i></a>-->
                 <a href='javascript:void();' title='Delete' onclick="delete_skillset('<?php echo $skillset->id; ?>');"><i class="fam-user-delete"></i></a>
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
function delete_skillset(skillset_id){
	var conform = confirm("Do you want to delete skillset?");
	if(conform){
		$.ajax({
			url:"<?php echo base_url('admin/skillset/delete_skillset');?>",
			type:"post",
			data:{
				skillset_id:skillset_id
			},
			success: function(data){
				if(data=='1'){
					$("#error_message").html("Record deleted successfully!!!");
					$("#row_id_"+skillset_id).html("");
				}else{
					$("#error_message").css("color","#F00");
					$("#error_message").html("Error in record delete!!!");
				}
			}
		});
	}
}
</script>