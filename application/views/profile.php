
<!-- check profile access -->
<?php if (check_user_feature_access('profile-page', $user->id) == TRUE): ?>
<section class="bg-light pt-0">
  <header>
      <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light bg-light pt-3">
              <a class="navbar-brand mr-lg-5" href="<?php echo base_url() ?>">
                  <img src="<?php echo base_url(settings()->logo) ?>" alt="logo">
              </a>

              <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <!-- Menu -->
              <div id="navbarContent" class="collapse navbar-collapse">

                  <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                      <li class="nav-item mr-0">
                          <?php if (is_admin()): ?>
                              <a class="btn btn-sm btn-light-secondary ml-auto" href="<?php echo base_url('auth/logout') ?>"><i class="icon-logout"></i> <?php echo trans('logout') ?> </a>

                              <a class="btn btn-sm btn-light-primary ml-auto" href="<?php echo base_url('admin/dashboard') ?>"><i class="icon-speedometer mr-1"></i> <?php echo trans('dashboard') ?></a>
                          <?php elseif(is_user()): ?>

                              <a class="btn btn-sm btn-light-secondary ml-auto" href="<?php echo base_url('auth/logout') ?>"><i class="icon-logout"></i> <?php echo trans('logout') ?> </a>

                               <a class="btn btn-sm btn-light-primary ml-auto" href="<?php echo base_url('admin/dashboard/user') ?>"><i class="icon-speedometer mr-1"></i> <?php echo trans('dashboard') ?></a>
                               
                          <?php else: ?>
                              <a class="btn btn-sm btn-light-primary ml-auto" href="<?php echo base_url('login') ?>"><?php echo trans('sign-in') ?></a>
                          <?php endif ?>
                      </li>
                  </ul>

              </div>
              <!-- End Menu -->

          </nav>
      </div>
  </header>
</section>


<section class="bg-light bottom-shape pt-4">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-4 col-sm-6 pr-sm-3 mb-4 mb-sm-0">
                <div class="cards border-light">
                    <?php if (empty($user->image)): ?>
                        <img src="<?php echo base_url('assets/images/avatar1.png') ?>" class="card-img-top rounded-circle shadow" alt="Image">
                    <?php else: ?>
                        <img src="<?php echo base_url($user->image) ?>" class="card-img-top rounded-circle" alt="Image">
                    <?php endif ?>
                    
                </div>
            </div>

            <div class="col-md-8 pr-3 pr-md-5 mb-9 mb-md-0">

                <div class="w-90 mb-4 ml-5 justify">
                    <?php $average = number_format(total_rating_user($user->id)/total_rating($user->id), 1) ?>
                        <?php if ($average != 0 && user()->enable_rating == 1): ?>
                            <p class="mb-1 mt-0">
                                <?php for($i = 1; $i <= 5; $i++):?>
                                    <?php 
                                        if ( round($average - .25) >= $i) {
                                            echo "<i class='fas fa-star text-warning'></i>";
                                        } elseif (round($average + .25) >= $i) {
                                            echo "<i class='fas fa-star-half-alt text-warning'></i>";
                                        } else {
                                            echo "<i class='far fa-star text-warning'></i>";
                                        }
                                    ?>
                                <?php endfor;?> &nbsp; <span>(<?php echo total_rating($user->id) ?> <?php echo trans('ratings') ?>)</span>
                            </p>
                        <?php endif ?>

                    <h2><?php echo ucfirst($user->name) ?></h2>
                    <p class="lead mb-1"><?php echo html_escape($user->specialist) ?></p>
                    <p class="lead mb-1"><?= $user->degree ?></p>
                    <p class="lead mt-3"><?= $user->about_me ?></p>
                </div>

                <!-- Counter -->
                <div class="row ml-3">
                    <?php if (!empty($user->exp_years)): ?>
                      <div class="col-4 col-sm-4 mb-5 mb-lg-4">
                          <div class="text-primary h4 mb-2 mb-lg-3"><span class="countup"><?php echo html_escape($user->exp_years) ?></span>+</div>
                          <h5 class="mt-0 mb-0 h6"><?php echo trans('experience-years') ?></h5>
                      </div>
                    <?php endif ?>

                    <?php if (!empty($user->patients)): ?>
                    <div class="col-4 col-sm-4 mb-5 mb-lg-4">
                        <div class="text-primary h4 mb-2 mb-lg-3"><span class="countup"><?php echo html_escape($patients) ?></span>+</div>
                        <h5 class="mt-0 mb-0 h6"><?php echo trans('patients') ?></h5>
                    </div>
                    <?php endif ?>

                    <?php if (!empty($user->prescriptions)): ?>
                    <div class="col-4 col-sm-4 mb-5 mb-lg-4">
                        <div class="text-primary h4 mb-2 mb-lg-3"><span class="countup"><?php echo html_escape($prescriptions) ?></span>+</div>
                        <h5 class="mt-0 mb-0 h6"><?php echo trans('visited-patients') ?> </h5>
                    </div>
                    <?php endif ?>
                    
                </div>
                <!-- End Counter -->

            </div>

        </div>

    </div>

    <!-- Bg shape -->
    <div class="bg-round-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1900 115" preserveAspectRatio="none meet" class="ie-height-115">
            <path class="fill-none" d="M-1,0S447.9,95.6,960,95.6c0,0,432.5,9.8,959-95.6Z" transform="translate(1)"></path>
            <path class="fill-white" d="M-1,130V0S521.4,101.6,960,95.6c0,0,440,5.3,959-95.6V130Z" transform="translate(1)"></path>
        </svg>
    </div>
    <!-- End Bg shape -->
</section>

<!-- check appointments access -->
<?php if (check_user_feature_access('appointments', $user->id) == TRUE): ?>
<section class="bg-lights">

    <div class="container">

        <div class="row align-items-center">

            <!-- Banner text -->
            <div class="col-lg-6 col-md-10 mb-7 mb-md-9 mb-lg-0">

                <h1 class="display-7 font-weight-bold mb-2">Before booking an appointment, please check availability</h1>
                <?php if(!empty($user->phone) && !empty($user->whatsapp)){?>
                <p>contact us at <?php $user->phone; ?> and whatapp  <?php  echo$user->whatsapp; ?>, call back form</p>
               <?php } ?>
                <?php $days = get_days(); ?>
                    <ul class="list-unstyled mb-5 pb-0">
                        <?php if (empty($my_days)): ?>
                            <li class="py-2">
                                <div class="d-flex">
                                    <span class="list-style9 mr-3">
                                        <i class="fas fa-times"></i>
                                    </span> <?php echo trans('schedule-is-not-setted') ?>
                                </div>
                            </li>
                        <?php else: ?>
                            <?php  $i=1; foreach ($days as $day): ?>
                                
                                <?php foreach ($my_days as $asnday): ?>
                                  <?php if ($asnday['day'] == $i) {
                                    $check = 'check';
                                     $mytime=get_time_by_days($i,$user->id);
                                    break;
                                  } else {
                                    $check = 'times not';
                                  }
                                 
                                  ?>
                                <?php endforeach ?>

                                <li class="py-2">
                                    <div class="d-flex">
                                        <span class="list-style<?php if($check == 'check'){echo 1;}else{echo 9;} ?> mr-3">
                                            <i class="fas fa-<?= $check; ?>"></i>
                                        </span> 
                                        <?php echo trans($day);?> 
                                       
                                        <?php if ($check == 'check'): ?>
                                        <?php
                                          	$date_arr=array_column($mytime, 'start');
											$date_arr1=array_column($mytime, 'end');
											usort($date_arr, function($a, $b) {
    											$dateTimestamp1 = strtotime($a);
    											$dateTimestamp2 = strtotime($b);
												return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
											});

											usort($date_arr1, function($a, $b) {
  												$dateTimestamp1 = strtotime($a);
  												$dateTimestamp2 = strtotime($b);
												return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
											});
											echo $date_arr[0].' - '.$date_arr1[count($date_arr1) - 1];
										?>
                                        
                                        <span class="text-primary">&nbsp; (<?php echo trans('open') ?>) </span>
                                        <?php else: ?>
                                            <span class="text-danger">&nbsp; (<?php echo trans('close') ?>) </span>
                                        <?php endif ?>
                                    </div>
                                </li>

                            <?php  $i++; endforeach ?>
                        <?php endif ?>
                    </ul>
            </div>
            <!-- Banner text -->

            <div class="col-lg-5 offset-lg-1">

                <div class="mb-4 mt-4 text-center">
                    <div class="success text-success"></div>
                    <div class="error text-danger"></div>
                    <div class="warning text-warning"></div>
                </div>

                <!-- Form -->
                <form id="booking_form" method="post" action="<?php echo base_url('profile/book_appointment/'.$user->slug); ?>" class="card shadow" autocomplete="off">

                    <div class="card-header bg-white text-center py-3 py-md-3 px-5 px-md-6">
                        <h2 class="h4 mb-0 "><i class="flaticon-calendar mr-1"></i>  <?php echo trans('book-appointment') ?></h2>
                    </div>

                    <div class="card-body p-4 p-md-5">

                      <div class="step1">
                        <?php if (count($chambers) > 1): ?>
                        <div class="form-group">
                            <label for="chamber" class="text-dark"><?php echo trans('chamber') ?> <span class="text-danger">*</span></label>
                            <select class="form-control" name="chamber" required="required">
                                <?php foreach ($chambers as $chamber): ?>
                                    <option value="<?php echo html_escape($chamber->id) ?>"><?php echo html_escape($chamber->name) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <?php else: ?>
                            <input type="hidden" class="mb-4" name="chamber" value="<?php echo $chambers[0]->id ?>">
                        <?php endif ?>

                        <div class="form-group">
                            <label for="chamber" class="text-dark"> <?php echo trans('appointment-type') ?> <span class="text-danger">*</span></label>
                            <select class="form-control" id="app_type" name="type" required="required">
                                  <option value=""><?php echo trans('select-type') ?></option>
                                  <?php if (evisit_settings($user->id)->status == 1): ?>
                                    <option value="1"><?php echo trans('online-consultation') ?></option>
                                  <?php endif ?>
                                  <!--<option value="2"><?php echo trans('offline') ?></option>-->
                              
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="text-dark"><?php echo trans('date') ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control datepicker" id="datepicker" name="date" autocomplete="off">
                            <input type="text" style="position: absolute !important; left: -10000px !important; top: -10000px !important;">
                        </div>

                        <div class="form-group">
                          <div class="col-md-12 p-0 text-center" id="load_data">
                          </div>
                        </div>

                        <?php if (isset(evisit_settings($user->id)->price) && evisit_settings($user->id)->price != 0): ?>
                          <div class="badge badge-pill badge-secondary-soft text-center mt-4"><?php echo trans('consultation-fee') ?>: <?php echo currency_symbol($user->currency); ?><?php echo evisit_settings($user->id)->price; ?></div>
                        <?php endif ?>

                        <div class="row p-3">
                            <button type="button" class="btn btn-primary btn-block mt-2 confirm_step"><?php echo trans('continue') ?> <i class="fas fa-long-arrow-alt-right"></i></button>
                        </div>
                      </div>


                      <div class="step2" style="display: none;">
                        <div class="cards tab-card">
                          <div class="card-header tab-card-header mb-6 pt-0">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link active click_new" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true"><i class="fa fa-user-plus"></i> <?php echo trans('new-registration') ?></a>
                              </li>
                              <li class="nav-item click_old">
                                  <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false"> <?php echo trans('already-have-account') ?></a>
                              </li>
                            </ul>
                          </div>

                          <div class="tab-content" id="myTabContent">
                            
                            <div class="tab-pane fade show active mt-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                              <div class="form-group">
                                  <label class="text-dark"><?php echo trans('name') ?> </label>
                                  <input type="text" class="form-control" name="name">
                              </div>

                              <div class="form-group">
                                  <label class="text-dark"><?php echo trans('email') ?> <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="email">
                              </div>

                              <div class="form-group">
                                  <label class="text-dark"><?php echo trans('password') ?> <span class="text-danger">*</span></label>
                                  <input type="password" class="form-control" name="new_password" autocomplete="off">
                              </div>

                              <div class="form-group">
                                  <label class="text-dark"><?php echo trans('phone') ?> <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="mobile">
                              </div>            
                            </div>

                            <div class="tab-pane fade mt-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                              <div class="form-group">
                                  <label class="text-dark"><?php echo trans('username') ?> <small>(<?php echo trans('email-or-mobile') ?>)</small> <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="user_name">
                              </div>

                              <div class="form-group">
                                  <label class="text-dark"><?php echo trans('password') ?> <span class="text-danger">*</span></label>
                                  <input type="password" class="form-control" name="password">
                              </div>             
                            </div>
                          </div>
                        </div>

                        <div class="row p-3 justify-content-between">

                          <?php if (settings()->enable_captcha == 1 && settings()->captcha_site_key != ''): ?>
                              <div class="g-recaptcha pull-left" data-sitekey="<?php echo html_escape(settings()->captcha_site_key); ?>"></div>
                          <?php endif ?>

                          <!-- csrf token -->
                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">


                          <input type="hidden" class="check_patient" name="check_patient" value="0">
                          <input type="hidden" name="id" value="<?php echo html_escape(md5($user->id)) ?>">
                          <button type="button" class="btn btn-light-secondary mt-5 back_step"><i class="fas fa-long-arrow-alt-left"></i> <?php echo trans('back') ?> </button>
                          <button type="submit" class="btn btn-primary mt-5 booking_btn"> <i class="fas fa-calendar-check"></i> <?php echo trans('book-appointment') ?></button>
                        </div>
                      </div>

                    </div>

                </form>
                <!-- End form -->

            </div>

        </div>

    </div>

</section>
<?php endif; ?>


<?php if (!empty($educations)): ?>
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h2 class="text-center mb-6"><i class="icon-graduation" ></i> <?php echo trans('educations') ?></h2>

                <div class="py-2">
                  <!-- timeline 1 -->
                  <?php $e=1; foreach ($educations as $education): ?>
                    <?php if ($e%2 == 0): ?>
                        <div class="row no-gutters">
                            <div class="col-sm"> <!--spacer--> </div>
                            
                            <!-- timeline item 1 center dot -->
                            <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                              <div class="row h-50">
                                <div class="col">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                              </div>
                              <h5 class="m-2">
                                <span class="badge-round badge-pill badge-primary-soft border">&nbsp;</span>
                              </h5>
                              <div class="row h-50">
                                <div class="col border-right">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                              </div>
                            </div>

                            <!-- timeline item 1 event content -->
                            <div class="col-sm py-2">
                              <div class="card shadow">
                                <div class="card-body">
                                  <div class="float-right text-muted small"><?php echo html_escape($education->years) ?></div>
                                  <h5 class="card-title text-dark"><?php echo html_escape($education->title) ?></h5>
                                  <p class="card-text"><?php echo html_escape($education->details) ?></p>
                                </div>
                              </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row no-gutters">
                            <div class="col-sm py-2">
                              <div class="card shadow">
                                <div class="card-body">
                                  <div class="float-right text-muted small"><?php echo html_escape($education->years) ?></div>
                                  <h5 class="card-title text-dark"><?php echo html_escape($education->title) ?></h5>
                                  <p class="card-text"><?php echo html_escape($education->details) ?></p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                              <div class="row h-50">
                                <div class="col border-right">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                              </div>
                              <h5 class="m-2">
                                <span class="badge-round badge-pill badge-primary-soft border">&nbsp;</span>
                              </h5>
                              <div class="row h-50">
                                <div class="col border-right">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                              </div>
                            </div>
                            <div class="col-sm"> <!--spacer--> </div>
                        </div>
                    <?php endif ?>
                  <?php $e++; endforeach ?>
                  <!--/row-->
                </div>

            </div> 
        </div>
    </div>
</section>
<?php endif ?>


<?php if (!empty($experiences)): ?>
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h2 class="text-center mb-6"><i class="icon-bulb" ></i> <?php echo trans('experiences') ?></h2>

                <div class="py-2">
                  <!-- timeline 1 -->
                  <?php $e=1; foreach ($experiences as $experience): ?>
                    <?php if ($e%2 == 0): ?>
                        <div class="row no-gutters">
                            <div class="col-sm"> <!--spacer--> </div>
                            <!-- timeline item 1 center dot -->
                            <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                              <div class="row h-50">
                                <div class="col">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                              </div>
                              <h5 class="m-2">
                                <span class="badge-round badge-pill badge-primary-soft border">&nbsp;</span>
                              </h5>
                              <div class="row h-50">
                                <div class="col border-right">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                              </div>
                            </div>
                            <!-- timeline item 1 event content -->
                            <div class="col-sm py-2">
                              <div class="card shadow">
                                <div class="card-body">
                                  <div class="float-right text-muted small"><?php echo html_escape($experience->years) ?></div>
                                  <h5 class="card-title text-dark"><?php echo html_escape($experience->title) ?></h5>
                                  <p class="card-text"><?php echo html_escape($experience->details) ?></p>
                                </div>
                              </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row no-gutters">
                            <div class="col-sm py-2">
                              <div class="card shadow">
                                <div class="card-body">
                                  <div class="float-right text-muted small"><?php echo html_escape($experience->years) ?></div>
                                  <h5 class="card-title text-dark"><?php echo html_escape($experience->title) ?></h5>
                                  <p class="card-text"><?php echo html_escape($experience->details) ?></p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                              <div class="row h-50">
                                <div class="col border-right">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                              </div>
                              <h5 class="m-2">
                                <span class="badge-round badge-pill badge-primary-soft border">&nbsp;</span>
                              </h5>
                              <div class="row h-50">
                                <div class="col border-right">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                              </div>
                            </div>
                            <div class="col-sm"> <!--spacer--> </div>
                        </div>
                    <?php endif ?>
                  <?php $e++; endforeach ?>
                  <!--/row-->
                </div>

            </div> 
        </div>
    </div>
</section>
<?php endif ?>


<?php else: ?>
<section>
    <div class="container h-600">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="custom-alert text-center">
                    <div class="alert alert-secondary" role="alert">
                        <h2 class="alert-heading"><i class="fas fa-eye-slash"></i></h2>
                        <p><?php echo trans('profile-not-available') ?></p>
                    </div>

                    <?php if ($this->session->userdata('logged_in') == TRUE && $user->id == $this->session->userdata('id')): ?>
                        <p class="mb-0">
                            <a href="<?php echo base_url('admin/subscription') ?>" class="btn btn-light-primary" target="_blank"><i class="fas fa-rocket mr-2 display-10 font-weight-bold"></i> <?php echo trans('upgrade-your-plan') ?></a>
                        </p>
                    <?php else: ?>
                        <a href="<?php echo base_url('admin/subscription') ?>" class="btn btn-light-primary"><i class="fas fa-home mr-2 display-10 font-weight-bold"></i> <?php echo trans('back-to-home') ?></a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>