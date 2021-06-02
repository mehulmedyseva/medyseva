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
                        <h2 class="to"><?php echo html_escape($patient->name) ?></h2>
                        <div class="address"><?php echo html_escape($patient->mobile) ?></div>
                        <div class="email"><a href="mailto:john@example.com"><?php echo html_escape($patient->email) ?></a></div>
                    </div>
                    <div class="col col-sm-4 invoice-details">
                        <h1 class="invoice-id">INVOICE <?php echo$this->session->userdata('invoice_id');  ?></h1>
                        <div class="date">Date of Invoice:<?php echo date("Y-m-d"); ?></div>
                       
                    </div>
                </div>
                <?php  //var_dump($amp);?>
                 <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">DESCRIPTION</th>
                            <th class="text-right">PRICE</th>
                            <th class="text-right">DISCOUNT</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total="0";  ?>
                     <?php foreach($items as $key=> $item): ?>   
                      <?php 
                      $total=$total+$item->price; $key=$key+1; ?>
                        <tr>
                            <td class="no"><?php echo$key; ?></td>
                            <td class="text-left"><h3>
                                <a target="_blank" href="">
                                <?php echo$item->name; ?>
                                </a>
                                </h3>
                               <a target="_blank" href="">
                                   
                               </a> 
                               
                            </td>
                            <td class="unit">Rs
                                   <?php if(empty($item->price)){echo"0.00";}else{echo$item->price;} ?></td>
                            <td class="qty">Rs 0.00</td>
                            <td class="total">Rs <?php if(empty($item->price)){echo"0.00";}else{echo$item->price;} ?></td>
                        </tr>
                  <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>Rs<?php 
                                   echo$total; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TAX 0%</td>
                            <td>Rs 0.00</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>Rs <?php 
                                   echo$total; ?></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div>
                
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
     $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });
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