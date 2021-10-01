{include file="theme/public/header.tpl" pageTitle="Contact Us" active="contact_us"}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/8.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center">
                    <div class="title--heading">
                        <h1>Contact Us</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('home')}">Home</a></li>
                        <li class="active">contacts us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact2" class="contact contact-2 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h2 class="heading heading--title">Get in Touch</h2>
                            <div class="divider--line divider--wide mb-30"></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="contact--desc">
                                <p>We believe that nothing builds a solid relationship better than adequate
                                    communication; we therefore have provided channels so you can reach out to us.
                                    Please feel free to send in your inquiries, suggestions, complaints and testimonial.
                                </p>
                            </div>
                            <div class="row mb-30">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="contact--info">
                                        <h3>Our Address</h3>
                                        <p style="font-size: 1.3em;">{$siteSettings.contact_address}</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="contact--info">
                                        <h3>Our Phone</h3>
                                        <p style="font-size: 1.3em;">
                                            <a href='tel:{$siteSettings.contact_phone|regex_replace:"/[\+\s\(\)]/":""}'>
                                                <span class="fa fa-phone"></span>
                                                {$siteSettings.contact_phone}
                                            </a>
                                        </p>
                                        <p style="font-size: 1.3em;">
                                            <a
                                                href='https://wa.me/{$siteSettings.whatsapp_number|regex_replace:"/[\+\s\(\)]/":""}'>
                                                <span class="fa fa-whatsapp"></span>
                                                {$siteSettings.whatsapp_number}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="contact--info">
                                        <h3>Our Email</h3>
                                        <p style="font-size: 1.3em;">Main Email : <a
                                                href="mailto:{$siteSettings.contact_email}">{$siteSettings.contact_email}</a>
                                        </p>
                                        <p style="font-size: 1.3em;">Inquiries : <a
                                                href="mailto:{$siteSettings.contact_email}">{$siteSettings.contact_email}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="contact-form">
                                <form id="contact_form" class="mb-0" onsubmit="return ajaxPost('contact_form');"
                                    action="{$route->urlFor('contact-us-form')}" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Name:" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email:" required>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="subject" id="subject"
                                                placeholder="Subject:" required>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="message" id="message" rows="2"
                                                placeholder="Message:" required></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="submit" value="Send Message" name="submit"
                                                class="btn btn--secondary btn--block">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{include file="theme/public/components/section-consultation.tpl"}

{include file="theme/public/components/section-clients.tpl"}

<script>
    function submitContactForm() {
        var form = document.getElementById('contact_form');
        var formData = JSON.stringify(Object.fromEntries(new FormData(form)));

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState !== 4) return;
            try {
                var response = JSON.parse(xhr.response);
                alert(response.message);
            } catch (e) {
                alert('An error occured. Please try again later.')
            }
        }

        xhr.open('POST', form.getAttribute('action'), true);
        xhr.setRequestHeader('content-type', 'application/json');
        xhr.send(formData);
        return false;
    }
</script>

{include file="theme/public/footer.tpl"}