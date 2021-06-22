<div class="container-fluid pt-0 pb-0">
    <div class="row">
    <?php $url = sprintf(
        'https://maps.google.com/maps?q=%s&t=&z=13&ie=UTF8&iwloc=&output=embed',
        htmlentities(urlencode($siteSettings['contact_address']))
    ); ?>
        <div class="mapouter">
            <div class="gmap_canvas"><iframe width="100%" height="450" id="gmap_canvas" src="<?=$url;?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" allowfullscreen="1"></iframe><a href="https://soap2day-to.com">soap2day</a><br>
                <style>
                    .mapouter {
                        position: relative;
                        text-align: right;
                        height: 450px;
                        width: 100%;
                    }
                </style><a href="https://www.embedgooglemap.net">embed code for google map</a>
                <style>
                    .gmap_canvas {
                        overflow: hidden;
                        background: none !important;
                        height: 450px;
                        width: 100%;
                    }
                </style>
            </div>
        </div>

    </div>

</div>