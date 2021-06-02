<div class="content-wrapper">
	<!-- Main content -->
	<section class="content container">
		<div class="row patient_form_section">
			<!-- experience area -->
			<div class="col-md-12">
				<div class="box add_area">
					<div class="box-header with-border">
				        <h3 class="box-title"><?php echo trans('prescriptions') ?> </h3>

				        <?php if (is_user()): ?>
					        <div class="box-tools pull-right">
					         	<a href="<?php echo base_url('admin/prescription') ?>" class="pull-right btn btn-light-secondary mt-15 btn-sm"><i class="fa fa-plus"></i> <?php echo trans('create-new-prescription') ?></a>
					         	<a href="" id="csvdata" class="pull-right btn btn-success btn-sm csv_btn"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</a>
					        </div>
				        <?php endif ?>
				    </div>

					<div class="box-body">
						<table id="dg_table" class="table table-bordered">
							<thead>
								<tr>
									<th width="30%">#</th>
									<th width="30%"><?php echo trans('mr.-no') ?></th>
									<th width="70%">
										<?php if (is_patient()): ?>
											<?php echo trans('doctor-info') ?>
										<?php else: ?>
											<?php echo trans('patient-name') ?>
										<?php endif ?>
									</th>
									<th><?php echo trans('phone') ?></th>
									<th><?php echo trans('email') ?></th>
									<th><?php echo trans('created') ?></th>
									<th style="visibility:hidden;"></th>
									<th class="text-center"><?php echo trans('action') ?></th>
								</tr>
							</thead>
							
							<tbody>
								<?php foreach ($prescription as $key => $row): ?>
									<?php  $patient = get_name_by_id($row->patient_id,'patientses');?>
									<tr>
										<td><?= $key+1;?></td>
										<td>#<?= $patient['mr_number'];?></td>
										<td>

											<?php if (is_patient()): ?>
												<?php  $doctor = get_name_by_id($row->user_id,'users');?>
												<?php echo $doctor['name'] ?>
												<?php echo $doctor['specialist'] ?>
											<?php else: ?>
												<?= $patient['name']?>
												<?php if (!empty($patient['age'])): ?>
													<?= $patient['age'] ?> years
												<?php endif ?>
											
												<?php if (!empty($patient['weight'])): ?>
													<?= $patient['weight'] ?> kg
												<?php endif ?>
												<?php endif ?>
										</td>
										<td><?php echo $patient['mobile'] ?></td>
										<td><?php echo $patient['email'] ?></td>

										<td><?= my_date_show_time($row->created_at)?></td>

										<td class="text-center">
											<?php $reports = get_reports_by_prescription($row->id); ?>
									
											<?php if (!empty($reports) && $row->check_report == 1): ?>
												<label data-toggle="tooltip" data-title="<?php echo $row->feedback ?>" class="badge badge-success-soft brd-20"> <?php echo trans('feedback-available') ?></label>
											<?php endif ?>

											<?php if (!empty($reports) && $row->check_report != 1): ?>
												<label class="badge badge-secondary-soft brd-20"><i class="flaticon-check ficon"></i> <?php echo trans('report-submitted') ?></label><br>
												<label class="badge badge-danger-soft brd-20"> <?php echo trans('feedback-pending') ?></label>
											<?php endif ?>
										</td>

										<td class="text-center">
											<?php if (is_patient()): ?>
												<a href="<?php echo base_url('admin/patients/prescription/'.$row->id); ?>" data-toggle="tooltip" data-title="<?php echo trans('view-prescription') ?>" class="btn btn-primary"> <i class="fa fa-eye"></i></a>
											<?php else: ?>
												<a href="<?php echo base_url('admin/prescription/single_prescription/'.$row->id); ?>" class="btn btn-light-secondary" ata-toggle="tooltip" data-title="<?php echo trans('view-prescription') ?>"> <i class="fa fa-eye"></i></a>
                                         <?php  if(!is_staff()):?>
												<a href="<?php echo base_url('admin/prescription/edit/1/'.$row->id); ?>" class="btn btn-light-secondary" ata-toggle="tooltip" data-title="<?php echo trans('edit-prescription') ?>"> <i class="fa fa-pencil"></i></a>

												<a href="<?php echo base_url('admin/prescription/edit/2/'.$row->id); ?>" class="btn btn-light-success"> <i class="fa fa-plus"></i> <?php echo trans('create-as-new') ?></a>
											<?php endif ?>
									  <?php endif ?>		
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>

					</div>

				</div>
			</div>

			<div class="pagi m-auto text-center">
				<?= $this->pagination->create_links(); ?>
			</div>

		</div>
	</section>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#dg_table').DataTable( {
        "order": [[ 5, "desc" ]]
    } );
} );
</script>
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
	export_table_to_csv(html, "prescription.csv");
});

</script>