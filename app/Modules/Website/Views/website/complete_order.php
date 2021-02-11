    <div class="ballance-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="content-title">
                        <h4><?php echo display('finished_trade') ?></h4>
                    </div>
                    <div class="history-table tableFixHead">
                        <table class="table">
                            <thead>
                                <tr class="table-bg">
                                    <th><?php echo display('trade') ?></th>
                                    <th><?php echo display('rate') ?></th>
                                    <th><?php echo display('qty') ?></th>
                                    <th><?php echo display('amount') ?></th>
                                    <th><?php echo display('market') ?></th>
                                    <th><?php echo display('open') ?></th>
                                    <th><?php echo display('status') ?></th>
                                </tr>
                            </thead>
                            <tbody id="usercompleteTrade">
                                <?php  foreach ($complete_trade as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo esc($value->bid_type); ?></td>
                                        <td><?php echo esc($value->bid_price); ?></td>
                                        <td><?php echo esc($value->bid_qty); ?></td>
                                        <td><?php echo esc($value->total_amount); ?></td>
                                        <td><?php echo esc($value->market_symbol); ?></td>
                                        <td><?php echo esc($value->open_order); ?></td>
                                        <td><p class="bg-success text-white text-center  pb-1 pl-1 pr-1 mb-1 mt-1"><?php echo display('success'); ?></p></td>
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