<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ригер</title>

    <!-- responsive meta -->
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <!-- For IE -->
    <meta content="IE=edge" http-equiv="X-UA-Compatible">

    <link href="{{ asset("assets/css/aos.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/imp.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/custom-animate.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/flaticon.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/font-awesome.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/owl.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/magnific-popup.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/scrollbar.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/hiddenbar.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/color.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/color/theme-color.css") }}" id="jssDefault" rel="stylesheet">
    <link href="{{ asset("assets/css/style.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/css/responsive.css") }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="assets/images/favicon/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="assets/images/favicon/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png">
    <link href="assets/images/favicon/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">

<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="{{ asset("assets/js/html5shiv.js") }}"></script>
    <![endif]-->
</head>
<body>
<div class="boxed_wrapper">
    <div class="preloader"></div>
    <!-- Main header -->
    <header class="main-header header-style-one">
        <!--Start Header Top-->
        <div class="header-top">
            <div class="outer-container">
                <div class="outer-box clearfix">
                    <div class="header-top-left pull-left">
                        <p><i aria-hidden="true" class="fa fa-bullhorn thm-clr"></i>Регистрируйся и получай бонусы!</p>
                    </div>
                    <div class="header-top-right clearfix pull-right">
                        <div class="header-social-link">
                            <ul>
                                <li>
                                    <a href="#"><i aria-hidden="true" class="fa fa-globe"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i aria-hidden="true" class="fa fa-vk"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="header-contact-info">
                            <ul>
                                <li><span class="flaticon-phone thm-clr"></span><a href="tel:123456789">(123)
                                        456-7891</a></li>
                                <li><span class="flaticon-mail thm-clr"></span><a href="mailto:info@templatepath.com">vkutov@popstop.space</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Top-->
        <!--Start header-->
        <div class="header">
            <div class="outer-container">
                <div class="outer-box thm-bgclr clearfix">
                    <!--Start Header Left-->
                    <div class="header-left clearfix pull-left">
                        <div class="logo">
                            <a href="/?employee_id=1"><img alt="Awesome Logo" src="assets/images/resources/logo.png"
                                                           title=""></a>
                        </div>
                        <div class="nav-outer clearfix">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler">
                                <div class="inner">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </div>
                            </div>
                            <!-- Main Menu -->
                            <nav class="main-menu style1 navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li><a href="#tips">Оставить чаевые</a></li>
                                        <li><a href="">Бонусы</a></li>
                                    </ul>
                                </div>
                            </nav>
                            <!-- Main Menu End-->
                        </div>
                    </div>
                    <!--End Header Left-->
                    <!--Start Header Right-->
                    <div class="header-right pull-right clearfix">
                        <div class="button">
                            <a class="thm-bgclr2" href="#">Авторизация</a>
                        </div>
                    </div>
                    <!--End Header Right-->
                </div>
            </div>
        </div>
        <!--End header -->
        <!--Sticky Header-->
        <div class="sticky-header">
            <div class="container">
                <div class="clearfix">
                    <!--Logo-->
                    <div class="logo float-left">
                        <a class="img-responsive" href="/"><img alt="" src="assets/images/resources/logo.png"
                                                                title=""></a>
                    </div>
                    <!--Right Col-->
                    <div class="right-col float-right">
                        <!-- Main Menu -->
                        <nav class="main-menu clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--End Sticky Header-->
        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-multiply"></span></div>

            <nav class="menu-box">
                <div class="nav-logo"><a href="/"><img alt="" src="assets/images/resources/logo.png" title=""></a>
                </div>
                <div class="menu-outer">
                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
                <!--Social Links-->
                <div class="social-links">
                    <ul class="clearfix">
                        <li><a href="#"><span class="fab fa fa-globe"></span></a></li>
                        <li><a href="#"><span class="fab fa fa-twitter-square"></span></a></li>
                        <li><a href="#"><span class="fab fa fa-pinterest-square"></span></a></li>
                        <li><a href="#"><span class="fab fa fa-google-plus-square"></span></a></li>
                        <li><a href="#"><span class="fab fa fa-youtube-square"></span></a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End Mobile Menu -->
    </header>
    <!-- Start Main Slider-->
    <section class="main-slider style1" style="background-image:url(assets/images/slides/main-slider-style1-bg.jpg)">
        <div class="slider-box">
            <!-- Banner Carousel -->
            <div class="banner-carousel owl-theme owl-carousel">
                <!-- Slide -->
                <div class="slide">
                    <div class="auto-container">
                        <div class="content">
                            <h2>Нигора<br>Настоящая узбекская кухня</h2>
                        </div>
                    </div>
                    <div class="image-holder">
                        <img alt="Slide Image" src="assets/images/slides/slide-style1-image-1.png">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="donate-style1-area" id="#tips">
        <div class="layer-outer" style="background-image: url(assets/images/shape/donate-style1-bg.png)"></div>
        <div class="container">
            <div class="title text-center">
                <h2>Оставить чаевые</h2>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <form action="send" id="donate-form-style1" method="post" name="donate_form_style1">
                        @csrf
                        <ul class="select-donate-style1-box">
                            <li>
                                <input id="donate-amount-1" name="donate-amount" type="radio" value="25"/>
                                <label data-amount="25" for="donate-amount-1">25 руб.</label>
                            </li>
                            <li>
                                <input checked="checked" id="donate-amount-2" name="donate-amount" type="radio"
                                       value="50"/>
                                <label data-amount="50" for="donate-amount-2">50 руб.</label>
                            </li>
                            <li>
                                <input id="donate-amount-3" name="donate-amount" type="radio" value="100"/>
                                <label data-amount="100" for="donate-amount-3">100 руб.</label>
                            </li>
                            <li>
                                <input id="donate-amount-4" name="donate-amount" type="radio" value="500"/>
                                <label data-amount="500" for="donate-amount-4">500 руб.</label>
                            </li>
                            <li>
                                <input id="donate-amount-5" name="donate-amount-custom" placeholder="Выбрать сумму"
                                       step="1"
                                       type="number" step="1"/>
                            </li>
                        </ul>
                        <input type="hidden" name="employee_id" value="{{ Request::get('employee_id') }}">
                        <div class="button-box text-center">
                            <button class="btn-one" type="submit">
                                <span class="txt">Отправить</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="features-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="single-feature-box wow fadeInUp animated" data-wow-delay="500ms"
                         data-wow-duration="1500ms">
                        <div class="img-holder">
                            <div class="inner">
                                <img alt="Картинка" class="js-tilt" src="assets/images/resources/feature-3.jpg">
                            </div>
                            <div class="title text-center">
                                <h3>Анна<br>Официант года</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features-area">
        <div class="container">
            <div class="row cart-button-box justify-content-center py-5">
                <div class="apply-coupon">
                    <div class="text">
                        <p>Оставить отзыв</p>
                    </div>
                    <form action="comment" id="donate-form-style1" method="post" name="donate_form_style1">
                        @csrf
                        <div class="inner d-flex justify-content-center">
                            <input type="hidden" name="employee_id" value="{{ Request::get('employee_id') }}">
                            <input name="message" placeholder="Напишите текст" type="text" value="">
                            <div class="rating-area d-flex justify-content-center align-items-center">
                                <input type="radio" id="star-1" name="rate" value="1">
                                <label for="star-1" title="Оценка «1»"></label>
                                <input type="radio" id="star-2" name="rate" value="2">
                                <label for="star-2" title="Оценка «2»"></label>
                                <input type="radio" id="star-3" name="rate" value="3">
                                <label for="star-3" title="Оценка «3»"></label>
                                <input type="radio" id="star-4" name="rate" value="4">
                                <label for="star-4" title="Оценка «4»"></label>
                                <input type="radio" id="star-5" name="rate" value="5" checked>
                                <label for="star-5" title="Оценка «5»"></label>
                            </div>
                            <div class="apply-coupon-button">
                                <button class="btn-one" type="submit"><span class="txt">Отправить</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer-area">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <!--Start single footer widget-->
                    <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12 wow animated fadeInUp" data-wow-delay="0.1s">
                        <div class="single-footer-widget marbtm">
                            <div class="our-company-info">
                                <div class="footer-logo">
                                    <a href="/"><img alt="Awesome Footer Logo"
                                                     src="assets/images/resources/logo.png" title="Logo"></a>
                                </div>
                                <div class="text">
                                    <p>
                                        ОТДЕЛ ПЕРСОНАЛА:<br>e-mail: hr@nigora.ru
                                    </p>
                                    <p>
                                        ПРЕДЛОЖИТЕ НАМ:<br>Cотрудничество, товары и услуги: zakupki@nigora.ru
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="outer-box">
                    <div class="copyright-text">
                        <p><a href="#">Ригер</a> &copy; 2021</p>
                    </div>
                    <div class="footer-menu">
                        <ul>
                            <li><a href="#">Политика конфиденциальности</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-angle-double-up"></span>
</button>
<script src="{{ asset("assets/js/jquery.js") }}"></script>
<script src="{{ asset("assets/js/appear.js") }}"></script>
<script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/js/bootstrap-select.min.js") }}"></script>
<script src="{{ asset("assets/js/isotope.js") }}"></script>
<script src="{{ asset("assets/js/jquery.bootstrap-touchspin.js") }}"></script>
<script src="{{ asset("assets/js/jquery.countdown.min.js") }}"></script>
<script src="{{ asset("assets/js/jquery.countTo.js") }}"></script>
<script src="{{ asset("assets/js/jquery.easing.min.js") }}"></script>
<script src="{{ asset("assets/js/jquery.enllax.min.js") }}"></script>
<script src="{{ asset("assets/js/jquery.fancybox.js") }}"></script>
<script src="{{ asset("assets/js/jquery.mixitup.min.js") }}"></script>
<script src="{{ asset("assets/js/jquery.paroller.min.js") }}"></script>
<script src="{{ asset("assets/js/jquery.polyglot.language.switcher.js") }}"></script>
<script src="{{ asset("assets/js/map-script.js") }}"></script>
<script src="{{ asset("assets/js/nouislider.js") }}"></script>
<script src="{{ asset("assets/js/owl.js") }}"></script>
<script src="{{ asset("assets/js/validation.js") }}"></script>
<script src="{{ asset("assets/js/wow.js") }}"></script>
<script src="{{ asset("assets/js/jquery.magnific-popup.min.js") }}"></script>
<script src="{{ asset("assets/js/slick.js") }}"></script>
<script src="{{ asset("assets/js/lazyload.js") }}"></script>
<script src="{{ asset("assets/js/scrollbar.js") }}"></script>
<script src="{{ asset("assets/js/tilt.jquery.js") }}"></script>
<script src="{{ asset("assets/js/jquery.bxslider.min.js") }}"></script>
<script src="{{ asset("assets/js/jquery-ui.js") }}"></script>
<script src="{{ asset("assets/js/jQuery.style.switcher.min.js") }}"></script>
<script src="{{ asset("assets/js/custom.js") }}"></script>
</body>
</html>
