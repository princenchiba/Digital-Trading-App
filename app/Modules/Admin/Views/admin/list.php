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
            <div class="card-body table-responsive">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="50"><?php echo display('sl_no') ?></th>
                            <th><?php echo display('image') ?></th>
                            <th><?php echo display('fullname') ?></th>
                            <th><?php echo display('email') ?></th>
                            <th><?php echo display('about') ?></th>
                            <th><?php echo display('last_login') ?></th>
                            <th><?php echo display('last_logout') ?></th>
                            <th><?php echo display('ip_address') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th class="text-center"  width="200"><?php echo display('action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($admin)) ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($admin as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td>
                            <td><img src="<?php echo base_url(!empty($value->image)?$value->image:'assets/images/icons/user.png'); ?>" alt="Image" height="30" width="30" ></td>
                            <td><?php echo esc($value->firstname." ".$value->lastname); ?></td>
                            <td><?php echo esc($value->email); ?></td>
                            <td><?php echo substr($value->about, 0,20); ?></td>
                            <td><?php echo esc($value->last_login); ?></td>
                            <td><?php echo esc($value->last_logout); ?></td>
                            <td><?php echo esc($value->ip_address); ?></td>
                            <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                            <td class="text-center">
                                <?php if ($value->is_admin == 1) { ?>

                                    <button class="btn btn-info btn-sm" title="<?php echo display('admin') ?>"><?php echo display('admin') ?></button>

                                <?php } else { ?> 
                                    <button class="btn btn-warning text-white" title="<?php echo display('sub_admin') ?>"><?php echo display('sub_admin') ?></button>
                                    <a href="<?php echo base_url("admin/edit-admin/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="hvr-buzz-out far fa-edit"></i></a>
                                    <a href="<?php echo base_url("admin/admin-delete/$value->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="hvr-buzz-out far fa-trash-alt"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?> 
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>

 