<?php
/**
Template Name: Member Login Template
 */
get_header();
global $current_user;
if ( ! post_password_required() )
{
    $args = array(
        'redirect' => get_permalink(),
        'id_username' => 'user',
        'id_password' => 'pass',
    )
    ;

    $featured = jeg_get_page_featured_heading(1200, 750);
    ?>
    <div class="headermenu">
        <?php jeg_get_template_part('template/rightheader'); ?>
    </div> <!-- headermenu -->

    <div class="contentheaderspace"></div>
    <div class="pagewrapper <?php echo vp_metabox('jkreativ_page_heading.heading_position', 'inside'); ?> <?php echo vp_metabox('jkreativ_page_pageposition.page_width', 'fullwidth'); ?>  <?php echo vp_metabox('jkreativ_page_pageposition.page_position', 'pagecenter'); ?>  <?php echo vp_metabox('jkreativ_page_pageposition.blog_layout', 'nosidebar'); ?>">
        <div class="pageholder">

            <?php
            if($featured !== '' && vp_metabox('jkreativ_page_heading.heading_position', 'inside') === 'outside' && !post_password_required()) {
                echo "<div class='featured'>{$featured}</div>";
            }
            ?>

            <div class="pageholdwrapper">
                <div class="mainpage blog-normal-article">
                    <div class="pageinnerwrapper tcb_redeem_template">
                        <div class="article-content tcb_custom_content member-login">
                            <?php
                            if(!is_user_logged_in()){
                                $args = array("redirect" => get_permalink(get_id_by_slug("members-dashboard")));
                                wp_login_form( $args );
                            }
                            else{
                                ?>
                                <h4>Welcome <?php echo $current_user->last_name; ?></h4>
                                <div class="group-input">
                                <?php
                                global $wpdb;
                                $t = strtotime("now");
                                $result = $wpdb->get_results( "SELECT * FROM {$wpdb->wrranty_db_table} WHERE user_id = " . $current_user->ID, ARRAY_A);
                                if($result){
                                    foreach($result as $key=>$val){
                                ?>
                                        <hr/>
                                        <div class="section-input clearfix">
                                            <div class="label-col">Name</div>
                                            <div class="detail-customer">
                                                <?php echo $val["name"]; ?>
                                            </div>
                                        </div>
                                        <div class="section-input clearfix">
                                            <div class="label-col">NRIC/FIN</div>
                                            <div class="detail-customer">
                                                <?php echo $val["nric_fin"]; ?>
                                            </div>
                                        </div>
                                        <div class="section-input clearfix">
                                            <div class="label-col">Address</div>
                                            <div class="detail-customer">
                                                <?php echo $val["address"]; ?>
                                            </div>
                                        </div>
                                        <div class="section-input clearfix">
                                            <div class="label-col">Contact</div>
                                            <div class="detail-customer">
                                                <?php echo $val["contact"]; ?>
                                            </div>
                                        </div>
                                        <div class="section-input clearfix">
                                            <div class="label-col">Invoice no.</div>
                                            <div class="detail-customer">
                                                <div class="detail-customer">
                                                    <?php echo $val["invoiceId"]; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section-input clearfix">
                                            <div class="label-col">Date of installation</div>
                                            <div class="detail-customer">
                                                <?php
                                                $t = strtotime($val["date_of_installation"]);
                                                echo date('d/m/Y',$t);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="section-input clearfix countdown-section">
                                            <div class="label-col">Warranty period</div>
                                            <div class="tcb-input-check detail-customer">
                                                <span id="time"></span>

                                                <?php
//                                                echo date("M/d/Y", strtotime($val["wrranty_date"])) . "<br/>";
                                                $date = DateTime::createFromFormat('d/m/Y',$val["wrranty_date"]);
//                                                echo $date->format("m/d/Y");
                                                $diff = abs(strtotime("now") - strtotime($date->format("m/d/Y")));
//                                                $years   = floor($diff / (365*60*60*24));
//                                                $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                $days    = floor($diff / (60*60*24));

                                                ?>
                                                <div id="CDT">
                                                    <span class="number-wrapper"><div class="line"></div><span class="number day"><?php echo 365 - $days; ?></span></span>
                                                </div>
                                                <div class="caption">TILL YOUR WARRANTY ENDS</div>
                                            </div>
                                        </div>

                                <?php
                                    }//foreach
                                }//if have result
                                ?>
                                </div>
                                <?php
                            }//else
                            ?>
                        </div> <!-- article content -->
                        <?php
                        if(is_user_logged_in()){
                        ?>
                            <div class="point-accumulated">
                                <h4>Point accumulated</h4>
                                <div class="point"><?php echo esc_attr( get_the_author_meta( 'point', get_current_user_id() ) ); ?></div>
                                <a href="<?php echo get_permalink(get_id_by_slug("rewards"))?>" class="submit-button-tcb">Get more points</a>
                                <a href="#" class="redeem-confirm submit-button-tcb">Redeem gift</a>
                                <div><img class="submit-loading" src="<?php echo get_template_directory_uri() . '/assets/img/ajax-loader.gif'; ?>"/></div>
                                <?php
                                if( have_posts() ) {
                                    while(have_posts()){
                                        the_post();
                                        ?>
                                        <div class="article-content redeem-remove">
                                            <?php the_content() ?>
                                        </div>
                                    <?php
                                    }
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="clearfix"></div>
                    </div> <!-- page inner wrapper -->
                </div>
                <div class="cd-popup" role="alert">
                    <div class="cd-popup-container">
                        <p>Check your email to get your redeem. Thank you!</p>
                        <a href="#0" class="cd-popup-close img-replace">Close</a>
                    </div> <!-- cd-popup-container -->
                </div> <!-- cd-popup -->
                <?php
                if(vp_metabox('jkreativ_page_pageposition.blog_layout') === 'withsidebar') {
                    jeg_get_template_part('template/blogpost/sidebar');
                }
                ?>
            </div>
        </div>
        <?php if(vp_option('joption.enable_footer_landing') && !vp_metabox('jkreativ_page_landing_vc.disable_landing_footer')) : ?>
            <div class="section-footer">
                <div class="landing-footer">
                    <div class="sectioncontainer">
                        <?php
                        jeg_get_template_part('template/landing-footer');
                        ?>
                    </div>
                </div>
                <div class="landing-btm-footer">
                    <div class="sectioncontainer">
                        <div class="landing-footer-copyright">
                            <?php echo vp_option('joption.website_copyright', '&copy; Jegtheme 2013. All Rights Reserved.'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div><!--/page wrapper-->

<?php
} else {
    jeg_get_template_part('template/password-form');
}

get_footer();
?>