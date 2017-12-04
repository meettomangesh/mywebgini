<?php
/*echo '<pre>';
print_r($skillsets);
exit;
*/
?>
<form class="col s12" name="edit-enquiry" id="add-enquiry" action="<?php echo base_url('dashboard/editEnquiry'); ?>" method="POST">
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
