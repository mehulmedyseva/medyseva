<style>
    .block2 {
    border: 1px solid #000;
    padding: 0px 19px;
    margin-left: 10px;
}
h3 {
    line-height: 30px;
    font-size: 14px;
}
.rx_header {
    border: 1px solid;
    margin-top: 3px;
}
.disclaimer {
    padding: 45px;
    text-align: justify;
    float: left;
    width: 70%;
}
.sign-box {
    border: 1px solid #0c0c0cc7;
    padding: 21px 37px;
    margin-top: 49px;
}
p.footer-text {
    text-decoration: none;
    margin: -12px;
    border-bottom: 0px;
}
</style>
<div class="row patient_section">
	<div class="col-md-9 m-auto">

    <form action="<?php echo base_url('admin/prescription/add')?>" method="post" id="preview">

      <h2 class="mb-10">Prescription Preview
        <button type="button" class="prevr-btn btn btn-primary btn-lg prescription_edit pull-right"><i class="fa fa-pencil"></i> Edit</button>
        <button type="submit" class="prevr-btn btn btn-primary btn-lg pull-right mr-15"><i class="fa fa-save"></i> Save & Continue</button>
      </h2>

      <div class="alert alert-info alert-line mb-20 mt-20">
        <i class="icon-info"></i> This is a preview of your prescription. Switch back to Edit if you need to make changes.
      </div>

		  <div class="box add_area" id="print_area">
			<div class="pdf-body">
				<div class="header-body">
					<div class="prescription_headers1">
			            <div class="row">
			              	<div class="col-md-6 text-left pre_header printhl">
			                	<p>Doctor Name - <?php echo html_escape(user()->name) ?></p>
		                    	<p>DEGREE - <?= user()->degree ?></p>
			                	<p>REGISTRATION NUMBER - <?php echo html_escape(user()->id) ?></p>
												<p>PHONE NUMBER - <?= user()->phone ?></p>
			              	</div>
			              	<div class="col-md-6 text-right printhl">
							  	<?php if (!empty($this->chamber->logo)): ?>
                  					<img class="chamber-img" src="<?php echo base_url($this->chamber->logo) ?>">
                				<?php endif ?>
			              	</div>
			            </div>
					</div>
				</div>
					
				<div class="print_section">
					<div class="row">
						<?php if(!empty(session('patient_id'))): ?>
							<div class="col-sm-12">
								<div class="top_status">
									<div class="left_tops">
										<?php $patient = get_name_by_id(session('patient_id'),'patientses');?>
										<!-- </?php var_dump($patient);?> -->
										<span>NAME OF PATIENT -</span> <?= isset($patient['name'])?$patient['name']:'';?> <br>
										<span style="padding-left:0px;">AGE / SEX -</span> <?= isset($patient['age'])?$patient['age']:'';?>
										/ <?php 
											if($patient['sex'] == 1)
												echo "Male";
											else
												echo "Female";
										?>
									</div>
									<div class="right_top">
										<?php $appoint = get_appoint_info($patient['id']);?>
										<?php foreach ($appoint as $row): ?>
										DATE OF CONSULT - <?= my_date_show($row->created_at);?><br>
										<?php $i++; endforeach ?>
										<span style="padding-left:44px;">PATIENTS ID - </span> <?= isset($patient['mr_number'])?$patient['mr_number']:'';?> 	
									</div>
								</div>
							</div>  
						<?php endif ?>
					</div>
					
					<div class="detail-table">
						<div class="sub-table">
							<div class="row">
								<div class="col-sm-12">
								<div class=" col1-border text-justify">
									<?php $appoint = get_appoint_info($patient['id']);?>
									
									<?php foreach ($appoint as $row): ?>
									<div class="block2">
										<h6 class="text-left p-10"><u>PHYSICAL EXAMINATION</u></h6>
									
										<div class="row"style="height: auto;">
											<span class="col-sm-8"><span style="font-weight: 600">T </span>- 
										<?php if(!empty(session('t'))): ?>
										<?php echo $t." F";?>
										<?php endif ?></span>
											<span class="col-sm-8"><span style="font-weight: 600">P </span>- <?php if(!empty(session('p'))): ?><?php echo $p."  /min";?><?php endif ?></span>
											<span class="col-sm-8"><span style="font-weight: 600">R </span>- <?php if(!empty(session('r'))): ?><?php echo $r." /min";?><?php endif ?></span>
											
											<span class="col-sm-8"><span style="font-weight: 600">BP</span> - <?php if(!empty(session('bp'))): ?><?php echo $bp." mmHg";?><?php endif ?></span>
											
											<span class="col-sm-8"><span style="font-weight: 600">HT</span> - <?php if(!empty(session('ht'))): ?><?php echo $ht." cm";?><?php endif ?></span>
											
											<span class="col-sm-8"><span style="font-weight: 600">WT</span> - <?php if(!empty(session('wt'))): ?><?php echo $wt." kg";?><?php endif ?></span>
											
											<span class="col-sm-8"><span style="font-weight: 600">SPO2</span> - <?php if(!empty(session('spo2'))): ?><?php 
											echo $spo2." %";?><?php endif ?></span>
											</div>
									</div>
									<div class="block1">
										<h6 class="text-left p-10"><u>CHIEF COMPLAINTS</u></h6>
										<?php $dd = array_filter(json_decode($chief_complains)); ?>
                        				<ul>
											<?php foreach ($dd as $d): ?>
											<li><?php echo $d; ?></li>
											<?php $i++; endforeach ?>
										</u>
									</div>
								
									<div class="block1">
										<h6 class="text-left p-10"><u>PAST HISTORY</u></h6>
										 <?php $dd = array_filter(json_decode($past_history)); ?>
                        				<ul>	<?php // var_dump($dd); ?>
											<?php foreach ($dd as $d): ?>
											<li><?php echo $d; ?></li>
											<?php $i++; endforeach ?>
										</u> 
									</div>
									<div class="block1">
										<h6 class="text-left p-10"><u>PERSONAL HISTORY</u></h6>
										 <?php $dd = array_filter(json_decode($personal_history)); ?>
                        				<ul>
											<?php foreach ($dd as $d): ?>
											<li><?php echo $d; ?></li>
											<?php $i++; endforeach ?>
										</u> 
									</div>
									<div class="block1">
										<h6 class="text-left p-10"><u>MENSURAL HISTORY</u></h6>
										<?php $dd = array_filter(json_decode($med_histry)); ?>
                        				<ul>
											<?php foreach ($dd as $d): ?>
											<li><?php echo $d; ?></li>
											<?php $i++; endforeach ?>
										</u>
									</div>
									<div class="block1">
										<h6 class="text-left p-10"><u>KNOWN ALLERGIES</u></h6>
										<?php $dd = array_filter(json_decode($allergies)); ?>
                        				<ul>
											<?php foreach ($dd as $d): ?>
											<li><?php echo $d; ?></li>
											<?php $i++; endforeach ?>
										</u>
									</div>	
									<?php $i++; endforeach ?>
								</div>
							
								<div class=" col2-border">
									<div class="right_pres_side">
										<div class="right_prescription">
											<div class="rx_header"><h1>&rx;</h1>
											<?php if(!empty(session('drugs'))): ?>
											<ol>
  											<?php $i=1; foreach (session('drugs') as $key => $value): ?><li>
                      							<?= get_name_by_id($value['drugs_id'],'drugs')['name'];?>
                         						<?php for($j=0;$j<= count($value['time_periods']);$j++): ?>
                                  					<?=  $j==1 && !empty($value['time_periods'][1])?"":'';?>
                                  					<?php if (!empty($value['time_periods'][$j])): ?>
                                    				<?php $vale = $value['time_periods'][$j]; ?>
                                    				<?php echo rtrim($vale, '+'); ?>
                                  					<?php endif ?>
                                  					<?= !empty($value['medicine_time'][$j])?"( ".$value['medicine_time'][$j]." )":'';?>
                                  
                                  					<?= !empty($value['duration_text'][$j])?" -".$value['duration_text'][$j]:'   ';?>
                                   					<?= !empty($value['duration'][$j])?$value['duration'][$j]:'';?> </span>
                                					<?= !empty($value['note'][$j])?$value['note'][$j]:''?> 
                          						<?php endfor ?>
												  </li>
    									 <?php endforeach; ?>
											</ol>
											</div>
										
										<div class="rx_header">
											<h3><u>ADVICE</h3></u>
											<?php if(!empty(session('advice')[0]['advice_id'])): ?>
  											<ol>
  												<?php foreach (session('advice') as $value): ?>
  												<li><?= get_name_by_id($value['advice_id'],'advises')['name'];?></li>	
                      							<!-- <p><?= get_name_by_id($value['advice_id'],'advises')['details'];?></p>  -->
  												<?php endforeach ?>
  											</ol>
  											<?php endif ?>
										</div>

										<div class="rx_header">
											<h3><u>PROVISIONAL DIAGNOSIS</h3>
								<?php //var_dump(session('diagnonosis')); ?>
										
                    			
													
										<?php if(!empty(session('diagonosis'))): ?>
													<ol>
														<?php foreach (session('diagonosis') as $value): ?>
													      <li><?= get_name_by_id($value['diagonosis_id'],'diagonosis')['name'];?></li>  
														<?php endforeach ?>
													</ol>
											<?php endif ?>  
										</div>
										

										<!-- <?php $appoint = get_appoint_info($patient['id']);?>
										<?php foreach ($appoint as $row): ?>
										<div class="rx_header">
											<h3><u>PROVISIONAL DIAGNOSIS</h3></u>
											<?php $dd = json_decode($row->prov_diagn); ?>
                                          <ol>
												<?php foreach ($dd as $d): ?>
												<li><?php echo $d; ?></li>
												<?php $i++; endforeach ?>
											</ol>
										</div>	
										<?php $i++; endforeach ?> -->

										</div>
									</div>
								</div>

								<div class=" col3-border">
									<div class="rx_header">
										<h3><u>INVESTIGATIONS</h3></u>
										<?php if(!empty(session('investigation')[0]['investigation_id'])): ?>
                    					<ol>
                    						<?php foreach (session('investigation') as $value): ?>
                      						<li><?= get_name_by_id($value['investigation_id'],'advise_investigations')['name'];?></li> 
                    						<?php endforeach ?>
                    					</ol>
            							<?php endif ?>
									</div>

									<div class="rx_header">
											<h3><u>ADDITIONAL NOTES</h3></u></h1>
											<?php if(!empty(session('ad_advices')[0]['ad_advices_id'])): ?>
  											<ol>
  												<?php foreach (session('ad_advices') as $value): ?>
  												<li><?= get_name_by_id($value['ad_advices_id'],'additional_advises')['name'];?></li>	
                      							<!-- <p><?= get_name_by_id($value['ad_advices_id'],'additional_advises')['details'];?></p>   -->
  												<?php endforeach ?>
  										
  											<?php endif ?>
  											
  												<?php //$i++; endforeach ?>
                    						
                    							</ol>
                    							<ol>
                    					 <?php if (!empty(session('next_visit'))) {?>
                      						<li style="font-weight: 600;">	<?php echo"next follow up:".session('next_visit'); ?> </li>
                    					<?php	} ?>
                    							</ol>
  											<?php endif ?>
										</div>
								</div>
								</div>
							</div>
						</div>
					</div>

					<div class="header-body">
						<div class="row">
							<div class="disclaimer">
							Disclaimer: <span>This prescription is issued on the information provided by you
							through teleconsultation. Visit doctor or hospital in case of emergency.
							This prescription is valid only in India.</span>
							<br>
							<span>We do not promote any particular brand of medicine, patient can go for generic composition or opt for any other brand available</span>
						
							</div>
							<div class="disclaimer-right">
								<div class="sign-box">
								 <?php echo html_escape(user()->name) ?>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 text-center m-10">
						<p class="footer-text">MEDYSERVE TECHNOLOGIES</p><br> 
						<p class="footer-text">18/A ELECTRONICS COMPLEX, PARDESIPURA, INDORE, MP- 452010</p><br>
						<p class="footer-text">PHONE- 8319653115, EMAIL- <span style="color: #1088de;">info@medyseva.com</span></p><br>
						<p class="footer-text">WEBSITE: www.medyseva.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
      <div class="row">
        <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
      </div>

    </form>
	</div>
</div>

