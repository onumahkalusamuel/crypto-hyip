<!-- Footer -->
<footer id="footer" class="footer" data-bg-color="#152029">
    <div class="container pt-70 pb-40">
        <div class="col-md-4">
            <div class="widget dark">
                <img alt="" src="assets/images/logo-footer.png">
                <p class="font-12 mt-20 mb-20"><?= $siteSettings['site_description']; ?></p>
                <p class="mt-20"><?= $siteSettings['contact_address']; ?></p>
                <ul class="list-inline">
                    <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-gray mr-5"></i> <a class="text-gray" href="tel:<?= str_replace([' ', '(', ')', '-'], '', $siteSettings['contact_phone']); ?>"><?= $siteSettings['contact_phone']; ?></a> </li>
                    <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-gray mr-5"></i> <a class="text-gray" href="index-mp-layout4.html#"><?= $siteSettings['contact_email']; ?></a> </li>
                </ul>
            </div>
        </div>
        <style>
            a.useful-link {
                padding: 5px 10px;
                border: 1px solid #888;
                border-radius: 50px;
                margin: 4px 2px;
                display: inline-block;
            }

            a.useful-link:hover {
                background-color: #aaa;
                color: #222;
            }

            hr.divider {
                border-color: #555;
                margin: 5px 0px;
            }
        </style>
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="widget dark">
                        <h4 class="widget-title">Useful Links</h4>
                        <div class="clearfix">
                            <div class="flex col-md">
                                <a class="useful-link" href="<?= $route->urlFor('home'); ?>">Home</a>

                                <?php foreach ($siteSettings['secondary_menu'] as $menu) : ?>
                                    <a class="useful-link" href="<?= $route->urlFor('page', ['page' => $menu]); ?>"><?= (ucwords(str_replace("-", " ", $menu))); ?></a>
                                <?php endforeach; ?>
                            </div>
                            <hr class="divider" />
                            <div class="flex col-md">
                                <?php foreach ($siteSettings['external_menu'] as $menu) : ?>
                                    <a class="useful-link" target="_blank" href="<?= $menu['url']; ?>"><?= $menu['title']; ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="widget dark">
                        <h4 class="widget-title">Opening Hours</h4>
                        <div class="opening-hours">
                            <ul class="list-border">
                                <li class="clearfix"> <span> Mon, Tues, Thurs, Friday : </span>
                                    <div class="value pull-right"> 8.00 am - 5.00 pm </div>
                                </li>
                                <li class="clearfix"> <span> Wednes :</span>
                                    <div class="value pull-right"> 8.00 am - 3.00 pm </div>
                                </li>
                                <li class="clearfix"> <span> Sat : </span>
                                    <div class="value pull-right"> 12.00 pm - 5.00 pm </div>
                                </li>
                                <li class="clearfix"> <span> Sun : </span>
                                    <div class="value pull-right bg-theme-colored2 text-white closed"> Closed </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom" data-bg-color="#253039">
        <div class="container pt-20 pb-20">
            <div class="row">
                <div class="col-md-6">
                    <p class="font-12 sm-text-center text-black-777 m-0">
                        Copyright &copy;&nbsp;<?= date('Y', time()); ?> <?= $siteSettings['site_name']; ?>. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<a class="scrollToTop" href="index-mp-layout4.html#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper -->

<!-- Footer Scripts -->
<!-- JS | Chart-->
<script src="assets/js/chart.js"></script>
<!-- JS | Custom script for all pages -->
<script src="assets/js/custom.js"></script>
<script src="assets/js/script.js"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
      (Load Extensions only on Local File Systems ! 
       The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="assets/js/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="assets/js/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="assets/js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="assets/js/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="assets/js/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="assets/js/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="assets/js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="assets/js/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>

</body>

</html>