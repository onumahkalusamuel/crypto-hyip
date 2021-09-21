{literal}
    <div class="gte-container">
        <div id="google_translate_element"></div>
        <button class="gte-toggler backtop" title="Translate Website" onclick="toggleTranlate();">
            <i class="fa fa-language"></i>
        </button>
    </div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en'}, 
                'google_translate_element'
            );
        }

        function toggleTranlate() {
            var gte = document.getElementById('google_translate_element');
            if (gte.style.display == 'none') {
                gte.style.display = 'block'
            } else {
                gte.style.display = 'none'
            }
        }
    </script>

    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
{/literal}

<style>
    .gte-container {
        z-index: 1000;
        position: fixed;
        bottom: 100px;
        right: 40px;
        display: flex;
        align-items: center;
    }

    #google_translate_element {
        border: 2px solid #9b8040;
        background-color: whitesmoke;
        border-radius: 10px;
        padding: 0px 10px;
        margin-right: 10px;
        display: none;
        transition: cubic-bezier(.68, -0.55, .27, 1.55) all 200ms;
    }

    @media screen and (max-width:920px) {
        .gte-container {
            z-index: 1000000;
            position: fixed;
            bottom: 30px;
            right: 15px;
        }
    }

    .gte-toggler {
        background-color: #9b8040;
        border: none !important;
        width: 50px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        color: #fff;
        cursor: pointer;
        border-radius: 50%;
        transition: opacity 0.2s ease-out;
        font-size: 25px;
    }
</style>