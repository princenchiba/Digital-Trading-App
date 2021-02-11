<div class="exchange-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="coin-name">
          <h2> <?php echo esc(@$market_details->full_name) ?></h2>
          <h5><?php echo esc($coin_symbol[0])." / ".esc($coin_symbol[1]) ?></h5>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card orders">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div><?php echo display('sell_orders') ?></div>
            <div class="buy-sell-orders"><?php echo esc($coin_symbol[0]) ?> <?php echo display('available') ?>: <span class="available_sell_coin"></span></div>
          </div>
          <div class="card-body">
            <div class="table-responsive sellRequest tableFixHead">
              <table class="table table-striped" >
                <thead>
                  <tr class="table-bg">
                    <th><?php echo display('price') ?> <?php echo esc($coin_symbol[0]) ?></th>
                    <th class="text-right"><?php echo esc($coin_symbol[0]) ?> <?php echo display('amount') ?></th>
                    <th class="text-right"><?php echo display('total') ?>: (<?php echo esc($coin_symbol[1]) ?>)</th>
                  </tr>
                </thead>
                <tbody id="selltrades">

                </tbody>

              </table>
            </div>
            <!-- /.End of Buy Orders table -->
          </div>
        </div>
        <!-- /.End of sell order -->                            
        <h5 class="text-center"><span class="price_updown">0.00</span></h5>
        <div class="card orders">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div><?php echo display('buy_orders') ?></div>
            <div class="buy-sell-orders"><?php echo esc($coin_symbol[0]) ?> <?php echo display('available') ?>: <span class="available_buy_coin"></span> </div>
          </div>
          <div class="card-body">
            <div class="table-responsive buyOrder tableFixHead">
              <table class="table table-striped">
                <thead>
                  <tr class="table-bg">
                    <th><?php echo display('price') ?> <?php echo esc($coin_symbol[0]) ?></th>
                    <th class="text-right"><?php echo esc($coin_symbol[0]) ?> <?php echo display('amount') ?></th>
                    <th class="text-right"><?php echo display('total') ?>: (<?php echo esc($coin_symbol[1]) ?>)</th>
                  </tr>
                </thead>
                <tbody id="buytrades">

                </tbody>
              </table>
            </div>
            <!-- /.End of Buy Orders table -->
          </div>
        </div>
        <!-- /.End of buy order -->
      </div>
      <div class="col-lg-6">
        <div class="chart-panel">
          <div class="row price-info">
            <div class="col-6 col-md-3">
              <div class="price-info-table">
                <span class="dollar"><?php echo esc($coin_symbol[0]) ?></span>
                <span class="last-price coin-last-price">0.00</span>
                <span class="last-price-title"><?php echo display('last_price') ?></span>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="price-info-table">
                <span class="dollar"><?php echo esc($coin_symbol[0]) ?></span>
                <span class="last-price coin-change-price positive">0.00%</span>
                <span class="last-price-title"><?php echo display('24hr_change') ?></span>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="price-info-table">
                <span class="dollar"><?php echo esc($coin_symbol[0]) ?></span>
                <span class="last-price coin-price-high">0.00</span>
                <span class="last-price-title"><?php echo display('24hr_high') ?></span>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="price-info-table">
                <span class="dollar"><?php echo esc($coin_symbol[0]) ?></span>
                <span class="last-price coin-price-low">0.00</span>
                <span class="last-price-title"><?php echo display('24hr_low') ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="total-volume">
              <?php echo display('24hr_volume') ?>: <span class='total_volume'></span> <?php echo esc($coin_symbol[0]) ?> / <span class='price_updown'></span> <?php echo esc($coin_symbol[1]) ?>
            </div>
          </div>
          <div id="exchangesChart"></div>
        </div>


        <!-- /.End of exchange chart -->

        <script src="<?php echo base_url('assets/website/js/vendors.bundle.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/website/js/amcharts/amcharts.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/website/js/amcharts/serial.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/website/js/amcharts/amstock.js'); ?>" type="text/javascript"></script>

        <!-- Amchats js -->
        <script src="<?php echo base_url('assets/website/js/amcharts/plugins/dataloader/dataloader.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/website/js/amcharts/plugins/export/export.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/website/js/amcharts/patterns.js') ?>"></script>
        <script src="<?php echo base_url('assets/website/js/amcharts/dark.js') ?>"></script>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between">
                <div class=""><?php echo display('buy') ?> <?php echo esc($coin_symbol[0]) ?></div>
                <div class="balance"><?php echo esc($coin_symbol[1]) ?> <?php echo display('balance') ?>: <span id="balance_buy"><?php echo esc(@$balance_to->balance)?@(float)esc($balance_to->balance):'0.00' ?></span></div>
              </div>
              <?php echo form_open('home/buy','id="buyform" class="buy-form" name="buyform"'); ?>
              <?php echo form_hidden('market', esc(@$market_details->symbol)); ?> 
              <div class="card-body">
                <div class="">
                  <div class="row">
                    <div class="col">
                      <label for="buypricing"><?php echo display('price') ?></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="<?php echo $coin_symbol[1] ?>"><?php echo esc($coin_symbol[1]) ?></span>
                        </div>
                        <input type="text" class="form-control" id="buypricing" name="buypricing" aria-describedby="<?php echo $coin_symbol[1] ?>" required>
                        <div class="invalid-feedback">

                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <label for="buyamount"><?php echo display('amount') ?></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="<?php echo $coin_symbol[0] ?>"><?php echo esc($coin_symbol[0]) ?></span>
                        </div>
                        <input type="text" class="form-control" id="buyamount" aria-describedby="<?php echo esc($coin_symbol[0]) ?>" name="buyamount" value="1" required>
                        <div class="invalid-feedback">

                        </div>
                      </div>
                    </div>
                  </div>                                                
                  <div class="price-details d-flex align-items-center justify-content-between">
                    <div class=""><?php echo display('estimated_open_price') ?>:</div>
                    <div class="" id="buywithout_fees">0.00</div>
                    <input type="hidden" name="buywithout_feesval" id="buywithout_feesval" />
                  </div>
                  <div class="price-details d-flex align-items-center justify-content-between">
                    <div class=""><?php echo display('open_fees') ?>:</div>
                    <div class="" id="buyfees">0.00 <?php echo esc($coin_symbol[1]) ?> (<?php echo esc(@$fee_usd->fees) ?>%)</div>
                    <input type="hidden" name="buyfeesval" id="buyfeesval" value="" />
                  </div>
                  <div class="price-details d-flex align-items-center justify-content-between">
                    <div class=""><?php echo display('total') ?>:</div>
                    <div class="total" id="buytotal">0.00</div>
                    <input type="hidden" name="buytotalval" id="buytotalval" value="" />
                  </div>
                </div>
                <div class="text-center">
                  <div class="buyloginMessage"></div>
                  <?php if($session->get('user_id')!=NULL){?>
                    <button type="submit" class="btn btn-block btn-success"><?php echo display('buy') ?> <?php echo esc($coin_symbol[0]) ?></button>
                  <?php } else{ ?>
                    <a href="<?php echo base_url('login') ?>" class="standard"><?php echo display('sign_in') ?></a> or <a href="<?php echo base_url('register') ?>" class="standard">Create an Account</a> to  trade.
                  <?php } ?>
                </div>
              </div>
              <?php echo form_close() ?>
            </div>
            <!-- /.End of buy BTC -->
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between">
                <div class=""><?php echo display('sell') ?> <?php echo esc($coin_symbol[0]) ?></div>
                <div class="balance"><?php echo esc($coin_symbol[0]) ?> <?php echo display('balance') ?>: <span id="balance_sell"><?php echo esc(@$balance_from->balance)?@(float)esc($balance_from->balance):'0.00' ?></span></div>
              </div>
              <?php echo form_open('home/sell','id="sellform" class="buy-form" name="sellform"'); ?>
              <?php echo form_hidden('market', esc(@$market_details->symbol)) ?> 
              <div class="card-body">                                        
                <div class="">                                                
                  <div class="row">
                    <div class="col">
                      <label for="sellamount"><?php echo display('amount') ?></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="<?php echo $coin_symbol[0] ?>"><?php echo esc($coin_symbol[0]) ?></span>
                        </div>
                        <input type="text" class="form-control" id="sellamount" aria-describedby="<?php echo esc($coin_symbol[0]) ?>" name="sellamount" value="1" required>
                        <div class="invalid-feedback">

                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <label for="sellpricing"><?php echo display('price') ?></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="<?php echo $coin_symbol[1] ?>"><?php echo esc($coin_symbol[1]) ?></span>
                        </div>
                        <input type="text" class="form-control" id="sellpricing" aria-describedby="<?php echo esc($coin_symbol[1]) ?>" name="sellpricing" required>
                        <div class="invalid-feedback">

                        </div>
                      </div>
                    </div>
                  </div>                                                
                  <div class="price-details d-flex align-items-center justify-content-between">
                    <div class=""><?php echo display('estimated_open_price') ?>:</div>
                    <div class="" id="sellwithout_fees">0.00</div>
                    <input type="hidden" name="sellwithout_feesval" id="sellwithout_feesval" />
                  </div>
                  <div class="price-details d-flex align-items-center justify-content-between">
                    <div class=""><?php echo display('open_fees') ?>:</div>
                    <div class="" id="sellfees">0.00 <?php echo esc($coin_symbol[0]) ?> (<?php echo esc(@$fee_coin->fees) ?>%)</div>
                    <input type="hidden" name="sellfeesval" id="sellfeesval" value="" />
                  </div>
                  <div class="price-details d-flex align-items-center justify-content-between">
                    <div class=""><?php echo display('total') ?>:</div>
                    <div class="total" id="selltotal">0.00</div>
                    <input type="hidden" name="selltotalval" id="selltotalval" value="" />
                  </div>
                </div>
                <div class="text-center">
                  <div class="sellloginMessage"></div>
                  <?php if($session->get('user_id')!=NULL){?>
                    <button type="submit" class="btn btn-block btn-danger"><?php echo display('sell') ?> <?php echo $coin_symbol[0] ?></button>
                  <?php } else{ ?>
                    <a href="<?php echo htmlspecialchars_decode(base_url('login')) ?>" class="standard"><?php echo display('sign_in') ?></a> or <a href="<?php echo htmlspecialchars_decode(base_url('register')) ?>" class="standard">Create an Account</a> to  trade.
                  <?php } ?>
                </div>
              </div>
              <?php echo form_close() ?>
            </div>
            <!-- /.End of sell BTC -->
          </div>
        </div>
        <div class="chart-panel">
          <h5><i class="fas fa-chart-line"></i> <?php echo display('market_depth') ?></h5>
          <div id="marketDepth"></div>
        </div>
        <!-- /.End of market depth -->
      </div>
      <div class="col-md-3">
        <div class="markert-tabs">
          <ul class="nav nav-tabs" id="myTab" role="tablist">

            <?php foreach ($coin_markets as $key => $value) { $coin_symbol = explode('_', $market_symbol);?>
            <li class="nav-item">
              <a class="nav-link <?php echo (esc($coin_symbol[1])==esc($value->name))?'active':'' ?>" id="baseTab<?php echo esc($value->name) ?>" data-toggle="tab" href="#tab<?php echo esc($value->name) ?>" role="tab" aria-controls="tab<?php echo esc($value->name) ?>" aria-selected="true"><?php echo esc($value->name) ?></a>
            </li>
          <?php } ?>
        </ul>
        <div class="tab-content" id="myTabContent">

          <?php foreach ($coin_markets as $key => $value) { ?>
            <div class="tab-pane fade show <?php echo (esc($coin_symbol[1])==esc($value->name))?'active':'' ?>" id="tab<?php echo esc($value->name) ?>" role="tabpanel" aria-labelledby="baseTab<?php echo esc($value->name) ?>">
              <div class="markert-table tableFixHead">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr class="table-bg">
                      <th class="coin"><?php echo display('coin') ?></th>
                      <th class="price text-right"><?php echo display('market_price') ?></th>
                      <th class="volume text-right"><?php echo display('volume') ?></th>
                      <th class="change text-center"><?php echo display('change') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($coin_pairs as $keyp => $valuep) { if($valuep->market_symbol == $value->symbol){ ?>
                        <tr onclick="window.location='<?php echo base_url("exchange/?market=$valuep->symbol") ?>';">
                          <th class="coin"><?php echo esc($valuep->currency_symbol)." / ".esc($valuep->market_symbol) ?></th>
                          <td class="price text-right" id="price_<?php echo esc($valuep->symbol) ?>"><?php echo esc($valuep->initial_price)==''?'0.00':esc($valuep->initial_price) ?></td>
                          <td class="volume text-right" id="volume_<?php echo esc($valuep->symbol) ?>">0.00</td>
                          <td class="change text-center" id="price_change_<?php echo esc($valuep->symbol) ?>">0%</td>
                        </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
        <!-- /.End of market table -->
        <div class="notices card">
          <div class="card-header">
            <?php echo display('live_chat') ?>
          </div>
          <div class="message-body">
            <div class="message">
              <div id="live_chat">
                <ul id="live_chat_list">

                </ul>
              </div>
              <div class="live_message">
                <?php echo form_open('#','id="message_form" class="message_form" name="message_form"'); ?>
                <div class="form-group">
                  <label for="message"><?php echo display('message') ?></label>
                  <textarea class="form-control" name="message"></textarea>
                </div>                                            

                <div class="text-center">
                  <div class="chatloginMessage"></div>
                  <?php if($session->get('user_id')!=NULL){?>
                    <button type="submit" class="btn btn-block btn-kingfisher-daisy"><?php echo display('post_comment') ?></button>
                  <?php } else{ ?>
                    <a href="<?php echo htmlspecialchars_decode(base_url('login')) ?>" class="standard"><?php echo display('sign_in') ?></a> or <a href="<?php echo htmlspecialchars_decode(base_url('register')) ?>" class="standard">Create an Account</a> to  trade.
                  <?php } ?>
                </div>
                <?php echo form_close() ?>
              </div>
              <!-- /.End of sell BTC -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-9">
        <div class="content-title">
          <h4><?php echo display('market_trade_history') ?></h4>
        </div>
        <div class="history-table tableFixHead">
          <table class="table table-striped">
            <thead>
              <tr class="table-bg">
                <th class="date"><?php echo display('date') ?></th>
                <th class="type"><?php echo display('type') ?></th>
                <th class="amount text-right"><?php echo display('amount') ?> <?php echo esc($coin_symbol[0]) ?></th>
                <th class="price text-right"><?php echo display('price') ?> (<?php echo esc($coin_symbol[1]) ?>)</th>
                <th class="total text-right"><?php echo display('total') ?> (<?php echo esc($coin_symbol[1]) ?>)</th>
              </tr>
            </thead>
            <tbody id="tradeHistory">

            </tbody>
          </table>
        </div>
        <!-- End of Trade History -->
      </div>
      <div class="col-md-12 col-lg-3">
        <div class="notices notice-main card">
          <div class="card-header">
            <?php echo display('notices') ?>
          </div>
          <div class="card-body">
            <div class="notice">

              <?php foreach ($notice as $key => $value) { 
                $notice_txt   =   isset($lang) && $lang =="french"?$value->article1_fr:$value->article1_en;
                $publish_date =   $value->publish_date;
              ?>
                <div class="notice-text">
                  <h5 class="notice-title"><?php echo htmlspecialchars_decode($notice_txt) ?></h5>
                  <div class="post-author"><?php echo display('posted_by'); ?><strong><?php echo esc($settings->title) ?> at</strong> 
                    <?php
                    $date=date_create($publish_date);
                    echo date_format($date,"jS, F Y");
                    ?>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- /.End of notices -->
      </div>
    </div>
  </div>
</div>

<div class="blog-grid-content">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="section-title text-center">
          <h3><?php echo isset($lang) && $lang =="french"?$news_cat->cat_title1_fr:$news_cat->cat_title1_en; ?></h3>
          <p><?php echo isset($lang) && $lang =="french"?$news_cat->cat_title2_fr:$news_cat->cat_title2_en; ?></p>
        </div>
      </div>


      <?php  

        foreach ($news as $news_key => $news_value) {
          $article_id    =   $news_value->article_id;
          $cat_id        =   $news_value->cat_id;
          $slug          =   $news_value->slug;
          $news_headline =   isset($lang) && $lang =="french"?$news_value->headline_fr:$news_value->headline_en;
          $news_article1 =   isset($lang) && $lang =="french"?$news_value->article1_fr:$news_value->article1_en;
          $news_article_i=   $news_value->article_image;
          $publish_date  =   $news_value->publish_date;

          $cat_slug = $db->table('web_category')->select("slug, cat_name_en, cat_name_fr")->where('cat_id', $cat_id)->get()->getRow();
      ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="blog-grid-post">
            <div class="post-header">
              <a href="<?php echo base_url('news/'.esc($cat_slug->slug)."/$slug"); ?>">
                <img src="<?php echo base_url(esc($news_article_i)); ?>" class="img-fluid" alt="<?php echo esc($news_headline); ?>">
              </a>
            </div>
            <div class="post-body">
              <h5 class="grid-title"><a href="<?php echo base_url('news/'.esc($cat_slug->slug)."/$slug"); ?>"><?php echo esc($news_headline); ?></a></h5>
              <div class="f-13 d-flex mb-3">
                <span class="post-date pr-3">
                  <?php
                  $date=date_create($publish_date);
                  echo date_format($date,"jS, F Y");
                  ?> 
                </span>
              </div>
              <p class="post-des"><?php echo substr(strip_tags($news_article1), 0, 110); ?></p>
            </div>
          </div>
          <!-- /.End of blog grid post-->
        </div>
      <?php } ?>
    </div>
  </div>
</div>
<!-- /.End of blog grid content -->