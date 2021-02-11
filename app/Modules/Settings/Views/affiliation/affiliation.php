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
                <?php echo form_open_multipart("admin/setting/affiliation") ?>
                <?php echo form_hidden('id', @$affiliation->id) ?> 

                    <div class="form-group row">
                        <label for="commission" class="col-sm-4 col-form-label font-weight-600"><?php echo display('commission');?><i class="text-danger">*</i></label>
                        <div class="col-sm-3">
                            <input name="commission" value="<?php echo @$affiliation->commission ?>" class="form-control" placeholder="0.00" type="text" id="commission">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-sm-4 col-form-label font-weight-600"><?php echo display('type');?></label>
                        <div class="col-sm-8 pt10">
                            <label class="radio-inline">
                                <?php echo form_radio('type', 'PERCENT', ((@$affiliation->type=='PERCENT' || @$affiliation->type==null)?true:false)); ?><?php echo display('percent');?>
                             </label>
                            <label class="radio-inline">
                                <?php echo form_radio('type', 'FIXED', ((@$affiliation->type=='FIXED')?true:false) ); ?><?php echo display('fixed');?>
                             </label> 
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label font-weight-600"><?php echo display('status') ?></label>
                        <div class="col-sm-8 pt10">
                            <label class="radio-inline">
                                <?php echo form_radio('status', '1', ((@$affiliation->status==1 || @$affiliation->status==null)?true:false)); ?><?php echo display('active');?>
                             </label>
                            <label class="radio-inline">
                                <?php echo form_radio('status', '0', ((@$affiliation->status=="0")?true:false) ); ?><?php echo display('inactive');?>
                             </label> 
                        </div>
                    </div>
                    <div class="row">
                        <label for="status" class="col-sm-4 col-form-label font-weight-600"></label>
                        <div class="col-sm-8">
                            <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo @$affiliation->id?display("update"):display("create") ?></button>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

 