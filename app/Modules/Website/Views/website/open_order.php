<div class="ballance-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="content-title">
                    <h4><?php echo display('open_order_history') ?></h4>
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
                </div>
                <div class="history-table tableFixHead">
                    <table class="table table-striped">
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
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody id="useropenTrade">
                            <?php  foreach ($open_trade as $key => $value) { ?>
                            	<tr>
                                    <td><?php echo esc($value->bid_type); ?></td>
                                    <td><?php echo esc($value->bid_price); ?></td>
                                    <td><?php echo esc($value->bid_qty); ?></td>
                                    <td><?php echo esc($value->bid_qty_available); ?></td>
                                    <td><?php echo esc($value->total_amount); ?></td>
                                    <td><?php echo esc($value->amount_available); ?></td>
                                    <td><?php echo esc($value->market_symbol); ?></td>
                                    <td><?php echo esc($value->open_order); ?></td>
                                    <td><p class='bg-primary text-white text-center pb-1 pl-1 pr-1 mb-1 mt-1'><?php echo display('running') ?></p></td>
                                    <td class="pt_10"><a href="<?php echo base_url("order-cancel/$value->id") ?>" class="bg-danger text-white text-center pt-1 pb-1 pl-1 pr-1 mb-1 mt-2"  data-toggle="tooltip" data-placement="left" title="Cancel"><?php echo display('cancel') ?></a></td>
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