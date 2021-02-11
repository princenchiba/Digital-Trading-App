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
                <?php echo form_open('admin/finance/add-credit','class="form-inner"') ?>
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-3 col-form-label font-weight-600"><?php echo display('user_id') ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-7">
                            <input name="user_id"  type="text" class="form-control" id="user_id" placeholder="<?php echo display('user_id') ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crypto_coin" class="col-sm-3 col-form-label font-weight-600">Coin <i class="text-danger">*</i></label>
                        <div class="col-sm-7">
                            <select class="form-control basic-single" name="crypto_coin" id="crypto_coin">
                                <option value=""><?php echo display('select_option');?></option>
                                <?php foreach ($coin_list as $key => $value) {  ?>
                                <option value="<?php echo esc($value->symbol); ?>"><?php echo esc($value->full_name); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label font-weight-600"><?php echo display('amount') ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-7">
                            <input name="amount" type="text" class="form-control" id="amount" placeholder="<?php echo display('amount') ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="notes" class="col-sm-3 col-form-label font-weight-600"><?php echo display('notes') ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-7">
                            <textarea name="note" class="form-control" placeholder="<?php echo display('notes') ?>"  rows="4"></textarea>
                        </div>
                    </div>  
                    
                    <div class="form-group  row">
                        <label for="notes" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-7">
                            <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('send') ?></button>
                        </div>
                    </div>

                <?php echo form_close() ?>
            </div> 
        </div>
    </div>
</div>

<!-- Third Party Scripts(used by this page)-->
<script src="<?php echo base_url('/assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/dist/js/pages/demo.select2.js') ?>"></script>
<!-- Third Party Scripts(used by this page)-->







 