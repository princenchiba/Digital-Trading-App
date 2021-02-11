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
                           <a class="btn btn-success w-md m-b-5 pull-right" href="<?php echo base_url("admin/exchanger/add-market") ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('market') ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th width="50"><?php echo display('sl_no') ?></th>
                            <th><?php echo display('name') ?></th>
                            <th>Full Name</th>
                            <th><?php echo display('symbol') ?></th>
                            <th><?php echo display('status') ?></th> 
                            <th class="text-center"><?php echo display('action') ?></th> 
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($market)) ?>
                        <?php $sl = 1; foreach ($market as $value) { ?>
                        <tr>
                            <td width="50"><?php echo $sl++; ?></td> 
                            <td><?php echo esc($value->name); ?></td>
                            <td><?php echo esc($value->full_name); ?></td>
                            <td><?php echo esc($value->symbol); ?></td>
                            <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url("admin/exchanger/edit-market/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="hvr-buzz-out fas fa-pencil-alt"></i></a>
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

 