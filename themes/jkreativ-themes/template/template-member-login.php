<?php
/**
Template Name: Member Login Template
 */
get_header();
global $current_user;
$user_meta = get_user_meta($current_user->ID);
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
                    <div class="pageinnerwrapper tcb_redeem_template <?php if(is_user_logged_in()){echo "has-login";} ?>">
                    <?php if(is_user_logged_in()){
                        $image_id = get_post_thumbnail_id();
                        $image_url = wp_get_attachment_image_src($image_id, "full");
                        $image_url = $image_url[0];
                    ?>
                        <div class="page-header" style="background: url('<?php echo $image_url; ?>') no-repeat center center #fff; -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;">
                            <h4>Welcome <?php echo esc_attr( $user_meta['salutation'][0]) . " " . $current_user->last_name; ?>,</h4>
                        </div>
                    <?php } ?>
                        <div class="article-content tcb_custom_content member-login">
                            <?php
                            if(!is_user_logged_in()){
                                $args = array("redirect" => get_permalink(get_id_by_slug("members-dashboard")),
                                    'label_username' => __( 'Username or Email Address' ));
                                wp_login_form( $args );
                            ?>
                                <div id="wp_login_error" style="color: red">
                                    <?php if( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) { ?>
                                        <p>The username or password was incorrect.</p>
                                    <?php }
                                    else if( isset( $_GET['login'] ) && $_GET['login'] == 'empty' ) { ?>
                                        <p>Please enter both username and password.</p>
                                    <?php } ?>
                                </div>
                            <?php
                            }
                            else{
                                ?>
                                <div class="group-input">
                                    <h4>Your information:</h4>

                                    <div class="section-input clearfix">
                                        <div class="label-col">NRIC/FIN</div>
                                        <div class="detail-customer">
                                            <?php echo esc_attr( $user_meta['nric_fin_user'][0]); ?>
                                        </div>
                                    </div>
                                    <div class="section-input clearfix">
                                        <div class="label-col">Postal code</div>
                                        <div class="detail-customer">
                                            <div class="detail-customer">
                                                <?php echo esc_attr( $user_meta['postal_code'][0]); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section-input clearfix">
                                        <div class="label-col">Contact</div>
                                        <div class="detail-customer">
                                            <?php echo esc_attr( $user_meta['phone'][0]); ?>
                                        </div>
                                    </div>
                                    <div class="section-input clearfix">
                                        <div class="label-col">Date of birth:</div>
                                        <div class="detail-customer">
                                            <?php echo esc_attr( $user_meta['dob'][0]); ?>
                                        </div>
                                    </div>
                                    <div class="section-input clearfix">
                                        <div class="label-col">Address</div>
                                        <div class="detail-customer">
                                            <?php echo esc_attr( $user_meta['address_user'][0]); ?>
                                        </div>
                                    </div>
                                    <div class="section-input clearfix">
                                        <div class="label-col">email</div>
                                        <div class="detail-customer">
                                            <?php echo $current_user->user_email; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                global $wpdb;
                                $t = strtotime("now");
                                $result = $wpdb->get_results( "SELECT * FROM {$wpdb->wrranty_db_table} WHERE user_id = " . $current_user->ID, ARRAY_A);
                                if($result){
                                ?>
                                <hr/>
                                <div class="group-input">
                                    <h4>Your invoice warranty information:</h4>
                                <?php
                                    foreach($result as $key=>$val){
                                ?>
                                    <?php echo ($key) ? "<hr/>" : "" ?>
<!--                                    <div class="section-input clearfix">-->
<!--                                        <div class="label-col">Name</div>-->
<!--                                        <div class="detail-customer">-->
<!--                                            --><?php //echo $val["name"]; ?>
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="section-input clearfix">-->
<!--                                        <div class="label-col">NRIC/FIN</div>-->
<!--                                        <div class="detail-customer">-->
<!--                                            --><?php //echo $val["nric_fin"]; ?>
<!--                                        </div>-->
<!--                                    </div>-->
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
                                            echo $val["date_of_installation"];
                                            ?>
                                        </div>
                                    </div>
                                    <?php if($val["wrranty_date"]){ ?>
                                    <div class="section-input clearfix warranty-section">
                                        <div class="label-col">Warranty period</div>
                                        <div class="detail-customer">

                                            <?php echo $val["wrranty_date"]; ?>
                                            <?php
                                            $date = DateTime::createFromFormat('d/m/Y',$val["wrranty_date"]);
                                            $date->modify("+365 days");
                                            echo " - ";
                                            echo date("d/m/Y",strtotime($date->format("m/d/Y")));
                                            $diff = abs(strtotime($date->format("m/d/Y")) - strtotime("now"));
                                            $days    = ceil($diff / (60*60*24));
                                            ?>
                                            <div class="end-warranty">
                                                <h3><?php echo $days; ?></h3>
                                                <div>DAYS LEFT</div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <?php
                                    }//foreach
                                ?>
                                </div>
                                <?php
                                }//if have result
                            }//else
                            ?>
                        </div> <!-- article content -->
                        <?php
                        if(is_user_logged_in()){
                        ?>
                            <div class="point-accumulated">
                                <h4>Points accumulated*</h4>
                                <div class="point">
                                    <?php
                                    $point = esc_attr( get_the_author_meta( 'point', get_current_user_id() ) );
                                    echo $point ? $point : "0";
                                    ?></div>
                                <a href="<?php echo get_permalink(get_id_by_slug("rewards"))?>" class="submit-button-tcb">Get more points</a>
                                <?php if($point){ ?>
                                <a href="#" class="redeem-confirm submit-button-tcb">Redeem gift</a>
                                <?php } ?>
                                <p style="margin: 0px auto; padding: 10px 0px 0px; text-align: justify; font-size: 14px; width: 80%;">*For every 50 points accumulated, you will be entitled to S$50 worth of
                                    shopping vouchers. Simply click  “Redeem Gift” and an email will be sent to your
                                    registered email address.</p>
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
                        <p style="font-family: cursive;">A redemption email has been sent to you. Kindly check your email inbox and print the redemption email out to redeem your gift at our showroom. Thank you!</p>
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
<script>
    jQuery(document).ready(function($){
        $("#loginform").prepend($("#wp_login_error"));
    })
</script>