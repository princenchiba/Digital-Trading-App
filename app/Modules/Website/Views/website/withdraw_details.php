<?php $request = \Config\Services::request(); ?>
<div class="invoice">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div  id="printableArea">
                    <div class="row mb-5">
                        <div class="col-sm-6">
                            <img src="<?php echo base_url(!empty($settings->logo)?$settings->logo:"assets/images/icons/logo.png"); ?>" class="img-responsive" alt="">
                            <br>
                            <address>
                                <strong><?php echo esc($settings->title) ?></strong><br>
                                <?php echo htmlspecialchars_decode($settings->description);?><br>
                                
                            </address>
                        </div>
                        <div class="col-sm-6 text-right">
                            <h4 class="mb-3"><?php echo display('withdraw_no') ?> : <?php echo esc($request->uri->setSilent()->getSegment(2))?></h4>
                            <div><?php echo esc($withdraw->request_date);?></div>
                            <address>
                                <strong><?php echo esc($my_info->first_name).' '.esc($my_info->last_name);?></strong><br>
                                <?php echo esc($my_info->email);?><br>
                                <?php echo esc($my_info->phone);?><br>
                            </address>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><?php echo display('payment_method')?></th>
                                    <th><?php echo display('wallet_id')?></th>
                                    <th><?php echo display('amount')?></th>
                                    <th><?php echo display('fees')?></th>
                                    <th><?php echo display('status')?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><div><strong><?php echo esc($withdraw->method);?></strong></div>
                                    <td><?php 
                                        if (is_string($withdraw->wallet_id) && is_array(json_decode($withdraw->wallet_id, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false) {

                                            $decode_bank = json_decode($withdraw->wallet_id, true);

                                            echo "<b>".display('account_name').": </b>".esc($decode_bank['acc_name'])."<br>";
                                            echo "<b>".display('account_no').": </b>".esc($decode_bank['acc_no'])."<br>";
                                            echo "<b>".display('branch_name').": </b>".esc($decode_bank['branch_name'])."<br>";
                                            echo "<b>".display('swift_code').": </b>".esc($decode_bank['swift_code'])."<br>";
                                            echo "<b>".display('abn_no').": </b>".esc($decode_bank['abn_no'])."<br>";
                                            echo "<b>".display('country').": </b>".esc($decode_bank['country'])."<br>";
                                            echo "<b>".display('bank_name').": </b>".esc($decode_bank['bank_name']);

                                        } else {

                                            echo $withdraw->wallet_id;
                                        }

                                     ?>
                                         
                                    </td>
                                    <td><?php echo esc($withdraw->currency_symbol).' '.esc($withdraw->amount);?></td>
                                    <td><?php echo esc($withdraw->fees_amount); ?></td>
                                    <td>
                                        <?php 
                                            if(esc($withdraw->status) == 1){
                                                echo ('<b class="text-success">Success</b>');
                                            }else if(esc($withdraw->status) == 2){                                                
                                                echo ('<b class="text-warning">Pending</b>');
                                            }else{
                                                echo ('<b class="text-danger">Cancel</b>');
                                            }

                                        ?>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-right">
                   <button type="button" class="btn btn-info" onclick="printContent('printableArea')"><span class="fa fa-print"></span></button>
                </div>
            </div>
        </div>
    </div>
</div>
