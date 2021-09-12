<?php $this->addAttribute('pageTitle', 'Home'); ?>
<?php $this->setLayout('public/layout.php'); ?>

<!-- Start main-content -->
<div class="main-content">
    <!-- Section: home -->
    <section id="home" class="divider">
        <div class="container-fluid p-0">

            <!-- START REVOLUTION SLIDER 5.0.7 -->
            <div id="rev_slider_home_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="news-gallery34" style="margin:0px auto;background-color:#ffffff;padding:0px;margin-top:0px;margin-bottom:0px;">
                <!-- START REVOLUTION SLIDER 5.0.7 fullwidth mode -->
                <div id="rev_slider_home" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
                    <ul>
                        <!-- SLIDE 1 -->
                        <li data-index="rs-1" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="assets/images/bg/bg7.jpg" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="Make an Impact">
                            <!-- MAIN IMAGE -->
                            <img src="assets/images/bg/bg7.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->
                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0 bg-theme-colored-transparent-8" id="slide-1-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1000" data-basealign="slide" data-responsive_offset="on" style="z-index: 5;background-color:rgba(0, 0, 0, 0.35);border-color:rgba(0, 0, 0, 1.00);">
                            </div>
                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0" id="slide-1-layer-2" data-x="['left','left','left','left']" data-hoffset="['50','50','50','30']" data-y="['top','top','top','top']" data-voffset="['160','100','70','90']" data-fontsize="['56','46','40','36']" data-lineheight="['70','60','50','45']" data-fontweight="['800','700','700','700']" data-width="['700','650','600','420']" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; min-width: 600px; max-width: 600px; white-space: normal;">Make A <span class="text-theme-colored2">Unique</span> Planning <br/>For Your Investment </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0" id="slide-1-layer-3" data-x="['left','left','left','left']" data-hoffset="['50','50','50','30']" data-y="['top','top','top','top']" data-voffset="['310','220','180','180']" data-fontsize="['18','18','16','13']" data-lineheight="['30','30','28','25']" data-fontweight="['600','600','600','600']" data-width="['800','650','600','420']" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 7; white-space: nowrap;">We at <?=$siteSettings['site_name'];?> make smart choices on your <br/> investments to generate profits for you while you sleep.
                            </div>
                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption tp-resizeme rs-parallaxlevel-0" id="slide-1-layer-4" data-x="['left','left','left','left']" data-hoffset="['53','53','53','30']" data-y="['top','top','top','top']" data-voffset="['390','290','260','260']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:0;y:0;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-responsive="off" style="z-index: 8; white-space: nowrap;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"><a href="<?= $route->urlFor('page', ['page' => 'login']); ?>" class="btn btn-default btn-theme-colored2 btn-xl mr-10">Login</a> <a href="<?= $route->urlFor('page', ['page' => 'register']); ?>" class="btn btn-dark btn-theme-colored2 btn-xl">Register Now</a>
                            </div>
                        </li>

                        <!-- SLIDE 2 -->
                        <li data-index="rs-2" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="assets/images/bg/bg8.jpg" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="Make an Impact">
                            <!-- MAIN IMAGE -->
                            <img src="assets/images/bg/bg8.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->
                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0 bg-theme-colored-transparent-7" id="slide-2-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1000" data-basealign="slide" data-responsive_offset="on" style="z-index: 5;background-color:rgba(0, 0, 0, 0.35);border-color:rgba(0, 0, 0, 1.00);">
                            </div>
                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0" id="slide-2-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['165','135','105','130']" data-fontsize="['56','46','40','36']" data-lineheight="['70','60','50','45']" data-fontweight="['800','700','700','700']" data-textalign="['center','center','center','center']" data-width="['700','650','600','420']" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; min-width: 600px; max-width: 600px; white-space: normal;">Invest In<span class="text-theme-colored2"> Cryptocurrency.</span> Choose <span class="text-theme-colored2">Right</span> Solution.
                            </div>
                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0" id="slide-2-layer-4" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['320','260','220','220']" data-fontsize="['18','18','16','13']" data-lineheight="['30','30','28','25']" data-fontweight="['600','600','600','600']" data-textalign="['center','center','center','center']" data-width="['800','650','600','420']" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 7; white-space: nowrap;">Your journey to the Crypto World <br/> starts right here with a smart choice to join us.
                            </div>
                            <!-- LAYER NR. 5 -->
                            <div class="tp-caption rs-parallaxlevel-0" id="slide-2-layer-5" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['400','340','300','300']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:0;y:0;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-responsive="off" style="z-index: 8; white-space: nowrap;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"><a href="<?= $route->urlFor('page', ['page' => 'login']); ?>" class="btn btn-default btn-theme-colored2 btn-xl mr-10">Login</a> <a href="<?= $route->urlFor('page', ['page' => 'register']); ?>" class="btn btn-dark btn-theme-colored2 btn-xl">Register Now</a>
                            </div>
                        </li>

                        <!-- SLIDE 3 -->
                        <li data-index="rs-3" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="assets/images/bg/bg9.jpg" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="Make an Impact">
                            <!-- MAIN IMAGE -->
                            <img src="assets/images/bg/bg9.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->
                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0 bg-theme-colored-transparent-7" id="slide-3-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1000" data-basealign="slide" data-responsive_offset="on" style="z-index: 5;background-color:rgba(0, 0, 0, 0.25);border-color:rgba(0, 0, 0, 1.00);">
                            </div>
                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0" id="slide-3-layer-2" data-x="['center','center','center','center']" data-hoffset="['310','200','100','0']" data-y="['top','top','top','top']" data-voffset="['160','100','70','90']" data-fontsize="['56','46','40','36']" data-lineheight="['70','60','50','45']" data-fontweight="['800','700','700','700']" data-width="['700','650','500','420']" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; min-width: 600px; max-width: 600px; white-space: normal;">Grow your Capital with <span class="text-theme-colored2">Transparent</span> Profits
                            </div>
                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0" id="slide-3-layer-3" data-x="['center','center','center','center']" data-hoffset="['310','200','100','0']" data-y="['top','top','top','top']" data-voffset="['310','220','180','180']" data-fontsize="['18','18','16','13']" data-lineheight="['30','30','28','25']" data-fontweight="['600','600','600','600']" data-width="['700','650','500','420']" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 7; white-space: nowrap;">We provide you with timely and detailed information <br/> about your investments. And you can withdraw your profits at anytime.
                            </div>
                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0" id="slide-3-layer-4" data-x="['center','center','center','center']" data-hoffset="['310','200','100','0']" data-y="['top','top','top','top']" data-voffset="['390','290','260','260']" data-fontsize="['18','18','16','16']" data-lineheight="['30','30','30','30']" data-fontweight="['600','600','600','600']" data-width="['700','650','500','420']" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 7; white-space: nowrap;"><a href="<?= $route->urlFor('page', ['page' => 'login']); ?>" class="btn btn-default btn-theme-colored2 btn-xl mr-10">Login</a> <a href="<?= $route->urlFor('page', ['page' => 'register']); ?>" class="btn btn-dark btn-theme-colored2 btn-xl">Register Now</a>
                            </div>
                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption rs-parallaxlevel-0" id="slide-3-layer-5" data-x="['center','center','center','center']" data-hoffset="['310','33','0','0']" data-y="['top','top','top','top']" data-voffset="['360','290','260','260']" data-width="['700','650','600','420']" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:0;y:0;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-responsive="off" style="z-index: 8; white-space: nowrap;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;">
                            </div>
                        </li>
                    </ul>
                    <div class="tp-bannertimer tp-bottom" style="height: 5px; background-color: rgba(255, 255, 255, 0.2);"></div>
                </div>
            </div>

            <!-- END REVOLUTION SLIDER -->
            <script type="text/javascript">
                var tpj = jQuery;
                var revapi34;
                tpj(document).ready(function() {
                    if (tpj("#rev_slider_home").revolution == undefined) {
                        revslider_showDoubleJqueryError("#rev_slider_home");
                    } else {
                        revapi34 = tpj("#rev_slider_home").show().revolution({
                            sliderType: "standard",
                            jsFileLocation: "assets/js/revolution-slider/js/",
                            sliderLayout: "fullscreen",
                            dottedOverlay: "none",
                            delay: 9000,
                            navigation: {
                                keyboardNavigation: "on",
                                keyboard_direction: "horizontal",
                                mouseScrollNavigation: "off",
                                onHoverStop: "on",
                                touch: {
                                    touchenabled: "on",
                                    swipe_threshold: 75,
                                    swipe_min_touches: 1,
                                    swipe_direction: "horizontal",
                                    drag_block_vertical: false
                                },
                                arrows: {
                                    style: "zeus",
                                    enable: true,
                                    hide_onmobile: true,
                                    hide_under: 600,
                                    hide_onleave: true,
                                    hide_delay: 200,
                                    hide_delay_mobile: 1200,
                                    tmp: '<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                                    left: {
                                        h_align: "left",
                                        v_align: "center",
                                        h_offset: 30,
                                        v_offset: 0
                                    },
                                    right: {
                                        h_align: "right",
                                        v_align: "center",
                                        h_offset: 30,
                                        v_offset: 0
                                    }
                                },
                                bullets: {
                                    enable: true,
                                    hide_onmobile: true,
                                    hide_under: 600,
                                    style: "metis",
                                    hide_onleave: true,
                                    hide_delay: 200,
                                    hide_delay_mobile: 1200,
                                    direction: "horizontal",
                                    h_align: "center",
                                    v_align: "bottom",
                                    h_offset: 0,
                                    v_offset: 30,
                                    space: 5,
                                    tmp: '<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span>'
                                }
                            },
                            viewPort: {
                                enable: true,
                                outof: "pause",
                                visible_area: "80%"
                            },
                            responsiveLevels: [1240, 1024, 778, 480],
                            gridwidth: [1240, 1024, 778, 480],
                            gridheight: [600, 550, 500, 450],
                            lazyType: "none",
                            parallax: {
                                type: "scroll",
                                origo: "enterpoint",
                                speed: 400,
                                levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
                            },
                            shadow: 0,
                            spinner: "off",
                            stopLoop: "off",
                            stopAfterLoops: -1,
                            stopAtSlide: -1,
                            shuffle: "off",
                            autoHeight: "off",
                            hideThumbsOnMobile: "off",
                            hideSliderAtLimit: 0,
                            hideCaptionAtLimit: 0,
                            hideAllCaptionAtLilmit: 0,
                            debugMode: false,
                            fallbacks: {
                                simplifyAll: "off",
                                nextSlideOnWindowFocus: "off",
                                disableFocusListener: false,
                            }
                        });
                    }
                }); /*ready*/
            </script>
            <!-- END REVOLUTION SLIDER -->
        </div>
    </section>

    <!-- Divider: Call To Action -->
    <section class="bg-theme-colored2">
        <div class="container pt-0 pb-0">
            <div class="row">
                <div class="call-to-action sm-text-center pt-30 pb-20">
                    <div class="col-md-9">
                        <h3 class="mt-5 text-white font-weight-600">Let our Professionals grow your cryptocurrency for you today!</h3>
                    </div>
                    <div class="col-md-3 text-right flip sm-text-center">
                        <a class="btn btn-default btn-lg font-weight-600 mt-5" href="<?= $route->urlFor('page', ['page' => 'register']); ?>">Register Now<i class="fa fa-angle-double-right font-18 ml-10"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- // sections -->

    <?php echo $this->fetch('public/components/section-features.php'); ?>

    <?php echo $this->fetch('public/components/section-about.php'); ?>

    <?php echo $this->fetch('public/components/section-services.php'); ?>

    <?php echo $this->fetch('public/components/section-referral.php'); ?>

    <?php echo $this->fetch(
        'public/components/section-investment-plans.php',
        ['investment_plans' => $data['investment_plans']]
    ); ?>

    <?php echo $this->fetch('public/components/section-live-table.php'); ?>


</div>
<!-- end main-content -->
