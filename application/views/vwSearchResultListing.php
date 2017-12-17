
            <?php
            if (isset($profiles) && !empty($profiles)) {
                foreach ($profiles as $profile) {
                    ?> 
                    <div class="result-provider <?php echo $profile->average_rating; ?> " id="src_provider_id_<?php echo $profile->provider_id; ?>">
                        <div class="card horizontal no-shd">
                            <div class="card-image">
                                <img src="<?php echo HTTP_IMAGES_PATH . (!empty($profile->photo) ? $profile->photo : 'no-pre.png'); ?>" alt="<?php echo $profile->company_name; ?>">
                                <a href="javascript:void(0)" class="view-port"><i class="fa fa-th" aria-hidden="true"></i> View Portfolio</a>
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <div class="com-info p-rel">
                                        <div class="comp-n"><?php echo $profile->company_name; ?></div>
                                        <div class="comp-rate">
                                            <span class="rating">
                                                <?php
                                                //pre($profile);
                                               // echo $profile->rating_count . '----' . $profile->average_rating;
                                                //exit;
                                                //if (!empty($profile->average_rating) && $profile->average_rating > 0) {
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        echo "<span class='star".(($i<=$profile->average_rating)?' active':'')."'></span>";
                                                    }
                                                //} else 
                                                ?>
                                            </span>
                                            <span class="rec-tex"><?php echo ($profile->rating_count)?$profile->rating_count:0;?> Reviews</span>
                                        </div>
                                        <div class="comp-pr"><?php if ($profile->turn_over != '') { ?><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $profile->turn_over; ?><?php
                                                if ($profile->is_company_individual == 'company') {
                                                    echo " Lacs";
                                                }
                                                ?> <span><?php if ($profile->is_company_individual == 'individual') { ?>Per Hour<?php } else { ?>Per Year<?php
                                                    }
                                                }
                                                ?></span></div>
                                    </div>
                                    <div class="short-des">
                                        <h5>Short Description</h5>
                                        <p><?php echo $profile->about_company; ?> </p>
                                    </div>
                                    <?php if (isset($profile->skill) && $profile->skill != '') { ?>
                                        <div class="skill-txt"><strong>Skills:</strong> <?php echo $profile->skill; ?></div>
                                        <?php } ?>
                                    <div class="exp-loc bold">
                                        <?php if ($profile->years_of_experience != '0' && $profile->years_of_experience != '') { ?>Experience : <?php echo $profile->years_of_experience; ?> Years   |<?php } ?>   Location : 
                                        <?php
                                        $city_name = explode(',', $profile->city_name);
                                        echo (isset($city_name[0])) ? $city_name[0] : '';
                                        ?></div>
                                </div>
                                <div class="card-action">
                                    <span class="ver-box"><?php echo ($profile->status == 1)?'Verified':'Not Verified';?></span>
                                    <a href="javascript:saveForLater('<?php echo $profile->provider_id ;?>')" class="save-lat"><i class="fa fa-clock-o" aria-hidden="true"></i> Save For Later</a>
                                    <a href="javascript:contactNow('<?php echo $profile->provider_id ;?>')" class="cont-box"><i class="fa fa-envelope" aria-hidden="true"></i> Contact Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "No Result Found!!!!";
            }
            ?>
            <?php
            $link = explode("</a>", $links);
//print_r($link);
            ?>

            <ul class="pagination">
                    <?php foreach ($link as $l) { ?>
                    <li class="waves-effect"><?php echo $l; ?></a></li>
<?php } ?>
            </ul>

<script>
    provider_list = <?php echo $profiles_json; ?>
</script>
