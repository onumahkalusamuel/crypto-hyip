<footer id="footer" class="footer footer-1">
    <div class="footer-widget">
        <div class="container">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-4 footer--widget widget-about">
                    <div class="widget-content">
                        <img class="footer-logo" src="assets/images/logo/logo-light.png" height="60px" alt="logo">
                        <p>{$siteSettings.site_description}</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-sm-offset-2 footer--widget widget-links">
                    <div class="widget-title">
                        <h5>Company</h5>
                    </div>
                    <div class="widget-content">
                        <ul>
                            <li><a href="{$route->urlFor('page', ['page'=>'about-us'])}">About Us</a></li>
                            <li><a href="{$route->urlFor('page', ['page'=>'latest-news'])}">Latest News</a></li>
                            <li><a href="{$route->urlFor('page', ['page'=>'contact-us'])}">Contact Us</a></li>
                            <li><a href="{$route->urlFor('page', ['page'=>'faqs'])}">FAQs</a></li>
                            <li><a href="{$route->urlFor('page', ['page'=>'login'])}">Login</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 footer--widget widget-links">
                    <div class="widget-title">
                        <h5>Useful Links</h5>
                    </div>
                    <div class="widget-content">
                        <ul>
                            {foreach from=$siteSettings.external_menu item=link}
                                <li><a href="{$link.url}" target="_blank">{$link.title}</a></li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="footer--bar">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 text--center footer--copyright">
                    <div class="payment--methods text--center">
                        <a href="#" title="Visa"><img src="assets/images/footer/visa.png" alt="Visa"></a>
                        <a href="#" title="Mastercard"><img src="assets/images/footer/mastercard.png"
                                alt="Mastercard"></a>
                        <a href="#" title="amex"> <img src="assets/images/footer/amex.png" alt="amex"></a>
                        <a href="#" title="Delta"><img src="assets/images/footer/delta.png" alt="Delta"> </a>
                        <a href="#" title="Cirrus"><img src="assets/images/footer/cirrus.png" alt="Cirrus"></a>
                        <a href="#" title="Paypal"><img src="assets/images/footer/paypal.png" alt="Paypal"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="back-to-top" class="backtop"><i class="fa fa-long-arrow-up"></i></div>
</div>
<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/bitcoinCalculators.js"></script>
<script src="assets/js/bitcoinPrice.js"></script>
<script src="assets/js/bitcoinChart.js"></script>
<script src="assets/js/functions.js"></script>
<script src="assets/js/script.js"></script>

<script src="assets/revolution/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
<script src="assets/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
<script src="assets/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="assets/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="assets/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="assets/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="assets/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="assets/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="assets/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="assets/revolution/js/extensions/revolution.extension.parallax.min.js"></script>

<script src="assets/js/rsconfig.js"></script>
</body>

</html>