<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="d-flex flex-column p-3 mb-3 bg-success shadow-sm rounded">
            <div class="header-pretitle text-white fs-11 font-weight-bold text-uppercase mb-2"><?php echo display('total_users');?></div>
            <div class="d-flex align-items-center text-size-3">
                <i class="fas fa-users text-white mr-2 fs-30"></i>
                <div class="text-monospace text-white">
                    <span class="text-size-3 p-3"><?php echo esc(@$total_user); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="d-flex flex-column p-3 mb-3 bg-warning shadow-sm rounded">
            <div class="header-pretitle text-white fs-11 font-weight-bold text-uppercase mb-2"><?php echo display('exchange_market');?></div>
            <div class="d-flex align-items-center text-size-3">
                <i class="fab fa-medium text-white mr-2 fs-30"></i>
                <div class="text-monospace text-white">
                    <span class="text-size-3 p-3"><?php echo esc(@$total_market); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="d-flex flex-column p-3 mb-3 bg-violet shadow-sm rounded">
            <div class="header-pretitle text-white fs-11 font-weight-bold text-uppercase mb-2"><?php echo display('max_buy_currency_amount');?></div>
            <div class="d-flex align-items-center text-size-3">
                <i class="fas fa-briefcase text-white mr-2 fs-30"></i>
                <div class="text-monospace text-white">
                    <span class="text-size-3 p-3"><?php echo number_format(@$maxBuyCurrency->totalBuyAmount,4)." ".@$maxBuyCurrency->currency_symbol; ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="d-flex flex-column p-3 mb-3 bg-color3 shadow-sm rounded">
            <div class="header-pretitle text-white fs-11 font-weight-bold text-uppercase mb-2">
               <?php echo display('max_sell_currency_amount');?>
            </div>
            <div class="d-flex align-items-center text-size-3">
                <i class="fab fa-sellcast text-white mr-2 fs-30 text-white"></i>
                <div class="text-monospace text-white">
                    <span class="text-size-3 p-3" ><?php echo number_format(@$maxSellCurrency->totalSellAmount,4)." ".@$maxSellCurrency->currency_symbol; ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="d-flex flex-column p-3 mb-3 bg-sky shadow-sm rounded">
            <div class="header-pretitle text-white fs-11 font-weight-bold text-uppercase mb-2">
                <?php echo display('total_crypto_fees');?>
                <i class="fa fa-info-circle info-position pull-right" data-toggle="tooltip" data-original-title="Summation of all coins fees are converted to BTC.This value will be BTC current price"></i>
            </div>
            <div class="d-flex align-items-center text-size-3">
                <i class="fab fa-btc text-white mr-2 fs-30 text-white"></i>
                <div class="text-monospace text-white">
                    <span class="text-size-3 p-3" id="fees_value_BTC">0.00</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="d-flex flex-column p-3 mb-3 bg-color2 shadow-sm rounded">
            <div class="header-pretitle text-white fs-11 font-weight-bold text-uppercase mb-2">
                <?php echo display('total_usd_fees');?>
                <i class="fa fa-info-circle info-position" data-toggle="tooltip" data-original-title="Summation of all coins fees are converted to USD.This value will be USD current price"></i>
            </div>
            <div class="d-flex align-items-center text-size-3">
                <i class="fas fa-hand-holding-usd text-white mr-2 fs-30 text-white"></i>
                <div class="text-monospace text-white">
                    <span class="text-size-3 p-3" id="fees_value_USD">0.00</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="d-flex flex-column p-3 mb-3 bg-color1 shadow-sm rounded">
            <div class="header-pretitle text-white fs-11 font-weight-bold text-uppercase mb-2">
                <?php echo display('referral_bonus_usd');?>
                <i class="fa fa-info-circle info-position" data-toggle="tooltip" data-original-title="Summation of all coins fees are converted to USD.This value will be USD current price"></i>
            </div>
            <div class="d-flex align-items-center text-size-3">
                <i class="fas fa-dollar-sign text-white mr-2 fs-30 text-white"  data-toggle="tooltip" data-original-title="Total paid REFERRAL bonus in USD"></i>
                <div class="text-monospace text-white">
                    <span class="text-size-3 p-3" id="coin_value_USD">0.00</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="d-flex flex-column p-3 mb-3 bg-gray shadow-sm rounded">
            <div class="header-pretitle text-white fs-11 font-weight-bold text-uppercase mb-2">
                <?php echo display('total_trade');?>
                <i class="fa fa-info-circle info-position" data-toggle="tooltip" data-original-title="Total Trade quantity!"></i>
            </div>
            <div class="d-flex align-items-center text-size-3">
                <img class="text-white mr-2 fs-30 text-white" height="33" width="33" src="<?php echo base_url('assets/images/icons/icon.png'); ?>">
                <div class="text-monospace text-white mt-10">
                    <span class="text-size-3 p-3 pl-3"><?php echo esc(@$total_trade); ?></span>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-lg-8 d-flex">
      <div class="card mb-4 flex-fill w-100">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-sm-12 col-md-9">
                        <h6 class="header-pretitle text-muted fs-13 font-weight-bold text-uppercase mb-1"><?php echo display('deposit,_withdraw,_transfer');?></h6>
                    </div>
                    <div class="col-sm-8 col-md-3">
                        <?php echo form_open('#','id="dwtForm" name="dwtForm" '); ?>
                            <select class="form-control basic-single" name="symbol" id="dwtSymbol">
                                <option><?php echo display('select_option') ?></option>
                                <?php foreach ($coins as $key => $value) { ?>
                                    <option value="<?php echo esc($value->symbol); ?>"><?php echo esc($value->symbol); ?></option>
                                <?php } ?>
                            </select>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="lineChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4 d-flex">
        <div class="card mb-4 flex-fill w-100">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-sm-12 col-md-6">
                        <h6 class="header-pretitle text-muted fs-13 font-weight-bold text-uppercase mb-1"><?php echo display('fees_collection');?></h6>
                    </div>
                    <div class="col-sm-8 col-md-6">
                        <?php echo form_open('#','id="feessymbolform" name="feessymbolform" '); ?>
                            <select class="form-control basic-single" name="symbol" id="feessymbol">
                                <option><?php echo display('select_option') ?></option>
                                <?php foreach ($coins as $key => $value) { ?>
                                    <option value="<?php echo esc($value->symbol); ?>"><?php echo esc($value->symbol); ?></option>
                                <?php } ?>
                            </select>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
            <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="pieChart" height="210" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 d-flex">
        <div class="card mb-4 flex-fill w-100">
            <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-sm-12 col-md-8">
                            <h6 class="header-pretitle text-muted fs-13 font-weight-bold text-uppercase mb-1"><?php echo display('user_growth_rate');?></h6>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <?php echo form_open('#','id="userGrowthForm" name="userGrowthForm" '); ?>
                                <select class="form-control basic-single" name="user_growth" id="user_growth">                                        
                                    <?php 
                                        $years      =  date("Y", strtotime("-5 year"));
                                        $years_now  =  date("Y");
                                        for($i = $years_now; $i >= $years; $i--)
                                            echo "<option value='".esc($i)."'>".esc($i)."</option>";
                                    ?>                                                   
                                </select>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="forecast" height="144"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 d-flex">
        <div class="card mb-4 flex-fill w-100">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-sm-12 col-md-8">
                        <h6 class="header-pretitle text-muted fs-13 font-weight-bold text-uppercase mb-1"><?php echo display('buy_&_sell');?></h6>
                    </div>
                    <div class="col-sm-8 col-md-4">
                        <?php echo form_open('#','id="buysellform" name="buysellform" '); ?>
                            <select class="form-control basic-single" name="symbol" id="buySell">
                                <option><?php echo display('select_option') ?></option>
                                <?php foreach ($coins as $key => $value) { ?>
                                    <option value="<?php echo esc($value->symbol); ?>"><?php echo esc($value->symbol); ?></option>
                                <?php } ?>
                            </select>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="barChart" height="144"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card-header">
           <h6 class="header-pretitle text-muted fs-13 font-weight-bold text-uppercase mb-1"><?php echo display('trade_history');?></h6>
        </div>
        <div class="card card-body">
            <div class=table-responsive>
                <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                    <thead>
                        <tr class="table-bg">
                            <th><?php echo display('trade');?></th>
                            <th><?php echo display('rate');?></th>
                            <th><?php echo display('required');?> <?php echo display('quantity');?></th>
                            <th><?php echo display('available');?> <?php echo display('quantity');?></th>
                            <th><?php echo display('required');?> <?php echo display('amount');?></th>
                            <th><?php echo display('available');?> <?php echo display('amount');?></th>
                            <th><?php echo display('market');?></th>
                            <th><?php echo display('open');?></th>
                            <th><?php echo display('complete');?> <?php echo display('quantity');?></th>
                            <th><?php echo display('complete');?> <?php echo display('amount');?></th>
                            <th><?php echo display('trade');?> <?php echo display('time');?></th>
                            <th class="text-center"><?php echo display('status');?></th>
                        </tr>
                    </thead>

                    <tbody id="usertradeHistory">
                        <?php  foreach ($trade_history as $key => $value) { ?>
                            <tr>
                                <td><?php echo esc($value->bid_type) ?></td>
                                <td><?php echo esc($value->bid_price) ?></td>
                                <td><?php echo esc($value->bid_qty) ?></td>
                                <td><?php echo esc($value->bid_qty_available) ?></td>
                                <td><?php echo esc($value->total_amount) ?></td>
                                <td><?php echo esc($value->amount_available) ?></td>
                                <td><?php echo esc($value->market_symbol) ?></td>
                                <td><?php echo esc($value->open_order) ?></td>
                                <td><?php echo esc($value->complete_qty) ?></td>
                                <td><?php echo esc($value->complete_amount) ?></td>
                                <td><?php echo esc($value->success_time) ?></td>
                                <td class="text-center"><?php echo esc($value->status)==0?"<i title='Canceled' class='far fa-times-circle mr-2 fs-20 text-danger'></i>":($value->status==1?"<i title='success' class='fas fa-check mr-2 fs-20 text-success'></i>":"<i title='Running' class='fas fa-spinner fa-pulse mr-2 fs-20 text-warning'></i>") ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
               </table>
               <tfoot class="mt-4">
                   <a target="_blank" href="<?php echo base_url('admin/trade/trade-history'); ?>"><?php echo display('see_all_trade_history');?></a>
               </tfoot>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/dist/js/pages/demo.select2.js') ?>"></script>