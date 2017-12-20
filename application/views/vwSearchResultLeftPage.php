<div class="search-filter">
    <div class="shead"><span><i class="fa fa-filter" aria-hidden="true"></i> Refine Your Search</span></div>
    <div class="filter-box">
        <div class="filter-head">Show By</div>
        <ul class="filter-list">
            <li><a href="javascript:getRedirectParam('iscomind',0);" target="_blank">All <span>( <?php echo $total_count->count_number; ?> )</span></a></li>
            <li><a href="javascript:getRedirectParam('iscomind',2);" target="_blank">Companys <span>( <?php echo $company_count->count_number; ?> )</span></a></li>
            <li><a href="javascript:getRedirectParam('iscomind',1);" target="_blank">Individuals <span>( <?php echo $individual_count->count_number; ?> )</span></a></li>
        </ul>
        <div class="filter-head">Show By Category</div>
        <ul class="filter-list">
            <li><a href="javascript:getRedirectParam('iscomind',0);" target="_blank">All <span>( <?php echo $total_count->count_number; ?> )</span></a></li>				
            <?php foreach ($refine_skills as $refine_skill) { ?>
                <?php if ($refine_skill['count']->count_number != '' && $refine_skill['count']->count_number != '0') { ?>
                    <li>
                        <!-- <a href="<?php echo base_url('search/role_wise_search/') . base64_encode($refine_skill['id']); ?>" target="_blank"> -->
                        <a href="javascript:getRedirectParam('skills','<?php echo $refine_skill['skill']; ?>')" target="_blank">
                            <?php echo $refine_skill['skill']; ?> <span>( <?php echo $refine_skill['count']->count_number; ?> )</span>
                        </a>
                    </li>
                        <?php } ?>
                    <?php } ?>				
            <!--<li><a href="<?php echo base_url('search/other_skills'); ?>" target="_blank">Other <span>( <?php echo $other_skills_count->count_number; ?> )</span></a></li>	-->			
        </ul>
    </div>
</div>
