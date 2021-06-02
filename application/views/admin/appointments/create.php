
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">

  <div class="row">
    <!-- experience area -->
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo trans('add-appointment') ?></h3>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/appointment/add')?>" role="form" novalidate>
            <div class="row">
             <div class="col-sm-6">        
            <div class="form-group">
              <label><?php echo trans('date') ?></label>
              <div class="input-group mb-3">
                <input type="text" class="form-control datepicker"id="appoint_date" name="date"  value="<?php echo date('Y-m-d') ?>" autocomplete="off">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
           </div>

            
            
             
          <div class="col-sm-6">
            <div class="form-group">
                   <label>Select Doctor</label>
                <select name="doctor_id" id="user_id" class="form-control select2"onchange="getTime()">
                    <option value="">Select Doctor </option>
                    <?php foreach ($doctors as $doctor): ?>
                    <option  value="<?php echo html_escape($doctor->id); ?>"><?= '<b>'.$doctor->name.'</b> - '.$doctor->id.'.';?></option>
                  <?php endforeach ?>
                </select>
            </div>
        </div>
        
       </div>
        
       
    
            <!--<div class="row">-->
            <!--    <div class="col-sm-3">-->
            <!--         <div class="form-group plr-10">-->
            <!--      <label>T</label>-->
            <!--       <input type="text"class="form-control"name="t"> -->
            <!--</div>-->
            <!--    </div>-->
            <!--    <div class="col-sm-3">-->
            <!--         <div class="form-group plr-10">-->
            <!--           <label>P</label>-->
            <!--          <input type="text"class="form-control"name="p">    -->
            <!--</div>-->
            <!--    </div>-->
            <!--    <div class="col-sm-3">-->
            <!--         <div class="form-group plr-10">-->
            <!--       <label>R</label>-->
            <!--       <input type="text"class="form-control"name="r"> -->
            <!--     </div>-->
            <!--    </div>-->
            <!--     <div class="col-sm-3">-->
            <!--         <div class="form-group plr-10">-->
            <!--       <label>BP</label>-->
            <!--       <input type="text"class="form-control"name="bp"> -->
            <!--     </div>-->
            <!--    </div>-->
                
            <!--     <div class="col-sm-3">-->
            <!--         <div class="form-group plr-10">-->
            <!--       <label>HT</label>-->
            <!--       <input type="text"class="form-control"name="ht"> -->
            <!--     </div>-->
            <!--    </div>-->
                
            <!--     <div class="col-sm-3">-->
            <!--         <div class="form-group plr-10">-->
            <!--       <label>WT</label>-->
            <!--       <input type="text"class="form-control"name="wt"> -->
            <!--     </div>-->
            <!--    </div-->
                
            <!--     <div class="col-sm-3">-->
            <!--         <div class="form-group plr-10">-->
            <!--       <label>SPO2</label>-->
            <!--       <input type="text"class="form-control"name="spo2"> -->
            <!--     </div>-->
            <!--    </div-->
            <!--</div>-->
            
            <!-- <div class="form-group plr-10">-->
            <!--  <label>Chief Complaints </label>-->
            <!--  <input class='form-control' type='text' name='chief_complains[]'/>-->
            <!--  <table id="chief_complains" class="table table-bordered"></table>-->
            <!--  <button type="button" class='btn btn-success addmore1'> + Add more </button>-->
            <!--</div>-->

            <!--<div class="form-group plr-10">-->
            <!--  <label>Medical/Hospitalization/ Mensural History</label>-->
            <!--  <input class='form-control' type='text' name='med_histry[]'/>-->
            <!--  <button type="button" class='btn btn-success addmore2'> + Add more </button>-->
            <!--  <table id="med_histry" class="table table-bordered"></table>-->
            <!--</div>-->


            <!--<div class="form-group plr-10">-->
            <!--  <label>Known Allergies </label>-->
            <!--  <input class='form-control' type='text' name='allergies[]'/>-->
            <!--  <button type="button" class='btn btn-success addmore3'> + Add more </button>-->
            <!--  <table id="allergies" class="table table-bordered"></table>-->
            <!--</div>-->
            
            <!--<div class="form-group plr-10">-->
            <!--  <label>PROVISIONAL DIAGNOSIS </label>-->
            <!--  <input class='form-control' type='text' name='prov_diagn[]'/>-->
            <!--  <button type="button" class='btn btn-success addmore4'> + Add more </button>-->
            <!--  <table id="prov_diagn" class="table table-bordered"></table>-->
            <!--</div>-->
         
         
 <div class="row"> 
          <div class="col-sm-4">
            <div class="form-group">
              <div class="radio radio-info radio-inline mt-10">
                <input type="radio" id="inlineRadio2" checked value="2" class="patient_type" name="patient_type">
                <label for="inlineRadio2"> <?php echo trans('old-patient') ?></label>&emsp;

                <input type="radio" id="inlineRadio1" value="1" class="patient_type" name="patient_type">
                <label for="inlineRadio1"> <?php echo trans('new-patient') ?></label> 
              </div>
            </div>
           </div>
           <div class="col-sm-4">
            <div class="form-group">
                <div class="radio radio-info radio-inline mt-10">
               <!-- <input type="radio" id="inlineRadio11" checked value="locally" class="patient_type" name="cons_type">
                   <label for="inlineRadio11">Offline</label>&emsp;  -->

                <input type="radio" id="inlineRadio12" checked value="online" class="patient_type" name="cons_type">
                  <label for="inlineRadio12">Online</label> 
              </div>
           <!-- <select name="cons_type" id="patients" class="form-control select2">
                    <option value="locally">Offline </option>
                    <option  value="online">Online</option>
                </select> -->
            </div>
        </div>
        
          <div class="col-sm-4">
            <div class="form-group plr-10">
              <label>Doctor's Availability</label>
            <select name="available_time"id="avl_time"class="form-control">
                
            </select>
          </div>
         </div>
            
    </div>
    <div class="row">
        <div class="form-group plr-10">
              <label><?php echo trans('time') ?></label>
              <input type="text" class="form-control timepicker" name="time"  value="" autocomplete="off">
            </div>
      </div>        
    
        
    </div>
      
    
    
    
    
       <input type="hidden"id="url"value="<?php echo base_url('admin/doctor/get_time')?>"/>
            
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
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            
            <button type="submit" class="btn btn-primary btn-lg ml-0 mt-10"><i class="fa fa-check"></i> <?php echo trans('add-serial') ?></button>
          </form>
        </div>

      </div>
    </div>


    <!-- experience area -->
    

  </div>

  </section>
</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
    $(document).ready(function(){
        $(".addmore1").on('click', function () {
            var count = $('#chief_complains tr').length+1;
            var data = "<tr class='case'><td><span id='snum" + count + "'>" + count + ".</span></td>";
            data += "<td><input class='form-control' type='text' name='chief_complains[]'/></td></tr>";
            $('#chief_complains').append(data);
            count1++;
        });
    });

    $(document).ready(function(){
        $(".addmore2").on('click', function () {
            var count = $('#med_histry tr').length+1;
            var data = "<tr class='case'><td><span id='snum" + count + "'>" + count + ".</span></td>";
            data += "<td><input class='form-control' type='text' name='med_histry[]'/></td></tr>";
            $('#med_histry').append(data);
            count++;
        });
    });

    $(document).ready(function(){
        $(".addmore3").on('click', function () {
            var count = $('#allergies tr').length+1;
            var data = "<tr class='case'><td><span id='snum" + count + "'>" + count + ".</span></td>";
            data += "<td><input class='form-control' type='text' name='allergies[]'/></td></tr>";
            $('#allergies').append(data);
            count++;
        });
    });

    $(document).ready(function(){
        $(".addmore4").on('click', function () {
            var count = $('#prov_diagn tr').length+1;
            var data = "<tr class='case'><td><span id='snum" + count + "'>" + count + ".</span></td>";
            data += "<td><input class='form-control' type='text' name='prov_diagn[]'/></td></tr>";
            $('#prov_diagn').append(data);
            count++;
        });
    });
    
function getTime()
 { 
     var user_id=$("#user_id").val();
     var date=$("#appoint_date").val();
     var url = $('#url').val();
      //alert(item_id);
     $.ajax({
         type:'GET',
          url:url,
          data: {
				"user_id":user_id,
				"date":date,
			},
			success:function(res)
			{
			   
			        $("#avl_time").html(res);
			   
			},
     });


 }
    
    
</script>