<p class="pick-date text-success">Pick Available Time Slot for Appointment  : </p> 
	
	<?php foreach ($times as $time): ?>
		<?php $check = check_time($time->time, $date) ?>
		<div class="btn-group" data-aos="fade-in">
		    <label class="btn btn-light-primary btn-sm time_btn ">
		      <input type="radio" class="time_inp" value="<?php echo $time->time ?>" name="time" autocomplete="off"> <?php echo $time->time ?>
		    </label>
		</div>
	<?php endforeach ?>