<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="shortcut icon" href="http://localhost:8888/StaffScheduling/assets/img/logo-fav.png"> -->
    <title>Home Screen | Staff Scheduling System</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Jquery timepicker css -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <!-- Icons -->
    <link href="<?= base_url() ?>assets/v2/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/v2/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />

    <!-- Library -->
    <link href="<?= base_url() ?>assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link rel='stylesheet' href='assets/homePage/styles/settings.css' type='text/css' media='all' />
    <link rel='stylesheet' href='assets/homePage/styles/woocommerce-layout.css' type='text/css' media='all' />

    <link rel='stylesheet' href='assets/homePage/styles/fontello.css' type='text/css' media='all' />
    <link rel='stylesheet' href='assets/homePage/styles/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='assets/homePage/styles/core.animation.css' type='text/css' media='all' />
    <link rel='stylesheet' href='assets/homePage/styles/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='assets/homePage/styles/theme.css' type='text/css' media='all' />
    <link rel='stylesheet' href='assets/homePage/styles//plugin.woocommerce.css' type='text/css' media='all' />
    <link rel='stylesheet' href='assets/homePage/styles/custom.css' type='text/css' media='all' />
    <link rel='stylesheet' href='assets/homePage/styles/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='assets/homePage/styles/comp.min.css' type='text/css' media='all' />


    <!-- CSS Files -->
    <link href="<?= base_url() ?>assets/v2/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/v2/css/custom.css" rel="stylesheet" />


    <style type="text/css">
        p {
            font-size: 1rem;
            /* font-weight: 10; */
            padding: 15px 15px 15px 15px;
            line-height: 1.7;
        }

        #sandbox-container .datepicker-inline,
        #sandbox-container .table-condensed {
            width: 100%;
            background-color: #ffffff;
        }

        #sandbox-container .datepicker-inline td {
            height: 50px;
        }

        #sandbox-container .datepicker-inline table tr td {
            border-radius: unset;
        }

        #sandbox-container .prev,
        #sandbox-container .next {
            visibility: hidden;
        }

        #sandbox-container .active {
            background: none;
        }

        /* Highlight styles */
        #sandbox-container .highlight-yellow {
            background: yellow;

        }

        #sandbox-container .highlight-blue {
            background: blue;

        }

        .container-fluid {
            margin: auto;
            width: 70%;
            padding-right: 15px;
            padding-left: 15px;
            margin-top: 150px;
        }

        .login_styles {
            border-left: 1px solid #ebebeb;
        }

        .banner-form-box {
            display: flex;
            width: 80%;
            background-color: #02122c;
            border-radius: 4px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .09);
            margin: 20px auto 0;
        }

        .banner-text {
            position: absolute;
            top: 35%;
            z-index: 1;
            width: 100%;
        }

        .footer-top {
            background: #151515 url(assets/img/footer-bg.png) no-repeat scroll 0 0 / cover;
            color: #8d8e92;
            position: relative;
            z-index: 1;
            padding: 30px 0;
        }

        .footer-contact {
            text-align: center;
            margin-left: 100px;
        }

        ul.footer-social li {
            display: inline-block;
            margin-bottom: 0;
        }

        ul.footer-social li a {
            background: #fff none repeat scroll 0 0;
            border-radius: 50%;
            color: #fff;
            display: block;
            font-size: 16px;
            height: 35px;
            line-height: 35px;
            text-align: center;
            width: 35px;
        }

        ul.footer-social li a.fb {
            background: #4267B2 none repeat scroll 0 0;
        }

        .card {
            padding-bottom: 16px;
            font-size: 14px;
            font-weight: 600;
        }

        .card-header-styles {
            margin-bottom: 14%;
            border-bottom: 1px solid rgb(221, 221, 221);
        }

        .columns_wrap {
            position: relative;
            z-index: 2;
        }

        .column_styles {
            background-color: rgb(255, 255, 255);
            display: flex;
            border-width: 1px;
            border-style: solid;
            border-color: rgb(221, 221, 221);
            border-image: initial;
            border-radius: 10px;
        }
    </style>
</head>

<body class="index home page body_style_wide body_filled article_style_stretch layout_single-standard template_single-standard scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide vc_responsive">

    <!-- <a id="toc_home" class="sc_anchor" title="Home" data-description="&lt;i&gt;Return to Home&lt;/i&gt; - &lt;br&gt;navigate to home page of the site" data-icon="icon-home" data-url="index.html" data-separator="yes"></a>
    <a id="toc_top" class="sc_anchor" title="To Top" data-description="&lt;i&gt;Back to top&lt;/i&gt; - &lt;br&gt;scroll to top of the page" data-icon="icon-double-up" data-url="" data-separator="yes"></a> -->


    <div class="body_wrap">
        <div class="page_wrap">
            <div class="top_panel_fixed_wrap"></div>
            <header class="top_panel_wrap top_panel_style_4 scheme_original">
                <div class="top_panel_wrap_inner top_panel_inner_style_4 top_panel_position_above">
                    <div class="top_panel_middle">
                        <div class="content_wrap">
                            <div class="contact_logo">
                                <div class="logo">
                                    <a href="<?= base_url() ?>">
                                        <img src="<?= base_url() ?>assets/img/EZLogo.png" class="logo_main" alt="" width="239" height="59" />
                                        <img src="<?= base_url() ?>assets/img/EZLogo.png" class="logo_fixed" alt="" width="239" height="59" />
                                    </a>
                                </div>
                            </div>
                            <div class="menu_main_wrap">
                                <nav class="menu_main_nav_area menu_hover_fade">
                                    <ul id="menu_main" class="menu_main_nav">
                                        <li class="menu-item current-menu-ancestor current-menu-parent"><a href="<?= base_url() ?>"><span>Home</span></a></li>
                                        <!-- <li class="menu-item"><a href="about.html"><span>About Us</span></a></li> -->
                                        <li class="menu-item menu-item-has-children"><a href="#Products"><span>Our Products</span></a> </li>
                                        <li class="menu-item"><a href="#footer"><span>Contacts Us</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="login_menu_wrap">
                                <nav class="menu_main_nav_area menu_hover_fade">
                                    <ul id="menu_main" class="menu_main_nav login_styles">
                                        <li class="menu-item"><a href="<?= base_url('Login/Signup') ?>"><span><i class="fa fa-user"></i> Signup</span></a></li>
                                        <li class="menu-item"><a href="<?= base_url('Login') ?>"><span><i class="fa fa-lock"></i> Login</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="header_mobile">
                <div class="content_wrap">
                    <div class="menu_button icon-menu"></div>
                    <div class="logo">
                        <a href="index.html">
                            <img src="<?= base_url() ?>assets/img/EZLogo.png" class="logo_main" alt="" width="239" height="59" />
                        </a>
                    </div>
                </div>
                <div class="side_wrap">
                    <div class="close">Close</div>
                    <div class="panel_top">
                        <nav class="menu_main_nav_area">
                            <ul id="menu_mobile" class="menu_main_nav">
                                <li class="menu-item"><a href="<?= base_url('Login/Signup') ?>"><span><i class="fa fa-user"></i> Signup</span></a></li>
                                <li class="menu-item"><a href="<?= base_url('Login') ?>"><span><i class="fa fa-lock"></i> Login</span></a></li>
                                <!-- <li class="menu-item current-menu-ancestor current-menu-parent"><a href="index.html"><span>Home</span></a></li>
                                <li class="menu-item"><a href="about.html"><span>About Us</span></a></li>
                                <li class="menu-item menu-item-has-children"><a href="cheese.html"><span>Our Product</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="cheese.html"><span>Cheese</span></a></li>
                                        <li class="menu-item"><a href="butter.html"> Butter</span></a></li>
                                        <li class="menu-item"><a href="milk.html">Milk</span></a></li>
                                        <li class="menu-item"><a href="ghee.html">Ghee</span></a></li>
                                    </ul>
                                </li>
                                <li class="menu-item"><a href="contact_us.html"><span>Contacts Us</span></a></li> -->
                            </ul>
                        </nav>
                    </div>
                    <div class="panel_bottom">
                    </div>
                </div>
                <div class="mask"></div>
            </div>
            <section class="slider_wrap slider_fullwide slider_engine_revo slider_alias_slider-1">
                <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" style="opacity: 0.6;">
                    <div id="rev_slider_1_1" class="rev_slider fullwidthabanner" data-version="5.2.6">
                        <ul>
                            <li data-index="rs-1" data-transition="cube" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="images/ez-airlines.png" data-rotate="0" data-saveperformance="off" data-title="Slide">
                                <img src="assets/img/ez-airlines.png" alt="" title="baggage" width="1903" height="873" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>

                            </li>
                            <li data-index="rs-2" data-transition="cube-horizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="images/Art 1.8.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                <img src="assets/homePage/images/Art 1.8.jpg" alt="" title="home-1-slide-2" width="1903" height="873" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                <!-- <div class="tp-caption BigWhiteText tp-resizeme" id="slide-2-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="-60" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:1000;e:Back.easeOut;" data-transform_out="opacity:0;s:300;" data-start="500" data-splitin="chars" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.1">Creamy Cheese </div>
                                <div class="tp-caption SmallWhiteText tp-resizeme" id="slide-2-layer-2" data-x="center" data-hoffset="" data-y="center" data-voffset="35" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="y:50px;opacity:0;s:800;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;" data-start="2890" data-splitin="none" data-splitout="none" data-responsive_offset="on">Fresh. Local. Delivered </div>
                                <div class="tp-caption ButtonText rev-btn" id="slide-2-layer-3" data-x="center" data-hoffset="" data-y="center" data-voffset="151" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:0;e:Linear.easeNone;" data-style_hover="c:rgba(255, 255, 255, 1.00);bg:rgba(255, 255, 255, 0);bc:rgba(255, 255, 255, 1.00);" data-transform_in="y:bottom;rZ:90deg;sX:2;sY:2;s:800;e:Quad.easeIn;" data-transform_out="opacity:0;s:300;" data-start="3970" data-splitin="none" data-splitout="none" data-actions='[{"event":"click","action":"simplelink","target":"_blank","url":"\/shop\/","delay":""}]' data-responsive_offset="on" data-responsive="off">View our products </div> -->
                            </li>
                            <li data-index="rs-3" data-transition="incube" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="images/home-1-slide-3-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                <img src="assets/images/home-1-slide-3.jpg" alt="" title="home-1-slide-3" width="1903" height="873" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                <!-- <div class="tp-caption BigWhiteText tp-resizeme" id="slide-3-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="-60" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:1000;e:Back.easeOut;" data-transform_out="opacity:0;s:300;" data-start="500" data-splitin="chars" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.1">Sweet Ice Cream </div>
                                <div class="tp-caption SmallWhiteText tp-resizeme" id="slide-3-layer-2" data-x="center" data-hoffset="" data-y="center" data-voffset="35" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="y:50px;opacity:0;s:800;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;" data-start="2890" data-splitin="none" data-splitout="none" data-responsive_offset="on">Fresh. Local. Delivered </div>
                                <div class="tp-caption ButtonText rev-btn" id="slide-3-layer-3" data-x="center" data-hoffset="" data-y="center" data-voffset="151" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:0;e:Linear.easeNone;" data-style_hover="c:rgba(255, 255, 255, 1.00);bg:rgba(255, 255, 255, 0);bc:rgba(255, 255, 255, 1.00);" data-transform_in="y:bottom;rZ:90deg;sX:2;sY:2;s:800;e:Quad.easeIn;" data-transform_out="opacity:0;s:300;" data-start="3970" data-splitin="none" data-splitout="none" data-actions='[{"event":"click","action":"simplelink","target":"_blank","url":"\/shop\/","delay":""}]' data-responsive_offset="on" data-responsive="off">View our products </div> -->
                            </li>
                        </ul>
                        <div class="tp-bannertimer tp-bottom"></div>
                    </div>
                </div>
                <!-- <div class="banner-text">
                    <div class="banner-title" style="text-align: center">
                        <h1>Welcome to</h1>
                        <h2>Staff Sheduling System</h2>
                    </div>
                    <div class="be-content">
                        <div class="main-content container-fluid">
                            <div></div>
                            <div class="row banner-form-box">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Shift Timings</label>
                                        <select class="form-control required" required="true" name="ShiftTimings">
                                            <option value="">--- Choose Shift Timing ----</option>
                                            <?php
                                            foreach ($shiftDetails as $key => $value) {
                                                echo '<option value="' . $value->ShiftID . '">' . ($value->StartTime) . ' - ' . ($value->EndTime) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group ">
                                        <label class="control-label">Month</label>
                                        <input type="text" class="form-control form-control-1 input-sm month-picker" placeholder="Month">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="sandbox-container">
                                <div class="col-sm-8"></div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </section>
            <div class="page_content_wrap page_paddings_no">
                <div class="content_wrap">
                    <div class="content">
                        <article class="post_item post_item_single post_featured_default post_format_standard page type-page hentry">
                            <section class="post_content">
                                <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1475063547001">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="sc_section margin_bottom_small section_style_dark_text" data-animation="animated fadeInUp normal">
                                                    <div class="sc_section_inner">
                                                        <h2 class="sc_section_title sc_item_title sc_item_title_without_descr">Welcome To Staff Scheduling System<span></span></h2>
                                                        <div class="sc_section_content_wrap">
                                                            <div class="sc_section sc_section_block margin_bottom_large aligncenter mw800">
                                                                <div class="sc_section_inner">
                                                                    <div class="sc_section_content_wrap">
                                                                        <span class="sc_highlight fst_1">
                                                                            Employee scheduling software automates the process of creating and maintaining a schedule.
                                                                            Automating the scheduling of employees increases productivity and allows organizations with hourly workforces to re-allocate resources to non-scheduling activities.
                                                                            As scheduling data is accumulated over time, it may be extracted for payroll or to analyze past activity.
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vc_empty_space h_6r">
                                                                <span class="vc_empty_space_inner"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row-full-width"></div>
                                <div class="vc_row wpb_row vc_row-fluid" id="Products">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner vc_custom_1475066123130">
                                            <div class="wpb_wrapper">
                                                <div id="sc_services_918_wrap" class="sc_services_wrap">
                                                    <div id="sc_services_918" class="sc_services sc_services_style_services-1 sc_services_type_images  margin_top_large margin_bottom_large fwidth" data-animation="animated fadeInUp normal">
                                                        <div class="sc_columns columns_wrap ">
                                                            <div class="column-1_3 column_padding_bottom">
                                                                <div id="sc_services_918_1" class="sc_services_item column_styles sc_services_item_1 odd first">
                                                                    <div class="sc_services_item_content">
                                                                        <div style="margin: 7% auto;">
                                                                            <div class="card-header-styles">
                                                                                <h4 class="sc_services_item_title" style="padding-bottom: 16px;">EMPLOYEE SCHEDULING SOFTWARE</h4>
                                                                            </div>
                                                                            <div class="sc_services_item_description">
                                                                                <div class="wpb_text_column wpb_content_element ">
                                                                                    <div class="wpb_wrapper">
                                                                                        <div class="product-info-box__SliderImageWrapper-sc-19uwn34-4 bGKJhT">
                                                                                            <img src="assets/img/schedule.svg" alt="calendar" class="product-info-box__SliderImage-sc-19uwn34-5 bHcjhX" style="padding-bottom: 25px;">
                                                                                        </div>
                                                                                        <h3>Schedule Faster</h3>
                                                                                        <p>Built for professional usage with working time rules, shift patterns & blazing-fast calendar views.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="column-1_3 column_padding_bottom">
                                                                <div id="sc_services_918_1" class="sc_services_item column_styles sc_services_item_1 odd first">
                                                                    <div class="sc_services_item_content">
                                                                        <div style="margin: 7% auto;">
                                                                            <div class="card-header-styles">
                                                                                <h4 class="sc_services_item_title" style="padding-bottom: 16px;">EMPLOYEE TIME TRACKING</h4>
                                                                            </div>
                                                                            <div class="sc_services_item_description">
                                                                                <div class="wpb_text_column wpb_content_element ">
                                                                                    <div class="wpb_wrapper">
                                                                                        <div class="product-info-box__SliderImageWrapper-sc-19uwn34-4 bGKJhT">
                                                                                            <img src="assets/img/timeclock.svg" alt="calendar" class="product-info-box__SliderImage-sc-19uwn34-5 bHcjhX" style="padding-bottom: 25px;">
                                                                                        </div>
                                                                                        <h3>Track Time Easier</h3>
                                                                                        <p>Integrate your schedule with the time clock and reduce labor costs.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="column-1_3 column_padding_bottom">
                                                                <div id="sc_services_918_1" class="sc_services_item column_styles sc_services_item_1 odd first">
                                                                    <div class="sc_services_item_content">
                                                                        <div style="margin: 7% auto;">
                                                                            <div class="card-header-styles">
                                                                                <h4 class="sc_services_item_title" style="padding-bottom: 16px;">APPLICANT TRACKING SOFTWARE</h4>
                                                                            </div>
                                                                            <div class="sc_services_item_description">
                                                                                <div class="wpb_text_column wpb_content_element ">
                                                                                    <div class="wpb_wrapper">
                                                                                        <div class="product-info-box__SliderImageWrapper-sc-19uwn34-4 bGKJhT">
                                                                                            <img src="assets/img/Hire-Graphic.svg" alt="calendar" class="product-info-box__SliderImage-sc-19uwn34-5 bHcjhX" style="padding-bottom: 25px;">
                                                                                        </div>
                                                                                        <h3>Hire Better</h3>
                                                                                        <p>Post jobs, track applicants, and hire better candidates faster.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row wpb_row vc_row-fluid">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="sc_section sc_section_block margin_top_huge margin_bottom_huge aligncenter" data-animation="animated fadeInUp normal">
                                                    <!-- <div class="sc_section_inner">
                                                        <h2 class="sc_section_title sc_item_title sc_item_title_without_descr">Products<span></span></h2>
                                                        <div class="sc_section_content_wrap">
                                                            <div class="columns_wrap sc_columns columns_nofluid sc_columns_count_4">
                                                                <div class="column-1_4 sc_column_item sc_column_item_1 odd first">
                                                                    <figure class="sc_image  sc_image_shape_round">
                                                                        <img src="assets/images/img_milk.jpg" alt="" />
                                                                    </figure>
                                                                    <h4 class="sc_title sc_title_regular cmrg_2">
                                                                        <a href="#">Milk</a>
                                                                    </h4>
                                                                    <div class="wpb_text_column wpb_content_element ">
                                                                        <div class="wpb_wrapper">
                                                                            <p>Dairy farming&#8217;s been part of agriculture for thousands of years.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="column-1_4 sc_column_item sc_column_item_2 even">
                                                                    <figure class="sc_image  sc_image_shape_round">
                                                                        <img src="assets/images/img_cheese.webp" alt="" />
                                                                    </figure>
                                                                    <h4 class="sc_title sc_title_regular cmrg_2">
                                                                        <a href="#">Cheese</a>
                                                                    </h4>
                                                                    <div class="wpb_text_column wpb_content_element ">
                                                                        <div class="wpb_wrapper">
                                                                            <p>Dairy farming&#8217;s been part of agriculture for thousands of years.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="column-1_4 sc_column_item sc_column_item_3 odd">
                                                                    <figure class="sc_image  sc_image_shape_round">
                                                                        <img src="assets/images/img_butter.webp" alt="" />
                                                                    </figure>
                                                                    <h4 class="sc_title sc_title_regular cmrg_2">
                                                                        <a href="#">Butter</a>
                                                                    </h4>
                                                                    <div class="wpb_text_column wpb_content_element ">
                                                                        <div class="wpb_wrapper">
                                                                            <p>Dairy farming&#8217;s been part of agriculture for thousands of years.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="column-1_4 sc_column_item sc_column_item_4 even">
                                                                    <figure class="sc_image  sc_image_shape_round">
                                                                        <img src="assets/images/img_cream.webp" alt="" />
                                                                    </figure>
                                                                    <h4 class="sc_title sc_title_regular cmrg_2">
                                                                        <a href="#">Cream</a>
                                                                    </h4>
                                                                    <div class="wpb_text_column wpb_content_element ">
                                                                        <div class="wpb_wrapper">
                                                                            <p>Dairy farming&#8217;s been part of agriculture for thousands of years.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    <!-- <div class="sc_section_button sc_item_button">
                                                            <a href="#" class="sc_button sc_button_square sc_button_style_filled sc_button_size_large">view all products</a>
                                                        </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1475048754773 inverse_colors">
                        <div class="wpb_column vc_column_container vc_col-sm-1">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper"></div>
                            </div>
                        </div>
                        <div class="wpb_column vc_column_container vc_col-sm-4">
                            <div class="vc_column-inner vc_custom_1475049444491">
                                <div class="wpb_wrapper">
                                    <figure class="sc_image sc_image_shape_square margin_top_huge" data-animation="animated fadeInLeft normal">
                                        <img src="assets/images/image1_1.webp" alt="" />
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="wpb_column vc_column_container vc_col-sm-1">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper"></div>
                            </div>
                        </div>
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <div class="vc_column-inner vc_custom_1475049863739">
                                <div class="wpb_wrapper">
                                    <div class="sc_section sc_section_block " data-animation="animated fadeInRight normal">
                                        <div class="sc_section_inner">
                                            <div class="sc_section_content_wrap"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>
                    </article>
                    <section class="related_wrap related_wrap_empty"></section>
                </div>
            </div>
        </div>
    </div>
    </div>
    <footer class="jobguru-footer-area" id="footer">
        <div class="footer-top section_50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="single-footer-widget footer-contact">
                            <div class="footer-logo">
                                <a href="index.html">
                                    <img src="http://jobportal.ezdockbooking.com/img/EZLogo.PNG" alt="jobguru logo" />
                                </a>
                            </div>
                            <p>Elizabeth-Zion Asia Pacific Pte Ltd providing various services across different industries with trending technologies.</p>
                            <!-- <ul class="footer-social">
                                <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" class="gp"><i class="fa fa-google-plus"></i></a></li>
                            </ul> -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="single-footer-widget footer-contact">
                            <h3 style="color: #f7f7f7;">Contact Info</h3>
                            <p><i class="fa fa-map-marker"></i> 16, Tradehub@21 , 01-42 <br> SINGAPORE 609965
                            </p>
                            <p><i class="fa fa-phone"></i> (+65) 97777640</p>
                            <p><i class="fa fa-envelope-o"></i> career@elizabeth-zion.com</p>
                            <p><i class="fa fa-calendar"></i> Monday - Friday: 9:00 AM to 6:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-left">
                            <p>Copyright &copy; 2019 Elizabeth-Zion Asia Pacific Pte Ltd. All Rights Reserved. Singapore Co. Reg.No 201207152E.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <a href="#" class="scroll_to_top icon-up" title="Scroll to top"></a>
    <div class="custom_html_section"></div>

    <script src="<?= base_url() ?>assets/v2/js/plugins/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/v2/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/moment.js/min/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/v2/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/v2/js/argon-dashboard.min.js?v=1.1.0"></script>
    <script type='text/javascript' src="<?php echo base_url(); ?>assets/homePage/scripts/email-decode.min.js"></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/jquery.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/custom.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/jquery.themepunch.tools.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/jquery.themepunch.revolution.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/revolution.extension.actions.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/revolution.extension.layeranimation.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/revolution.extension.navigation.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/revolution.extension.slideanims.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/superfish.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/core.utils.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/core.init.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/shortcodes.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/core.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/widget.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/homePage/scripts/tabs.min.js'></script>

    <script>
        $(document).ready(function() {
            var calendarPicker = $('#sandbox-container div').datepicker({
                clearBtn: true,
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
                maxViewMode: 0,
                datesDisabled: ['02/06/2020', '02/21/2020'],
            }).hide();
            var monthPicker = $('.month-picker').datepicker({
                autoclose: true,
                minViewMode: 1,
                format: 'MM/yyyy'
            });
            calendarPicker.on('changeDate', function(selected) {
                var selectedDate = new Date(selected.date.valueOf());
                selectedDate.setDate(selectedDate.getDate(new Date(selected.date.valueOf())));
                // monthPicker.datepicker('setDate', selectedDate);
            });
            monthPicker.on('changeDate', function(selected) {
                var selectedDate = new Date(selected.date.valueOf());
                selectedDate.setDate(selectedDate.getDate(new Date(selected.date.valueOf())));
                calendarPicker.datepicker('setDate', selectedDate);
            });
            $('[name="ShiftTimings"]').on('change', function() {
                getShifts();
            });

            $('[name="Month"]').on('change', function() {
                getShifts();
            });

            function getShifts() {
                var shiftTimings = $('[name="ShiftTimings"]').val();
                var selMonth = $('[name="Month"]').val();
                if (shiftTimings !== '' && selMonth !== '') {
                    $.ajax({
                        type: 'GET',
                        url: '<?php echo base_url(); ?>HomeScreen/getShifts?shiftId=' + shiftTimings + '&month=' + selMonth,
                        dataType: 'JSON',
                        beforeSend: function() {
                            // $('.be-loading').addClass('be-loading-active');
                        },
                        success: function(data) {
                            calendarPicker.show();
                            $('.highlight-yellow').removeClass('highlight-yellow');
                            $('.highlight-blue').removeClass('highlight-blue');
                            if (data.length > 0) {
                                $.each(data, function(idx, item) {
                                    var dateObj = new Date(item.BookedDate);
                                    var unixTimestamp = dateObj.getTime();
                                    var nodeEle = $('[data-date="' + unixTimestamp + '"');
                                    if (parseInt(item.BookingsCount) !== 0) {
                                        if (parseInt(item.BookingsCount) < parseInt(item.AvailableBookings)) {
                                            nodeEle.addClass('highlight-yellow');
                                        }
                                        if (parseInt(item.BookingsCount) === parseInt(item.AvailableBookings)) {
                                            nodeEle.addClass('highlight-blue');
                                        }
                                    }
                                });
                            }
                            console.log(data);
                        }
                    });
                } else {
                    calendarPicker.hide();
                }
            }
        });
    </script>
</body>

</html>