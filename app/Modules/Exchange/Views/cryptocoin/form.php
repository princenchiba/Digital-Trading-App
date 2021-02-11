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
                    <?php echo form_open_multipart("admin/exchanger/cryptocoin-edit/$cryptocoin->id") ?>
                    <?php echo form_hidden('id', $cryptocoin->id) ?> 
                        <div class="form-group row">
                            <label for="cid" class="col-sm-4 col-form-label font-weight-600"><?php echo display('coin_id');?><i class="text-danger">*</i></label>
                            <?php if(!empty($cryptocoin->id)){?>
                                <div class="col-sm-8">
                                    <input name="cid" value="<?php echo esc($cryptocoin->cid) ?>" class="form-control" placeholder="Coin Id" type="number" id="cid" readonly>
                                </div>
                            <?php } else { ?>
                                <div class="col-sm-8">
                                    <input name="cid" value="<?php echo esc($last_row->cid +1) ?>" class="form-control" placeholder="Coin Id" type="number" id="cid" readonly>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group row">
                            <label for="symbol" class="col-sm-4 col-form-label font-weight-600"><?php echo display('symbol');?><i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input name="symbol" value="<?php echo esc($cryptocoin->symbol) ?>" class="form-control" placeholder="example: USD" type="text" id="symbol">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="coin_name" class="col-sm-4 col-form-label font-weight-600"><?php echo display('coin_name');?><i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input name="coin_name" value="<?php echo esc($cryptocoin->coin_name) ?>" class="form-control" placeholder="example: Dollar" type="text" id="coin_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="full_name" class="col-sm-4 col-form-label font-weight-600"><?php echo display('coin_full_name');?></label>
                            <div class="col-sm-8">
                                <input name="full_name" value="<?php echo esc($cryptocoin->full_name) ?>" class="form-control" placeholder="example: US Dollar" type="text" id="full_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rank" class="col-sm-4 col-form-label font-weight-600"><?php echo display('rank');?></label>
                            <div class="col-sm-8">
                                <input name="rank" value="<?php echo esc($cryptocoin->rank) ?>" class="form-control" placeholder="example: 1" type="number" id="rank">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="show_home" class="col-sm-4 col-form-label font-weight-600"><?php echo display('show_home');?></label>
                            <div class="col-sm-8 pt10">
                                <label class="radio-inline">
                                    <?php echo form_radio('show_home', '1', ((esc($cryptocoin->show_home)==1 || esc($cryptocoin->show_home)==null)?true:false)); ?><?php echo display('yes');?>
                                 </label>
                                <label class="radio-inline">
                                    <?php echo form_radio('show_home', '0', ((esc($cryptocoin->show_home)=="0")?true:false) ); ?><?php echo display('no');?>
                                 </label> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="coin_position" class="col-sm-4 col-form-label font-weight-600"><?php echo display('serial');?></label>
                            <div class="col-sm-8">
                                <input name="coin_position" value="<?php echo esc($cryptocoin->coin_position) ?>" class="form-control" type="text" id="algorithm" placeholder='example: 1'>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label font-weight-600"><?php echo display('coin_image/icon/logo');?></label>
                            <div class="col-sm-8">
                                <input name="image" value="<?php echo $cryptocoin->image ?>" class="form-control"  type="file" id="image">
                                <span class="text-danger">24x24 or 50x50 px(jpg, jpeg, png, gif, ico)</span><br>
                                <input type="hidden" name="image_old" value="<?php echo $cryptocoin->image ?>">
                                <?php if (!empty($cryptocoin->image)) { ?>
                                    <img src="<?php echo site_url("$cryptocoin->image") ?>" width="150">
                                 <?php } ?>                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-sm-4 col-form-label font-weight-600"><?php echo display('status') ?></label>
                            <div class="col-sm-8 pt10">
                                <label class="radio-inline">
                                    <?php echo form_radio('status', '1', ((esc($cryptocoin->status)==1 || esc($cryptocoin->status)==null)?true:false)); ?><?php echo display('active');?>
                                 </label>
                                <label class="radio-inline">
                                    <?php echo form_radio('status', '0', ((esc($cryptocoin->status)=="0")?true:false) ); ?><?php echo display('inactive');?>
                                 </label> 
                            </div>
                        </div>
                        <div class="row">
                             <label for="status" class="col-sm-4 col-form-label font-weight-600"></label>
                            <div class="col-sm-8">
                                <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                                <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo esc($cryptocoin->id)?display("update"):display("create") ?></button>
                            </div>
                        </div>
                    <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 