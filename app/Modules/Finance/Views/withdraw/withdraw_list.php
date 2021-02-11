<div class="card">
  <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table display table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th><?php echo display('user_id') ?></th>
                        <th><?php echo display('payment_method') ?></th>
                        <th><?php echo display('wallet_id') ?></th>
                        <th><?php echo display('amount') ?></th>
                        <th><?php echo display('fees') ?></th>
                        <th class="text-center"><?php echo display('status') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($withdraw)) ?>
                    <?php $sl = 1; ?>
                    <?php foreach ($withdraw as $value) { ?>
                    <tr>
                        <td><?php echo esc($value->user_id); ?></td>
                        <td><?php echo esc($value->method); ?></td>
                        <td>
                        <?php
                            if (is_string($value->wallet_id) && is_array(json_decode($value->wallet_id, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false) {
                                $decode_bank = json_decode($value->wallet_id, true);
                                echo "<b>Account Name: </b>".esc($decode_bank['acc_name'])."<br>";
                                echo "<b>Account No: </b>".esc($decode_bank['acc_no'])."<br>";
                                echo "<b>Branch Name: </b>".esc($decode_bank['branch_name'])."<br>";
                                echo "<b>SWIFT Code: </b>".esc($decode_bank['swift_code'])."<br>";
                                echo "<b>ABN No: </b>".esc($decode_bank['abn_no'])."<br>";
                                echo "<b>Country: </b>".esc($decode_bank['country'])."<br>";
                                echo "<b>Bank Name: </b>".esc($decode_bank['bank_name']);
                            } else {
                               echo esc($value->wallet_id);
                            }
                        ?>
                        </td>
                        <td><?php echo esc($value->currency_symbol)." ".esc($value->amount); ?></td>
                        <td><?php echo esc($value->fees_amount); ?></td>
                        <td class="text-center">
                            <?php if($value->status==2){?>
                             <i title='<?php echo display('pending_withdraw')?>' class='fas fa-spinner fa-pulse mr-2 fs-20 text-warning'></i>
                             <?php } else if($value->status==1){?>
                             <i title='<?php echo display('success')?>' class='fas fa-check mr-2 fs-20 text-success'></i>
                             <?php } else if($value->status==0){ ?>
                             <i title='<?php echo display('cancel')?>' class='far fa-times-circle mr-2 fs-20 text-danger'></i>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?> 
                </tbody>
            </table>
            <?php echo $pager; ?>
        </div>
    </div>
</div>