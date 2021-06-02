
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">

  <div class="row">
    <!-- experience area -->
    <!-- <div class="col-md-4">
      <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo trans('add-appointment') ?></h3>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/appointment/add')?>" role="form" novalidate>

            <div class="form-group plr-10">
              <label><?php echo trans('date') ?></label>
              <div class="input-group mb-3">
                <input type="text" class="form-control datepicker" name="date"  value="<?php echo date('Y-m-d') ?>" autocomplete="off">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>

            <div class="form-group plr-10">
              <label><?php echo trans('time') ?></label>
              <input type="text" class="form-control timepicker" name="time"  value="" autocomplete="off">
            </div>

            <div class="form-group plr-10">
              <div class="radio radio-info radio-inline mt-10">
                <input type="radio" id="inlineRadio2" checked value="2" class="patient_type" name="patient_type">
                <label for="inlineRadio2"> <?php echo trans('old-patient') ?></label>&emsp;

                <input type="radio" id="inlineRadio1" value="1" class="patient_type" name="patient_type">
                <label for="inlineRadio1"> <?php echo trans('new-patient') ?></label> 
              </div>
            </div>

            <div class="form-group plr-10">
            <label>Consultation Type</label>
            <select name="cons_type" id="patients" class="form-control select2">
                    <option value="locally">Offline </option>
                    <option  value="online">Online</option>
                </select>
            </div>

            <div class="old_patient_area plr-10">
              <div class="form-group">
                <label><?php echo trans('patient') ?> <span class="text-danger">*</span></label>
                  <select name="patient_id" id="patients" class="form-control select2">
                    <option value=""><?php echo trans('select') ?> </option>
                    <?php foreach ($patientses as $patient): ?>
                    <option  value="<?php echo html_escape($patient->id); ?>"><?= '<b>'.$patient->name.'</b> - '.$patient->mr_number.' - '.$patient->mobile;?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="new_patient_area plr-10 hide">
              <div class="form-group">
                <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name">
              </div>

              <div class="form-group">
                <label><?php echo trans('email') ?> <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email">
              </div>

              <div class="form-group">
                <label><?php echo trans('phone') ?> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mobile">
              </div>

              <div class="form-group">
                <label><?php echo trans('age') ?> </label>
                <input type="text" class="form-control" name="age">
              </div>

              <div class="form-group">
                <label><?php echo trans('weight') ?></label>
                <input type="text" class="form-control" name="weight">
              </div>

              <div class="form-group">
                <label><?php echo trans('gender') ?> <span class="text-danger"></span></label>
                <div class="radio radio-info radio-inline mt-10">
                  <input type="radio" id="inlineRadio11" checked value="1" name="sex">
                  <label for="inlineRadio11"> <?php echo trans('male') ?> </label>
                  <input type="radio" id="inlineRadio22" value="2" name="sex">
                  <label for="inlineRadio22"> <?php echo trans('female') ?> </label>
                </div>
              </div>
            </div>

            <!-- csrf token -->
          <!--  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            
            <button type="submit" class="btn btn-primary btn-lg ml-0 mt-10"><i class="fa fa-check"></i> <?php echo trans('add-serial') ?></button>
          </form>
        </div>

      </div>
    </div> -->


    <!-- experience area -->
    <div class="col-md-12">
      <div class="box add_area">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo trans('appointments') ?> </h3>

            <div class="box-tools pull-right">
              <a href="<?php echo base_url('admin/appointment/all_list') ?>" class="btn btn-light-primary btn-sm pull-right mt-15"><i class="flaticon-calendar mr-1"></i> <?php echo trans('list-by-date') ?> </a>
              <a href="" id="csvdata" class="pull-right btn btn-success btn-sm csv_btn"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</a>
            </div>
        </div>

        <div class="box-body">
        
          <table class="table table-bordered <?php if(isset($appointments) && count($appointments) >= 10){echo "datatable";} ?>">
              <thead>
                  <tr>
                      <th>#</th>
                      <th><?php echo trans('serial-no') ?></th>
                      <th width="20%"><?php echo trans('patient-info') ?></th>
                      <th><?php echo trans('schedule-info') ?></th>
                      <th>Payment Status</th>
                     <th>Doctor</th>

                      <th><?php echo trans('action') ?></th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; 
                
                
            
                
                foreach ($appointments as $amp): 
                
                
               
                
                
                ?>
                 
             
                                                                 
                                                                    
                  
                  
                  <tr id="row_<?php echo html_escape($amp->id); ?>">
                      
                      <td><?= $i; ?></td>
                      <td><?php echo html_escape($amp->serial_id); ?></td>
                      <td>
                        <?php echo html_escape($amp->name); ?> (<?php echo html_escape($amp->mr_number); ?>)
                        <?php echo html_escape($amp->mobile); ?>
                        <?php echo html_escape($amp->email); ?>
                      </td>

                      <td>
                        <label class="badge badge-primary-soft brd-20"><i class="fa fa-calendar"></i> <?php echo my_date_show($amp->date); ?></label>
                        <label class="badge badge-primary-soft brd-20"><i class="fa fa-clock-o"></i> <?php echo $amp->time; ?></label>
                      </td>
                      
                      <td>
                        <?php if ($amp->status != 'verified'): ?>
                          <label class="badge badge-danger-soft brd-20"> <?php echo 'Not Paid'; ?> </label>
                        <?php else: ?>
                        <label class="badge badge-danger-soft brd-20"> <?php echo 'Paid'; ?> </label>
                        <?php endif ?>
                        
                        
                                      
                                      
                      </td>
                      <td>
                          <?php echo $amp->dr_name; ?>
                      </td>
                      <td class="actions" width="15%">
                          <?php if(is_parent()|| is_staff()): ?>
                        <a data-val="experience" data-id="<?php echo html_escape($amp->id); ?>" href="<?php echo base_url('admin/appointment/delete/'.html_escape($amp->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
                        <a  href="<?php echo base_url('admin/appointment/edit/'.html_escape($amp->id));?>"  class="on-default edit-row" data-placement="top" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                    
                                         
                                     <?php  
                                       $id=$amp->patient_id; 
                                       $ps=get_data($id); 
                                        ?>                          
                                    <?php  if(!empty($ps)):  ?>
                                   <a  href="<?php echo base_url('admin/prescription/single_prescription/'.$ps->id);?>" target="_blank" ><i class="fa fa-eye"></i></a> 
                                    <?php endif;  ?>
                                    
                                      <?php if ($amp->status != 'verified'){  ?>
                                      
                                        <a target="_blank" href="<?php echo base_url('admin/invoice/create_new/'.$amp->id);?>" class="btn btn-light-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="create Invoice"><i class="icon-paper-plane"></i></a>
                                
                                      
                                      <?php }else { ?>
                                       
                                        
                                      <?php } ?>
                         <!--              <?php if ($amp->status != 'verified'){  ?>
                                       
                                        
                                                                                                                
                            <form action="<?php echo base_url('admin/payment/rozerpay_payment/'.$amp->id) ?>" method="POST">
                              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                               <?php 
                                    $amount =  get_invoice_amount($amp->id);
                                ?>
                                                                    
                              <script
                                 src="https://checkout.razorpay.com/v1/checkout.js"
                                 data-key="rzp_test_oDw757e5auoleh" 
                                 data-amount="<?php echo html_escape($amount->price*100) ?>"  
                                 data-currency="INR" 
                                 data-buttontext="PAY Now"
                                 data-name="Medyseva"
                                 data-description="Thanks for connect with us."
                                 data-image="https://medyseva.com/clinic/uploads/thumbnail/quest_queen_thumb-100x118_thumb-100x118.png"
                                 data-prefill.name="<?php  echo $amp->name;  ?>"
                                 data-prefill.email="<?php  echo $amp->email;  ?>"
                                 data-theme.color="#F37254"
                                 ></script>
                              <input type="hidden" custom="Hidden Element" name="hidden">
                           </form>
                           
                                                            <?php }else {?>
                                                            <input type="submit" name="submit" value="Paid" disabled  class="btn btn-success btn-lg" style="background-color:#0000FF;">
                                                            
                                                            <?php } ?>
                                                            
                        -->    
                        <?php  $current_time=date("h:ia"); $current_date= date("Y-m-d"); //echo$amp->date; ?>
                        <?php if($amp->date==$current_date): ?>  <?php //echo$current_time; ?>
                             <?php if($amp->status == 'verified'&& $current_time>=$amp->time):  ?>
    
                               <a target="_blank" href="<?php echo base_url('admin/live/zoom/patient/'.html_escape($amp->id));?>" class="btn btn-primary btn-sm d-none d-sm-block"><i class="fa fa-video-camera"></i> <?php echo trans('join') ?></a>
                        <?php endif; endif;  endif; ?>
                                    <!-- <a target="_blank" href="</?php echo base_url('admin/payment/user_receipt/'.$amp->id) ?>" class="pull-right btn btn-default btn-sm"><i class="fa fa-eye"></i> </?php echo trans('view') ?></a> -->
                                    
                                             
                        
                      </td>
                  </tr>
                  
                <?php $i++; endforeach; ?>
              </tbody>
          </table>

        </div>

      </div>
    </div>

  </div>

  </section>
</div>
<script>
function download_csv(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
}

function export_table_to_csv(html, filename) {
	var csv = [];
	var rows = document.querySelectorAll("table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV
    download_csv(csv.join("\n"), filename);
}

document.querySelector("#csvdata").addEventListener("click", function () {
    var html = document.querySelector("table").outerHTML;
	export_table_to_csv(html, "appointments.csv");
});

</script>