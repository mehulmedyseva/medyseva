<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
</head>
<body>
<!--     <input type="text" name="url1" id="url1" value="<?php echo base_url('admin/invoice/delete_test')?>
     
      <a href="<?php echo base_url('admin/invoice/generateInvoice')?>-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function remove(data)
    {
         $.ajax({  
            type: "get",            
            url: "https://medyseva.com/live/clinic/admin/invoice/delete_test/"+data,
            data: { id: data },
            success: function (response) {
               location.reload();
            }
        });

    }
    
    
    function remove_consultation(data){
         
         $.ajax({  
            type: "get",     
            
            url: "https://medyseva.com/live/clinic/admin/invoice/delete_consultation/"+data,
            data: { id: data },
            success: function (response) {
              location.reload();
            }
        });
        
    }
</script>
<div style="border: 1px solid #ddd;width: 900px; margin: 0 auto;font-family: sans-serif;">
	<div style="padding: 30px 20px;">
		<table style="width: 100%;border-bottom: 1px solid #ddd;padding: 20px 0;">
			<tr>
				<td width="10%">

					 <a target="_blank"  href="https://lobianijs.com">
                           <?php if (!empty($this->chamber->logo)): ?>
                            <img width="100%"  src="<?php echo base_url($this->chamber->logo) ?>"class="company-image" />
                           <?php endif ?>

                            </a>
				</td>
				<td width="60%" style="text-align: center;">
					
					<h4 style="margin-bottom: 5px;margin-top: 0;"><?php echo html_escape($this->chamber->address) ?></h4>
					<h4 style="margin-bottom: 5px;margin-top: 0;"><?php echo$amp->dr_email; ?></h4>
				</td>
				<td width="10%" style="vertical-align: bottom;">
					<h5 style="margin-bottom: 5px;margin-top: 0;text-align: right;">OPD Billing </h5>
					
				</td>
			</tr>
		</table>
		<table style="width: 100%;">
			<tr>
				<td width="40%">
					<table>
						<tr>
							<td width="40%" style="font-size: 14px;padding: 5px;font-weight: 600;">Patient Name: </td>
							<td width="60%" style="font-size: 14px;padding: 5px;"><span style="text-transform: uppercase;font-weight: 600;"><?php  echo $amp->name;  ?></span></td>
						</tr>
						
						<tr>
							<td width="40%" style="font-size: 14px;padding: 5px;font-weight: 600;">MR No: </td>
							<td width="60%" style="font-size: 14px;padding: 5px;"><?php  echo $amp->mr_number;  ?></td>
							
						</tr>
						
						<tr>
							<td width="40%" style="font-size: 14px;padding: 5px;font-weight: 600;">Gender/ Age: </td>
							<td width="60%" style="font-size: 14px;padding: 5px;"><?php  
							
							        if($amp->sex == 2){
							        echo 'Female';
							        }else{
							            echo 'Male';
							        }
							
							
							
							    ?>/<?php  echo $amp->age;  ?></td>
							
						</tr>
						<tr>
							<td width="40%" style="font-size: 14px;padding: 5px;font-weight: 600;">Ref. Doctor: </td>
							<td width="60%" style="font-size: 14px;padding: 5px;"><?php echo html_escape($amp->dr_name) ?></td>
							
						</tr>
						
						<tr>
							<td width="40%" style="font-size: 14px;padding: 5px;font-weight: 600;">Center Name: </td>
							<td width="60%" style="font-size: 14px;padding: 5px;"><?php echo html_escape($this->chamber->name) ?></td>
							
						</tr>
						
					
					</table>
					
					
				</td>
				<td width="50%" style="vertical-align: top;">
					<table>
						
						<tr>
							<td width="40%" style="font-size: 14px;padding: 5px;font-weight: 600;">Bill No: </td>
							<td width="60%" style="font-size: 14px;padding: 5px;"><?php echo $amp->id;  ?></td>
							
						</tr>
						
						<tr>
							<td width="40%" style="font-size: 14px;padding: 5px;font-weight: 600;">Date: </td>
							<td width="60%" style="font-size: 14px;padding: 5px;"><?php echo  date('Y-m-d',strtotime($amp->date)); ?>
							</td>
							
						</tr>
						
			
						
							<tr>
							<td width="40%" style="font-size: 14px;padding: 5px;font-weight: 600;">Ref. Company: </td>
							<td width="60%" style="font-size: 14px;padding: 5px;">SELF</td>
							
						</tr>
						
						<tr>
							<td width="40%" style="font-size: 14px;padding: 5px;font-weight: 600;">Mobile No.: </td>
							<td width="60%" style="font-size: 14px;padding: 5px;"><?php echo $amp->mobile; ?></td>
							
						</tr>
						
					</table>
					
				</td>
			</tr>
		</table>


		<table style="width: 100%;text-align: left; margin-top: 20px;font-size: 14px;border:1px solid #ddd;border-collapse: collapse;">
			<tbody>
				   <tr >
						<td style="background-color: #eee;" colspan="3">
							<table style="width: 100%;">
									<td width="20%" style="padding: 5px;">
										S.No
									</td>
									<td width="40%" style="padding: 5px;">
										Service Name
									</td>
									<td width="40%" style="padding: 5px;">
										<table style="width: 100%">
											<tr>
											<td width="20%">
												QTY
											</td>
											<td width="40%">
												Rate
											</td>
											<td width="40%">
												Amount
											</td>
										</tr>
										</table>
									</td>
								</table>
						</td>
					</tr>
                       <?php 
                       
                        
           
                      if($amp->show_consultation == 'yes'){ 
                      
                      
                      
                      ?>
					  <tr>
						<td style="" colspan="3">
							<table style="width: 100%;">
									<td width="20%" style="padding: 5px;">
										1
									</td>
									<td width="40%" style="padding: 5px;">
										Consultation Fees
									</td>
									<td width="40%" style="padding: 5px;">
										<table style="width: 100%">
										  <tr>
											<td width="20%">
												1
											</td>
											<td width="40%">
												Rs <?php if(empty($amp->amount)){
                                   echo$amp->price;}else{ echo$amp->amount;} ?>
											</td>
											<td width="40%">
												Rs <?php if(empty($amp->amount)){
                                   echo$amp->price;}else{ echo$amp->amount;} ?>
                                                 
                                                 <a href="javascript:void(0)" onclick="remove_consultation('<?php echo $amp->id;  ?>')" >Delete</a>
											</td>
										  </tr>
										</table>
									</td>
								</table>
						</td>
					</tr>
					
					<?php 
					      $cal_amount = $amp->price;
                      }else{
                      
                        $cal_amount = 0;
                      
                      }
					?>
				    
				    <?php 
				        $test_price = [];
				        $count = 2;
				        if(!empty($info)){
				            
				        foreach($info as $value){
				            
				        $detail =  get_name_by_id($value->investigation_id,'advise_investigations');
				        
				        
				    ?>
					  <tr>
						<td style="" colspan="3">
							<table style="width: 100%;">
									<td width="20%" style="padding: 5px;">
										<?php  echo $count++; ?>
									</td>
									<td width="40%" style="padding: 5px;">
										<?php echo $detail['name'];  ?>
									</td>
									<td width="40%" style="padding: 5px;">
										<table style="width: 100%">
											 <tr>
											<td width="20%">
												1
											</td>
											<td width="40%">
												Rs <?php 
												
										            if(!empty($detail['price'])){
												    echo ($detail['price']);
												    }else{
												        echo 0.0;
												    }  
												    
												    ?>
											</td>
											<td width="40%">
											    
												Rs <?php 
												    
												    if(!empty($detail['price'])){
												    echo ($detail['price']);
												    }else{
												        echo 0.0;
												    }
												    
												    
												    ?>
												
												<a href="javascript:void(0)" onclick="remove('<?php echo $value->id;  ?>')" >Delete</a>
											</td>
										  
										</tr>
										</table>
									</td>
								</table>
						</td>
					</tr>
					<?php 
					 
					 $test_price[] = $detail['price'];
					
				        } 
				        }
				     
				     $final_amount = array_sum($test_price);
				     
				     
				    ?>
					
						  
				
					
				</tbody>
			
		</table>
    
		<table style="width: 40%;margin-right: 0;margin-left: auto; font-size: 14px;margin-top: 20px;border-collapse: collapse;">
			<tbody>
				<tr>
					<td style="padding: 5px;"><b>Total</b> </td>
					<td style="padding: 5px;">:</td>
					<td style="padding: 5px;"><b><?php if(empty($cal_amount)){
                                   echo 'Rs '. ($cal_amount+$final_amount);}else{ echo 'Rs '. ($cal_amount+$final_amount);} ?></b></td>
				</tr>
				<!--<tr>
					<td style="padding: 5px;"><b>Pre Paid Amount</b> </td>
					<td style="padding: 5px;">:</td>
					<td style="padding: 5px;">4350</td>
				</tr>
				<tr>
					<td style="padding: 5px;"><b>Post Paid Amount</b> </td>
					<td style="padding: 5px;">:</td>
					<td style="padding: 5px;">4350</td>
				</tr>-->
				<tr>
					<td style="padding: 5px;border-top: 2px solid #ddd;"><b></b> </td>
					<td style="padding: 5px;border-top: 2px solid #ddd;"></td>
					<td style="padding: 5px;border-top: 2px solid #ddd;"></td>
				</tr>
				
			</tbody>
		</table>

			<table style="width: 50%; font-size: 14px;margin-top: 20px;border-collapse: collapse;">
			<tbody>
				<tr>
					<td style="padding: 5px;"><b>Net Amount In Words</b> </td>
					<td style="padding: 5px;">:</td>
					<td style="padding: 5px;"><b><?php   
					
					 if(empty($cal_amount)){
					     
                        $amount = ($cal_amount+$final_amount);}else{ $amount = ($cal_amount+$final_amount);} 
                                   
                                   
					
					
					echo inrToword($amount);  ?></b></td>
				</tr>
				
			
				
			</tbody>
		</table>
        <table class="signature"style="">
            <tr>
                <td colspan="3"></td>
            </tr>
             <tr>
                <td colspan="3">For Medyserve Technologies</td>
            </tr>
        </table>
           <form action="<?php echo base_url('admin/payment/rozerpay_payment/'.$amp->id) ?>" method="POST">
                              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                                                    
                              <script
                                 src="https://checkout.razorpay.com/v1/checkout.js"
                                 data-key="rzp_live_4sw2qGAWn71T2P" 
                                 data-amount="<?php echo html_escape($amount*100) ?>"  
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
		
	</div>
</div>
<style>
    .signature{
        float: right;
    font-weight: 600;
    font-size: unset;
    margin-top: 2px;
    }
</style>
<script>


    function deletefunction(value){
    
    alert(value);    
    }   
    
    

</script>

</body>
</html>