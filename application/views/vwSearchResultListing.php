
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
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo "<span class='star" . (($i <= $profile->average_rating) ? ' active' : '') . "'></span>";
                                    }
                                    ?>
                                </span>
                                <span class="rec-tex"><?php echo ($profile->rating_count) ? $profile->rating_count : 0; ?> Reviews</span>
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
                        <span class="ver-box"><?php echo ($profile->is_verified == 1) ? 'Verified' : 'Not Verified'; ?></span>
<!--                        <a href="javascript:saveForLater('<?php echo $profile->provider_id; ?>')" class="save-lat"><i class="fa fa-clock-o" aria-hidden="true"></i> Save For Later</a>-->
                        <a href="#modal_<?php echo $profile->provider_id; ?>" class=" modal-trigger save-lat"><i class="fa fa-clock-o" aria-hidden="true"></i> Save For Later</a>
                        <a href="javascript:contactNow('<?php echo $profile->provider_id; ?>')" class="cont-box"><i class="fa fa-envelope" aria-hidden="true"></i> Contact Now</a>
                    </div>
                </div>
            </div>
            <div id="modal_<?php echo $profile->provider_id; ?>" class="modal">
            <div class="modal-content">
                    <div id="save-header" class="pure-g m-c">
                        <div class="comp-n"><?php echo $profile->company_name; ?></div>
                            <div class="comp-rate">
                                <span class="rating">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo "<span class='star" . (($i <= $profile->average_rating) ? ' active' : '') . "'></span>";
                                    }
                                    ?>
                                </span>
                                <span class="rec-tex"><?php echo ($profile->rating_count) ? $profile->rating_count : 0; ?> Reviews</span>
                            </div>

                    </div>
             
                <nav class="red">
                    <div class="nav-wrapper">
                        <div class="left col s12 m5 l5">
                            <ul>
                                <li><a href="#!" class="email-menu"><i class="modal-action modal-close  mdi-hardware-keyboard-backspace"></i></a>
                                </li>
                                <li><a href="#!" class="email-type">Save for Later</a></li>    
                            </ul>
                        </div>
                        <div class="col s12 m7 l7 hide-on-med-and-down">
                            <ul class="right">
                                <li><a href="javascript:void(0);"><i class="modal-action modal-close  mdi-content-send"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </nav>
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
