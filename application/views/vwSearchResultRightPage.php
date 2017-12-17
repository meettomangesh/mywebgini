<div class="col s5">
    <div class="rec-comp">
        <div class="shead"><span><i class="fa fa-building" aria-hidden="true"></i> Recommended for your Search</span></div>
        <div class="rec-comp-box">
            <div class="owl-carousel owl-theme scol-3">
                <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp1.jpg" alt=""></div>
                </div>
                <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp2.jpg" alt=""></div>
                </div>
                <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp5.jpg" alt=""></div>
                </div>
                <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp1.jpg" alt=""></div>
                </div>
                <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp2.jpg" alt=""></div>
                </div>
                <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp5.jpg" alt=""></div>
                </div>
            </div>
        </div>
    </div>

    <div class="view-loc-comp">
        <div class="shead"><span><i class="fa fa-map-marker" aria-hidden="true"></i> View By Locations</span></div>
        <div class="row loc-comp-box">
            <div class="input-field s-winp col s4">
                <select name="country_name" id="country_name" class="form-control" onchange="get_states(this.value);">
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country) { ?>
                        <option value="<?php echo $country->id; ?>" ><?php echo $country->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-field s-winp col s4">
                <select name="state_name" id="state_name" class="form-control"  onchange="get_cities(this.value);">
                    <option value="">Select State</option>
                </select>
            </div>
            <div class="input-field s-winp col s4">
                <select name="city_name" id="city_name" class="form-control" onchange="javascript:void(0);">
                    <option value="" >Select City</option>
                </select>
            </div>
        </div>
        <div class="map mt15">
            <div id="map" style="width: 100%;height: 220px;"></div>
        </div>
    </div>

    <div class="price-rate mt20">                            
        <div class="row">
            <div class="col s6">
                <div class="shead"><span><i class="fa fa-money" aria-hidden="true"></i> By Price</span></div>
                <div class="pslider"><div id="ps-slider"></div></div>
            </div>
            <div class="col s6">
                <div class="shead"><span><i class="fa fa-star-half-o" aria-hidden="true"></i> By Ratings</span></div>
                <div class="rating-filter">
                    <p>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            //echo $i;
                            echo "<input type='checkbox' value='".$i."' class='filled-in results-filter-provider-class' id='star" . $i . "' />";
                            echo "<label for='star" . $i . "'><span class='rating'>";
                            for ($j = 1; $j <= 5; $j++) {
                                echo "<span class='star" . (($j == $i) ? ' active' : '') . "'></span>";
                            }
                            echo "</span></label>";
                        }
                        ?>
                    </p>
<!--                    <p>
                        <input type="checkbox" class="filled-in" id="star4" />
                        <label for="star4"><span class="rating">
                                <span class="star"></span><span class="star active"></span><span class="star"></span><span class="star"></span><span class="star"></span>
                            </span></label>
                    </p>
                    <p>
                        <input type="checkbox" class="filled-in" id="star3" checked />
                        <label for="star3"><span class="rating">
                                <span class="star"></span><span class="star"></span><span class="star active"></span><span class="star"></span><span class="star"></span>
                            </span></label>
                    </p>
                    <p>
                        <input type="checkbox" class="filled-in" id="star2" />
                        <label for="star2"><span class="rating">
                                <span class="star"></span><span class="star"></span><span class="star"></span><span class="star active"></span><span class="star"></span>
                            </span></label>
                    </p>
                    <p>
                        <input type="checkbox" class="filled-in" id="star1" />
                        <label for="star1"><span class="rating">
                                <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star active"></span>
                            </span></label>
                    </p>-->
                </div>
            </div>
        </div>
    </div>
    <div class="fea-comp mt20">
        <div class="shead"><span><i class="fa fa-briefcase" aria-hidden="true"></i> Featured Companies</span></div>
        <div  class="fea-comp-box">
            <div id="featured_companies" class="owl-carousel owl-theme scol-3">
               <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp1.jpg" alt=""></div>
                </div>
                <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp2.jpg" alt=""></div>
                </div>
                <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp5.jpg" alt=""></div>
                </div>
                <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp1.jpg" alt=""></div>
                </div>
                <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp2.jpg" alt=""></div>
                </div>
                <div class="item comp-sbox">
                    <div class="comp-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>companies/comp5.jpg" alt=""></div>
                </div>
            </div>
        </div>
    </div>
    <div class="fea-emp mt20">
        <div class="shead"><span><i class="fa fa-user" aria-hidden="true"></i> Featured Freelancers</span></div>
        <div class="rec-comp-box">
            <div id="featured_freelancer" class="owl-carousel owl-theme scol-3">
                
                <div class="item dev-sbox">
                    <div class="dev-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>developer/dev1.jpg" alt=""></div>
                    <div class="dev-details">
                        <div class="dev-name t-up">GRAYSON CARROLL</div>
                        <div class="dev-des">Mobile App Developer</div>
                    </div>
                </div>
                <div class="item dev-sbox">
                    <div class="dev-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>developer/dev2.jpg" alt=""></div>
                    <div class="dev-details">
                        <div class="dev-name t-up">GRAYSON CARROLL</div>
                        <div class="dev-des">Developer and Designer</div>
                    </div>
                </div>
                <div class="item dev-sbox">
                    <div class="dev-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>developer/dev3.jpg" alt=""></div>
                    <div class="dev-details">
                        <div class="dev-name t-up">GRAYSON CARROLL</div>
                        <div class="dev-des">Mobile App Developer</div>
                    </div>
                </div>
                <div class="item dev-sbox">
                    <div class="dev-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>developer/dev4.jpg" alt=""></div>
                    <div class="dev-details">
                        <div class="dev-name t-up">GRAYSON CARROLL</div>
                        <div class="dev-des">Finance Advicer</div>
                    </div>
                </div>
                <div class="item dev-sbox">
                    <div class="dev-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>developer/dev5.jpg" alt=""></div>
                    <div class="dev-details">
                        <div class="dev-name t-up">GRAYSON CARROLL</div>
                        <div class="dev-des">Digital Marketing</div>
                    </div>
                </div>
                <div class="item dev-sbox">
                    <div class="dev-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>developer/dev1.jpg" alt=""></div>
                    <div class="dev-details">
                        <div class="dev-name t-up">GRAYSON CARROLL</div>
                        <div class="dev-des">Mobile App Developer</div>
                    </div>
                </div>
                <div class="item dev-sbox">
                    <div class="dev-ipic"><img src="<?php echo HTTP_IMAGES_PATH; ?>developer/dev2.jpg" alt=""></div>
                    <div class="dev-details">
                        <div class="dev-name t-up">GRAYSON CARROLL</div>
                        <div class="dev-des">Developer and Designer</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>