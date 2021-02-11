<div class="col-lg-4 offset-lg-4  form-content login mt-4 mb-4">
    <div class="mb-4 form-design">
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
        <!-- /.alert message -->
        <h3 class="user-login-title mb-3"><?php echo display('withdraw');?></h3>
        <?php echo form_open('withdraw',array('name'=>'withdraw','id'=>'withdraw'));?>
        <div class="form-group">
           <label for="withdraw_type" class="">Withdraw(Crypto/Dollar)</label>
           <select class="form-control basic-single" name="withdraw_type" id="withdraw_type" required>
              <option><?php echo display('select_option');?></option>
              <option value="coin">Cryptocurrency</option>
              <option value="usdollar">US Dollar</option>
           </select>
        </div>
        <div class="form-group">
           <label for="crypto_coin" class="">Coin</label>
           <select class="form-control basic-single" name="crypto_coin" id="crypto_coin" onchange="Fee()" required>
              <option><?php echo display('select_option');?></option>
           </select>
        </div>
        <div class="form-group">
           <label for="amount" class=""><?php echo display('amount');?></label>
           <input class="form-control" name="amount" step="any" min="0" type="number" id="amount" onkeyup="Fee()" autocomplete="off" required>
           <span id="fee" class="form-text text-success"></span>
        </div>
        <div class="form-group">
           <label for="payment_method" class=""><?php echo display('payment_method');?></label>
           <select class="form-control basic-single" name="method" id="payment_method"  onchange="WalletId(this.value); Fee()" >
              <option><?php echo display('payment_method')?></option>
           </select>
           <div id="walletidis" class="form-text text-success"></div>
        </div>
        <div id="coinwallet" class="form-group"></div>
        <div class="form-group row">
           <label for="p_name" class="col-sm-4"><?php echo display('otp_send_to')?></label>
           <div class="col-sm-8">
              <div class="custom-control custom-radio custom-control-inline">
                 <input type="radio" id="inlineRadio1" value="1" name="varify_media" class="custom-control-input">
                 <label class="custom-control-label" for="inlineRadio1"><?php echo display('sms')?></label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                 <input type="radio" id="inlineRadio2" value="2" name="varify_media" class="custom-control-input">
                 <label class="custom-control-label" for="inlineRadio2"><?php echo display('email')?></label>
              </div>
           </div>
        </div>
        <input type="hidden" name="walletid" value="">
        <input type="hidden" name="level" value="withdraw">
        <input type="hidden" name="fees" value="">
        <div class=" m-b-15">
           <button type="submit" disabled class="btn btn-kingfisher-daisy"><?php echo display('withdraw');?></button>
           <a href="<?php echo base_url();?>" class="btn btn-danger"><?php echo display('cancel')?></a>
        </div>
        <?php echo form_close();?>
    </div>
</div>
     