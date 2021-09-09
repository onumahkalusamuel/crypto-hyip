    <!-- Divider: Live Table -->
    <section class="layer-overlay overlay-theme-colored-9" data-bg-img="assets/images/bg/bg4.jpg">
        <div class="container">
            <div class="section-title text-center mb-40">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="title text-white text-uppercase">Live <span class="text-theme-colored2">Price Table</span></h2>
                        <div class="line-bottom-double-line-centered"></div>
                        <p class="text-gray-lightgray mt-10">Stay updated with the market as it moves. <br>Make your investments and trading decisions based on realtime and reliable data.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php echo $this->fetch(
                        'public/components/coinlib-widget.php',
                        ['widgetConfig' => []]
                    ); ?>
                </div>
            </div>
        </div>
    </section>