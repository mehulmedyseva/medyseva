<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="row">
      
      <div class="col-md-8 m-auto">
        <form method="post" action="<?php echo base_url('admin/payment/user_update') ?>" role="form" class="form-horizontal pr-20">
          
          <div class="row">
            <div class="col-sm-12">
              <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title"><?php echo trans('currency') ?></h3>
                  </div>
                  <div class="box-body">
                    <select class="form-control single_select" name="currency">
                        <option value=""><?php echo trans('select') ?></option>
                        <?php foreach ($currencies as $currency): ?>
                            <?php if (!empty($currency->currency_name)): ?>
                              <option value="<?php echo html_escape($currency->id); ?>" 
                                <?php echo (user()->country == $currency->id) ? 'selected' : ''; ?>>
                                <?php echo html_escape($currency->name.'  -  '.$currency->currency_code.' ('.$currency->currency_symbol.')'); ?>
                              </option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>
              </div>
            </div>
          </div>
         
          <div class="row">
            <div class="col-sm-6">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title d-block">Paypal <span class="pull-right"><input type="checkbox" name="paypal_payment" value="1" <?php if(user()->paypal_payment == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="primary" data-width="80"></span></h3>
                </div>

                <div class="box-body minh-300">
                    <div class="form-group mt-20">
                        <label class="col-sm-6 control-label" for="example-input-normal">Paypal <?php echo trans('mode') ?> </label>
                        <div class="col-sm-12">
                          <select class="form-control" name="paypal_mode">
                              <option value="">Select</option>
                                <option value="sandbox" <?php echo (user()->paypal_mode == 'sandbox') ? 'selected' : ''; ?>>Sandbox</option>
                                <option value="live" <?php echo (user()->paypal_mode == 'live') ? 'selected' : ''; ?>>Live</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="example-input-normal">Paypal <?php echo trans('account') ?></label>
                        <div class="col-sm-12">
                            <input type="text" name="paypal_email" value="<?php echo html_escape(user()->paypal_email); ?>" class="form-control" >
                        </div>
                    </div>
                </div>

              </div>
            </div>

            <div class="col-sm-6">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title d-block">Stripe  <span class="pull-right"><input type="checkbox" name="stripe_payment" value="1" <?php if(user()->stripe_payment == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="primary" data-width="80"></span></h3>
                </div>

                <div class="box-body minh-300">

                  <div class="row">

                    <div class="col-sm-12 p-0">
                      <div class="form-group mt-20">
                          <label class="col-sm-4 control-label" for="example-input-normal"><?php echo trans('publish-key') ?></label>
                          <div class="col-sm-12">
                            <input type="text" name="publish_key" value="<?php echo html_escape(user()->publish_key); ?>" class="form-control" >
                          </div>
                      </div>
                    </div>

                    <div class="col-sm-12 p-0">
                        <div class="form-group mt-20">
                            <label class="col-sm-4 control-label" for="example-input-normal"><?php echo trans('secret-key') ?> </label>
                            <div class="col-sm-12">
                              <input type="text" name="secret_key" value="<?php echo html_escape(user()->secret_key); ?>" class="form-control" >
                            </div>
                        </div>
                    </div>

                  </div>
                    
                </div>

              </div>
            </div>
          </div>

          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <div class="div">
            <button type="submit" class="btn btn-light-primary btn-lg btn-blocks waves-effect w-md waves-light m-b-5"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
          </div>

        </form>
      </div>

    </div>

  </section>
</div>
