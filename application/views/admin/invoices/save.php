<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="content-wrapper">
  <!-- Main content -->
 <section class="content container w-1500">
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
            <a href="<?php echo base_url('admin/invoice/generateInvoice')?>
" class="btn btn-info">Generate Invoice</a>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="https://lobianijs.com">
                           <?php if (!empty($this->chamber->logo)): ?>
                            <img src="<?php echo base_url($this->chamber->logo) ?>"class="company-image" />
                           <?php endif ?>

                            </a>
                            
                            
                    </div>
                      
                         <input type="hidden"id="url_delete"value="<?php echo base_url('admin/invoice/deleteitem2')?>"/>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="https://lobianijs.com">
                           <?php echo html_escape($this->chamber->name) ?>
                            </a>
                            <p><?php echo html_escape($amp->dr_name) ?></p>
                        </h2>
                        <div><?php echo html_escape($this->chamber->address) ?></div>
                        <div><?php echo$amp->dr_email; ?></div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                         <select class="form-control"name="patient_id"id="patient_id">
                              <?php foreach ($patients as $doctor): ?>
                                <option  value="<?php echo html_escape($doctor->id); ?>"><?php echo$doctor->name; ?></option>
                               <?php endforeach ?>
                             
                         </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                           <select class="form-control"name="item_id"id="item_id">
                              <?php foreach ($items as $item): ?>
                                <option  value="<?php echo html_escape($item->id); ?>"><?php echo$item->name; ?></option>
                               <?php endforeach ?>
                               
                             
                         </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="hidden"id="url"value="<?php echo base_url('admin/invoice/saveitem')?>"/>
                        <button onclick="save()"class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
                <?php  //var_dump($amp);?>
                <div id="invoice-table"></div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
</div></div>
<script>

 function save()
 { 
     var id=$("#patient_id").val();
     var item_id=$("#item_id").val();
     var url = $('#url').val();
      
     $.ajax({
         type:'GET',
          url:url,
          data: {
				"patient_id":id,
				"item_id":item_id,
			},
			success:function(res)
			{
			   
			        $("#invoice-table").html(res);
			   
			},
     });


 }
 
 
 function delete_rec(obj){
     
     var id= obj;
     var url = $('#url_delete').val();

       $.ajax({
         type:'GET',
          url:url,
          data: {
				"id":id,
			},
			success:function(res)
			{   
			       
			     $("#invoice-table").html(res);
			     $("#append_data").hide();
			           
			},
     });

 }
    
    
</script>
<style>
    #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
img.company-image {
    height: 88px;
}
.invoice .invoice-details {
    text-align: right;
    margin-right: 10px;
}
</style>