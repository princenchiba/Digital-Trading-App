<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <title><?php echo esc($settings->title) ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="<?php echo base_url($settings->favicon); ?>">
        <!-- Bootstrap CSS -->
        <link href="<?php echo base_url('writable/exchange/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('writable/exchange/assets/plugins/fontawesome/css/all.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('writable/exchange/assets/plugins/themify-icons/themify-icons.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('writable/exchange/assets/plugins/feather-icon/dist/feather.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('writable/exchange/assets/plugins/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('writable/exchange/assets/plugins/select2/dist/css/select2.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('writable/exchange/assets/js/amcharts/export.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('writable/exchange/assets/css/style.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('writable/exchange/assets/css/custom.css') ?>" rel="stylesheet">
        <script type='text/javascript' src="<?php echo base_url('Adapter/javascript/?market='.$adapter_symbol) ?>"></script>
    </head>
    <body id="body" class="night-mode">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p><?php echo display('please_wait');?>...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        <!--Navbar-->
        <nav class="navbar-custom-menu navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url('/'.$settings->logo) ?>" class="logo img-fluid" alt="">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?php echo display('home'); ?></a>
                    </li>
                    <li class="nav-item dropdown user-menu">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo display('finance'); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo base_url('balances') ?>"><i class="fe fe-credit-card"></i><?php echo display('balance');?></a>
                            <a class="dropdown-item" href="<?php echo base_url('deposit') ?>"><i class="fe fe-droplet"></i><?php echo display('deposit') ?></a>
                            <a class="dropdown-item" href="<?php echo base_url('withdraw') ?>"><i class="fe fe-dollar-sign"></i><?php echo display('withdraw') ?></a>
                            <a class="dropdown-item" href="<?php echo base_url('transfer') ?>"><i class="fe fe-book"></i><?php echo display('transfer') ?></a>
                            <a class="dropdown-item" href="<?php echo base_url('transactions') ?>"><i class="fe fe-droplet"></i><?php echo display('transection') ?></a>
                        </div>
                    </li>

                    <li class="nav-item dropdown user-menu">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo display('trade'); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo base_url('open-order') ?>"><?php echo display('open_order') ?></a>
                            <a class="dropdown-item" href="<?php echo base_url('complete-order') ?>"><?php echo display('complete_order') ?></a>
                            <a class="dropdown-item" href="<?php echo base_url('trade-history') ?>"><?php echo display('trade_history') ?></a>
                        </div>
                    </li>
                    <?php  if($session->get('user_id') != NULL){ ?>
                        <li class="nav-item dropdown user-menu">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo display('account'); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo base_url('bank-setting'); ?>"><?php echo display('bank_setting') ?></a>
                                <a class="dropdown-item" href="<?php echo base_url('payout-setting'); ?>"><?php echo display('payout_setup') ?></a>
                                <a class="dropdown-item" href="<?php echo base_url('profile'); ?>"><?php echo display('profile') ?></a>
                            </div>
                        </li>
                    <?php } ?>
                    <?php  if($session->get('user_id') == NULL){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('login'); ?>"><?php echo display('login'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('register'); ?>"><?php echo display('register'); ?></a>
                        </li>
                    <?php } ?>
                </ul>
                <?php  if($session->get('user_id') != NULL){ ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown user-menu">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="<?php echo base_url('login')?>" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name"><?php echo esc($userinfo->first_name." ".$userinfo->last_name) ?></span>
                            </div>
                            <span><img class="user-avatar" src="<?php echo base_url(!empty($userinfo->image)?$user->image: "assets/images/icons/user.png") ?>" alt=""></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" >
                            <a class="dropdown-item" href="<?php echo base_url('customer/auth/logout') ?>"><i class="fe fe-log-out"></i><?php echo display('logout') ?></a>
                        </div><!--/.dropdown-menu -->
                    </li>
                </ul>
            <?php } ?>
            </div>
        </nav>
        <section class="content-wrapper">
            <!--Sidebar-->
            <!--Sidebar nav-->
            <div class="sidebar-nav">
                <ul class="nav flex-column" role="tablist">
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>" class="nav-link">
                            <i class="fe fe-home"></i>
                            <span><?php echo display('back_to_home');?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chat-tab" data-toggle="tab" href="#chat" role="tab" aria-controls="chat" aria-selected="true">
                            <i class="fe fe-message-square"></i>
                            <span><?php echo display('live_chat') ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">
                            <i class="fe fe-clock"></i>
                            <span><?php echo display('trading_history');?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="news-tab" data-toggle="tab" href="#news" role="tab" aria-controls="history" aria-selected="false">
                            <i class="fe fe-globe"></i>
                            <span><?php echo display('news');?></span>
                        </a>
                    </li>
                </ul>
            </div>
            <!--Chat content-->
            <div class="tab-pane chat-content" id="chat" role="tabpanel" aria-labelledby="chat-tab">
                <!--Chat panel-->
                <div class="chat-panel active">
                    <div class="chat-header d-flex align-items-center">
                        <div class="meta-info data mr-auto">
                            <h5><a href="#"><?php echo display('live_chat') ?></a></h5>
                        </div>
                    </div>
                    <div class="chat-body" id="live_chat_list">
                        
                    </div>
                    <?php echo form_open('#','id="message_form" class="position-relative w-100" name="message_form"'); ?>
                    <div class="chat-bottom d-flex align-items-center">
                        <?php if($session->get('user_id') != NULL){?>
                            <input name="message" class="form-control" placeholder="Type a message here...">
                            <button type="submit" class="btn send"><i class="fab fa-telegram-plane"></i></button>
                             <?php } else { ?>
                        <?php echo form_close() ?>
                            <a href="<?php echo base_url('register'); ?>" class="primaryLink"><?php echo display('sign_in') ?></a>
                            <p>&nbsp;Or&nbsp;</p>
                            <a href="<?php echo base_url('login'); ?>" class="secondaryLink"><?php echo display('login') ?></a>
                        <?php } ?>
                    </div><!--/.chat area bottom-->
                    <div class="chatloginMessage"></div>
                    <?php echo form_close() ?>
                </div>
            </div>
            <div class="tab-pane trading-history" id="history" role="tabpanel" aria-labelledby="history-tab">
                <div class="chat-header d-flex align-items-center">
                    <div class="meta-info data mr-auto">
                        <h5><?php echo display('trade_history');?></h5>
                    </div>
                </div>
                <div class="history-table-wrap position-relative">
                    <table class="history-table table data-table table-borderless display compact">
                        <thead>
                            <tr>
                                <th class="amount text-right"><?php echo display('amount') ?></th>
                                <th class="price text-right"><?php echo display('price') ?></th>
                                <th class="change"><?php echo display('time');?></th>
                            </tr>
                        </thead>
                        <tbody id="tradeHistory">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane news-tab_content active" id="news" role="tabpanel" aria-labelledby="news-tab">
                <div class="news-content position-relative">
                    <div class="sidebar-title text-center">
                        <h3><?php echo display('latest_news');?></h3>
                    </div>
                        <!-- livefeed item -->
                        <?php 
                            foreach ($news as $v) {

                                $article_id         =   $v->article_id;
                                $cat_id             =   $v->cat_id;
                                $slug               =   $v->slug;
                                $news_headline      =   isset($lang) && $lang =="french"?$v->headline_fr:$v->headline_en;
                                $news_article1      =   isset($lang) && $lang =="french"?$v->article1_fr:$v->article1_en;
                                $news_article_image =   $v->article_image;
                                $publish_date       =   $v->publish_date;

                                $cat_slug = $db->table('web_category')->select("slug, cat_name_en, cat_name_fr")->where('cat_id', $cat_id)->get()->getRow();
                                $cat_name      =   isset($lang) && $lang =="french"?$cat_slug->cat_name_fr:$cat_slug->cat_name_en;
                              
                        ?>
                            <article class="category-postwidget eachNews" data-toggle="modal" data-target=".news-content_modal" data-news-id="<?php echo $v->article_id; ?>">
                                <div class="img-wrapper">
                                    <img src="<?php echo base_url($v->article_image)?>" alt="" class="img-fluid">
                                </div>
                                <div class="post-info">
                                    <ul class="info">
                                        <li><span class="link time">
                                            <?php
                                                $date = date_create(esc($v->publish_date));
                                                echo date_format($date,"jS, F Y");
                                            ?>
                                    </span></li>
                                    </ul>
                                    <h5 class="title"><?php echo strip_tags(esc(substr($news_headline,0,35))); ?></h5>
                                </div>
                            </article>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <!--Header-->
                <header class="header d-flex">
                    <div class="coin-name d-flex justify-content-center align-items-center">
                        <span class="coin-title dollar"><?php echo esc($market_symbol) ?></span>
                    </div>
                    <div class="d-flex align-items-center ml-3">
                        <div class="d-flex align-items-center">
                            <span class="trade-price number-style last-price coin-last-price">0.00 &nbsp;<?php echo esc($coin_symbol[0]) ?></span>
                            <span class="trade-price_title"><?php echo display('last_price') ?></span>
                        </div>
                        <div class="d-flex align-items-center ml-3">
                            <span class="trade-price number-style">
                                <span class=""><?php echo esc($coin_symbol[0]) ?> &nbsp;</span>
                                <span class="last-price coin-change-price positive">&nbsp;0.00%</span>
                            </span>
                            <span class="trade-price_title"><?php echo display('24hr_change') ?></span>
                        </div>
                        <div class="d-flex align-items-center ml-3">
                            <span class="trade-price number-style"><?php echo esc($coin_symbol[0]) ?>&nbsp;</span>
                            <span class="trade-price number-style coin-price-high"> &nbsp;0.00</span>
                            <span class="trade-price_title"><?php echo display('24hr_high') ?> &nbsp;</span>
                        </div>
                        <div class="d-flex align-items-center ml-3">
                            <span class="trade-price number-style"><?php echo esc($coin_symbol[0]) ?> &nbsp;</span>
                            <span class="trade-price number-style coin-price-low">&nbsp;0.00</span>
                            <span class="trade-price_title"><?php echo display('24hr_low') ?></span>
                        </div>
                    </div>
                </header>
                <div class="body-content">
                    <div class="row card-group no-gutters">
                        <div class="col-md-3 card">
                            <div class="sell-order-table-wrap position-relative">
                                <table class="sell-order-table table data-table table-borderless display compact">
                                    <thead>
                                        <tr>
                                            <th class="coin"><?php echo display('price') ?> <?php echo esc($coin_symbol[0]) ?></th>
                                            <th class="price"><?php echo esc($coin_symbol[0]) ?> <?php echo display('amount') ?></th>
                                            <th class="change"><?php echo display('total') ?>: (<?php echo esc($coin_symbol[1]) ?>)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body" id="selltrades">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="section-title">
                                <h5 class="text-center"><span class="price_updown">0.00</span></h5>
                            </div>
                            <div class="buy-order-table-wrap position-relative">
                                <table class="buy-order-table table data-table table-borderless display compact">
                                    <thead>
                                        <tr>
                                            <th class="coin"><?php echo display('price') ?> <?php echo esc($coin_symbol[0]) ?></th>
                                            <th class="price"><?php echo esc($coin_symbol[0]) ?> <?php echo display('amount') ?></th>
                                            <th class="change"><?php echo display('total') ?>: (<?php echo esc($coin_symbol[1]) ?>)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body" id="buytrades">
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 card">
                            <div class="news-content position-relative chart-part">
                            <div id="exchangesChart" class="flot-chart"></div>
                            <div class="row no-gutters">
                                <div class="col-md-6 card buy-card">
                                    <div class="card-header gradient-header-green d-flex align-items-center justify-content-between px-3">
                                        <div class="font-weight-500"><?php echo display('buy') ?> <?php echo esc($coin_symbol[0]) ?></div>
                                        <div class=""><i class="ti-wallet"></i>&nbsp;-&nbsp;<?php echo esc($coin_symbol[1]) ?> <?php echo display('balance') ?>: <span id="balance_buy"><?php echo esc(@$balance_to->balance)?@(float)esc($balance_to->balance):'0.00' ?></span></div>
                                    </div>
                                    <div class="card-body position-relative">
                                        <!--Registered mask-->
                                        <?php if($session->get('user_id') == NULL){?>
                                        <div class="registered-mask">
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <div>
                                                    <a href="<?php echo base_url('register') ?>" class="primaryLink"><?php echo display('create_an_account');?></a> <?php echo display('to__trade');?>.
                                                    <p>Or</p>
                                                    <a href="<?php echo base_url('login') ?>" class="secondaryLink"><?php echo display('log_in');?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php echo form_open('buy','id="buyform" class="buy-form" name="buyform"'); ?>
                                        <?php echo form_hidden('market', esc(@$market_details->symbol)); ?> 
                                            <div class="form-group row no-gutters mb-2">
                                                <label for="price" class="col-sm-3 col-form-label font-weight-500"><?php echo display('price') ?>:</label>
                                                <div class="col-sm-9">
                                                    <input step="any" min="0" type="number" class="form-control" id="buypricing" name="buypricing" placeholder="BTC" required>
                                                </div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group row no-gutters mb-2">
                                                <label for="amount" class="col-sm-3 col-form-label font-weight-500"><?php echo display('amount') ?>:</label>
                                                <div class="col-sm-9">
                                                    <input step="any" min="0" type="number" class="form-control" id="buyamount" name="buyamount" placeholder="<?php echo esc($coin_symbol[0]) ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row no-gutters mb-2">
                                                <div class="buyloginMessage"></div>
                                                <div class="col-sm-7"><?php echo display('estimated_open_price') ?>:</div>
                                                <div class="col-sm-5 text-right" id="buywithout_fees">0.00</div>
                                                <input type="hidden" name="buywithout_feesval" id="buywithout_feesval" />
                                                <div class="col-sm-7"><?php echo display('open_fees') ?>:</div>
                                                <div class="col-sm-5 text-right" id="buyfees">0.00 <?php echo esc($coin_symbol[1]) ?> (<?php echo esc(@$fee_usd->fees) ?>%)</div>
                                                <input type="hidden" name="buyfeesval" id="buyfeesval" value="" />
                                                <div class="col-sm-7"><?php echo display('total') ?>:</div>
                                                <div class="total col-sm-5 text-right" id="buytotal">0.00</div>
                                                <input readonly="readonly" type="hidden" class="form-control" name="buytotalval" id="buytotalval">
                                            </div>
                                            <div class="form-group row no-gutters mb-1">
                                                <div class="col-sm-12">
                                                   <button type="submit" class="btn btn-success btn-block rounded-0 btn-sm">
                                                   BUY <?php echo esc($coin_symbol[0]) ?></button>
                                                </div>
                                            </div>
                                        <?php echo form_close() ?>
                                    </div>
                                    <!-- /.End of buy BTC -->
                                </div>
                                <div class="col-md-6 card sell-card">
                                    <div class="card-header gradient-header-green d-flex align-items-center justify-content-between px-3">
                                        <div class="font-weight-500"><?php echo display('sell') ?> <?php echo esc($coin_symbol[0]) ?></div>
                                        <div class="balance"><i class="ti-wallet"></i>&nbsp;-&nbsp;<?php echo esc($coin_symbol[0]) ?> <?php echo display('balance') ?>: <span id="balance_sell"><?php echo esc(@$balance_from->balance)?@(float)esc($balance_from->balance):'0.00' ?></span></div>
                                    </div>
                                    <div class="card-body position-relative">
                                        <!--Registered mask-->
                                        <?php if($session->get('user_id') == NULL){?>
                                        <div class="registered-mask">
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <div>
                                                    <a href="<?php echo base_url('register') ?>" class="primaryLink"><?php echo display('create_an_account');?></a> <?php echo display('to__trade');?>.
                                                    <p>Or</p>
                                                    <a href="<?php echo base_url('login') ?>" class="secondaryLink"><?php echo display('log_in');?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php echo form_open('sell','id="sellform" class="buy-form" name="sellform"'); ?>
                                        <?php echo form_hidden('market', esc(@$market_details->symbol)) ?> 
                                            <div class="form-group row no-gutters mb-2">
                                                <label for="price2" class="col-sm-3 col-form-label font-weight-500"><?php echo display('amount') ?>:</label>
                                                <div class="col-sm-9">
                                                    <input step="any" min="0" type="number" class="form-control" id="sellamount" name="sellamount" value="1" placeholder="<?php echo esc($coin_symbol[0]) ?>" data-toggle="popover" data-trigger="focus" data-content="<?php echo esc($coin_symbol[0]) ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row no-gutters mb-2">
                                                <label for="sellpricing" class="col-sm-3 col-form-label font-weight-500"><?php echo display('price') ?>:</label>
                                                <div class="col-sm-9">
                                                    <input step="any" min="0" type="number" class="form-control" id="sellpricing" name="sellpricing" placeholder="<?php echo $coin_symbol[1] ?>" required>
                                                </div>
                                                <div class="sellloginMessage"></div>
                                            </div>
                                            
                                            <div class="form-group row no-gutters mb-2">
                                                <div class="col-sm-7"><?php echo display('estimated_open_price') ?>:</div>
                                                <div class="col-sm-5 text-right" id="sellwithout_fees">0.00</div>
                                                <input type="hidden" name="sellwithout_feesval" id="sellwithout_feesval" />
                                                <div class="col-sm-7"><?php echo display('open_fees') ?>:</div>
                                                <div class="col-sm-5 text-right" id="sellfees">0.00 <?php echo esc($coin_symbol[0]) ?> (<?php echo esc(@$fee_coin->fees) ?>%)</div>
                                                <input type="hidden" name="sellfeesval" id="sellfeesval" value="" />

                                                <div class="col-sm-7"><?php echo display('total') ?>:</div>
                                                <div class="total col-sm-5 text-right" id="selltotal">0.00</div>
                                                <input type="hidden" name="selltotalval" id="selltotalval" value="" />
                                            </div>
                                            <div class="form-group row no-gutters mb-1">
                                                <div class="col-sm-12">
                                                   <button type="submit" class="btn btn-danger btn-block rounded-0 btn-sm">
                                                   SELL <?php echo esc($coin_symbol[0]) ?></button>
                                                </div>
                                            </div>
                                        <?php echo form_close() ?>
                                    </div>
                                    <!-- /.End of buy BTC -->
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="market-tabs position-relative">
                                <ul class="nav nav-tabs" role="tablist">
                                     <?php 
                                        $i = 1;
                                        foreach ($coin_markets as $key => $value) { $coin_symbol = explode('_', $market_symbol);
                                        if($i <= 3){
                                     ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?php echo (esc($coin_symbol[1])==esc(strtoupper($value->name)))?'active':'' ?>" id="m_tab_<?php echo esc($value->name) ?>" data-toggle="tab" href="#m_<?php echo esc($value->name) ?>" role="tab" aria-controls="m_<?php echo esc($value->name) ?>" aria-selected="true"><?php echo esc(strtoupper($value->name)) ?></a>
                                        </li>
                                    <?php $i++; }} ?>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">MORE</a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php 
                                                $i = 1;
                                                foreach ($coin_markets as $key => $value) { $coin_symbol = explode('_', $market_symbol);
                                                if($i++ > 3){
                                             ?>
                                            <a class="dropdown-item nav-link <?php echo (esc($coin_symbol[1])==esc(strtoupper($value->name)))?'active':'' ?>" id="m_tab_<?php echo esc($value->name) ?>" data-toggle="tab" href="#m_<?php echo esc($value->name) ?>" role="tab" aria-controls="m_<?php echo esc($value->name) ?>" aria-selected="true"><?php echo esc(strtoupper($value->name)) ?></a>
                                            <?php }} ?>
                                           
                                        </div>
                                    </li>
                                </ul>
                                <?php foreach ($coin_markets as $key => $value) { ?>
                                <div class="tab-pane fade show <?php if($coin_symbol[1] == strtoupper($value->name)) echo "active"; ?>" id="m_<?php echo esc($value->name) ?>" role="tabpanel" aria-labelledby="tab_<?php echo esc($value->name) ?>">
                                    <div class="market-table-wrap position-relative">
                                        <table class="market-table table data-table table-borderless display compact">
                                            <thead>
                                                <tr>
                                                    <th class="coin"><?php echo display('coin');?></th>
                                                    <th class="price"><?php echo display('price');?></th>
                                                    <th class="change"><?php echo display('change');?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-body">
                                                <?php 
                                                foreach ($coin_pairs as $keyp => $valuep) { 
                                                    if($valuep->market_symbol == $value->symbol){ 
                                                ?>
                                                    <tr data-href="#" onclick="window.location='<?php echo base_url("exchange/?market=$valuep->symbol") ?>';">
                                                        <td class="coin"><?php echo esc($valuep->currency_symbol)." / ".esc($valuep->market_symbol) ?></td>
                                                        <td class="price positive"><?php echo esc($valuep->initial_price)==''?'0.00':esc($valuep->initial_price) ?> </td>
                                                        <td class="change" id="price_change_<?php echo esc($valuep->symbol) ?>">0%</td>
                                                    </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Footer-->
        <footer class="footer-content d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <select class="custom-select" id="lang-change" data-width="fit">
                    <option value="english" <?php echo isset($lang) && $lang =="english"?'Selected':''; ?>>English</option>
                    <option value="french" <?php echo isset($lang) && $lang =="french"?'Selected':''; ?>><?php echo esc($web_language->name); ?></option>
                </select>
                <div class="toggle-white">
                    <div class="d-flex align-items-center">
                        <label class="toggler toggler--is-active" id="white"><?php echo display('white');?> </label>
                        <div class="toggle">
                            <input type="checkbox" id="switcher" class="check">
                            <b class="toggle-switch"></b>
                        </div>
                        <label class="toggler" id="dark"><?php echo display('dark');?></label>
                    </div>
                </div>
            </div>
            <div class="date-time">
                <?php echo date("D j M"); ?> &nbsp;<span id="clock"></span>
            </div>
        </footer>
        <!--Register modal-->
        <div class="modal register-modal" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="accordion" id="accordionExample">
                            <nav class="nav mb-3">
                                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><?php echo display('login');?></a>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><?php echo display('sign_up');?></a>
                            </nav>
                            <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                <div class="form-title_wrap mb-3">
                                    <h4 class="form-title mb-0"><?php echo display('login');?></h4>
                                </div>
                                <!--Login Form-->
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" placeholder="Your email address">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" placeholder="Your password">
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input" id="remember">
                                            <label class="custom-control-label" for="remember"><?php echo display('remember_me');?></label>
                                        </div>
                                        <a href="#" class="forgot d-block text-left" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><?php echo display('forgot_password');?>?</a>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block"><?php echo display('login');?></button>
                                </form>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                <div class="form-title_wrap mb-3">
                                    <h4 class="form-title mb-0"><?php echo display('sign_up');?></h4>
                                </div>
                                <!--Register Form-->
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email2" placeholder="Your email address">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="pass" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="c_pass" placeholder="Confirm password">
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1"><?php echo display('your_password_at_global_crypto_are_encrypted_and_secured');?></label>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block"><?php echo display('sign_up');?></button>
                                </form>
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                <div class="form-title_wrap mb-3">
                                    <h4 class="form-title mb-0"><?php echo display('reset');?></h4>
                                    <p class="des"><?php echo display('enter_your_email_address_to_retrieve_your_password');?>.<p>
                                </div>
                                <!--Retrieve password form-->
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email1" placeholder="Email Address">
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><?php echo display('retrieve_password');?></button>
                                </form>
                            </div>
                            <div id="collapseFour" class="collapse" data-parent="#accordionExample">
                                <div class="form-title_wrap mb-3">
                                    <h4 class="form-title mb-0"><?php echo display('reset_your_password');?></h4>
                                </div>
                                <!--Retrieve password form-->
                                <form>
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Verification code">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Confirm Password">
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block"><?php echo display('retrieve_password');?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="signup-section"><?php echo display('not_a_member_yet');?>? <a href="#a" class="text-primary" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> <?php echo display('sign_up');?></a>.</div>
                    </div>
                </div>
            </div>
        </div>
        <!--News details moda-->
        <div class="modal news-content_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" id="newsDetails">
                <div class="modal-content">
                    <button type="button" class="close news-modal_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <header class="header-img">
                    </header>
                    <div class="modal-body">
                        <div class="news-details">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Profile-->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('writable/exchange/assets/plugins/popper/popper.min.js') ?>"></script>
        <script src="<?php echo base_url('writable/exchange/assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('writable/exchange/assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') ?>"></script>
        <script src="<?php echo base_url('writable/exchange/assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo base_url('writable/exchange/assets/plugins/datatables/dataTables.bootstrap4.min.js') ?>"></script>
        <script src="<?php echo base_url('writable/exchange/assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
        <!--This js for amchart start-->
        <script src="<?php echo base_url('writable/exchange/assets/js/amcharts/amcharts.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('writable/exchange/assets/js/amcharts/serial.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('writable/exchange/assets/js/amcharts/amstock.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('writable/exchange/assets/js/amcharts/plugins/dataloader/dataloader.min.js') ?>"></script>
        <script src="<?php echo base_url('writable/exchange/assets/js/amcharts/plugins/export/export.min.js') ?>"></script>
        <script src="<?php echo base_url('writable/exchange/assets/js/amcharts/patterns.js') ?>"></script>
        <script src="<?php echo base_url('writable/exchange/assets/js/amcharts/dark.js') ?>"></script>
        <script src="<?php echo base_url('writable/exchange/assets/js/exchange.js') ?>"></script>
        <script src="<?php echo base_url('writable/exchange/assets/js/custom.js?v=bdtask') ?>"></script>
    </body>
</html>