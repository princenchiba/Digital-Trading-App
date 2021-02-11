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
                            <a href="<?php echo base_url('admin/cms/add-slider'); ?>" class="btn btn-success w-md m-b-5 pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Slider</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th width="50"><?php echo display('sl_no') ?></th>
                            <th><?php echo display('slider_h1_en') ?></th>
                            <th><?php echo display('slider_h1')." ".esc($web_language->name) ?></th>
                            <th><?php echo display('image') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th width="80"><?php echo display('action') ?></th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($slider)) ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($slider as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td> 
                            <td><?php echo htmlspecialchars_decode($value->slider_h1_en); ?></td>
                            <td><?php echo htmlspecialchars_decode($value->slider_h1_fr); ?></td>
                            <td><img src="<?php echo base_url().$value->slider_img; ?>" width="150" /></td>
                            <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                            <td>
                                <a href="<?php echo base_url("admin/cms/edit-slider/$value->id") ?>" class="btn btn-info btn-sm" title="Update"><i class="hvr-buzz-out fas fa-pencil-alt"></i></a>
                                <a href="<?php echo base_url("admin/cms/delete-slider/$value->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" title="Delete "><i class="hvr-buzz-out fas fa-trash"></i></a>
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