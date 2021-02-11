        <div class="ballance-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-title">
                            <h4><?php echo display('balance') ?></h4>
                        </div>
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
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-bg">
                                        <th><?php echo display('cryptocoin') ?></th>
                                        <th><?php echo display('name') ?></th>
                                        <th><?php echo display('total_balance') ?></th>
                                        <th><?php echo display('available_balance') ?></th>
                                        <th colspan="2" class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($coin_list as $coin_key => $coin_value) { ?>
                                <?php $balance = '0.00'; foreach ($balances as $key => $value) { 
                                    if ($value->currency_symbol== $coin_value->symbol) {
                                        $balance = $value->balance;

                                    }

                                 } ?>
                                    <tr>
                                        <td><div class="d-flex marks-ico">
                                                <div><img src="<?php echo base_url("$coin_value->image") ?>" alt=""></div>
                                                <div class="ico-name">
                                                    <font><?php echo esc($coin_value->symbol); ?></font>
                                                    <span class="text-muted">(<?php echo esc($coin_value->coin_name); ?>)</span>
                                                </div>
                                            </div></td>
                                        <td><?php echo esc($coin_value->coin_name); ?></td>
                                        <td><?php echo esc($balance); ?></td>
                                        <td><?php echo esc($balance); ?></td>
                                        <td class="text-center"><a href="<?php echo base_url("deposit/$coin_value->symbol"); ?>" class="btn btn-primary"><?php echo display('deposit'); ?></a></td>
                                        <td class="text-center"><a href="<?php echo base_url("withdraw/$coin_value->symbol"); ?>" class="btn btn-info"><?php echo display('withdraw') ?></a></td>
                                    </tr>                                
                                <?php } ?>
                            </table>
                            <?php echo $pager; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>