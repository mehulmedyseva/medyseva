<div class="content-wrapper">

 <section class="content">


  <div class="container">

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="flaticon-settings"></i> <?php echo trans('manage-settings') ?></h3>
      </div>

      <div class="box-body">
        <div class="row">
          <div class="col-md-3 mb-3">
            <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-cog"></i> <?php echo trans('website-settings') ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="zoom-tab" data-toggle="tab" href="#zoom" role="tab" aria-controls="zoom" aria-selected="false"><i class="fa fa-video-camera"></i> Zoom <?php echo trans('settings') ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="prefrences-tab" data-toggle="tab" href="#prefrences" role="tab" aria-controls="prefrences" aria-selected="false"><i class="fa fa-paint-brush"></i> <?php echo trans('preferences') ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="mail-tab" data-toggle="tab" href="#mail" role="tab" aria-controls="mail" aria-selected="false"><i class="fa fa-envelope"></i> <?php echo trans('email-settings') ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="captcha-tab" data-toggle="tab" href="#captcha" role="tab" aria-controls="captcha" aria-selected="false"><i class="fa fa-check"></i> reCaptcha V2 <?php echo trans('settings') ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="false"><i class="fa fa-facebook-official"></i> <?php echo trans('social-settings') ?></a>
              </li>
            </ul>
          </div>

          <!-- col-md-4 -->
          
            <div class="col-md-9">
              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update') ?>" role="form" class="form-horizontal pl-20">
                <div class="tab-content" id="myTabContent">
                  
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            
                      <div class="row mb-4">
                          <div class="col-sm-4">
                              <div class="form-group m-t-20">
                                <div class="col-sm-12">
                                  <div class="mih-100">
                                    <img width="50px" src="<?php echo base_url($settings->favicon); ?>">
                                  </div>

                                  <div class="psr m-t-5">
                                    <a class='btn btn-light-secondary' href='javascript:;'>
                                      <i class="fa fa-cloud-upload"></i> <?php echo trans('upload-favicon') ?>
                                      <input type="file" class="upload_img_deg" name="photo1" size="40"  onchange='$("#upload-favicon").html($(this).val());'>
                                    </a>
                                    &nbsp;
                                    <span class='label label-default' id="upload-favicon"></span>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="form-group m-t-20">
                                <div class="col-sm-12">
                                  <div class="mih-100">
                                  <img width="150px" src="<?php echo base_url($settings->logo); ?>">
                                </div>

                                  <div class="psr m-t-5">
                                    <a class='btn btn-light-secondary' href='javascript:;'>
                                      <i class="fa fa-cloud-upload"></i> <?php echo trans('upload-logo') ?>
                                      <input type="file" class="upload_img_deg" name="photo2" size="40"  onchange='$("#upload-logo").html($(this).val());'>
                                    </a>
                                    &nbsp;
                                    <span class='label label-default' id="upload-logo"></span>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="form-group m-t-20">
                                <div class="col-sm-12">
                                  <div class="mih-100">
                                  <img width="100px" src="<?php echo base_url($settings->hero_img); ?>">
                                </div>

                                  <div class="psr m-t-5">
                                    <a class='btn btn-light-secondary' href='javascript:;'>
                                      <i class="fa fa-cloud-upload"></i> <?php echo trans('upload-home-image') ?>
                                      <input type="file" class="upload_img_deg" name="photo3" size="40"  onchange='$("#upload-hero").html($(this).val());'>
                                    </a>
                                    &nbsp;
                                    <span class='label label-default' id="upload-hero"></span>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>



                      <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('application-name') ?></label>
                        <div class="col-sm-12">
                          <input type="text" name="site_name" value="<?php echo html_escape($settings->site_name); ?>" class="form-control" >
                        </div>
                      </div>

                      <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('application-title') ?></label>
                        <div class="col-sm-12">
                          <input type="text" name="site_title" value="<?php echo html_escape($settings->site_title); ?>" class="form-control" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('keywords') ?></label>
                        <div class="col-sm-12">
                          <input type="text" data-role="tagsinput" name="keywords" value="<?php echo html_escape($settings->keywords); ?>" class="form-control" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('description') ?></label>
                        <div class="col-sm-12">
                          <textarea class="form-control" name="description" rows="4"><?php echo html_escape($settings->description); ?></textarea>
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('footer-about') ?></label>
                        <div class="col-sm-12">
                          <textarea class="form-control" name="footer_about"><?php echo html_escape($settings->footer_about); ?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('admin-email') ?></label>
                        <div class="col-sm-12">
                          <input type="email" name="admin_email" class="form-control" value="<?php echo html_escape(user()->email); ?>">
                          <p class="smalls text-danger"><i class="fa fa-info-circle"></i> <?php echo trans('settings-email-info') ?></p>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('copyright') ?></label>
                        <div class="col-sm-12">
                          <input type="text" name="copyright" class="form-control" value="<?php echo html_escape($settings->copyright); ?>">
                        </div>
                      </div>

                      <div class="form-group m-b-20">
                        <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('set-trial-days') ?></label>
                        <div class="col-sm-12">
                          <input type="number" name="trial_days" class="form-control" value="<?php echo html_escape($settings->trial_days); ?>">
                          <p class="smalls text-danger"><i class="fa fa-info-circle"></i> <?php echo trans('set-trial-info') ?></p>
                        </div>
                      </div>
                  </div>


                  <!-- zoom tab -->
                  <div class="tab-pane fade" id="zoom" role="tabpanel" aria-labelledby="zoom-tab">
                      <div class="form-group mt-20 p-10">
                          <p class="pull-right"><a class=" badge badge-danger-soft brd-20" target="_blank" href="<?php echo base_url('assets/images/zoom-instruction.pdf') ?>"><i class="fa fa-question-circle"></i> Zoom Integration guideline</a></p>
                      </div>

                      <div class="form-group mt-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Zoom API Key</label>
                        <div class="col-sm-12">
                          <input type="text" name="zoom_api_key" value="<?php echo html_escape($settings->zoom_api_key); ?>" class="form-control" >
                        </div>
                      </div>
                      <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Zoom Secret Key</label>
                        <div class="col-sm-12">
                          <input type="text" name="zoom_secret_key" value="<?php echo html_escape($settings->zoom_secret_key); ?>" class="form-control" >
                        </div>
                      </div>
                  </div>

                  <!-- prefrences tab -->
                  <div class="tab-pane fade" id="prefrences" role="tabpanel" aria-labelledby="prefrences-tab">
                      <div class="form-group">
                          <div class="col-sm-12 mt-15">

                            <div class="custom-control custom-switch ml-10">
                                <input type="checkbox" name="enable_multilingual" class="custom-control-input" value="1" id="switch-8" <?php if($settings->enable_multilingual == 1){echo "checked";} ?>>
                                <label class="custom-control-label" for="switch-8"><?php echo trans('multilingual-system') ?></label>
                                <p class="text-muted"><small><?php echo trans('enable-multilingual') ?>.</small></p>
                            </div>
                            
                            <div class="custom-control custom-switch ml-10 mt-25">
                                <input type="checkbox" name="enable_registration" class="custom-control-input" value="1" id="switch-2" <?php if($settings->enable_registration == 1){echo "checked";} ?>>
                                <label class="custom-control-label" for="switch-2"><?php echo trans('registration-system') ?></label>
                                <p class="text-muted"><small><?php echo trans('registration-title') ?>.</small></p>
                            </div>

                            <div class="custom-control custom-switch ml-10 mt-25">
                                <input type="checkbox" name="enable_captcha" class="custom-control-input" value="1" id="switch-1" <?php if($settings->enable_captcha == 1){echo "checked";} ?>>
                                <label class="custom-control-label" for="switch-1">reCaptcha</label>
                                <p class="text-muted"><small><?php echo trans('recaptcha-title') ?></small></p>
                            </div>

                            <div class="custom-control custom-switch ml-10 mt-25">
                                <input type="checkbox" name="enable_email_verify" class="custom-control-input" value="1" id="switch-3" <?php if($settings->enable_email_verify == 1){echo "checked";} ?>>
                                <label class="custom-control-label" for="switch-3"><?php echo trans('email-verification') ?></label>
                                <p class="text-muted"><small><?php echo trans('email-verify-title') ?></small></p>
                            </div>

                            <div class="custom-control custom-switch ml-10 mt-25">
                                <input type="checkbox" name="enable_users" class="custom-control-input" value="1" id="switch-4" <?php if($settings->enable_users == 1){echo "checked";} ?>>
                                <label class="custom-control-label" for="switch-4"><?php echo trans('users') ?></label>
                                <p class="text-muted"><small><?php echo trans('users-title') ?></small></p>
                            </div>

                            <div class="custom-control custom-switch ml-10 mt-25">
                                <input type="checkbox" name="enable_blog" class="custom-control-input" value="1" id="switch-5" <?php if($settings->enable_blog == 1){echo "checked";} ?>>
                                <label class="custom-control-label" for="switch-5"><?php echo trans('blogs') ?></label>
                                <p class="text-muted"><small><?php echo trans('blogs-title') ?></small></p>
                            </div>

                            <div class="custom-control custom-switch ml-10 mt-25">
                                <input type="checkbox" name="enable_faq" class="custom-control-input" value="1" id="switch-6" <?php if($settings->enable_faq == 1){echo "checked";} ?>>
                                <label class="custom-control-label" for="switch-6"><?php echo trans('faqs') ?></label>
                                <p class="text-muted"><small><?php echo trans('faq-title') ?></small></p>
                            </div>

                            <div class="custom-control custom-switch ml-10 mt-25">
                                <input type="checkbox" name="enable_workflow" class="custom-control-input" value="1" id="switch-7" <?php if($settings->enable_workflow == 1){echo "checked";} ?>>
                                <label class="custom-control-label" for="switch-7"><?php echo trans('workflow') ?></label>
                                <p class="text-muted"><small><?php echo trans('workflow-enable') ?></small></p>
                            </div>

                          </div>
                      </div>
                  </div>


                  <!-- mail tab -->
                  <div class="tab-pane fade" id="mail" role="tabpanel" aria-labelledby="mail-tab">
                      
                    <div class="col-sm-12 mt-15">

                        <div class="callout callout-default">
                            <h4><i class="fa fa-envelope-o"></i> Gmail Smtp</h4>

                            <p>Gmail Host:&nbsp;&nbsp;smtp.gmail.com <br>
                            Gmail Port:&nbsp;&nbsp;465</p>

                            <p class="text-success mb-5"><b><i class="fa fa-info-circle"></i> <?php echo trans('mail-info-title') ?></b></p>
                            <p><i class="fa fa-long-arrow-right"></i> <?php echo trans('two-factor-off') ?> <br>
                            <i class="fa fa-long-arrow-right"></i> <?php echo trans('less-secure-app-on') ?></p>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo trans('mail-type') ?></label>
                            <select name="mail_protocol" class="form-control custom-select">
                                <option value="smtp" <?php echo ($settings->mail_protocol == "smtp") ? "selected" : ""; ?>>smtp</option>
                                <option value="mail" <?php echo ($settings->mail_protocol == "mail") ? "selected" : ""; ?>>mail</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo trans('mail-title') ?></label>
                            <input type="text" class="form-control" name="mail_title"
                                   value="<?php echo html_escape($settings->mail_title); ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo trans('mail-host') ?></label>
                            <input type="text" class="form-control" name="mail_host"
                                   value="<?php echo html_escape($settings->mail_host); ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo trans('mail-port') ?></label>
                            <input type="text" class="form-control" name="mail_port"
                                    value="<?php echo html_escape($settings->mail_port); ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo trans('mail-username') ?></label>
                            <input type="text" class="form-control" name="mail_username"
                                    value="<?php echo html_escape($settings->mail_username); ?>" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo trans('mail-password') ?></label>
                            <input type="password" class="form-control" name="mail_password"
                                    value="<?php echo base64_decode($settings->mail_password); ?>" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo trans('mail-encryption') ?></label>
                            <select name="mail_encryption" class="form-control custom-select">
                                <option value="ssl" <?php echo ($settings->mail_encryption == "ssl") ? "selected" : ""; ?>>SSL</option>
                                <option value="tls" <?php echo ($settings->mail_encryption == "tls") ? "selected" : ""; ?>>TLS</option>
                            </select>
                            <p class="small"><i class="fa fa-info-circle"></i> <?php echo trans('mail-port-help') ?> </p>
                        </div>

                        <div class="form-group">
                        <a target="_blank" href="<?php echo base_url('auth/test_mail') ?>" class="btn btn-light-secondary btn-lg mb-50 pull-left"><i class="fa fa-paper-plane"></i> <?php echo trans('send-test-mail') ?></a>
                      </div>
                    </div>

                  </div>

                  <!-- social tab -->
                  <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                      <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Facebook</label>
                        <div class="col-sm-12">
                          <input type="text" name="facebook" value="<?php echo html_escape($settings->facebook); ?>" class="form-control" >
                        </div>
                      </div>
                      <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Twitter</label>
                        <div class="col-sm-12">
                          <input type="text" name="twitter" value="<?php echo html_escape($settings->twitter); ?>" class="form-control" >
                        </div>
                      </div>
                      <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Instagram</label>
                        <div class="col-sm-12">
                          <input type="text" name="instagram" value="<?php echo html_escape($settings->instagram); ?>" class="form-control" >
                        </div>
                      </div>
                      <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Linkedin</label>
                        <div class="col-sm-12">
                          <input type="text" name="linkedin" value="<?php echo html_escape($settings->linkedin); ?>" class="form-control" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-12 control-label" for="example-input-normal">Google Analytics</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" name="google_analytics" rows="8"><?php echo base64_decode($settings->google_analytics) ?></textarea>
                        </div>
                      </div>
                  </div>

                  <!-- captcha tab -->
                  <div class="tab-pane fade" id="captcha" role="tabpanel" aria-labelledby="captcha-tab">

                      <div class="form-group p-5 mb-50">
                        <label class="col-sm-12 control-label" for="example-input-normal">reCaptcha Result</label>
                        <?php if (settings()->captcha_site_key != ''): ?>
                            <div class="g-recaptcha pull-left m-10" data-sitekey="<?php echo html_escape(settings()->captcha_site_key); ?>"></div>
                        <?php endif ?>
                      </div>

                      <div class="form-group mt-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Captcha Site key</label>
                        <div class="col-sm-12">
                          <input type="text" name="captcha_site_key" value="<?php echo html_escape($settings->captcha_site_key); ?>" class="form-control" >
                        </div>
                      </div>
                      <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Captcha Secret key</label>
                        <div class="col-sm-12">
                          <input type="text" name="captcha_secret_key" value="<?php echo html_escape($settings->captcha_secret_key); ?>" class="form-control" >
                        </div>
                      </div>
                  </div>
                  

                </div>

                <!-- csrf token -->
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                <div class="pr-30 mt-30">
                  <button type="submit" class="btn btn-light-primary btn-lg btn-block ml-15 mb-50 pull-left"><i class="fa fa-check"></i> <?php echo trans('save-changes') ?></button>
                </div>
                  
              </form>
            </div>
          
        </div>
      </div>
    </div>

  </div>

