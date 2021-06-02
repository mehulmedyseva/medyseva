  <div class="row"><?php //var_dump($amp); ?>
                <div class="col-sm-3">
                  	<div class="form-group plr-10">
                  		<label>T</label>
                  		<input type="text"class="form-control"name="t" placeholder="°F"value="<?php echo$amp->t; ?>"> 
                  	</div>
                </div>
                <div class="col-sm-3">
                  	<div class="form-group plr-10">
                    	<label>P</label>
                    	<input type="text"class="form-control"name="p"value="<?php echo$amp->p; ?>" placeholder=" /min">    
                	</div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group plr-10">
                   		<label>R</label>
                   		<input type="text"class="form-control"name="r" value="<?php echo$amp->r; ?>"placeholder="/min"> 
                 	</div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group plr-10">
                   		<label>BP</label>
                   		<input type="text"class="form-control"name="bp"value="<?php echo$amp->bp; ?>"placeholder="mmHg"> 
                 	</div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group plr-10">
                   		<label>HT</label>
                   		<input type="text"class="form-control"name="ht"value="<?php echo$amp->ht; ?>"placeholder="cm"> 
                 	</div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group plr-10">
                   		<label>WT</label>
                   		<input type="text"class="form-control"name="wt"value="<?php echo$amp->wt; ?>"placeholder="kg"> 
                 	</div>
                </div>  
                <div class="col-sm-3">
                    <div class="form-group plr-10">
                   		<label>SPO2</label>
                   		<input type="text"class="form-control"name="spo2"value="<?php echo$amp->spo2; ?>"placeholder="%"> 
                  	</div>
                </div>
			</div>

             <div class="form-group plr-10">
              <label>Chief Complaints </label>
              <?php $dd = array_filter(json_decode($amp->chief_complains)); ?>
               <?php foreach ($dd as $d): ?>
              <input class='form-control' type='text' value="<?php echo$d; ?>" name='chief_complains[]'/>
              <?php endforeach; ?>
             <table id="chief_complains" class="table table-bordered"></table>
             <button type="button" class='btn btn-success addmore1'> + Add more </button>
           </div>

           <!-- <div class="form-group plr-10">
             <label>Medical/Hospitalization/ Mensural History</label>
             <input class='form-control' type='text' name='med_histry[]'/>
              <button type="button" class='btn btn-success addmore2'> + Add more </button>]
             <table id="med_histry" class="table table-bordered"></table>
            </div> -->

              <div class="form-group plr-10">
             <label>Mensural History</label>
             <?php $dd = array_filter(json_decode($amp->med_histry)); ?>
               <?php foreach ($dd as $d): ?>
             <input class='form-control' type='text' value="<?php echo$d; ?>"name='med_histry[]'/>
             <?php endforeach; ?>
              <button type="button" class='btn btn-success addmore2'> + Add more </button>
             <table id="med_histry" class="table table-bordered"></table>
            </div>
            
             <div class="form-group plr-10">
             <label>Past History</label>
             <?php $dd = array_filter(json_decode($amp->past_history)); ?>
               <?php foreach ($dd as $d): ?>
             <input class='form-control' type='text'value="<?php echo$d; ?> "name='past_history[]'/>
             <?php endforeach; ?>
              <button type="button" class='btn btn-success addpast'> + Add more </button>
             <table id="past_history" class="table table-bordered"></table>
            </div>
            
           <div class="form-group plr-10">
             <label>Personal History </label>
              <?php $dd = array_filter(json_decode($amp->personal_history)); ?>
               <?php foreach ($dd as $d): ?>
             <input class='form-control' type='text'value="<?php echo$d; ?>" name='personal_history[]'/>
             <?php  endforeach; ?>
             <button type="button" class='btn btn-success addpersonal'> + Add more </button>
             <table id="personal_history" class="table table-bordered"></table>
            </div>
            
           <div class="form-group plr-10">
              <label>PROVISIONAL DIAGNOSIS </label>
              <?php $dd = array_filter(json_decode($amp->prov_diagn)); ?>
               <?php foreach ($dd as $d): ?>
              <input class='form-control' type='text'value="<?php echo$d; ?>" name='prov_diagn[]'/>
              <?php endforeach; ?>
              <button type="button" class='btn btn-success addmore4'> + Add more </button>
             <table id="prov_diagn" class="table table-bordered"></table>
          </div> 
         
           <div class="form-group plr-10">
              <label>ALLERGIES </label>
               <?php $dd = array_filter(json_decode($amp->allergies)); ?>
               <?php foreach ($dd as $d): ?>
              <input class='form-control' type='text'value="<?php echo$d; ?>" name='allergies[]'/>
              <?php  endforeach;  ?>
              <button type="button" class='btn btn-success addmore5'> + Add more </button>
             <table id="allergies" class="table table-bordered"></table>
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
    
     $(document).ready(function(){
        $(".addmorepast").on('click', function () {
            var count = $('#prov_diagn tr').length+1;
            var data = "<tr class='case'><td><span id='snum" + count + "'>" + count + ".</span></td>";
            data += "<td><input class='form-control' type='text' name='past_history[]'/></td></tr>";
            $('#past_histry').append(data);
            count++;
        });
    });
    
    
      $(document).ready(function(){
        $(".addmorepersonal").on('click', function () {
            var count = $('#prov_diagn tr').length+1;
            var data = "<tr class='case'><td><span id='snum" + count + "'>" + count + ".</span></td>";
            data += "<td><input class='form-control' type='text' name='personal_history[]'/></td></tr>";
            $('#personal_histry').append(data);
            count++;
        });
    });

</script>         
            
            
            
            