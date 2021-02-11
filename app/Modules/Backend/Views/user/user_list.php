<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card ">
            <div class="card-body">
                <div class="">
                    <table class="datatable table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo 'sl_no'; ?></th>
                                <th><?php echo 'image'; ?></th>
                                <th><?php echo 'username'; ?></th>
                                <th><?php echo display('email'); ?></th>
                                <th><?php echo 'about'; ?></th>
                                <th><?php echo 'last_login'; ?></th>
                                <th><?php echo 'last_logout'; ?></th>
                                <th><?php echo 'ip_address'; ?></th>
                                <th><?php echo 'action'; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl = 1; foreach ($user as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><img src="<?php echo base_url().$value->image; ?>" height="80px" width="70px"></td>
                                <td><?php echo $value->fullname; ?></td>
                                <td><?php echo $value->email; ?></td>
                                <td><?php echo $value->about; ?></td>
                                <td><?php echo $value->last_login; ?></td>
                                <td><?php echo $value->last_logout; ?></td>
                                <td><?php echo $value->ip_address; ?></td>
                                 <td>
                                    <?php if (session('isAdmin')) { ?>
                                    <a href="<?php echo base_url('user/edit_user/'.$value->id)?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="far fa-edit" aria-hidden="true"></i></a>
                                    <?php if($permission->method('new_invoice','create')->access()){ ?>
                                    <a href="<?php echo base_url('user/delete_user/'.$value->id)?>" onclick="return confirm('<?php echo lan("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="far fa-trash-alt" aria-hidden="true"></i></a>
                                <?php }?>
                                    <?php } else { ?> 
                                    <button class="btn btn-info btn-sm" title="<?php echo 'admin' ?>"><?php echo 'admin';?></button>
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
</div>

 