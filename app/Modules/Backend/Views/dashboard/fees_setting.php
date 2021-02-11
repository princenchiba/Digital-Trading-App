<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty(esc($title))?esc($title):null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="border_preview">

                <?php echo form_open_multipart("backend/dashboard/setting/fees_setting_save") ?>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="coin_id"><?php echo display("coin") ?> <i class="text-danger">*</i></label>
                            <select class="form-control basic-single" name="coin_id">
                                <option><?php echo display('select_option') ?></option>
                                <?php foreach ($coins as $key => $value) { ?>
                                <option value="<?php echo esc($value->symbol); ?>"><?php echo esc($value->coin_name); ?></option>
                                <?php } ?>
                            </select>
                        </div>                       
                        <div class="form-group col-lg-4">
                            <label><?php echo display("select_level") ?> <i class="text-danger">*</i></label>
                           <select class="form-control" name="level" required >
                               <option value="">--<?php echo display("select_level") ?>--</option>
                               <option value="BUY"><?php echo display("buy") ?></option>
                               <option value="SELL"><?php echo display("sell") ?></option>
                               <option value="DEPOSIT"><?php echo display("deposit") ?></option>
                               <option value="TRANSFER"><?php echo display("transfer") ?></option>
                               <option value="WITHDRAW"><?php echo display("withdraw") ?></option>
                           </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label><?php echo display("fees") ?>% <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="fees" required >
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
                            <th><?php echo display('Level');?></th>
                            <th><?php echo display('fees');?></th>
                            <th><?php echo display('coin');?></th>
                           <th class="text-center"><?php echo display('action');?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(isset($fees_data)){ 
                            foreach ($fees_data as $key => $value) {  
                        ?>
                        <tr>
                            <td><?php echo $value->level;?></td>
                            <td class="text-left"><?php echo esc($value->fees);?>%</td>
                            <td class="text-left"><?php echo esc($value->currency_symbol);?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url('backend/dashboard/setting/delete_fees_setting/'.$value->id) ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

 