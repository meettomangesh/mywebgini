<div class="col s7">
    <div class="sres-list">
        <div class="sres-head">
            <div class="shead"><span><i class="fa fa-file-text" aria-hidden="true"></i>  Showing Results</span></div>
            <div class="sres-sort">
                <a href="" class="sort-ic sort-th active"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                <a href="" class="sort-ic sort-li"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                <div class="input-field">
                    <select>
                        <option value="" disabled selected>Sort By</option>
                        <option value="1">Price</option>
                        <option value="2">Price</option>
                        <option value="3">Price</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="sblock-list">
            <?php
            if (isset($profiles) && !empty($profiles)) {
                foreach ($profiles as $profile) {
                    ///echo "<pre>";print_r($profile);
                    ?> 
                    <div class="card horizontal no-shd">
                        <div class="card-image">
                            <img src="<?php echo HTTP_PROFILE_IMAGE_PATH . $profile->photo; ?>" alt="<?php echo $profile->company_name; ?>">
                            <a href="javascript:void(0)" class="view-port"><i class="fa fa-th" aria-hidden="true"></i> View Portfolio</a>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <div class="com-info p-rel">
                                    <div class="comp-n"><?php echo $profile->company_name; ?></div>
                                    <div class="comp-rate">
                                        <span class="rating">
                                            <span class="star"></span><span class="star active"></span><span class="star"></span><span class="star"></span><span class="star"></span>
                                        </span>
                                        <span class="rec-tex">58 Reviews</span>
                                    </div>
                                    <div class="comp-pr"><?php if ($profile->turn_over != '') { ?><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $profile->turn_over; ?><?php if ($profile->is_company_individual == 'company') {
                    echo " Lacs";
                } ?> <span><?php if ($profile->is_company_individual == 'individual') { ?>Per Hour<?php } else { ?>Per Year<?php }
            } ?></span></div>
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
        <?php $city_name = explode(',', $profile->city_name);
        echo (isset($city_name[0])) ? $city_name[0] : '';
        ?></div>
                            </div>
                            <div class="card-action">
                                <span class="ver-box">Verified</span>
                                <a href="javascript:void(0)" class="save-lat"><i class="fa fa-clock-o" aria-hidden="true"></i> Save For Later</a>
                                <a href="javascript:void(0)" class="cont-box"><i class="fa fa-envelope" aria-hidden="true"></i> Contact Now</a>
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
        </div>
    </div>
</div>