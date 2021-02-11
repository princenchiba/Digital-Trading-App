<?php
    $data = json_decode($v->data);
    $request = \Config\Services::request();
?>
<div class="invoice">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div id="printableArea">
                   <div class="row mb-5">
                        <div class="col-sm-6 transfer-details">
                            <img src="<?php echo base_url(!empty($settings->logo)?$settings->logo:"assets/images/icons/logo.png"); ?>" class="img-responsive" alt="">
                            <br>
                            <address>
                                <strong><?php echo esc($settings->title) ?></strong><br>
                                <?php echo htmlspecialchars_decode($settings->description);?><br>
                            </address>
                        </div>
                        <div class="col-sm-6 text-right transfer-details">
                            <h4 class="mb-3">Transfer No : <?php echo $request->uri->setSilent()->getSegment(2)?></h4>
                            <div><?php echo date('d-M-Y');?></div>
                            <address>
                                <strong><?php echo $my_info->first_name.' '.$my_info->last_name;?></strong><br>
                                <?php echo esc($my_info->email);?><br>
                                <?php echo esc($my_info->phone);?><br>
                                <abbr title="Phone"><?php echo display('account') ?> :</abbr> <?php echo esc($my_info->user_id);?>
                            </address>
                        </div>
                    </div> 
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="table-bg">
                                    <th><?php echo display('receiver_name')?></th>
                                    <td><?php echo esc($u->first_name).' '. esc($u->last_name);?></td>
                                </tr>
                                <tr class="table-bg">
                                    <th><?php echo display('email');?></th>
                                    <td><?php echo esc($u->email);?></td>
                                </tr>
                                <tr class="table-bg">
                                    <th><?php echo display('user_id');?></th>
                                    <td><?php echo esc($u->user_id);?></td>
                                </tr>
                                <tr class="table-bg">
                                    <th><?php echo display('fees');?></th>
                                    <td><?php echo esc($data->fees); ?></td>
                                </tr>
                                <tr class="table-bg">
                                    <th><?php echo display('transfer_amount');?></th>
                                    <td><?php echo esc($data->currency_symbol).' '.esc($data->amount);?></td>
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
