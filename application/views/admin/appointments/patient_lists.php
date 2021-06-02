
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container">

  <div class="row p-0 mt-20">
      
        <div class="col-md-12">
          <div class="box add_area" data-aos="fade-down" data-aos-duration="400">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('appointments') ?> </h3>
                <a href="<?php echo base_url('users') ?>" class="btn btn-primary ml-4">Create Appointment</a>
            </div>

            <div class="box-bodys p-10 table-responsive">

              <?php if (empty($appointments)): ?>
                  <div class="mt-4 mb-4 text-center">
                    <h4><img src="<?php echo base_url('assets/images/not-found.png') ?>"></h4>
                    <h5><?php echo trans('data-not-found') ?></h5>
                  </div>
              <?php else: ?>

              <table id="example" class="table table-bordered <?php if(isset($appointments) && count($appointments) >= 10){echo "datatable";} ?>">
                  <thead>
                      <tr>
                          <th><?php echo trans('serial-no') ?></th>
                          <th><?php echo trans('mr.-no') ?></th>
                          <th><?php echo trans('doctor-info') ?></th>
                          <th><?php echo trans('schedule-info') ?></th>
                          <th><?php echo trans('consultation-type') ?></th>
                          <th><?php echo trans('price') ?></th>
                          <th><?php echo trans('pay-status') ?></th>
                          <th><?php echo trans('prescription') ?></th>
                          <th><?php echo trans('actions') ?></th>
                          <th><?php echo trans('foolw-up') ?></th>
                          <th style="visibility:hidden;"></th>
                      </tr>
                  </thead>
                  
                  <tbody>
                    <?php $i=1; foreach ($appointments as $amp): ?>
                      <tr id="row_<?php echo html_escape($amp->id); ?>" style="background: #<?php if($amp->status == 1){echo "eefaf6";}else{echo "fff";} ?>">
                          
                 
                          <td><?php echo html_escape($amp->serial_id); ?></td>

                          <td>#<?php echo html_escape($amp->mr_number); ?></td>
                          
                          <td>
                            <p class="mb-0"><?php echo html_escape($amp->dr_name); ?></p><br>
                            <p class="mb-0"><?php echo html_escape($amp->chamber); ?></p><br>
                            <?php  $doctor = get_name_by_id($amp->user_id,'users');?>
							<?php echo $doctor['specialist'] ?>
                          </td>

                          <td>
                            <label class="badge badge-primary-soft brd-20"><i class="fa fa-calendar"></i> <?php echo my_date_show($amp->date); ?></label><br>
                            <label class="badge badge-primary-soft brd-20"><i class="fa fa-clock-o"></i> <?php echo $amp->time; ?></label>
                          </td>

                          <td>
                            <?php if ($amp->type == 'online'): ?>
                              <label class="badge badge-danger-soft brd-20"><i class="fa fa-circle"></i> <?php echo trans('online') ?> </label>
                            <?php else: ?>
                              <label class="badge badge-secondary-soft brd-20"><i class="fa fa-circle"></i> <?php echo trans('offline') ?> </label>
                            <?php endif ?>
                          </td>

                          <td>
                            <p class="mb-0"><?php echo currency_symbol($amp->currency); ?><?php echo html_escape($amp->price); ?></p>
                          </td>

                          <td>
                            <?php $payment = check_appointment_payment($amp->id, $amp->user_id); ?>
                            <?php if ($payment == TRUE): ?>
                              <label class="badge badge-success-soft brd-20"><i class="flaticon-check ficon"></i> <?php echo trans('verified') ?></label>
                            <?php else: ?>
                              <label class="badge badge-danger-soft brd-20"><i class="fa fa-clock-o"></i> <?php echo trans('pending') ?></label>
                            <?php endif ?>
                          </td>

                          <td>
                            <?php if ($amp->status == 1): ?>
                              <label class="badge badge-success-soft brd-20"><i class="ficon flaticon-check"></i> <?php echo trans('created') ?></label>
                            <?php else: ?>
                              <label class="badge badge-warning-soft brd-20" data-toggle="tooltip" data-placement="top" title="<?php echo trans('prescription-not-created-yet') ?>"><i class="fa fa-times"></i> <?php echo trans('not-created') ?></label>
                            <?php endif ?>
                          </td>
                          
                          <td class="actions" width="15%">
                              <?php if ($amp->date >= date('Y-m-d')): ?>
                                <?php if($amp->type == 'online' && $payment == FALSE && $amp->status == 0): ?>
                                    <a href="<?php echo base_url('admin/payment/patient/'.html_escape($amp->id));?>" class="btn btn-primary btn-sm"><i class="fa fa-dollar"></i> <?php echo trans('pay-now') ?></a>
                                <?php endif ?>

                                <?php if($amp->type == 'online' && $payment == TRUE && $amp->is_start == 1): ?>
                                    <!-- small device join -->
                                    <a target="_blank" href="<?php echo evisit_settings($amp->user_id)->invitation_link; ?>" class="btn btn-success btn-sm d-block d-sm-none"><i class="fa fa-video-camera"></i> <?php echo trans('join') ?></a>

                                    <!-- large device join -->
                                    <a target="_blank" href="<?php echo base_url('admin/live/zoom/patient/'.html_escape($amp->id));?>" class="btn btn-primary btn-sm d-none d-sm-block"><i class="fa fa-video-camera"></i> <?php echo trans('join') ?></a>
                                <?php endif ?>
                              <?php else: ?>
                                <label class="badge badge-danger-soft brd-20"><i class="fa fa-times"></i> <?php echo trans('expire') ?></label>
                              <?php endif ?>


                              <?php if ($amp->status == 1): ?>
                                <a target="_blank" href="<?php echo base_url('admin/patients/prescription/'.$amp->prescription_id); ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="<?php echo trans('view-prescription') ?>"> <i class="fa fa-eye"></i></a>
                              <?php endif; ?>
                          </td>

                        <td><?php echo my_date_show_time($amp->created_at); ?></td>
                          <td>
                            <?php if ($amp->is_start == 1): ?>
                              <div class="pulse"></div>
                            <?php endif; ?>
                          </td>
                      </tr>
                      
                    <?php $i++; endforeach; ?>
                  </tbody>
                 
              </table>
              
              <?php endif; ?>

            </div>

          </div>
        </div>
      </div>

  </section>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 5, "desc" ]]
    } );
} );
</script>