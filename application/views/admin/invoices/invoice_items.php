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

                                <?php echo$item->name; ?>
                                
                                </h3>
                               <a target="_blank" href="">
                                   
                               </a> 
                               
                            </td>
                            <td class="unit">Rs
                                   <?php if(empty($item->price)){echo"0.00";}else{echo$item->price;} ?></td>
                            <td class="qty">Rs 0.00</td>
                            <td class="total">Rs <?php if(empty($item->price)){echo"0.00";}else{echo$item->price;} ?>
                                <br/>
                                 <a href="javascript:void(0)" onclick="delete_rec('<?php echo$item->id;  ?>')" >Delete</a>
                            </td>
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