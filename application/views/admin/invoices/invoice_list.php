
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">

  <div class="row">

    <!-- experience area -->
    <div class="col-md-12">
      <div class="box add_area">
        <div class="box-header with-border">
            <h3 class="box-title">Manual Invoice List </h3>

            <div class="box-tools pull-right">
                
            </div>
        </div>

        <div class="box-body">
        
          <table class="table table-bordered <?php if(isset($appointments) && count($appointments) >= 10){echo "datatable";} ?>">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Invoice No.</th>
                      <th width="20%">Patient name</th>
                      <th>Total</th>
                   
                      <th><?php echo trans('action') ?></th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($invoice as $val): ?>
                  <tr id="row_<?php echo html_escape($val->id); ?>">
                      
                      <td><?= $i; ?></td>
                      <td><?php echo $val->invoice_id; ?></td>
                      <td>
                          
                          <?php 
                            
                            $name = get_name_by_id($val->patient_id,'patientses');
                            
                            echo ucfirst($name['name']);
                          
                          ?>
                          
                          
                      </td>

                      <td>
                        <?php echo $val->total;  ?>
                      </td>
                      
                    
                      
                      <td class="actions" width="15%">
                           <a data-val="experience" data-id="<?php echo html_escape($val->id); ?>" href="<?php echo base_url('admin/invoice/delete/'.html_escape($val->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
                           <a  href="<?php echo base_url('admin/invoice/edit/'.html_escape($val->id));?>"  class="on-default edit-row" data-placement="top" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                    
                                    <?php 
                                    
                                    if($val->paymant_status == 'pending'){
                                    
                                    ?>
                         <form action="<?php echo base_url('admin/payment/rozerpay_payment_custome/'.$val->id) ?>" method="POST">
                              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                               
                              <script
                                 src="https://checkout.razorpay.com/v1/checkout.js"
                                 data-key="rzp_live_4sw2qGAWn71T2P" 
                                 data-amount="<?php echo html_escape($val->total*100) ?>"  
                                 data-currency="INR" 
                                 data-buttontext="PAY Now"
                                 data-name="Medyseva"
                                 data-description="Thanks for connect with us."
                                 data-image="https://medyseva.com/live/clinic/uploads/medium/png_Mdyseva_English_Logo_medium-1000x252.png"
                                 data-prefill.name="<?php  echo $amp->name;  ?>"
                                 data-prefill.email="<?php  echo $amp->email;  ?>"
                                 data-theme.color="#F37254"
                                 ></script>
                              <input type="hidden" custom="Hidden Element" name="hidden">
                           </form>
                           
                           
                           <?php 
                           
                                    } ?>
                                    <!--<a target="_blank" href="<?php echo base_url('admin/invoice/generateInvoice_new/'.$val->id);?>" class="btn btn-light-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="create Invoice"><i class="icon-paper-plane"></i></a>
                                    -->
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