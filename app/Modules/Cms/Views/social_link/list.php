<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0"></h6>
                    </div>
                    <div class="text-right">
                        <div class="actions">
                            <a href="#" class="action-item"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="datatable2 table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th  width="80" class="text-center"><?php echo display('sl_no')?></th>
                            <th><?php echo display('name')?></th>
                            <th><?php echo display('link')?></th>
                            <th><?php echo display('icon')?></th>
                            <th><?php echo display('status')?></th>
                            <th width="50" class="text-center"><?php echo display('action')?></th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($social_link)) ?>
                        <?php $sl = 1; foreach ($social_link as $value) { ?>
                        <tr>
                            <td class="text-center"><?php echo $sl++; ?></td> 
                            <td><?php echo esc($value->name); ?></td>
                            <td><?php echo esc($value->link); ?></td>
                            <td><h1><i class="fa fa-<?php echo esc($value->icon); ?>"></i></h1></td>
                            <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url("admin/cms/edit-social-link/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="hvr-buzz-out fas fa-pencil-alt"></i></a>
                            </td>
                        </tr>
                        <?php } ?>  
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>