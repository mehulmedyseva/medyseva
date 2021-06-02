<div class="d-flex align-items-center position-relative min-vh-100">

    <!-- Left content -->
    <div class="jarallax overlay overlay-primary overlay-70 col-lg-5 col-xl-4 d-none d-lg-flex align-items-center h-100vh px-0" data-jarallax data-speed="0.9" style="background-image: url(<?php echo base_url() ?>assets/front/img/vericla-cover.jpg);">

        <div class="w-100 p-5 text-center">

            <div class="position-relative">
                <a href="<?php echo base_url() ?>"><h1 class="text-white display-4 font-weight-normal" data-aos="fade-up" data-aos-duration="300"><?php echo html_escape(settings()->site_name); get_pres_values();?></h1></a>
                <p class="lead text-white-90 mb-0 w-85 w-xl-70 mx-auto" data-aos="fade-up" data-aos-duration="400">
                    Book and attend appointments online, Get online prescriptions and lab reports directly to your email id.
                </p>
            </div>

            <div class="position-absolute right-0 bottom-0 left-0 text-center text-white p-5">
                <div class="row">
                    <div class="col-6">
                        <p class="mb-0 mt-1"><span class="text-white-85"> <?php echo html_escape(settings()->copyright) ?></span></p>
                    </div>
                    <div class="col-6">
                        <ul class="list-inline-item mb-0">
                            <li class="list-inline-item"><a href="<?php echo base_url('page/privacy-policy') ?>" class="text-white-85 hover-white"><?php echo trans('privacy') ?></a></li>
                            <li class="list-inline-item"><a href="<?php echo base_url('page/terms-of-service') ?>" class="text-white-85 hover-white"><?php echo trans('terms') ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Left content -->


    <?php if (isset($page_title) && $page_title == 'Register'): ?>   
        <!-- Register form -->
        <div class="container">
            <div class="row justify-content-center justify-content-lg-start">
                <div class="col-md-8 col-lg-7 col-xl-5 offset-lg-2 offset-xl-3 my-5" data-aos="fade-left" data-aos-duration="400">

                    <?php if (settings()->enable_registration == 0): ?>
                        <div class="mb-6 text-center">
                            <img class="mb-4" width="30%" src="<?php echo base_url('assets/front/img/not-found.png') ?>">
                            <h3 class="text-muted"><?php echo trans('registration-system-is-disabled-') ?></h3>
                            <a class="btn btn-light-primary btn-sm mt-2" href="<?php echo base_url('contact') ?>"> <?php echo trans('contact-admin') ?></a>
                            <a class="btn btn-light-primary btn-sm mt-2" href="<?php echo base_url() ?>"><i class="icon-home"></i> <?php echo trans('home') ?> </a>
                        </div>
                    <?php else: ?>
                        <div class="mb-6 text-center">
                            <h2 class="font-weight-bold mb-0"><a href="<?php echo base_url() ?>"><img width="30%" src="<?php echo base_url(settings()->logo) ?>"></a></h2>
                            <p class="mb-0"><?php echo trans('get-started-with-a') ?> <span class="font-weight-bold text-dark"><?php echo html_escape(settings()->site_name) ?> </span> <?php echo trans('account') ?></p>
                        </div>

                        <div class="mb-4 mt-4">
                            <div class="success text-success"></div>
                            <div class="success_extend text-success"></div>
                            <div class="error text-danger"></div>
                            <div class="warning text-warning"></div>
                        </div>

                        <form id="register_form" class="authorization__form authorization__form--shadow leave_con" method="post" action="<?php echo base_url('auth/book_appointment'); ?>">

                            <div class="row">

                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label><?php echo trans('name') ?></label>
                                        <input type="text" class="form-control" name="name" placeholder="<?php echo trans('your-full-name') ?>">
                                    </div>
                                </div>


                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label><?php echo trans('email') ?></label>
                                        <input type="email" class="form-control" name="email" placeholder="<?php echo trans('your-email-address') ?>">
                                    </div>
                                </div>

                               <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label><?php echo trans('phone') ?></label>
                                     <input type="text" class="form-control" name="mobile" placeholder="Phone no." oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="\d{10}" maxlength="10" required>

                                    </div>
                                </div>
                                
                                
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label><?php echo trans('password') ?></label>
                                        <input type="password" class="form-control" name="new_password" placeholder="<?php echo trans('your-password') ?>">
                                    </div>
                                </div>

                            </div>


                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <?php if (settings()->enable_captcha == 1 && settings()->captcha_site_key != ''): ?>
                                        <div class="g-recaptcha pull-left" data-sitekey="<?php echo html_escape(settings()->captcha_site_key); ?>"></div>
                                    <?php endif ?>
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="agree" class="custom-control-input agree_btn" id="terms-condition" required>
                                        <label class="custom-control-label" for="terms-condition">
                                            <?php echo trans('i-have-read-and-understood-the') ?> <a href="<?php echo base_url('page/terms-of-service') ?>"><?php echo trans('terms-and-conditions') ?></a> <?php echo trans('and') ?> <a href="<?php echo base_url('page/privacy-policy') ?>"> <?php echo trans('privacy-policy') ?> </a><?php echo trans('of-this-site') ?>.</label>
                                    </div>
                                </div>

                                <div class="col-md-12 center">
                                    <input type="hidden" name="plan" value="<?php if(isset($_GET['plan'])){echo html_escape($_GET['plan']);}else{echo "basic";} ?>">
                                    <input type="hidden" name="billing" value="<?php if(isset($_GET['billing'])){echo html_escape($_GET['billing']);}else{echo "monthly";} ?>">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    <button type="submit" class="btn btn-primary btn-block mt-4 mb-0 register_button"><?php echo trans('register') ?></button>
                                </div>
                            </div>


                            <div class="text-center text-small mt-4">
                                <span><?php echo trans('already-have-an-account') ?> <a href="<?php echo base_url('login') ?>"><?php echo trans('sign-in') ?></a></span>
                            </div>

                        </form>
                    <?php endif ?>

                </div>
            </div>
        </div>
        <!-- End Register form -->
    <?php endif ?>

    <?php if (isset($page_title) && $page_title == 'Email Verification'): ?>
    <!-- email verify -->
    <div class="container">
        <div class="row justify-content-center justify-content-lg-start">
            <div class="col-md-8 col-lg-7 col-xl-5 offset-lg-2 offset-xl-3 my-5" data-aos="fade-down" data-aos-duration="400">

         
                    <div class="mb-3 text-center">
                        <img class="mb-4" width="30%" src="<?php echo base_url('assets/front/img/message.png') ?>">
                        <p class="lead"><?php echo trans('send-verification-code') ?></p>
                    </div>

                    <form id="verify_from" method="post" action="<?php echo base_url('auth/verify_account'); ?>">

                        <div class="row justify-content-center">
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <input type="text" class="form-control text-center" name="code" placeholder="Enter Code here">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <button type="submit" class="btn btn-success btn-blocks mb-0 verify_btn"><i class="ficon flaticon-check"></i> <?php echo trans('verify-code') ?></button>
                            </div>
                        </div>


                        <div class="loader mb-2 mt-4 text-primary text-center hide"><?php echo trans('sending') ?> <i class="fa fa-spinner fa-spin"></i></div>

                        <div class="text-center text-small mt-2">
                            <span><?php echo trans('dont-received-code') ?> <a class="resend_mail" href="<?php echo base_url('auth/resend') ?>"><?php echo trans('resend') ?></a></span>
                        </div>

                    </form>

            </div>
        </div>
    </div>
    <!-- End email verify -->
    <?php endif ?>
</div>






