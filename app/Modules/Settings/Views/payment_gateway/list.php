<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th width="90"><?php echo display('sl_no') ?></th>
                            <th><?php echo display('gateway_name') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th width="90" class="text-center"><?php echo display('action') ?></th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($payment_gateway)) ?>
                        <?php $sl = 1; foreach ($payment_gateway as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td> 
                            <td><?php echo esc($value->agent); ?></td>
                            <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url("admin/setting/update-gateway/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-cog" aria-hidden="true"></i> Setup</a>
                            </td>
                        </tr>
                        <?php } ?>  
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>