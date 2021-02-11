<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-hover">
                        <thead>
                            <tr class="table-bg">
                                <th><?php echo display('trade');?></th>
                                <th class="text-right"><?php echo display('rate');?></th>
                                <th class="text-right"><?php echo display('required');?> <?php echo display('quantity');?></th>
                                <th class="text-right">Available <?php echo display('quantity');?></th>
                                <th class="text-right"><?php echo display('required');?> <?php echo display('amount');?></th>
                                <th class="text-right">Available <?php echo display('amount');?></th>
                                <th><?php echo display('market');?></th>
                                <th><?php echo display('date');?></th>
                                <th class="hide text-right">Complete <?php echo display('quantity');?></th>
                                <th class="hide text-right">Complete <?php echo display('amount');?></th>
                                <th><?php echo display('trade');?> <?php echo display('time');?></th>
                                <th class="text-center"><?php echo display('status');?></th>
                            </tr>
                        </thead>
                        <tbody id="usertradeHistory">
                            <?php  foreach ($trade_history as $key => $value) { ?>
                                <tr>
                                    <td><?php echo esc($value->bid_type) ?></td>
                                    <td class="text-right"><?php echo esc($value->bid_price) ?></td>
                                    <td class="text-right"><?php echo esc($value->bid_qty) ?></td>
                                    <td class="text-right"><?php echo esc($value->bid_qty_available) ?></td>
                                    <td class="text-right"><?php echo esc($value->total_amount) ?></td>
                                    <td class="text-right"><?php echo esc($value->amount_available) ?></td>
                                    <td><?php echo esc($value->market_symbol) ?></td>
                                    <td><?php echo esc($value->open_order) ?></td>
                                    <td class="hide text-right"><?php echo esc($value->complete_qty) ?></td>
                                    <td class="hide text-right"><?php echo esc($value->complete_amount) ?></td>
                                    <td><?php echo esc($value->success_time) ?></td>
                                    <?php if($value->bid_qty_available == 0){?>
                                        <td class="text-center"><i title='<?php echo display('complete');?>' class='fas fa-check mr-2 fs-20 text-success'></i></td>
                                    <?php } else { ?>
                                        <td class="text-center"><i title='<?php echo display('running');?>' class='fas fa-spinner fa-pulse mr-2 fs-20 text-warning'></i></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php echo htmlspecialchars_decode($pager); ?>
                </div>
            </div> 
        </div>
    </div>
</div>

 