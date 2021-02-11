    <div class="ballance-content">
		<div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="content-title">
                        <h4><?php echo display('trade_history') ?></h4>
                    </div>
                    <div class="history-table tableFixHead">
                        <table class="table">
                            <thead>
                                <tr class="table-bg">
                                    <th><?php echo display('trade') ?></th>
                                    <th><?php echo display('rate') ?></th>
                                    <th><?php echo display('required_qty') ?></th>
                                    <th><?php echo display('available_qty') ?></th>
                                    <th><?php echo display('required_amount') ?></th>
                                    <th><?php echo display('available_amount') ?></th>
                                    <th><?php echo display('market') ?></th>
                                    <th><?php echo display('open') ?></th>
                                    <th><?php echo display('complete_qty') ?></th>
                                    <th><?php echo display('complete_amount') ?></th>
                                    <th><?php echo display('trade_time') ?></th>
                                    <th><?php echo display('status') ?></th>
                                </tr>
                            </thead>
                            <tbody id="usertradeHistory">
                                <?php  foreach ($user_trade_history as $key => $value) { ?>
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
                                		<td><?php echo esc($value->status)==0?"<p class='bg-warning text-white text-center pb-1 pl-1 pr-1 mb-1 mt-1'>Canceled</p>":(esc($value->status)==1?"<p class='bg-success text-white text-center pb-1 pl-1 pr-1 mb-1 mt-1'>Completed</p>":"<p class='bg-primary text-white text-center pb-1 pl-1 pr-1 mb-1 mt-1'>Running</p>") ?></td>
                                	</tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- End of Trade History -->
                </div>
            </div>
        </div>
    </div>