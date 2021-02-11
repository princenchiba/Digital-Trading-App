<div class="payment-process-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">            
                <div class="payment-process">
                    <?php 
                        if ($deposit->method_id=='bitcoin') { 
                    ?>

    <!-- Note - If your website not use Bootstrap4 CSS as main style, please use custom css style below and delete css line above. 
        It isolate Bootstrap CSS to a particular class 'bootstrapiso' to avoid css conflicts with your site main css style -->
   
        <script src="<?php echo base_url("assets/website/js/jquery-3.5.1.min.js"); ?>" crossorigin="anonymous"></script> 
        <script src="<?php echo base_url("gourl/js/support.min.js"); ?>" crossorigin="anonymous"></script> 
        <!-- CSS for Payment Box -->
        <?php
       
    // Display payment box  
        echo $deposit_data['box']->display_cryptobox_bootstrap($deposit_data['coins'], $deposit_data['def_coin'], $deposit_data['def_language'], $deposit_data['custom_text'], $deposit_data['coinImageSize'], $deposit_data['qrcodeSize'], $deposit_data['show_languages'], $deposit_data['logoimg_path'], $deposit_data['resultimg_path'], $deposit_data['resultimgSize'], $deposit_data['redirect'], $deposit_data['method'], $deposit_data['debug']);

    // You can setup method='curl' in function above and use code below on this webpage -
    // if successful bitcoin payment received .... allow user to access your premium data/files/products, etc.
        
        ?>

    <?php } elseif ($deposit->method_id=='payeer') { ?>
        <div class="col-lg-8 offset-lg-2">
            <table class="table table-bordered">
                <tr>
                    <th><?php echo display("user_id") ?></th>
                    <td class="text-right"><?php echo esc($deposit->user_id) ?></td>
                </tr>
                <tr>
                    <th><?php echo display("payment_gateway") ?></th>
                    <td class="text-right"><?php echo esc($deposit->method_id) ?></td>
                </tr>
                <tr>
                    <th><?php echo display("amount") ?></th>
                    <td class="text-right"><?php echo esc($deposit->amount) ?></td>
                </tr>
                <tr>
                    <th><?php echo display("fees") ?></th>
                    <td class="text-right"><?php echo (float)esc(@$deposit->fees_amount) ?></td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td class="text-right"><?php echo esc($deposit->amount+(float)@$deposit->fees_amount) ?></td>
                </tr>
            </table>
            <form method="post" action="https://payeer.com/merchant/">
                <input type="hidden" name="m_shop" value="<?php echo esc($deposit_data['m_shop']) ?>">
                <input type="hidden" name="m_orderid" value="<?php echo esc($deposit_data['m_orderid']) ?>">
                <input type="hidden" name="m_amount" value="<?php echo esc($deposit_data['m_amount']) ?>">
                <input type="hidden" name="m_curr" value="<?php echo esc($deposit_data['m_curr']) ?>">
                <input type="hidden" name="m_desc" value="<?php echo esc($deposit_data['m_desc']) ?>">
                <input type="hidden" name="m_sign" value="<?php echo esc($deposit_data['sign']) ?>">                               
                <input type="submit" name="m_process" value="Payment Process" class="btn btn-success w-md m-b-5" />
                <a href="<?php echo base_url('deposit'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                <br>
                <br>
                <br>
            </form>
        </div>
    <?php } elseif ($deposit->method_id=='paypal')  { ?>
        <table class="table table-bordered">
            <tr>
                <th><?php echo display("user_id") ?></th>
                <td class="text-right"><?php echo esc($deposit->user_id) ?></td>
            </tr>
            <tr>
                <th><?php echo display("payment_gateway") ?></th>
                <td class="text-right"><?php echo esc($deposit->method_id) ?></td>
            </tr>
            <tr>
                <th><?php echo display("amount") ?></th>
                <td class="text-right"><?php echo esc($deposit->amount) ?></td>
            </tr>
            <tr>
                <th><?php echo display("fees") ?></th>
                <td class="text-right"><?php echo esc($deposit->fees_amount) ?></td>
            </tr>
            <tr>
                <th>Total</th>
                <td class="text-right"><?php echo esc($deposit->amount+$deposit->fees_amount) ?></td>
            </tr>
        </table>
        <a class="btn btn-success w-md m-b-5 text-right" href="<?php echo $deposit_data['approval_url'] ?>">Payment Process</a>

    <?php } elseif ($deposit->method_id=='coinpayment')  { ?>
        <table class="table table-bordered">
            <tr>
                <td>
                    <strong>Important</strong></br>
                    <ul>
                        <li>
                            Send Only <strong><?php echo esc($deposit->currency_symbol);?></strong>
                        deposit address. Sending any other coin or token to this address may result in the loss of your deposit.</li>
                    </ul>
                    <br>
                    <center>
                        <div class="diposit-address mt-20">
                            <div class="label">
                                <?php echo esc($deposit->currency_symbol);?> Diposit Address.
                            </div>
                            <div class="dip_address">
                                <strong><input type="text" id="copyed" value="<?php echo esc($deposit_data['result']['address'])?>" readonly="readonly"/></strong>
                            </div>
                            <div class="copy_address mt-20">
                                <button  class="btn btn-primary" onclick="copyFunction()">Copy Address</button>
                            </div>
                            <div class="diposit-qrcode mt-20">
                                <div class="qrcode">
                                    <img src="<?php echo $deposit_data['result']['qrcode_url'] ?>" />
                                </div>
                            </div>
                            <div class="deposit-balance mt-20">
                                <h2><?php echo esc(number_format($deposit->amount+(float)@$deposit->fees_amount,8))." <span>".esc($deposit->currency_symbol); ?></span></h2>
                            </div>
                        </div>
                    </center>

                    <div class="please-note mt-20">
                        <div class="label_note">
                            Please Note
                        </div>
                        <div class="textnote">
                            <ul>
                                <li>Coins will be deposited immediately after <font color="#03a9f4"><?php echo esc($deposit_data['result']['confirms_needed']);?></font> network confirmations</li>
                                <li>You can track its progress on the <a target="_blank" href="<?php echo $deposit_data['result']['status_url'];?>"><?php echo display('history');?></a>  <?php echo display('page');?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="please-note mt-20">
                        <div class="label_note">
                            <a href="<?php echo base_url()?>"><button type="button" class="btn btn-success"><?php echo display('back');?></button></a>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    <?php } elseif ($deposit->method_id=='token') { ?>
      
        <table class="table table-bordered">
            <tr>
                <td>
                    <strong><?php echo display('important');?></strong></br>
                    <ul>
                        <li>
                            <?php echo display('send_only');?> <strong><?php echo $deposit->currency_symbol;?></strong>
                        <?php echo display('deposit_address');?>. <?php echo display('sending_any_other_coin_or_token_to_this_address_may_result_in_the_loss_of_your_deposit');?>.</li>
                    </ul>
                    <br>
                    <center>
                        <div class="diposit-address mt-20">
                            <div class="label">
                                <?php echo esc($deposit->currency_symbol);?> <?php echo display('deposit_address');?>.
                            </div>
                            <div class="dip_address">
                                <strong><input type="text" id="copyed" value="<?php echo esc(@$gateway->public_key) ?>" readonly="readonly"/></strong>
                            </div>
                            <div class="copy_address mt-20">
                                <button  class="btn btn-primary" onclick="copyFunction()"><?php echo display('copy_address');?></button>
                            </div>
                            <?php if ($gateway->secret_key=='show') { ?>
                                <div class="diposit-qrcode mt-20">
                                    <div class="qrcode">
                                        <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo @$gateway->public_key ?>&choe=UTF-8" />
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <h4><?php echo esc($deposit->amount+(float)@$deposit->fees_amount) ?> <?php echo esc($deposit->currency_symbol);?></h4>
                    </center>

                    <div class="please-note mt-20">
                        <div class="textnote">
                            <?php echo esc(@$gateway->private_key) ?>
                        </div>
                    </div>
                    <div class="please-note mt-20">
                        <div class="label_note">
                            <a class="btn btn-success w-md m-b-5 text-right" href="<?php echo $deposit_data['approval_url'] ?>"><?php echo display('payment_complete');?></a>
                            <a class="btn btn-danger w-md m-b-5 text-right" href="<?php echo $deposit_data['cancel_url'] ?>"><?php echo display('cancel');?></a>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    <?php } elseif ($deposit->method_id=='stripe')  { ?>
        <table class="table table-bordered">
            <tr class="table-bg">
                <th><?php echo display("user_id") ?></th>
                <td class="text-right"><?php echo esc($deposit->user_id) ?></td>
            </tr>
            <tr class="table-bg">
                <th><?php echo display("payment_gateway") ?></th>
                <td class="text-right"><?php echo esc($deposit->method_id) ?></td>
            </tr>
            <tr class="table-bg">
                <th><?php echo display("amount") ?></th>
                <td class="text-right"><?php echo esc($deposit->amount) ?></td>
            </tr>
            <tr class="table-bg">
                <th><?php echo display("fees") ?></th>
                <td class="text-right"><?php echo esc($deposit->fees_amount) ?></td>
            </tr>
            <tr class="table-bg">
                <th><?php echo display("total") ?></th>
                <td class="text-right"><?php echo esc($deposit->amount+(float)@$deposit->fees_amount) ?></td>
            </tr>
        </table>
        <?php echo form_open('payment_callback/stripe_confirm', 'method="post" '); ?>
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $deposit_data['stripe']['publishable_key']; ?>" data-description="<?php echo $deposit_data['description'] ?>" data-amount="<?php $total = $deposit->amount+$deposit->fees_amount; echo round($total*100) ?>" data-locale="auto">
        </script>
        <?php echo form_close();?>

    <?php } elseif ($deposit->method_id=='phone')  { ?>
        <table class="table table-bordered">
            <tr>
                <th><?php echo display("user_id") ?></th>
                <td class="text-right"><?php echo esc($deposit->user_id) ?></td>
            </tr>
            <tr>
                <th><?php echo display("payment_gateway") ?></th>
                <td class="text-right"><?php echo esc($deposit->method_id) ?></td>
            </tr>
            <tr>
                <th><?php echo display("amount") ?></th>
                <td class="text-right"><?php echo esc(@$deposit->amount) ?></td>
            </tr>
            <tr>
                <th><?php echo display("fees") ?></th>
                <td class="text-right"><?php echo esc(@$deposit->fees_amount) ?></td>
            </tr>
            <tr>
                <th>Total</th>
                <td class="text-right"><?php echo esc(@$deposit->amount+@$deposit->fees_amount) ?></td>
            </tr>
        </table>
        <a class="btn btn-success w-md m-b-5 text-right" href="<?php echo $deposit_data['approval_url'] ?>"><?php echo display('payment_process');?></a>

    <?php } elseif ($deposit->method_id=='bank')  { ?>
        <table class="table table-bordered">
            <tr>
                <th><?php echo display("user_id") ?></th>
                <td class="text-right"><?php echo esc($deposit->user_id) ?></td>
            </tr>
            <tr>
                <th><?php echo display("payment_gateway") ?></th>
                <td class="text-right"><?php echo esc($deposit->method_id) ?></td>
            </tr>
            <tr>
                <th><?php echo display("amount") ?></th>
                <td class="text-right"><?php echo esc(@$deposit->amount) ?></td>
            </tr>
            <tr>
                <th><?php echo display("fees") ?></th>
                <td class="text-right"><?php echo esc(@$deposit->fees_amount) ?></td>
            </tr>
            <tr>
                <th>Total</th>
                <td class="text-right"><?php echo esc(@$deposit->amount+@$deposit->fees_amount) ?></td>
            </tr>
        </table>
        <a class="btn btn-success w-md m-b-5 text-right" href="<?php echo $deposit_data['approval_url'] ?>"><?php echo display('payment_process');?></a>

    <?php } ?>

</div>
</div>
</div>
</div>
</div>


