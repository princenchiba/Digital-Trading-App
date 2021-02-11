<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="border_preview">
                    <?php echo form_open_multipart("backend/dashboard/setting/transaction_setup_save") ?>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="currency_symbol"><?php echo display('coin') ?><i class="text-danger">*</i></label>
                            <select class="form-control basic-single" name="currency_symbol">
                                <option><?php echo display('select_option') ?></option>
                                <?php foreach ($coins as $key => $value) { ?>
                                    <option value="<?php echo esc($value->symbol); ?>"><?php echo esc($value->coin_name); ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-lg-4">
                            <label>Transaction Type <i class="text-danger">*</i></label>
                            <select class="form-control" name="trntype" required >
                               <option value="">--<?php echo display("select_option") ?>--</option>
                               <option value="WITHDRAW">Withdraw</option>
                               <option value="TRANSFER">Transfer</option>
                           </select>
                       </div>                      
                   </div>
                   <div class="row">                    
                    <div class="form-group col-lg-4">
                        <label>Account Type <i class="text-danger">*</i></label>
                        <select class="form-control" name="acctype" required >
                           <option value="">--<?php echo display("select_option") ?>--</option>
                           <option value="VERIFIED">Verified</option>
                           <option value="UNVERIFIED">Unverified</option>
                       </select>
                   </div>

                   <div class="form-group col-lg-4">
                    <label>Limit Amount <i class="text-danger">*</i></label>
                    <input type="text" class="form-control" name="upper" required >
                </div>                        
            </div>

            <div>
                <button type="submit" class="btn btn-success"><?php echo display("save") ?></button>
            </div>
            <?php echo form_close() ?>
        </div>

    </div>
</div>
</div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " >
        <div class="panel panel-bd">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title">
                    <h4><?php echo display('setting');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable3 table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>Transaction Type</th>
                            <th>Account Type</th>
                            <th>Coin</th>
                            <th class="text-right">Weekly Limit</th>
                            <th class="text-right">Monthly Limit</th>
                            <th class="text-right">Yearly Limit</th>
                            <th><?php echo display('action');?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(isset($transaction_setup)){ 
                            foreach ($transaction_setup as $key => $value) {  
                                ?>
                                <tr>
                                    <td><?php echo esc($value->trntype);?></td>
                                    <td><?php echo esc($value->acctype);?></td>
                                    <td><?php echo esc($value->currency_symbol);?></td>
                                    <td class="text-right"><?php echo esc($value->upper*1);?></td>
                                    <td class="text-right"><?php echo esc($value->upper*4.33);?></td>
                                    <td class="text-right"><?php echo esc($value->upper*52);?></td>
                                    <td>
                                        <a href="<?php echo base_url('backend/dashboard/setting/delete_transaction_setup/'.$value->id) ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

