<div class="content-wrapper">

  <!-- Main content -->
    <section class="content container">

    <div class="col-md-8 m-auto box add_area mt-50 <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
      
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit-department') ?> </h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('add-new-department') ?> </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <?php $required = ''; ?>
            <a href="<?php echo base_url('admin/department') ?>" class="pull-right btn btn-light-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php else: ?>
            <?php $required = 'required'; ?>
            <a href="#" class="text-right btn btn-light-secondary btn-sm cancel_btn"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/department/add')?>" role="form" novalidate>

          <div class="form-group">
              <label><?php echo trans('title') ?></label>
              <input type="text" class="form-control" name="name" value="<?php echo html_escape($department[0]['name']); ?>">
          </div>
        
          <input type="hidden" name="id" value="<?php echo html_escape($department['0']['id']); ?>">
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

    <div class="box list_area container">

      <div class="box-header with-border mb-4">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit <a href="<?php echo base_url('admin/pages') ?>" class="pull-right btn btn-primary btn-sm mt-15"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('departments') ?></h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
           <a href="#" class="pull-right btn btn-light-secondary btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-department') ?></a>
           <a href="" id="csvdata" class="pull-right btn btn-success btn-sm csv_btn"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</a>          
          </div>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
          <table class="table table-hover <?php if(count($departments) > 100){echo "datatable";} ?>" id="dg_tables">
              <thead>
                  <tr>
                      <th>#</th>
                      <th><?php echo trans('name') ?></th>
                      <th><?php echo trans('action') ?></th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($departments as $row): ?>
                  <tr id="row_<?php echo ($row->id); ?>">
                      
                      <td width="5%"><?= $i; ?></td>
                      <td  width="20%"><?php echo html_escape($row->name); ?></td>
                      <td class="actions" width="12%">

                        <?php if (is_admin() || is_user() && user()->id == $row->user_id): ?>
                        
                          <a href="<?php echo base_url('admin/department/edit/'.html_escape($row->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="page" data-id="<?php echo html_escape($row->id); ?>" href="<?php echo base_url('admin/department/delete/'.html_escape($row->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>

                        <?php else: ?>

                          <a href="#" class="on-defaults text-muted" data-placement="top" title="Edit"><i class="fa fa-ban"></i> <?php echo trans('disabled') ?></a> &nbsp; 

                        <?php endif ?>


                      </td>
                  </tr>
                <?php $i++; endforeach; ?>
              </tbody>
          </table>
      </div>

    </div>
    <?php endif; ?>

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
	export_table_to_csv(html, "departments.csv");
});

</script>