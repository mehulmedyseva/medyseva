<label><?php echo trans('patient-name') ?> <span class="text-danger">*</span></label>
<select name="patient_name" id="patients" onchange="showData()" class="form-control select2">
	<option value=""><?php echo trans('select-patient') ?> </option>
	<?php foreach ($patients as $pt): ?>
		<?php if (empty($prescription)): ?>
			<option <?php if(isset($patient_id) && $patient_id == $pt->id){echo "selected";} ?> value="<?= $pt->id; ?>"><?= '<b>'.$pt->name.'</b> - '.$pt->mr_number.' - '.$pt->mobile;?></option>
		<?php else: ?>
			<option <?php if($prescription['patient_id'] == $pt->id){echo "selected";} ?> value="<?= $pt->id; ?>"><?= '<b>'.$pt->name.'</b> - '.$pt->mr_number.' - '.$pt->mobile;?></option>
		<?php endif ?>
	<?php endforeach ?>
</select>
    <input type="hidden"name="url"id="url"value="<?php echo base_url('admin/prescription/getdetails')?>">
<script>
function showData()
 { 
       var patient_id=$("#patients").val();
       var url=$("#url").val();
       $.ajax({
             type:"get",
             url:url,
             data:{patient_id:patient_id},
             success:function(res)
                {
                   $("#load-patient-data").html(res);
                }
             });
   }    
</script>