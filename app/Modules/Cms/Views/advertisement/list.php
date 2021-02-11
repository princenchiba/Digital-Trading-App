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
                            <a href="<?php echo base_url('admin/cms/add-advertisement'); ?>" class="btn btn-success w-md m-b-5 pull-right"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('add_advertisement') ?></a>
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
                                <th><?php echo display('name') ?></th>
                                <th><?php echo display('image') ?></th>
                                <th><?php echo display('embed_code') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th width="100" class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if (!empty($advertisement)) $sl = 1; 

                                foreach ($advertisement as $value) { 
                            ?>
                            <tr>
                                <td><?php echo $sl++; ?></td> 
                                <td><?php echo esc($value->name); ?></td>
                                <td><a href="<?php echo $value->url; ?>">
                                    <?php if (!empty($value->image)) { ?>
                                        <img src="<?php echo base_url(esc($value->image)); ?>" width="100" />
                                    <?php } else { ?>
                                         <img src="<?php echo base_url(esc('assets/images/icons/no-img.png')); ?>" width="100" />
                                    <?php } ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars_decode($value->script); ?></td>
                                <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo base_url("admin/cms/edit-advertisement/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="hvr-buzz-out fas fa-pencil-alt"></i></a>&nbsp;&nbsp;
                                    <a href="<?php echo base_url("admin/cms/delete-advertisement/$value->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="hvr-buzz-out fas fa-trash"></i></a>
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

 