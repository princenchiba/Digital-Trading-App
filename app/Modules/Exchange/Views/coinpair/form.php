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
                  <?php echo form_open_multipart("admin/exchanger/add-coin-pair/$coinpair->id") ?>
                  <?php echo form_hidden('id', $coinpair->id) ?> 
                  <input name="symbol" value="<?php echo $coinpair->symbol  ?>" class="form-control" type="hidden" id="symbol">
                  <div class="form-group row">
                     <label for="name" class="col-sm-2 col-form-label font-weight-600"><?php echo display('name') ?><i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input name="name" value="<?php echo esc($coinpair->name) ?>" class="form-control" placeholder="<?php echo display('name') ?>" type="text" id="name">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="full_name" class="col-sm-2 col-form-label font-weight-600"><?php echo display('full-name');?></label>
                     <div class="col-sm-8">
                        <input name="full_name" value="<?php echo esc($coinpair->full_name) ?>" class="form-control" placeholder="Full Name" type="text" id="full_name">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="market_id" class="col-sm-2 col-form-label font-weight-600"><?php echo display('market');?><i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <select class="form-control basic-single" name="market_id" id="market_id">
                           <option value=""><?php echo display('select_option') ?></option>
                           <?php foreach ($market as $key => $value) { ?>
                           <option value="<?php echo $value->symbol; ?>" <?php echo ($coinpair->market_symbol==$value->symbol)?'Selected':'' ?>><?php echo esc($value->full_name); ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="coin_id" class="col-sm-2 col-form-label font-weight-600">Coin<i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <select class="form-control basic-single" name="coin_id" id="coin_id">
                           <option value=""><?php echo display('select_option') ?></option>
                           <?php foreach ($coins as $key => $value) { ?>
                           <option value="<?php echo esc($value->symbol); ?>" <?php echo ($coinpair->currency_symbol==$value->symbol)?'Selected':'' ?>><?php echo esc($value->coin_name); ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="initial_price" class="col-sm-2 col-form-label font-weight-600"><?php echo display('initial-price');?></label>
                     <div class="col-sm-8">
                        <input name="initial_price" value="<?php echo $coinpair->initial_price ?>" class="form-control" placeholder="0.015" type="text" id="initial_price">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="status" class="col-sm-2 col-form-label font-weight-600"><?php echo display('status') ?></label>
                     <div class="col-sm-8 mb-4 pt10">
                        <label class="radio-inline">
                        <?php echo form_radio('status', '1', (($coinpair->status==1 || $coinpair->status==null)?true:false)); ?><?php echo display('active');?>
                        </label>
                        <label class="radio-inline">
                        <?php echo form_radio('status', '0', (($coinpair->status=="0")?true:false) ); ?><?php echo display('inactive');?>
                        </label> 
                     </div>
                  </div>
                  <div class="row">
                     <label for="status" class="col-sm-2 col-form-label font-weight-600"></label>
                     <div class="col-sm-8">
                        <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                        <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $coinpair->id?display("update"):display("create") ?></button>
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