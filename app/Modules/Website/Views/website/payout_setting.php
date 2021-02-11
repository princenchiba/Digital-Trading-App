<div class="payout-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
                <div class="row form-design">
                    <div class="col-lg-6 ">
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Bitcoin Wallet <span class="text-danger"><span class="text-danger">*</span></span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo @$bitcoin_btc->currency_symbol=='BTC'?@$bitcoin_btc->wallet_id:''; ?>" type="text" required>
                                <input class="form-control" name="currency_symbol" value="BTC" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Bitcoincash Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo @$bitcoin_bch->currency_symbol=='BCH'?@$bitcoin_bch->wallet_id:''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="BCH" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Litecoin Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo @$bitcoin_ltc->currency_symbol=='LTC'?@$bitcoin_ltc->wallet_id:''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="LTC" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Dash Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo @$bitcoin_dash->currency_symbol=='DASH'?@$bitcoin_dash->wallet_id:''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="DASH" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Dogecoin Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo @$bitcoin_doge->currency_symbol=='DOGE'?@$bitcoin_doge->wallet_id:''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="DOGE" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Speedcoin Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo @$bitcoin_spd->currency_symbol=='SPD'?@$bitcoin_spd->wallet_id:''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="SPD" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Reddcoin Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo @$bitcoin_rdd->currency_symbol=='RDD'?@$bitcoin_rdd->wallet_id:''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="RDD" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Potcoin Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo @$bitcoin_pot->currency_symbol=='POT'?@$bitcoin_pot->wallet_id:''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="POT" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Feathercoin Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo @$bitcoin_ftc->currency_symbol=='FTC'?@$bitcoin_ftc->wallet_id:''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="FTC" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Vertcoin Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo @$bitcoin_vtc->currency_symbol=='VTC'?@$bitcoin_vtc->wallet_id:''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="VTC" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Peercoin Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo esc(@$bitcoin_ppc->currency_symbol) == 'PPC'?esc(@$bitcoin_ppc->wallet_id):''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="PPC" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Monetaryunit Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo esc(@$bitcoin_mue->currency_symbol) == 'MUE'?@esc($bitcoin_mue->wallet_id):''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="MUE" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/bitcoin');?>
                            <label >Universalcurrency Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo esc(@$bitcoin_unit->currency_symbol) == 'UNIT'?esc(@$bitcoin_unit->wallet_id):''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="UNIT" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/payeer');?>
                            <label>Payeer Wallet <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo esc(@$payeer_btc->currency_symbol) == 'BTC'?esc(@$payeer_btc->wallet_id):''; ?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="BTC" type="hidden">
                                <input class="form-control" name="currency_symbol1" value="USD" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div> 
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/paypal');?>
                            <label >Paypal <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo esc(@$paypal->wallet_id);?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="USD" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div> 
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/stripe');?>
                            <label >Stripe <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo esc(@$stripe->wallet_id);?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="USD" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div> 
                        <div class="mb-3">  
                            <?php echo form_open('payout-setting/phone');?>
                            <label ><?php echo display('mobile');?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" name="wallet_id" value="<?php echo @$phone->wallet_id;?>" required type="text">
                                <input class="form-control" name="currency_symbol" value="USD" type="hidden">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-kingfisher-daisy"><?php echo display("update") ?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>  
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</div>