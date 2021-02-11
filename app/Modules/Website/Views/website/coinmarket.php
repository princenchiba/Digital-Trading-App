<div class="container">
    <div class="tab-content">
        <div class="table-responsive" id="crypto">
            <table class="table table-striped table-hover nowrap" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><?php echo display('name'); ?></th>
                        <th><?php echo display('ticker'); ?></th>
                        <th><?php echo display('price'); ?></th>
                        <th><?php echo display('24h_volume'); ?></th>
                        <th><?php echo display('24h_change'); ?></th>
                        <th><?php echo display('graph_24h'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($cryptocoins as $cry_key => $cry_value) {

                            $id       = $cry_value->Id;
                            $url      = $cry_value->Url;
                            $image    = $cry_value->ImageUrl;
                            $name     = $cry_value->Name;
                            $symbol   = $cry_value->Symbol;
                            $coinname = $cry_value->CoinName;
                            $fullname = $cry_value->FullName;
                    ?>
                    <tr data-href="<?php echo base_url("coin-details/$id"); ?>" id="BGCOLOR_<?php echo esc($symbol); ?>">
                        <td>
                            <div class="logo-name">
                                <div class="item-logo">
                                    <img width="30" src="<?php echo base_url("$image"); ?>" class="img-responsive" alt="<?php echo strip_tags(esc($fullname)) ?>">
                                </div>
                                <span class="item_name_value"><?php echo esc($coinname); ?></span>
                            </div>
                        </td>
                        <td><span class="value_ticker"><?php echo esc($symbol); ?></span></td>
                        <td>$ <span class="price value_cap" id="PRICE_<?php echo $symbol; ?>">0</span></td>
                        <td><span class="value_max_quantity" id="VOLUME24HOURTO_<?php echo esc($symbol); ?>"></span></td>
                        
                        <td><span id="CHANGE24HOUR_<?php echo esc($symbol); ?>"></span><span id="CHANGE24HOURPCT_<?php echo esc($symbol); ?>"></span></td>
                        <td>
                            <span class="bdtasksparkline value_graph" id="GRAPH_<?php echo esc($symbol); ?>"></span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php echo htmlspecialchars_decode($links); ?>
        </div>
    </div>
</div>