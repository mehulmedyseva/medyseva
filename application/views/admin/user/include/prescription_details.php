<style>
    img.chamber-img1 {
    max-width: 30%;
    margin-bottom: 5px;
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
	
	<?php $reports = get_reports_by_prescription($prescription['id']); ?>
	<?php if (!empty($reports)): ?>
	<div class="col-md-2">
		<div class="row mt-10">
			<div class="col-sm-12 mb-4">
				<h4> <?php echo trans('lab-reports') ?></h4>
			</div>
			<?php $r=1; foreach ($reports as $report): ?>
				<div class="col-sm-6 mb-4 report-content" id="row_<?php echo $report->id; ?>">
					<a href="<?php echo base_url($report->file) ?>" data-lightbox="reports" data-title="<?php echo $report->test_name; ?>">
						<div class="report-img">
							<img src="<?php echo base_url($report->file) ?>">
						</div>
					</a>
					<label class="badge badge-secondary-soft brd-20 mt-10 small"> <?php echo html_escape($report->test_name); ?></label>

					<?php if (is_patient()): ?>
						<a href="<?php echo base_url('admin/patients/delete_report/'.$report->id) ?>" class="delete_item del-report" data-id="<?php echo $report->id; ?>" data-toggle="tooltip" data-title="Delete"><i class="fa fa-times"></i></a>
					<?php endif ?>

				</div>
			<?php $r++; endforeach ?>

			<?php if (is_user()): ?>
				<a href="#feedbackModal" data-toggle="modal" class="btn btn-light-success btn-block m-4 mr-30"><i class="fa fa-pencil"></i> <?php if($prescription['check_report'] == 1){echo trans('update');}else{echo trans('write');} ?> <?php echo trans('feedback') ?></a>
			<?php endif ?>

			<?php if (is_patient() && $prescription['check_report'] == 1): ?>
				<a href="#feedbackModal" data-toggle="modal" class="btn btn-light-primary btn-block m-4 mr-30"><i class="fa fa-eye"></i> <?php echo trans('view-feedback') ?></a>
			<?php endif ?>

		</div>
	</div>
	<?php endif ?>
<?php //print_r($prescription['next_visit']);exit;?>
 
	<div class="col-md-10 m-auto mt-50">

		<?php if (is_patient()): ?>
			<?php if (!empty($appointment) && $appointment['type'] == 'online'): ?>
				<?php $payment = check_appointment_payment($appointment['id'], $appointment['user_id']); ?>
                <?php if ($payment == TRUE): ?>
					<button type="button" class="btn btn-light-secondary print_prescription pull-left cus-btn-pd mt-30 mb-10 mt-10 mr-5"><i class="fa fa-print"></i> <?php echo trans('print') ?></button>
				<?php else: ?>
					<a href="<?php echo base_url('admin/payment/patient/'.html_escape($appointment['id']));?>" class="btn btn-primary mb-10 btn-sm"><i class="fa fa-dollar"></i> <?php echo trans('pay-now') ?></a>
				<?php endif ?>
			<?php else: ?>
				<button type="button" class="btn btn-light-primary print_prescription pull-left cus-btn-pd mt-3o mb-10 mt-10 mr-5"><i class="fa fa-print"></i> <?php echo trans('print') ?></button>
			<?php endif ?>

			<?php if(!empty($pre_investigation)): ?>
				<a href="#reportModal" data-toggle="modal" class="btn btn-light-success pull-left cus-btn-pd mt-3o mb-10 mt-10 mr-5"><i class="fa fa-cloud-upload"></i> <?php echo trans('upload-report') ?></a>
			<?php endif ?>
	
	
		<?php else: ?>
		<?php if(!is_staff()): ?>
		<a target="_blank" href="<?php echo base_url('admin/prescription/edit/2/'.$prescription['id']); ?>" class="btn btn-light-secondary cus-btn-pd pull-right mt-3o mb-10 mt-10 mr-5"><i class="fa fa-plus-circle"></i> <?php echo trans('create-as-new') ?></a>

		<a href="<?php echo base_url('admin/prescription/edit/1/'.$prescription['id']); ?>" class="btn btn-light-secondary cus-btn-pd pull-right mt-3o mb-10 mt-10 mr-5"><i class="fa fa-pencil"></i> <?php echo trans('edit') ?></a>
         <?php endif; ?>
		<button type="button" class="btn btn-light-primary print_prescription pull-left cus-btn-pd mt-3o mb-10 mt-10 mr-5"><i class="fa fa-print"></i> <?php echo trans('print') ?></button>

		<a href="<?php echo base_url('admin/prescription/all_prescription'); ?>" class="btn btn-light-primary cus-btn-pd pull-left mt-3o mb-10 mt-10 mr-5"><i class="fa fa-file-text-o"></i> <?php echo trans('all-prescriptions') ?></a>
        
        <?php if(!empty($pre_investigation)): ?>
				<a href="#reportModal" data-toggle="modal" class="btn btn-light-success pull-left cus-btn-pd mt-3o mb-10 mt-10 mr-5"><i class="fa fa-cloud-upload"></i> <?php echo trans('upload-report') ?></a>
			<?php endif ?>


		<?php endif ?>

		<!-- <div class="box add_area" >
			<div class="box-body">
				<div class="" id="print_area">
					
					<div class="prescription_headers">
			            <div class="row">
			              <div class="col-md-6 text-left pre_header printhl">
			                <h3></?php echo html_escape($prescription['user_name']) ?></h3>
			                <p></?php echo html_escape($prescription['specialist']) ?></p>
		                    <p></?= $prescription['degree'] ?></p>
			                <p></?php echo html_escape($prescription['email']) ?></p>
			              </div>
			              <div class="col-md-6 text-right printhl">
			                </?php if (!empty($prescription['logo'])): ?>
		                      <img class="chamber-img" src="</?php echo base_url($prescription['logo']) ?>">
		                    </?php endif ?>
		                    <h4 class="mb-0"></?php echo html_escape($prescription['chamber_name']) ?></h4>
		                    <p class="mb-0"></?php echo html_escape($prescription['chamber_title']) ?></p>
		                    <p class="mb-0"></?php echo html_escape($prescription['address']) ?></p>
			              </div>
			            </div>
			        </div>

					<div class="print_section">
						<div class="row">
							</?php if(!empty($prescription['patient_id'])): ?>
								<div class="col-sm-12">
									<div class="top_status">
										<div class="left_tops">
											</?php  $patient =  get_name_by_id($prescription['patient_id'],'patientses');?>
											</?= isset($patient['name'])?$patient['name']:'';?> 
										</div>
										<div class="right_top">
											<ul>
												<li class="top-first"><i class="mr-5"></i> <?php if(isset($patient['age'])){$patient['age'].' years';} ?> </li>
												<li class="top-mid"><i class="mr-5"></i> <?php if(isset($patient['weight'])){$patient['weight'].' kg';} ?></li>
												<li class="top-last"><i class="mr-5"></i> <?= my_date_show($prescription['created_at'])?></li>
											</ul>
										</div>
									</div>
								</div>  
							</?php endif ?>

							<div class="prescription_body">
								<div class="left_pres_side">
									<div class="left_prescription">
										</?php if(!empty($pre_diagonosis)): ?>
											<div class="single_left">
												<div class="left_p_header left">
													<h4></?php echo trans('clinical-diagnosis') ?></h4>
												</div>
												<div class="left_p_details">
													<ol>
														</?php foreach ($pre_diagonosis as $value): ?>
															<li><?= get_name_by_id($value['diagonosis_id'],'diagonosis')['name'];?></li>
														</?php endforeach ?>
													</ol>
												</div>
											</div>
										</?php endif ?>

										</?php if(!empty($pre_ad_advices)): ?>
											<div class="single_left">
												<div class="left_p_header left">
													<h4></?php echo trans('additional-advices') ?></h4>
												</div>
												<div class="left_p_details">
													<ol>
														</?php foreach ($pre_ad_advices as $value): ?>  
															<p><?= get_name_by_id($value['ad_advices_id'],'additional_advises')['details'];?></p>  
														</?php endforeach ?>
													</ol>
												</div>
											</div>
										</?php endif ?>

										</?php if(!empty($pre_advice)): ?>
											<div class="single_left">
												<div class="left_p_header left">
													<h4></?php echo trans('advice') ?></h4>
												</div>
												<div class="left_p_details">
													<ol>
														</?php foreach ($pre_advice as $value): ?>
															<p></?= get_name_by_id($value['advice_id'],'advises')['details'];?></p> 
														</?php endforeach ?>
													</ol>
												</div>
											</div>
										</?php endif ?>

										</?php if(!empty($pre_investigation)): ?>
											<div class="single_left">
												<div class="left_p_header left">
													<h4></?php echo trans('diagnosis-tests') ?></h4>
												</div>
												<div class="left_p_details">
													<ol>
														</?php foreach ($pre_investigation as $value): ?>
															<li></?= get_name_by_id($value['investigation_id'],'advise_investigations')['name'];?></li> 
															
														</?php endforeach ?>
													</ol>
												</div>
											</div>
										</?php endif ?>

									</div>
								</div>

								<div class="right_pres_side">
									<div class="right_prescription">
										<div class="rx_header"><h1>&rx;</h1></div>
										</?php if(!empty($drugs)): ?>
											<div class="right_single pl-20">
												</?php  foreach ($drugs as $key => $value): ?>
												<div class="left_p_header">
													<h4 class="drug_name"></?= $value['name'];?></h4>
													</?php $i=1; foreach ($value['prescription_items'] as $item): ?>
														<div class="second_value">
															<p> 
																<b>
																	</?=  $i!=1 && !empty($item['time_periods'][1])?"<span class='then'> Then</span> ":'';?>	
																</b>  
																</?php if (!empty($item['time_periods'])): ?>
								                                    </?php $vale = $item['time_periods']; ?>
								                                    </?php echo rtrim($vale, '+'); ?>
								                                </?php endif ?>
																</?= !empty($item['medicine_time'])?"( ".$item['medicine_time']." )":'';?>
																<span>
																	</?= !empty($item['duration_text'])?" --- ".$item['duration_text']:' --- ';?><?= !empty($item['duration'])?" ".$item['duration']:'';?> 
																</span>
															</p>

															</?php if (!empty($item['note'])): ?>
																<p class="note_text"></?= $item['note'] ?></p> 
															</?php endif ?>
															
														</div>
													</?php $i++; endforeach ?>

												</div>

												</?php  endforeach ?>
											</div>
										</?php endif ?>

									</div>
								</div>
								
							</div>
							
							
						</div>
						<div class="footer_pescript w-100">
							<div class="visit_left">
								<p class="last_visit_pn"></?= !empty($prescription['next_visit'])?'Next follow up: '.$prescription['next_visit']:'';?> </p>
							</div>

							<div class="visit_right">
								<p class="dr_name"><b></?php echo html_escape($prescription['user_name']) ?></b></p>
							</div>
						</div>
					</div>

					<div class="row hidden">
						<div class="col-sm-12">
							<div class="bottom_image">
								<img src="" alt="">
							</div>
						</div>
					</div>
				</div>

			</div>
		</div> -->


		<div class="box add_area" id="print_area">
			<div class="pdf-body">
				<div class="header-body">
					<div class="prescription_headers1">
			            <div class="row">
			              	<div class="col-md-6 text-left pre_header printhl">
								  
			                	<p>Doctor Name - <?php echo html_escape($prescription['user_name']) ?></p>
		                    	<p>DEGREE - <?= $prescription['degree'] ?></p>
			                	<p>REGISTRATION NUMBER - <?php echo html_escape($prescription['user_id']) ?></p>
												<p>PHONE NUMBER - <?php echo html_escape($prescription['phone']) ?></p>
			              	</div>
			              	<div class="col-md-6 text-right printhl">
			                	<?php if (!empty($prescription['logo'])): ?>
		                      		<img class="chamber-img1" src="<?php echo base_url($prescription['logo']) ?>">
		                    	<?php endif ?>
			              	</div>
			            </div>
					</div>
				</div>
					
				<div class="print_section">
					<div class="row">
						<?php if(!empty($prescription['patient_id'])): ?>
							<div class="col-sm-12">
								<div class="top_status">
									<div class="left_tops">
										<?php  $patient =  get_name_by_id($prescription['patient_id'],'patientses');?>
										<!-- </?php var_dump($patient); exit;?> -->
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
										DATE OF CONSULT - <?= my_date_show($prescription['created_at'])?><br>
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
								<div class=" col1-border">
									<?php $appoint = get_appoint_info($patient['id']);?>
									<!-- </?php var_dump($appoint); ?> -->
									<?php foreach ($appoint as $row): ?>
									<div class="block1">
										<h6 class="text-center p-10"><u>PHYSICAL EXAMINATION</u></h6>
											<div class="row" style="height: auto;">
											<span class="col-sm-8"><span style="font-weight: 600">T</span> - <?php echo $prescription['t']." F"; ?></span>
											<span class="col-sm-8"><span style="font-weight: 600">P </span>- <?php echo $prescription['p']." /mins"; ?></span>
											
											
									<span class="col-sm-8"><span style="font-weight: 600">R</span> - <?php echo $prescription['r']." /min"; ?></span>
											<span class="col-sm-8"><span style="font-weight: 600">BP</span> - <?php echo $prescription['bp']." mmHg"; ?></span>
											<span class="col-sm-8"><span style="font-weight: 600">HT</span> - <?php echo $prescription['ht']." cm"; ?></span>
											<span class="col-sm-8"><span style="font-weight: 600">WT</span> - <?php echo $prescription['wt']." kg"; ?></span>
											<span class="col-sm-8"><span style="font-weight: 600">SPO2</span> - <?php echo $prescription['spo2']; ?></span>
											</div>
									</div>
									<div class="block1">
										<h6 class="text-center p-10"><u>CHIEF COMPLAINTS</u></h6>
										<?php $dd = array_filter(json_decode($prescription['chief_complains'])); ?>
                       		<ul>
											<?php foreach ($dd as $d): ?>
											<li><?php echo $d; ?></li>
											<?php $i++; endforeach ?>
										</u>
									</div>
									<div class="block1">
										<h6 class="text-center p-10"><u>PAST HISTORY</u></h6>
										 <?php $dd = array_filter(json_decode($prescription['past_history'])); ?>
                       		<ul>
											<?php foreach ($dd as $d): ?>
											<li><?php echo $d; ?></li>
											<?php $i++; endforeach ?>
										</u> 
									</div>
									<div class="block1">
										<h6 class="text-center p-10"><u>PERSONAL HISTORY</u></h6>
										 <?php $dd = array_filter(json_decode($prescription['personal_history'])); ?>
                       		<ul>
											<?php foreach ($dd as $d): ?>
											<li><?php echo $d; ?></li>
											<?php $i++; endforeach ?>
										</u> 
									</div>
									<div class="block1">
										<h6 class="text-center p-10"><u>MENSURAL HISTORY</u></h6>
										<?php $dd = array_filter(json_decode($prescription['med_histry'])); ?>
                        				<ul>
											<?php foreach ($dd as $d): ?>
											<li><?php echo $d; ?></li>
											<?php $i++; endforeach ?>
										</u>
									</div>
									<div class="block1">
										<h6 class="text-center p-10"><u>KNOWN ALLERGIES</u></h6>
										<?php $dd = array_filter(json_decode($prescription['allergies'])); ?>
                       				<ul>
											<?php foreach ($dd as $d): ?>
											<li><?php echo $d; ?></li>
											<?php $i++; endforeach ?>
										</u>
									</div>
									<!-- <div class="block1">
										<h6 class="text-center p-10"><u>PROVISIONAL DIAGNOSIS</u></h6>
										<?php $dd = json_decode($row->prov_diagn); ?>
                        				<ul>
											<?php foreach ($dd as $d): ?>
											<li><?php echo $d; ?></li>
											<?php $i++; endforeach ?>
										</u>
									</div> -->
									<?php $i++; endforeach ?>	
								</div>
								
								<div class=" col2-border">
									<div class="right_pres_side">
										<div class="right_prescription">
											<div class="rx_header"><h1>&rx;</h1>
											<?php if(!empty($drugs)): ?>
											<ol>
												<?php  foreach ($drugs as $key => $value): ?>
												<li>
													<h4 class="drug_name"><?= $value['name'];?></h4>
													<?php $i=1; foreach ($value['prescription_items'] as $item): ?>
													<?=  $i!=1 && !empty($item['time_periods'][1])?"<span class='then'> </span> ":'';?>	
													<?php if (!empty($item['time_periods'])): ?>
								                    <?php $vale = $item['time_periods']; ?>
								                    <?php echo rtrim($vale, '+');  ?>
								                    <?php endif ?>
													<?= !empty($item['medicine_time'])?"( ".$item['medicine_time']." )":'';?>
													<?= !empty($item['duration_text'])?" -".$item['duration_text']:' -';?><?= !empty($item['duration'])?" ".$item['duration']:'';?> 
													<?php if (!empty($item['note'])): ?>
													<p class="note_text"><?= $item['note'] ?></p> 
													<?php endif ?>
													<?php $i++; endforeach ?>
												</li>
												<?php  endforeach ?>
											
											</ol>
											</div>
											<?php endif ?>

											<div class="rx_header">
												<h3><u>ADVICE</h3></u>
												<?php if(!empty($pre_advice)): ?>
												<?php //print_r($pre_advice); ?>
													<ol>
														<?php foreach ($pre_advice as $value): ?>
															<li><?= get_name_by_id($value['advice_id'],'advises')['name'];?></li> 
														<?php endforeach ?>
													</ol>
												<?php endif ?>
											</div>

											<div class="rx_header">
											<h3><u>PROVISIONAL DIAGNOSIS</h3>
											<?php if(!empty($pre_diagonosis)): ?>
													<ol>
														<?php foreach ($pre_diagonosis as $value): ?>
														
															<li><?= get_name_by_id($value['diagonosis_id'],'diagonosis')['name'];?></li>
														<?php endforeach ?>
													</ol>
											<?php endif ?>
										</div>
										

											<!-- <div class="rx_header">
												<h3><u>ADDITIONAL NOTES</h3></u></h1>
												<?php if(!empty($pre_ad_advices)): ?>
												<ol>
													<?php foreach ($pre_ad_advices as $value): ?>  
														<li><?= get_name_by_id($value['ad_advices_id'],'additional_advises')['details'];?></li>  
													<?php endforeach ?>
													
													
												</ol>
												<?php endif ?>
												<ol>
												
											</div> -->
										</div>
									</div>
								</div>

								<div class=" col3-border">
									<div class="rx_header">
										<h3><u>INVESTIGATIONS</h3></u>
										<?php if(!empty($pre_investigation)): ?>
										<ol>
											<?php foreach ($pre_investigation as $value): ?>
											<li><?= get_name_by_id($value['investigation_id'],'advise_investigations')['name'];?></li> 
											<?php endforeach ?>
										</ol>
										<?php endif ?>	
									</div>

									<div class="rx_header">
												<h3><u>ADDITIONAL NOTES</h3></u></h1>
												<?php if(!empty($pre_ad_advices)): ?>
												<ol>
													<?php foreach ($pre_ad_advices as $value): ?>  
														<li><?= get_name_by_id($value['ad_advices_id'],'additional_advises')['name'];?></li>  
													<?php endforeach ?>
												</ol>
												<?php endif ?>
												
												  <?php if (!empty($prescription['next_visit'])) {?>
                      						        <li style="font-weight: 600;">	<?php echo"next follow up:".$prescription['next_visit']; ?> </li>
                    					<?php	} ?>
												</ol>
										</div>
								</div>
								</div>
							</div>
						</div>
					</div>

					<div class="header-body">
						<div class="row">
							<div class="disclaimer">
							Disclaimer: This prescription is issued on the information provided by you
							through teleconsultation. Visit doctor or hospital in case of emergency.
							This prescription is valid only in India.<br>
							  We do not promote any particular brand of medicine, patient can go for generic composition or opt for any other brand available.
							</div>
							<div class="disclaimer-right">
								<div class="sign-box">
									<?php echo html_escape($prescription['user_name']) ?>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 text-center m-10">
						MEDYSEVA TECHNOLOGIES<br> 
						18/A ELECTRONICS COMPLEX, PARDESIPURA, INDORE, MP- 452010<br>
						PHONE- 8319653115, EMAIL- <span style="color: #1088de;"><u>info@medyseva.com</u></span><br>
						WEBSITE: www.medyseva.com
						</div>
					</div>
				</div>
			</div>
		</div>
		
		 <div id="reportModal" class="modal fade" role="dialog">
		    <div class="modal-dialog modal-lg">

		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title"><?php echo trans('upload-test-report') ?></h4>
		        </div>
		        <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/patients/add_report/'.$prescription['id'])?>" role="form" novalidate>
		            <div class="modal-body">
		              
		              <?php $f=1; foreach ($pre_investigation as $value): ?>
			                <div class="row">
			                	<div class="report-upload">
				                	<div class="col-md-12">
				                		<h3 class="pl-10"><?= get_name_by_id($value['investigation_id'],'advise_investigations')['name'];?> </h3>
				                	</div>
				                	
					                <div class="col-md-12">
					                	<?php for ($i=1; $i < 5; $i++) { ?>
							                <div class="upload-wrap">
											  <div class="uploadpreview <?php echo $i.$f; ?>"></div>
											  <input id="<?php echo $i.$f; ?>" type="file" name="files<?php echo $f; ?>[]" accept="image/*">
											</div>
										<?php } ?>
									</div>
								</div>
			                </div>
		              <?php $f++; endforeach ?>

		              <!-- csrf token -->
		              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-light-danger mt-10" data-dismiss="modal"><?php echo trans('close') ?></button>
			            <button type="submit" class="btn btn-primary pull-left mr-5"><i class="fa fa-check"></i> <?php echo trans('submit') ?></button>
			        </div>
		        </form>
		      </div>

		    </div>
		  </div>

		  <div id="feedbackModal" class="modal fade" role="dialog">
		    <div class="modal-dialog modal-md">

		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title"><?php echo trans('test-reports') ?></h4>
		        </div>
		        
		            <div class="modal-body">
		              
		            	<h4><?php echo $prescription['feedback'] ?></h4>

			        </div>

			        <div class="modal-footer">
			            <button type="button" class="btn btn-light-danger mt-10" data-dismiss="modal"><?php echo trans('close') ?></button>
			        </div>
		
		      </div>

		    </div>
		  </div>
							
		<?php if (is_patient()): ?>
		  <div id="reportModal" class="modal fade" role="dialog">
		    <div class="modal-dialog modal-lg">

		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title"><?php echo trans('upload-test-report') ?></h4>
		        </div>
		        <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/patients/add_report/'.$prescription['id'])?>" role="form" novalidate>
		            <div class="modal-body">
		              
		              <?php $f=1; foreach ($pre_investigation as $value): ?>
			                <div class="row">
			                	<div class="report-upload">
				                	<div class="col-md-12">
				                		<h3 class="pl-10"><?= get_name_by_id($value['investigation_id'],'advise_investigations')['name'];?> </h3>
				                	</div>
				                	
					                <div class="col-md-12">
					                	<?php for ($i=1; $i < 5; $i++) { ?>
							                <div class="upload-wrap">
											  <div class="uploadpreview <?php echo $i.$f; ?>"></div>
											  <input id="<?php echo $i.$f; ?>" type="file" name="files<?php echo $f; ?>[]" accept="image/*">
											</div>
										<?php } ?>
									</div>
								</div>
			                </div>
		              <?php $f++; endforeach ?>

		              <!-- csrf token -->
		              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-light-danger mt-10" data-dismiss="modal"><?php echo trans('close') ?></button>
			            <button type="submit" class="btn btn-primary pull-left mr-5"><i class="fa fa-check"></i> <?php echo trans('submit') ?></button>
			        </div>
		        </form>
		      </div>

		    </div>
		  </div>

		  <div id="feedbackModal" class="modal fade" role="dialog">
		    <div class="modal-dialog modal-md">

		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title"><?php echo trans('test-reports') ?></h4>
		        </div>
		        
		            <div class="modal-body">
		              
		            	<h4><?php echo $prescription['feedback'] ?></h4>

			        </div>

			        <div class="modal-footer">
			            <button type="button" class="btn btn-light-danger mt-10" data-dismiss="modal"><?php echo trans('close') ?></button>
			        </div>
		
		      </div>

		    </div>
		  </div>
		
		 <?php else: ?>

		<div id="feedbackModal" class="modal fade" role="dialog">
		    <div class="modal-dialog modal-md">

		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title"><?php echo trans('submit-report-feedback') ?></h4>
		        </div>
		        <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/patients/submit_report_feedback/'.$prescription['id'])?>" role="form" novalidate>
		            <div class="modal-body">
		              
		            <div class="form-group">
		            	<textarea class="form-control" name="feedback" rows="6" placeholder="Write your feedback here..."><?php echo $prescription['feedback'] ?></textarea>
		            </div>

		            <!-- csrf token -->
		            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-light-danger mt-10" data-dismiss="modal"><?php echo trans('close') ?></button>
			            <button type="submit" class="btn btn-primary pull-left mr-5"><i class="fa fa-check"></i> <?php echo trans('submit') ?></button>
			        </div>
		        </form>
		      </div>

		    </div>
		  </div>

		<?php endif; ?>

	</div>
</div>