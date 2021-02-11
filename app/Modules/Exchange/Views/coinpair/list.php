<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">&nbsp;</h6>
                    </div>
                    <div class="text-right">
                        <div class="actions">
                           <a class="btn btn-success w-md m-b-5 pull-right" href="<?php echo base_url("admin/exchanger/add-coin-pair") ?>"><i class="fa fa-plus" aria-hidden="true"></i> Coin Pair</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-hover">
                        <thead>
                            <tr> 
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('market') ?></th>
                                <th><?php echo display('coin') ?></th>
                                <th><?php echo display('name') ?></th>
                                <th>Full <?php echo display('name') ?></th>
                                <th><?php echo display('symbol') ?></th>
                                <th>Initial <?php echo display('price') ?></th>
                                <th><?php echo display('market') ?> <?php echo display('price') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th> 
                            </tr>
                        </thead>    
                        <tbody>
                            <?php if (!empty($coinpair)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($coinpair as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td> 
                                <td>
                                    <?php foreach ($market as $mvalue) { ?>
                                    <?php echo ($value->market_symbol==$mvalue->symbol)?$mvalue->full_name:'' ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php foreach ($coins as $cvalue) { ?>
                                    <?php echo esc(($value->currency_symbol==$cvalue->symbol))?$cvalue->full_name:'' ?>
                                    <?php } ?>
                                </td>
                                <td><?php echo esc($value->name); ?></td>
                                <td><?php echo esc($value->full_name); ?></td>
                                <td><?php echo esc($value->symbol); ?></td>
                                <td><?php echo esc($value->initial_price); ?></td>
                                <td id="price_<?php echo esc($value->symbol) ?>"><?php echo esc($value->market_symbol); ?></td>
                                <td><?php echo ((esc($value->status) == 1)?display('active'):display('inactive')); ?></td>
                                <td>
                                    <a href="<?php echo base_url("admin/exchanger/edit-coin-pair/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="hvr-buzz-out fas fa-pencil-alt"></i></a>
                                </td>
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

 