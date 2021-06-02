
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="row">

      <div class="col-md-12">
            <a href="<?php echo base_url('admin/live_consults') ?>" class="pull-right btn btn-light-secondary mb-15"><i class="icon-calendar"></i> <?php echo trans('consultations') ?>  </a>
          </div>

      <div class="col-md-12">

          <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/live_consults/evisit_settings')?>" role="form" novalidate>
          
            <div class="box add_area2" >
              <div class="box-header with-border">
                <h3 class="box-title d-block"><?php echo trans('update') ?></h3>

                <div class="box-tools pull-right">
                    <!--<a href="#" class="text-right btn btn-light-primary btn-sm mt-15 cancel_btn2"><i class="fa fa-long-arrow-left"></i> <?php echo trans('back') ?></a>-->
                </div>
              </div>

              <div class="box-body minh-300">

                <div class="row">

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Zoom <?php echo trans('meeting-id') ?> <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" required name="zoom_meeting_id" value="<?php echo evisit_settings($user_id)->zoom_meeting_id; ?>" >
                    </div>
                  </div>

                  <div class="col-sm-12">
                      <div class="form-group">
                        <label>Zoom <?php echo trans('meeting-password') ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="zoom_meeting_password" value="<?php echo evisit_settings($user_id)->zoom_meeting_password; ?>" >
                      </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label><?php echo trans('consultation-fees') ?> <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" required name="price" value="<?php echo evisit_settings($user_id)->price; ?>" >
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Zoom <?php echo trans('invitation-link') ?> </label>
                      <input type="text" class="form-control" name="invitation_link" value="<?php echo evisit_settings($user_id)->invitation_link; ?>" >
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                        <div class="custom-control custom-switch ml-10">
                            <input type="checkbox" name="status" class="custom-control-input" value="1" id="switch-2" <?php if(evisit_settings($user_id)->status == 1){echo "checked";} ?>>
                            <label class="custom-control-label" for="switch-2"><?php echo trans('live-consultation') ?></label>
                            <p class="text-muted"><small><?php echo trans('enable-to-allow-consultation') ?></small></p>
                        </div>
                    </div>
                  </div>


                  <input type="hidden" name="settings_id" value="<?php echo $user_id; ?>">
                  
                  <!-- csrf token -->
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

        
                  <div class="col-sm-12">
                      <button type="submit" class="btn btn-light-primary btn-lg pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
                  </div>

                </div>
                  
              </div>
            </div>

           <!-- <div class="box list_area2">
                <div class="box-header">
                  <h3 class="box-title"><?php echo trans('consultation-settings') ?></h3>

                  <div class="box-tools pull-right">
                    <a href="#" class="text-right btn btn-light-primary mt-15 btn-sm add_btn2"><i class="fa fa-pencil"></i> <?php echo trans('update') ?></a>
                  </div>
                </div>

                <div class="box-body py-4">

                  <table class="table m-10">
                      <thead class="border-0">
                          <tr class="bb1">
                              <th>
                                 <p>Zoom <?php echo trans('meeting-id') ?></p>
                                 <label class="badge badge-secondary-soft brd-20"><?php echo html_escape(evisit_settings(user()->id)->zoom_meeting_id) ?></badge>
                              </th>

                              <th>
                                 <p>Zoom <?php echo trans('meeting-password') ?></p>
                                 <label class="badge badge-secondary-soft brd-20"><?php echo html_escape(evisit_settings(user()->id)->zoom_meeting_password) ?></badge>
                              </th>

                              <th>
                                 <p><?php echo trans('consultation-fees') ?></p>
                                 <label class="badge badge-primary-soft brd-20"> ₹ <?php echo html_escape(evisit_settings(user()->id)->price) ?></badge>
                              </th>

                              <th>
                                 <p><?php echo trans('status') ?></p>
                                  <?php if (evisit_settings(user()->id)->status == 1):?>
                                    <label class="badge badge-success-soft brd-20"><i class="ficon flaticon-check"></i> <?php echo trans('active') ?></label>
                                  <?php else: ?>
                                    <label class="badge badge-secondary-soft brd-20"><i class="fa fa-eye-slash"></i> <?php echo trans('hidden') ?></label>
                                  <?php endif; ?>
                              </th>
                          </tr>

                          <tr>
                            <th>
                                <p>Zoom <?php echo trans('invitation-link') ?></p>
                                <label class="badge badge-secondary-soft brd-20"><?php echo evisit_settings(user()->id)->invitation_link; ?></badge>
                            </th>
                          </tr>
                      </thead>
                  </table>

                </div>
            </div>-->
          </form>
      </div>

    </div>

  </section>
</div>
