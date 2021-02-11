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
                                <th class="text-right"><?php echo display('available');?> <?php echo display('quantity');?></th>
                                <th class="text-right"><?php echo display('required');?> <?php echo display('amount');?></th>
                                <th class="text-right"><?php echo display('available');?> <?php echo display('amount');?></th>
                                <th><?php echo display('market');?></th>
                                <th><?php echo display('open');?></th>
                                <th class="text-center"><?php echo display('status');?></th>
                            </tr>
                        </thead>
                        <tbody id="useropenTrade">
                            <?php  foreach ($open_trade as $key => $value) { ?>
                                <tr>
                                    <td><?php echo esc($value->bid_type); ?></td>
                                    <td class="text-right"><?php echo esc($value->bid_price); ?></td>
                                    <td class="text-right"><?php echo esc($value->bid_qty); ?></td>
                                    <td class="text-right"><?php echo esc($value->bid_qty_available); ?></td>
                                    <td class="text-right"><?php echo esc($value->total_amount); ?></td>
                                    <td class="text-right"><?php echo esc($value->amount_available); ?></td>
                                    <td><?php echo esc($value->market_symbol); ?></td>
                                    <td><?php echo esc($value->open_order); ?></td>
                                    <td class="text-center"><button type="button" class="btn btn-primary btn-sm cursor-deafult"><i title='<?php echo display('running');?>' class='fas fa-spinner fa-pulse mr-2 fs-20 text-warning'></i><?php echo display('running');?></button></td>
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

 