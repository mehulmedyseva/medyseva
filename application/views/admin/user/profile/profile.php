<div class="content-wrapper">

  <section class="content container">

    <div class="row">
      <div class="col-xl-3 col-lg-3">

        <!-- Profile Image -->
        <div class="box">
          <div class="box-body box-profile text-center">
            <img class="profile-user-img rounded-circle img-fluid mx-auto d-block shadow-lg" src="<?php echo base_url($user->thumb); ?>" alt="User profile picture">

            <h4 class="text-center"><?php echo html_escape($user->name) ?></h4>
            <p class="text-center mb-0"><?php echo html_escape($user->specialist) ?></p>
            <p class="text-center"><?= $user->degree ?></p>

            <div class="user-social-acount text-center">
                <?php if (!empty($user->facebook)): ?>
                  <a href="<?php echo html_escape($user->facebook) ?>" class="btn btn-circle btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                <?php endif ?>

                <?php if (!empty($user->twitter)): ?>
                  <a href="<?php echo html_escape($user->twitter) ?>" class="btn btn-circle btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                <?php endif ?>

                <?php if (!empty($user->instagram)): ?>
                  <a href="<?php echo html_escape($user->instagram) ?>" class="btn btn-circle btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                <?php endif ?>

                <?php if (!empty($user->linkedin)): ?>
                  <a href="<?php echo html_escape($user->linkedin) ?>" class="btn btn-circle btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                <?php endif ?>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->

      <div class="box col-xl-9 col-lg-9">  
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/profile/update') ?>" role="form" class="form-horizontal">
 
          <div class="nav-tabs-custom b-0">
              <ul class="nav nav-tabs">
                  <li><a class="active" href="#content1" data-toggle="tab"><i class="fa fa-pencil-square"></i> <?php echo trans('update-info') ?></a></li>
                  <li><a href="#content4" data-toggle="tab"><i class="fa fa-cog"></i> <?php echo trans('social-settings') ?></a></li>
              </ul>
                          
              <div class="tab-content">
                
                <!-- tab 1 -->
                <div class="active tab-pane" id="content1">

                  <div class="row">
                      <div class="col-md-12 mb-20">
                        
                        <div class="form-group m-t-20">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('name') ?></label>
                            <div class="col-sm-12">
                                <input type="text" name="name" value="<?php echo html_escape($user->name); ?>" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('specialist') ?></label>
                            <div class="col-sm-12">
                                <input type="text" name="specialist" class="form-control" value="<?php echo html_escape($user->specialist); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('degree') ?></label>
                            <div class="col-sm-12">
                                <textarea id="ckEditor1" class="form-control" name="degree" rows="2"><?= $user->degree; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group m-t-20">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('experience-years') ?></label>
                            <div class="col-sm-12">
                                <input type="number" name="exp_years" value="<?php echo html_escape($user->exp_years); ?>" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('email') ?></label>
                            <div class="col-sm-12">
                                <input type="email" name="email" class="form-control" value="<?php echo html_escape($user->email); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('phone') ?></label>
                            <div class="col-sm-12">
                                <input type="text" name="phone" class="form-control" value="<?php echo html_escape($user->phone); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="example-input-normal"><?php echo trans('about-me') ?></label>
                            <div class="col-sm-12">
                                <textarea id="ckEditor" class="form-control" name="about_me" rows="10"><?= $user->about_me; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group m-t-20">
                            <label class="col-sm-12 control-label" for="example-input-normal"></label>
                            <div class="col-sm-12">
                                <img width="100px" src="<?php echo base_url($user->thumb); ?>"><br><br>
                                <div class="psr m-t-5">
                                    <a class='btn btn-default' href='javascript:;'>
                                        <i class="fa fa-cloud-upload"></i> <?php echo trans('change-avatar') ?>
                                        <input type="file" class="upload_img_deg" name="photo" size="40"  onchange='$("#upload-logo").html($(this).val());'>
                                    </a>
                                    &nbsp;
                                    <span class='label label-default' id="upload-logo"></span>
                                </div>
                            </div>
                        </div>

                      </div>
                  </div>

                </div>


                <!-- tab 4 -->
                <div class="tab-pane" id="content4" aria-hidden="false">
                    <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Facebook</label>
                        <div class="col-sm-12">
                            <input type="text" name="facebook" value="<?php echo html_escape($user->facebook); ?>" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Twitter</label>
                        <div class="col-sm-12">
                            <input type="text" name="twitter" value="<?php echo html_escape($user->twitter); ?>" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Linked in</label>
                        <div class="col-sm-12">
                            <input type="text" name="linkedin" value="<?php echo html_escape($user->linkedin); ?>" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group m-t-20">
                        <label class="col-sm-12 control-label" for="example-input-normal">Instagram</label>
                        <div class="col-sm-12">
                            <input type="text" name="instagram" value="<?php echo html_escape($user->instagram); ?>" class="form-control" >
                        </div>
                    </div>
                </div>
                
                <!-- csrf token -->
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                <div class="box-bottom mb-20">
                    <div class="pull-left ">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
                    </div>
                </div>
                

              </div>

          </div>

        </form>
      </div>

  </section>

</div>