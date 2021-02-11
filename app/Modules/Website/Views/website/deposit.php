<div class="cryp_wrapper">
  <div class="col-lg-4 offset-lg-4 form-content login mt-4 mb-4">
   <!-- alert message -->
   <?php if ($session->get('message') != null) {  ?>
   <div class="alert alert-info alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?php echo $session->get('message'); ?>
   </div>
   <?php } ?>
   <?php if ($session->get('exception') != null) {  ?>
   <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?php echo $session->get('exception'); ?>
   </div>
   <?php } ?>
   <!-- /.end of alert message -->
   <div class="deposit-info mb-0 form-design">
      <h3 class="user-login-title mb-3"><?php echo display('deposit');?></h3>
      <?php echo form_open_multipart('deposit', array('name'=>'deposit_form', 'id'=>'deposit_form', 'class'=>'mb-4'));?>
      <div class="form-group">
         <label for="deposit_type" class=""><?php echo display('deposit_crypto_dollar') ?></label>
         <select class="form-control basic-single" name="deposit_type" required id="deposit_type">
            <option><?php echo display('select_option');?></option>
            <option value="coin"><?php echo display('cryptocurrency') ?></option>
            <option value="usdollar"><?php echo display('us_dollar') ?></option>
         </select>
      </div>
      <div class="form-group">
         <label for="crypto_coin" class="">Coin</label>
         <select class="form-control basic-single" name="crypto_coin" id="crypto_coin" onchange="Fee()" required>
            <option><?php echo display('select_option');?></option>
         </select>
      </div>
      <div class="form-group">
         <label for="deposit_amount" class=""><?php echo display('deposit_amount');?></label>
         <input class="form-control" name="amount" step="any" min="0" type="number" id="deposit_amount" onkeyup="Fee()"autocomplete="off" required>
      </div>
      <div class="form-group">
         <label for="payment_method" class=""><?php echo display('deposit_method');?></label>
         <select class="form-control basic-single" name="method" required onchange="Fee()" id="payment_method" disabled>
            <option value=""><?php echo display('deposit_method');?></option>
         </select>
         <span id="fee" class="form-text text-success"></span>
      </div>
      <span class="payment_info">
         <div class="form-group">
            <label for="comment" class=""><?php echo display('comments');?></label>
            <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
         </div>
      </span>
      <button type="submit" class="btn btn-kingfisher-daisy w-md m-b-5 mt-3"><?php echo display('deposit');?></button>
      <a href="<?php echo base_url();?>" class="btn btn-danger w-md m-b-5 mt-3"><?php echo display('cancel')?></a>
   </div>
   <input type="hidden" name="level" value="deposit">
   <input type="hidden" name="fees" value="">
   <?php echo form_close();?>  
  </div>
</div>
  