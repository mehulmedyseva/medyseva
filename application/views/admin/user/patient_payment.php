

<?php
    $paypal_url = ($user->paypal_mode == 'sandbox')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
    $paypal_id = html_escape($user->paypal_email);
    $price = evisit_settings($user->id)->price;
?>

<div class="content-wrapper">
    <div class="content">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="pay-boxss">


                        <div class="tabbable-panel mt-20">
                            <div class="tabbable-line">
                                
                                <ul class="nav nav-tabs ">
                                    <?php if ($user->paypal_payment == 1): ?>
                                    <!-- <li class="active">
                                        <a href="#tab_default_1" data-toggle="tab">
                                        Paypal </a>
                                        
                                    </li> -->
                                    <?php endif ?>

                                    <?php if ($user->stripe_payment == 1): ?>
                                    <li class="<?php if($user->stripe_payment == 1){echo "active";} ?>">
                                        <!--<a href="#tab_default_2" data-toggle="tab">
                                        Stripe </a>-->
                                    </li>
                                    <?php endif ?>

                                    <!-- </?php if ($user->stripe_payment == 1): ?> -->
                                    <li class="">
                                        <!--<a href="#tab_default_3" data-toggle="tab">
                                        Paytm </a>-->
                                    </li>
                                    
                                    <li class="">
                            <form action="<?php echo base_url('admin/payment/rozerpay_payment/'.$appointment->id) ?>" method="POST">
                              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                              <script
                                 src="https://checkout.razorpay.com/v1/checkout.js"
                                 data-key="rzp_live_4sw2qGAWn71T2P" 
                                 data-amount="<?php echo html_escape($price*100) ?>"  
                                 data-currency="INR" 
                                 data-buttontext="PAY Online"
                                 data-name="Medyseva"
                                 data-description="Thanks for connect with us."
                                 data-image="https://medyseva.com/live/clinic/uploads/medium/png_Mdyseva_English_Logo_medium-1000x252.png"
                                 data-prefill.name="<?php  echo $user->name;  ?>"
                                 data-prefill.email="<?php  echo $user->email;  ?>"
                                 data-theme.color="#F37254"
                                 ></script>
                              <input type="hidden" custom="Hidden Element" name="hidden">
                           </form>
                                    </li>
                                     
                                    
                                    <!-- </?php endif ?> -->
                                </ul> <br> <br>

                                <div class="tab-content">

                                    <!-- paypal payment area -->
                                   <!-- <div class="tab-pane active text-center" id="tab_default_1">
                                        <!-- paypal payment -->
                                        <?php if ($user->paypal_payment == 1): ?>
                                           <!-- <div class="payment_area container" id="paypal" style="display: <?php if ($user->paypal_payment == 1){echo "block";}else{echo "none";} ?>">
                                               <div class="row">
                                                    <div class="box col-md-8 m-auto text-center">
                                                        
                                                        <div class="box-body text-center">

                                                            <div class="box-header mb-30">
                                                                <h3 class="text-center">Payment Method - Paypal</h3>
                                                                <h4 class="mb-0 text-center"><strong>
                                                                    Consultation Fee: <?php echo currency_symbol($user->currency); ?><?php echo html_escape($price) ?></strong>
                                                                </h4><br>
                                                            </div>

                                                            <!-- PRICE ITEM -->
                                                         <!--   <form action="<?php echo html_escape($paypal_url); ?>" method="post" name="frmPayPal1">
                                                                <input type="hidden" name="business" value="<?php echo html_escape($paypal_id); ?>" readonly>
                                                                <input type="hidden" name="cmd" value="_xclick">
                                                                <input type="hidden" name="item_name" value="Book Appointment">
                                                                <input type="hidden" name="item_number" value="1">
                                                                <input type="hidden" name="amount" value="<?php echo html_escape($price) ?>" readonly>
                                                                <input type="hidden" name="no_shipping" value="1">
                                                                <input type="hidden" name="currency_code" value="<?php echo html_escape($user->currency);?>">
                                                                <input type="hidden" name="cancel_return" value="<?php echo base_url('admin/payment/payment_cancel/'.html_escape($appointment->id)) ?>">
                                                                <input type="hidden" name="return" value="<?php echo base_url('admin/payment/payment_success/'.html_escape($appointment->id)) ?>">  
                                                             
                                                                <div class="mt-30">
                                                                    <button class="btn btn-primary paypal-btn" href="#">Pay Now <?php echo currency_symbol($user->currency); ?><?php echo html_escape($price) ?></button>
                                                                </div>
                                                            </form>
                                                            <!-- PRICE ITEM -->

                                                      <!--  </div>

                                                    </div>
                                                </div>
                                            </div> -->
                                        <?php endif ?>  
                                    <!-- </div>  -->
                                
                                    <!-- stripe payment area -->
                                    <div class="tab-pane text-center <?php if($user->stripe_payment == 1){echo "active";} ?>" id="tab_default_2" >
                                        <!-- stripe payment -->
                                        <?php if ($user->stripe_payment == 1): ?>
                                            <div class="payment_area container" id="stripe" style="display:none;">
                                               <div class="row justify-content-center">
                                                    <div class="box col-md-8 m-auto text-center">

                                                        <div class="box-header mb-30">
                                                            <h3 class="text-center">Stripe Payment </h3>
                                                            <badge class="mb-0 badge badge-pill badge-info-soft">
                                                                Total booking price: <?php echo currency_symbol($user->currency); ?><?php echo html_escape($price) ?>
                                                            </badge><br>
                                                        </div>
                               
                                                        <div class="credit-card-box">
                                                            <h4 class="box-title text-left">Card Details 
                                                                <span><img class="img-responsive pull-right mt--5" width="40%" src="<?php echo base_url('assets/images/accept-cards.jpg') ?>"></span>
                                                            </h4>
                                                            <hr>
                                                            <div class="spacer py-1"></div>

                                                            <div class="box-body p-0">
                                                
                                                                <form role="form" action="<?php echo base_url('admin/payment/stripe_payment') ?>" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo html_escape($user->publish_key); ?>" id="payment-form">
                                                                    
                                                                    <div class='row'>
                                                                        <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                        </div>
                                                                    </div>

                                                                    <div class='row'>
                                                                        <div class='col-xs-12 col-md-12 form-group required text-left'>
                                                                            <input class='textfield textfield--grey' type='text' value="" placeholder="Cardholder's Name" size='12'>
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-12 form-group required text-left'>
                                                                            <input autocomplete='off' class='textfield textfield--grey card-number'
                                                                                type='text' placeholder="Card Number" value="" size='12'>
                                                                        </div>
                                                                    </div>
                                                        

                                                                    <div class='form-row row'>
                                                                        <div class='col-xs-12 col-md-5 form-group expiration required text-left'>
                                                                            <input class='textfield textfield--grey card-expiry-month' placeholder='Expiration month MM' size='2'
                                                                                type='text' value="">
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-5 form-group expiration required text-left'>
                                                                            <input class='textfield textfield--grey card-expiry-year' placeholder='Expiration Year YYYY' size='4'
                                                                                type='text' value="">
                                                                        </div>
                                                                        <div class='col-xs-12 col-md-2 form-group cvc required text-left'>
                                                                            <input autocomplete='off' class='textfield textfield--grey card-cvc' placeholder='CVC' size='4'
                                                                                type='text' value="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="text-center text-success">
                                                                        <div class="payment_loader hide"><i class="fa fa-spinner fa-spin"></i> Loading....</div><br>
                                                                    </div>
                                                             
                                                                    <!-- csrf token -->
                                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                                                    
                                                                    <input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="badge badge-pill badge-warning-soft mb-4"><i class="icon-lock"></i> All transactions are secure and encrypted. Credit card information is never stored.</div>
                                                                        </div>
                                                                        <div class="spacer py-2"></div>
                                                                        <div class="col-md-12 mb-30">
                                                                            <button class="btn btn-primary payment_btn btn-lg" type="submit">Pay Now <?php echo currency_symbol($user->currency); ?><?php echo html_escape($price) ?></button>
                                                                        </div>
                                                                    </div>
                                                                         
                                                                </form>
                                                            </div>
                                                        </div>        
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>      
                                    </div>
                                    </div>



                                    <!-- stripe payment area -->
                                    <div class="tab-pane text-center" id="tab_default_3" style="display:none;">
                                        <!-- stripe payment -->
                                        <!-- <?php if ($user->stripe_payment == 1): ?> -->
                                            <div class="payment_area container" id="paytm">
                                               <div class="row justify-content-center">
                                                    <div class="box col-md-8 m-auto text-center">

                                                        <div class="box-header mb-30">
                                                            <h3 class="text-center">Paytm Payment </h3>
                                                            <badge class="mb-0 badge badge-pill badge-info-soft">
                                                                Total booking price: <?php echo currency_symbol($user->currency); ?><?php echo html_escape($price) ?>
                                                            </badge><br>
                                                        </div>
                                                            <form action="<?php echo base_url('admin/Predirect/add')?>" role="form" novalidate method="post">
                                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                                                <div class="form-group">
                                                                <input type="hidden" id="INDUSTRY_TYPE_ID" name="INDUSTRY_TYPE_ID" value="Retail">
                                                                <input type="hidden"  id="CHANNEL_ID" name="CHANNEL_ID" value="WEB">
                                                                
                                                                <input type="hidden" class="form-control" id="ORDER_ID" name="ORDER_ID" size="20" maxlength="20" autocomplete="off" tabindex="1" value="<?php echo  "ord" . rand(100,999);?>">
                                                                <input type="hidden"   name="cust_id" value="<?php echo html_escape($user->id) ?>">
                                                                <input type="hidden"   name="appointment_id" value="<?php echo html_escape($appointment_id) ?>">
                                                                <input type="hidden"   name="patient_id" value="<?php echo html_escape($appointment->patient_id) ?>">
                                                                <input type="hidden" class="form-control"  name="TXN_AMOUNT" autocomplete="off" tabindex="5" value="<?php echo html_escape($price) ?>" disable>
                                                                <input type="submit" name="submit" value="CheckOut" class="btn btn-success btn-lg" style="background-color:#0000FF;">   
                                                            </form>       
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- <?php endif ?>       -->
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>