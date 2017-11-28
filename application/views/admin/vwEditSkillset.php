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
        <div class="panel-heading">Edit Skillset Details <span style='float:right; margin-top: -7px;'><a class="btn btn-info" href="<?php echo base_url('admin/skillset/');?>">Back</a></span></div>
		<form action="<?php echo base_url();?>admin/skillset/update_skillset" method="post">
		
        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Titles</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
			<?php 
			if(isset($skillsets) && !empty($skillsets)){
			foreach($skillsets as $skillset){ ?>
            <tr>
              <td>Parent Skillset</td>
			  <td>
			  <input type="hidden" name="skillset_id" value="<?php echo $skillset->id;?>">
			  <select name="parent_skillset[]" id="parent_skillset" class="form-control" multiple>
					<option value="0" <?php if($skillset->parent_id==0) echo "selected"; ?>>Select Parent Skillset</option>
					<?php foreach($skills as $skill){ 
					$skillset_ids = explode(",",$skillset->parent_id);
					?>
						<option value="<?php echo $skill->id;?>" <?php if(in_array($skill->id,$skillset_ids)){ echo "selected";} ?> ><?php echo $skill->skill; ?></option>
					<?php } ?>
				</select>
			  </td>
            </tr>
			<tr>
				<td>Skillset</td>
				<td><input type="text" name="skillset" id="skillset" class="form-control" value="<?php echo $skillset->skill; ?>"></td>
			</tr>
			<tr>
				<td colspan='2' style="text-align:center"><input type="submit" name="submit" value="Submit" class="btn"></td>
				
			</tr>
			
			<?php } } ?>				
          </tbody>
        </table>
		</form>
		
      </div>
 
    </div><!-- /.container -->
     
	
<?php
$this->load->view('admin/vwFooter');
?>