<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0"></h6>
                    </div>
                    <div class="text-right">
                        <div class="actions">
                            <a href="#" class="action-item"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="border_preview">
                <?php echo form_open_multipart("admin/setting/fees-setting-save") ?>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label class="font-weight-600" for="coin_id"><?php echo display("coin") ?> <i class="text-danger">*</i></label>
                            <select class="form-control basic-single" name="coin_id">
                                <option value="">Select <?php echo display('coin') ?></option>
                                <?php foreach ($coins as $key => $value) { ?>
                                <option value="<?php echo esc($value->symbol); ?>"><?php echo esc($value->coin_name); ?></option>
                                <?php } ?>
                            </select>
                        </div>                       
                        <div class="form-group col-lg-4">
                            <label class="font-weight-600"><?php echo display("select_level") ?> <i class="text-danger">*</i></label>
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
                            <label class="font-weight-600"><?php echo display("fees") ?>% <i class="text-danger">*</i></label>
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
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Level');?></th>
                            <th><?php echo display('fees');?></th>
                            <th><?php echo display('coin');?></th>
                           <th class="text-center" width="100"><?php echo display('action');?></th>
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
                                <a href="<?php echo base_url('admin/setting/delete-fees-setting/'.$value->id) ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" title="Delete "><i class="hvr-buzz-out fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
                <?php echo $pager; ?>
            </div>
        </div>
    </div>
</div>

<!-- Third Party Scripts(used by this page)-->
<script src="<?php echo base_url('/assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/dist/js/pages/demo.select2.js') ?>"></script>