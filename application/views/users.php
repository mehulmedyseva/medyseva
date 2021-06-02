<section class="pt-6">
    <div class="container">

        <?php if (empty($users)): ?>
            <div class="row">
                <div class="col-md-10 col-lg-9 col-xl-8 mx-md-auto">
                    <?php include'include/not_found_msg.php'; ?>
                </div>
            </div>
        <?php else: ?>

        <div class="text-center mx-md-auto mb-5 mb-md-7 mb-lg-9">
            <h2 class="mb-0"><?php echo html_escape(settings()->site_name) ?> — <?php echo trans('experts') ?></h2>
            <p><?php echo trans('expert-title') ?></p>
        </div>


        <form method="GET" class="sort_form" action="<?php echo base_url('users') ?>">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="department" class="form-control sort_department">
                            <option value=""><?php echo trans('select-departments') ?></option>
                            <?php foreach ($departments as $department): ?>
                                <option <?php if(isset($_GET['sort_department']) && $_GET['sort_department'] == $department->id){echo "selected";} ?> value="<?php echo html_escape($department->id); ?>"><?php echo html_escape($department->name); ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="experience" class="form-control sort_experience">
                            <option value=""><?php echo trans('select-experiences') ?></option>
                            <?php for ($i=1; $i < 51; $i++) { ?>
                                <option <?php if(isset($_GET['experience']) && $_GET['experience'] == $i){echo "selected";} ?> value="<?= $i ?>"><?= $i ?> Years</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                 <div class="col-md-3">
                    <div class="form-group">
                        <select name="city" class="form-control sort_experience">
                            <option value="">Location</option>
                            <option value="Bhopal">Bhopal</option>
                            <option value="Indore">Indore</option>
                            <option value="Jabalpur">Jabalpur</option>
                            <option value="Jaipur">Jaipur</option>
                        </select>
                    </div>
                  </div>
                
                
                
                
                <div class="col-md-4 col-xs-12 offset-md-2 pull-right">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="<?php echo trans('search-by-name') ?>">
                        <div class="input-group-append">
                          <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                          </button>
                        </div>
                    </div>
                </div>  
                
            </div>
        </form>

        <!-- Users -->
        <div class="row mt-4">
            <?php foreach ($users as $user): ?>
                <div class="col-sm-6 col-md-3 mb-5 mb-md-0">
                    <div class="user-area">
                        <div class="team-img">
                            <?php if (empty($user->image)): ?>
                               <a href="<?php echo base_url('profile/'.$user->slug) ?>">
                                  <img src="<?php echo base_url('assets/images/avatar1.png') ?>" alt="User Image">
                               </a>
                            <?php else: ?>
                                <a href="<?php echo base_url('profile/'.$user->slug) ?>">
                                <img src="<?php echo base_url($user->image) ?>" alt="User Image">
                                </a>
                            <?php endif ?>
                        </div>
                        <div class="text-center bg-white shadow-light py-4 minh-150">
                            
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
                                    <?php endfor;?>
                                </p>
                            <?php endif ?>

                            <h6 class="h6 mb-1">
                                <?php echo html_escape($user->name) ?>
                                <?php if (!empty($user->specialist)): ?>
                                    - <?php echo html_escape($user->specialist) ?>
                                <?php endif ?>
                                    
                            </h6>
                            <p class="mb-1">
                                <?php if (!empty($user->exp_years)): ?>
                                   <a href="<?php echo base_url('profile/'.$user->slug) ?>">
                                         <?php echo html_escape($user->exp_years) ?> <?php echo trans('years-experience') ?>
                                  </a>         
                                <?php endif ?>
                            </p>
                            
                            <div class="row justify-content-center">
                                <?php if (check_user_feature_access('profile-page', $user->id) == TRUE): ?>
                                    <?php if (check_user_feature_access('appointments', $user->id) == TRUE): ?>
                                        <a href="<?php echo base_url('profile/'.$user->slug) ?>" class="btn btn-light-primary btn-sm mt-2"><i class="flaticon-calendar"></i> <?php echo trans('book-appointment') ?></a>
                                    <?php else: ?>
                                        <a href="<?php echo base_url('profile/'.$user->slug) ?>" class="btn btn-light-secondary btn-sm mt-2"><i class="icon-eye"></i> <?php echo trans('view-profile') ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            

                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <div class="col-md-12 text-center mt-4">
            <?php echo $this->pagination->create_links(); ?>
        </div>
        <!-- End Users -->
        <?php endif; ?>
    </div>
</section>