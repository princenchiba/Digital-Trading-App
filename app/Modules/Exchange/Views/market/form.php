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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="border_preview">
                <?php echo form_open_multipart("admin/exchanger/add-market/$market->id") ?>
                <?php echo form_hidden('id', $market->id) ?> 

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label font-weight-600"><?php echo display('name') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                            <input name="name" value="<?php echo esc($market->name) ?>" class="form-control" placeholder="<?php echo display('name') ?>" type="text" id="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="full_name" class="col-sm-2 col-form-label font-weight-600"><?php echo display('full-name');?></label>
                        <div class="col-sm-8">
                            <input name="full_name" value="<?php echo esc($market->full_name) ?>" class="form-control" placeholder="<?php echo display('full_name') ?>" type="text" id="full_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="symbol" class="col-sm-2 col-form-label font-weight-600"><?php echo display('symbol') ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                            <select class="form-control basic-single" name="symbol">
                                <option value=""><?php echo display('select_option') ?></option>
                                <?php foreach ($coins as $key => $value) { ?>
                                    <option value="<?php echo $value->symbol; ?>" <?php echo ($market->symbol==$value->symbol)?'Selected':'' ?>><?php echo esc($value->symbol); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label font-weight-600"><?php echo display('status') ?></label>
                        <div class="col-sm-8 pt10">
                            <label class="radio-inline">
                                <?php echo form_radio('status', '1', (($market->status==1 || $market->status==null)?true:false)); ?><?php echo display('active');?>
                             </label>
                            <label class="radio-inline">
                                <?php echo form_radio('status', '0', (($market->status=="0")?true:false) ); ?><?php echo display('inactive'); ?>
                             </label> 
                        </div>
                    </div>
                    <div class="row">
                        <label for="status" class="col-sm-2 col-form-label font-weight-600"></label>
                        <div class="col-sm-8">
                            <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $market->id?display("update"):display("create") ?></button>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/dist/js/pages/demo.select2.js') ?>"></script>
 