<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    
        <div class="row">
            <div class="col-md-12"><h3 class="box-title"><?php echo trans('all-users') ?> </h3> </div>
        </div>

        <div class="row">

            <div class="col-md-3 pull-left">
                <form action="<?php echo base_url('admin/users/all_users/all') ?>" class="sort_package_form" method="get">
                    <div class="form-group">
                        <select name="package" class="form-control sort_package search">
                            <option><?php echo trans('sort-by-packages') ?></option>
                            <option <?php if(isset($_GET['package']) && $_GET['package'] == 'all'){echo "selected";} ?> value="all">All</option>
                            <?php foreach ($packages as $package): ?>
                                <option <?php if(isset($_GET['package']) && $_GET['package'] == $package->id){echo "selected";} ?> value="<?php echo html_escape($package->id) ?>"><?php echo html_escape($package->name) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </form>
            </div>

            <div class="col-md-3 pull-left">
                <form action="<?php echo base_url('admin/users/all_users/all') ?>" class="sort_form" method="get">
                    <div class="form-group">
                        <select name="sort" class="form-control sort search">
                            <option><?php echo trans('sort-by-status') ?></option>
                            <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'all'){echo "selected";} ?> value="all"><?php echo trans('all') ?></option>
                            <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'verified'){echo "selected";} ?> value="verified"><?php echo trans('verified') ?></option>
                            <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'pending'){echo "selected";} ?> value="pending"><?php echo trans('pending') ?></option>
                            <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'expired'){echo "selected";} ?> value="expired"><?php echo trans('expired') ?></option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="col-md-3"></div>

            <div class="col-md-3 pull-right">
                <form role="search" autocomplete="off" action="<?php echo base_url('admin/users/all_users/all') ?>" method="get">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by name">
                        <div class="input-group-append">
                          <button class="btn btn-dark" type="button">
                            <i class="icon-magnifier px-2"></i>
                          </button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
          
    
        <div class="table-responsive">
            <table class="table table-hover m-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo trans('avatar') ?></th>
                        <th><?php echo trans('name') ?></th>
                        <th><?php echo trans('email') ?></th>
                        <th><?php echo trans('chambers') ?></th>
                        <!-- <th><?php echo trans('package') ?></th>
                        <th><?php echo trans('payment-status') ?></th> -->
                        <th><?php echo trans('account-status') ?></th>
                        <th><?php echo trans('joined') ?></th>
                        <!-- <th><?php echo trans('expired') ?></th> -->
                        <th><?php echo trans('action') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($users as $user): ?>
                        <tr id="row_<?php echo html_escape($user->id) ?>">
                            <th scope="row"><?php echo html_escape($i) ?></th>
                            
                            <?php if ($user->thumb == ''): ?>
                                <?php $avatar = 'assets/images/avatar.png'; ?> 
                            <?php else: ?>
                                <?php $avatar = $user->thumb; ?>
                            <?php endif ?>
                            <td><img width="60px" class="img-circle" src="<?php echo base_url($avatar) ?>"></td>

                            <td>
                                <?php echo ucfirst($user->name); ?>
                                <span>
                                    <p class="small mb-0"><?php echo html_escape($user->specialist) ?></p>
                                    <div class="small degree"><?= $user->degree ?></div>
                                </span>
                            </td>
                            <td><?php echo html_escape($user->email); ?></td>
                            <td>
                                <?php foreach ($user->chambers as $chamber): ?>
                                    <p class="small mb-0"><i class="fa fa-angle-right"></i> <?php echo html_escape($chamber->name) ?></p>
                                <?php endforeach ?>
                            </td>
                            
                            <!-- <td>
                                <span class="badge badge-primary-soft font-weight-bold"><i class="ficon flaticon-package"></i> <?php echo html_escape(user_payment_details($user->id)->package); ?></span>
                            </td> -->
                            
                            <!-- <td>
                                <?php $label = ''; ?>
                                <?php if (user_payment_details($user->id)->status == 'pending'){
                                  $label = 'warning';
                                  $text = '<i class="ficon flaticon-wall-clock"></i> '.user_payment_details($user->id)->status;
                                }else if(user_payment_details($user->id)->status == 'verified'){ 
                                  $label = 'success';
                                  $text = '<i class="ficon flaticon-check"></i> '.user_payment_details($user->id)->status;
                                }else if(user_payment_details($user->id)->status == 'expired'){ 
                                  $label = 'danger';
                                  $text = '<i class="ficon flaticon-empty-set-mathematical-symbol"></i>  Expired';
                                }?>
                                <span class="badge badge-<?php echo html_escape($label) ?>-soft">
                                    <b><?= $text; ?></b>
                                </span>
                            </td> -->
                            
                            <td>
                              <?php if ($user->status == 1): ?>
                                  <span class="badge badge-success-soft"><b><i class="ficon flaticon-check"></i> <?php echo trans('active') ?></span>
                              <?php else: ?>
                                <span class="badge badge-danger-soft"><b><?php echo trans('disabled') ?></span>
                              <?php endif ?>
                            </td>

                            <td><?php echo my_date_show($user->created_at) ?></td>

                            <!-- <td>
                              <?php if ($user->payment_status != 'expire'): ?>
                                  <span class="badge badge-secondary-soft"><b><?php echo date_dif(date('Y-m-d'), $user->payment->expire_on) ?> <?php echo trans('days-left') ?></span>
                              <?php else: ?>
                                <span class="badge badge-danger-soft"><b><?php echo get_time_ago($user->payment->expire_on) ?></span>
                              <?php endif ?>
                            </td> -->


                            <td class="actions" width="12%">
                                <?php if ($user->status == 1): ?>
                                    <a href="<?php echo base_url('admin/users/status_action/2/'.html_escape($user->id));?>" class="on-default deactive-row" data-toggle="tooltip" data-placement="top" title="<?php echo trans('inactive') ?>"><i class="fa fa-times"></i></a> &nbsp;
                                <?php else: ?>
                                    <a href="<?php echo base_url('admin/users/status_action/1/'.html_escape($user->id));?>" class="text-success on-default active-row" data-toggle="tooltip" data-placement="top" title="<?php echo trans('active') ?>"><i class="fa fa-check-circle"></i></a>
                                <?php endif ?> &nbsp; 

                                <a data-val="page" data-id="<?php echo html_escape($user->id); ?>" href="<?php echo base_url('admin/users/delete/'.html_escape($user->id));?>" class="text-danger on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="<?php echo trans('delete') ?>"><i class="fa fa-trash-o"></i></a> &nbsp;

                              </td>
                        </tr>
                    <?php $i++; endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            <div class="text-center p-30">
                <?= $this->pagination->create_links(); ?>
            </div>
        </div>


  </section>
</div>
