<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="box add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit') ?></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('create-new') ?></h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/additional_advises') ?>" class="pull-right btn btn-light-secondary btn-sm mt-15"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php else: ?>
            <a href="#" class="text-right btn btn-light-secondary btn-sm cancel_btn"><i class="fa fa-list"></i> <?php echo trans('all-additional-advises') ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/additional_advises/add')?>" role="form" novalidate>

          <div class="form-group">
            <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="name" value="<?php echo html_escape($additional_advise[0]['name']); ?>" >
          </div>

          <div class="form-group">
            <label><?php echo trans('details') ?></label>
            <textarea id="ckEditor" class="form-control" name="details" rows="6"><?php echo html_escape($additional_advise[0]['details']); ?></textarea>
          </div>

          <input type="hidden" name="id" value="<?php echo html_escape($additional_advise['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

       
          <div class="row m-t-30">
            <div class="col-sm-12">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i><?php echo trans('save-changes') ?></button>
              <?php else: ?>
                <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save') ?></button>
              <?php endif; ?>
            </div>
          </div>

        </form>

      </div>
    </div>


    <?php if (isset($page_title) && $page_title != "Edit"): ?>
    <div id="import_exp" class="pull-right btn btn-secondary btn-sm csv_btn" style="display:none;">
          <form method="post" action="<?php echo base_url('admin/import_file/add_additional_advises')?>" role="form" novalidate enctype="multipart/form-data">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          <input type="file" name="file"/>
          <input type="submit" class="btn btn-dark" name="submit_file" value="Submit"/>
          </form>
    </div>
    <a href="" id="csvdata" class="pull-right btn btn-success btn-sm csv_btn"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</a>
    <div id="import" class="pull-right btn btn-success btn-sm csv_btn"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Import</div>
   
    <div class="box list_area">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/additional_advises') ?>" class="pull-right btn btn-light-secondary btn-sm mt-15"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('all-additional-advises') ?> </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <a href="#" class="pull-right btn btn-light-secondary btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('create-new') ?></a>
          <!-- <a href="" id="csvdata" class="pull-right btn btn-success btn-sm csv_btn"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</a> -->
        
        </div>
      </div>

      <div class="box-body">
        
        <div class="col-md-12 col-sm-12 col-xs-12 scroll">
            <table class="table table-hover <?php if(count($additional_adviseses) > 10){echo 'datatable';} ?>" id="dg_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo trans('name') ?></th>
                        <th><?php echo trans('details') ?></th>
                        <th><?php echo trans('action') ?></th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($additional_adviseses as $additional_advise): ?>
                    <tr id="row_<?php echo html_escape($additional_advise->id); ?>">
                        
                        <td><?= $i; ?></td>
                        <td><?php echo html_escape($additional_advise->name); ?></td>
                        <td><?php echo character_limiter($additional_advise->details, 80); ?></td>
                        
                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/additional_advises/edit/'.html_escape($additional_advise->id));?>" class="on-default edit-row" data-placement="top" title="<?php echo trans('edit') ?>"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="Category" data-id="<?php echo html_escape($additional_advise->id); ?>" href="<?php echo base_url('admin/additional_advises/delete/'.html_escape($additional_advise->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="<?php echo trans('delete') ?>"><i class="fa fa-trash-o"></i></a> &nbsp;
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
$('#import').on('click', function() {
    $('#import_exp').show();
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
	export_table_to_csv(html, "Additional_advise.csv");
});

</script>