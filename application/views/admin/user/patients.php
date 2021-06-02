
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">
      
  

    <div class="box add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit') ?></h3>
          <?php else: ?>
            <h3 class="box-title"><?php echo trans('create-new') ?> </h3>
          <?php endif; ?>

          <div class="box-tools pull-right">
            <?php if (isset($page_title) && $page_title == "Edit"): ?>
              <a href="<?php echo base_url('admin/patients') ?>" class="pull-right btn btn-light-secondary mt-15 btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
              <?php else: ?>
                <a href="#" class="text-right btn btn-light-secondary btn-sm cancel_btn"><i class="fa fa-bars"></i> <?php echo trans('all-patients') ?></a>
              <?php endif; ?>
            </div>
          </div>

          <div class="box-body">
            <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/patients/add')?>" role="form" novalidate>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="name" value="<?php echo html_escape($patients[0]['name']); ?>" >
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo trans('email') ?> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="email" value="<?php echo html_escape($patients[0]['email']); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo trans('phone') ?> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  name="mobile" value="<?php echo html_escape($patients[0]['mobile']); ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="\d{10}" maxlength="10" required>
                  </div>
                </div>
              </div>

                <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>DOB</label>
                    
                 
                    <div class="input-group mb-3">
                      <input type="text" class="form-control datepicker" onchange="select_dob();" name="dob"  id="dob"  value="<?php echo html_escape($patients[0]['dob']); ?>" autocomplete="off">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Religion</label>
                    <select name="religion" class="form-control"> 
                        <option value="">Select</option>
                        <option value="Hindu"  <?php  if($patients[0]['religion'] == 'Hindu'){  ?>  selected="selecetd"  <?php } ?> >Hindu</option>
                        <option value="Muslim" <?php  if($patients[0]['religion'] == 'Muslim'){  ?>  selected="selecetd"  <?php } ?> >Muslim</option>
                        <option value="Jain" <?php  if($patients[0]['religion'] == 'Jain'){  ?>  selected="selecetd"  <?php } ?> >Jain</option>
                        <option value="Sikh" <?php  if($patients[0]['religion'] == 'Sikh'){  ?>  selected="selecetd"  <?php } ?> >Sikh</option>
                        <option value="Christian" <?php  if($patients[0]['religion'] == 'Christian'){  ?>  selected="selecetd"  <?php } ?> >Christian</option>
                        <option value="Bhuddism" <?php  if($patients[0]['religion'] == 'Bhuddism'){  ?>  selected="selecetd"  <?php } ?> >Bhuddism</option>
                    </select>
                    <!-- <input type="text" class="form-control" required name="religion" value="<?php echo html_escape($patients[0]['religion']); ?>"> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Occuptation</label>
                    <input type="text" class="form-control" required name="occuptation" value="<?php echo html_escape($patients[0]['occuptation']); ?>">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Govt ID Proof</label>
                    <select name="govt_id" class="form-control" id="gvt_id"> 
                        <option value="">Select</option>
                        <option value="Aadhar" <?php  if($patients[0]['govt_id'] == 'Aadhar'){  ?>  selected="selecetd"  <?php } ?>  >Aadhar</option>
                        <option value="DL" <?php  if($patients[0]['govt_id'] == 'DL'){  ?>  selected="selecetd"  <?php } ?>  >DL</option>
                        <option value="Pan-card" <?php  if($patients[0]['govt_id'] == 'Pan-card'){  ?>  selected="selecetd"  <?php } ?>  >Pan card</option>
                        <option value="Passport" <?php  if($patients[0]['govt_id'] == 'Passport'){  ?>  selected="selecetd"  <?php } ?>  >Passport</option>
                    </select>
                    <input type="text" style="display:none;" id="gvt_dt" placeholder="Govt ID Details" class="form-control" required name="govt_id_detail" value="<?php echo html_escape($patients[0]['govt_id']); ?>" >
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Registration Date</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control datepicker" name="reg_date"  value="<?php echo date('Y-m-d') ?>" autocomplete="off">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo trans('age') ?></label>
                    <input type="text" class="form-control" name="age" id="age" value="<?php echo html_escape($patients[0]['age']); ?>" >
                  </div>
                </div>

             <!--   <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo trans('weight') ?> </label>
                    <input type="text" class="form-control" name="weight" value="<?php echo html_escape($patients[0]['weight']); ?>" >
                  </div>
                </div>-->

                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo trans('present-address') ?></label>
                    <textarea class="form-control" name="present_address" rows="6"><?php echo html_escape($patients[0]['present_address']); ?></textarea>
                  </div>
                </div>
<!--
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo trans('permanent-address') ?></label>
                    <textarea class="form-control" name="permanent_address" rows="6"><?php echo html_escape($patients[0]['permanent_address']); ?></textarea>
                  </div>
                </div>-->

                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo trans('gender') ?> <span class="text-danger"></span></label>
                    <div class="radio radio-info radio-inline mt-10">
                      <input type="radio" id="inlineRadio1" checked="" <?php if($patients[0]['sex']==2){echo "checked";} ?> value="1" name="sex">
                      <label for="inlineRadio1"> <?php echo trans('male') ?> </label>
                      <input type="radio" id="inlineRadio2" <?php if($patients[0]['sex']==2){echo "checked";} ?>  value="2" name="sex">
                      <label for="inlineRadio2"> <?php echo trans('female') ?> </label>
                    </div>
                  </div>
                </div>

              </div>
              

              <input type="hidden" name="id" value="<?php echo html_escape($patients['0']['id']); ?>">
              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

              <div class="row m-t-30">
                <div class="col-sm-12">
                  <?php if (isset($page_title) && $page_title == "Edit"): ?>
                    <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
                    <?php else: ?>
                      <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save') ?></button>
                    <?php endif; ?>
                  </div>
                </div>

              </form>

            </div>

          </div>


          <?php if (isset($page_title) && $page_title != "Edit"): ?>

            <div class="box list_area">
              <div class="box-header with-border">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <h3 class="box-title">Edit patients <a href="<?php echo base_url('admin/patients') ?>" class="pull-right btn btn-light-primary mt-15 btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                  <?php else: ?>
                    <h3 class="box-title"><?php echo trans('all-patients') ?> </h3>
                  <?php endif; ?>

                  <div class="box-tools pull-right">
                      <?php if(is_parent()||is_staff()): ?>
                   <a href="#" class="pull-right btn btn-light-secondary btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-patients') ?></a>
                   <?php endif ?>
                   <a href="" id="csvdata" class="pull-right btn btn-success btn-sm csv_btn"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</a>
                 </div>
               </div>

               <div class="box-body">

                  <div class="col-md-12 col-sm-12 col-xs-12 scroll">
                    <table class="table table-hover <?php if(count($patientses) > 10){echo "datatable";} ?>">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><?php echo trans('mr.-no') ?></th>
                          <th><?php echo trans('name') ?></th>
                          <th><?php echo trans('age') ?></th>
                          <th><?php echo trans('phone') ?></th>
                          <!-- <th>Email</th>
                          <th>Gender</th>
                          <th>DOB</th>
                          <th>Religion</th>
                          <th>Occuptation</th>
                          <th>Govt ID Proof</th>
                          <th>Registration Date</th> -->
                          <th><?php echo trans('address') ?> </th>
                          <th><?php echo trans('action') ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($patientses as $patients): ?>
                        <tr id="row_<?php echo html_escape($patients->id); ?>">

                          <td><?= $i; ?></td>
                          <td><?php echo html_escape($patients->mr_number); ?></td>
                          <td><?php echo html_escape($patients->name); ?></td>
                          <td><?php echo html_escape($patients->age); ?></td>
                          <td><?php echo html_escape($patients->mobile); ?></td>
                          <!-- <td></?php echo html_escape($patients->email); ?></td>
                          <td></?php echo html_escape($patients->sex); ?></td>
                          <td></?php echo html_escape($patients->dob); ?></td>
                          <td></?php echo html_escape($patients->religion); ?></td>
                          <td></?php echo html_escape($patients->occuptation); ?></td>
                          <td></?php echo html_escape($patients->govt_id); ?></td>
                          <td></?php echo html_escape($patients->reg_date); ?></td> -->
                          <td><?php echo character_limiter($patients->present_address); ?></td>
                          
                          <td class="actions" width="13%">
                              <?php if(is_parent() || is_staff()): ?>
                            <a href="<?php echo base_url('admin/patients/edit/'.html_escape($patients->id));?>" class="on-default edit-row" data-placement="top" title="<?php echo trans('edit') ?>"><i class="fa fa-pencil"></i></a> &nbsp; 

                            <a data-val="Category" data-id="<?php echo html_escape($patients->id); ?>" href="<?php echo base_url('admin/patients/delete/'.html_escape($patients->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="<?php echo trans('delete') ?>"><i class="fa fa-trash-o"></i></a> &nbsp;
                          <?php endif ?>
                          </td>
                        </tr>

                        <?php $i++; endforeach; ?>
                      </tbody>
                    </table>
                  </div>

              </div>

            </div>
          <?php endif; ?>

        </section>
      </div>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
$('#gvt_id').on('change', function() {
    $('#gvt_dt').show();
});

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

function select_dob(){
    
    
    var birth = $('#dob').val();
    ageMS = Date.parse(Date()) - Date.parse(birth);
    age = new Date();
    age.setTime(ageMS);
    ageYear = age.getFullYear() - 1970;

 
    $('#age').val(ageYear);
    
    
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
	export_table_to_csv(html, "patients.csv");
});

</script>