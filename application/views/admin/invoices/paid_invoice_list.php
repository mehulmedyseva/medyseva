
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">

  <div class="row">

    <!-- experience area -->
    <div class="col-md-12">
      <div class="box add_area">
        <div class="box-header with-border">
            <h3 class="box-title">Paid Invoice List </h3>

            <div class="box-tools pull-right">
                
            </div>
        </div>

        <div class="box-body">
        
          <table class="table table-bordered <?php if(isset($appointments) && count($appointments) >= 10){echo "datatable";} ?>">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Transaction id</th>
                      <th width="20%">Patient name</th>
                      <th>Total</th>
                      <th>Created at</th>
                      <th><?php echo trans('action') ?></th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($invoice as $val): ?>
                  <tr id="row_<?php echo html_escape($val->id); ?>">
                      
                      <td><?= $i; ?></td>
                      <td><?php echo $val->puid; ?></td>
                      <td>
                          
                          <?php 
                            
                            $name = get_name_by_id($val->patient_id,'patientses');
                            
                            echo ucfirst($name['name']);
                          
                          ?>
                          
                          
                      </td>

                      <td>
                        <?php echo $val->amount;  ?>
                      </td>
                      
                      <td>
                        <?php echo date('d M Y',strtotime($val->created_at));  ?>
                      </td>
                      
                    
                      
                      <td class="actions" width="15%">
                          
                         <?php  if($val->invoice_type == 'custome'){ ?>
                         
                         <a target="_blank" href="<?php echo base_url('admin/invoice/show_custome_invoice/'.$val->id);?>" class="btn btn-light-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="view Invoice"><i class="fa fa-eye"></i></a>
                        
                        
                         <?php } else { ?>
                         <a target="_blank" href="<?php echo base_url('admin/invoice/show_invoice/'.$val->id);?>" class="btn btn-light-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="view Invoice"><i class="fa fa-eye"></i></a>
                                            
                        <?php } ?>                   
                      </td> 
                  </tr>
                  
                <?php $i++; endforeach; ?>
              </tbody>
          </table>

        </div>

      </div>
    </div>

  </div>

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
	export_table_to_csv(html, "appointments.csv");
});

</script>