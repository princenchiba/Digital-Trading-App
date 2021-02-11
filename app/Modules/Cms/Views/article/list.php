<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fs-17 font-weight-600 mb-0">&nbsp;</h6>
            </div>
            <div class="text-right">
                <div class="actions">
                    <a href="<?php echo base_url('admin/cms/add-page-content'); ?>" class="btn btn-success w-md m-b-5 pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Page Content</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="example" class="table table-bordered table-hover">
            <thead>
                <tr> 
                    <th><?php echo display('sl_no') ?></th>
                    <th><?php echo display('headline_en') ?></th>
                    <th><?php echo display('category') ?></th>
                    <th><?php echo display('sl_no') ?></th>
                    <th width="80"><?php echo display('action') ?></th> 
                </tr>
            </thead>    
            <tbody>
                <?php  
                 if (!empty($article)){
                    $sl = 1; 
                    foreach ($article as $value) {  
                    
                ?>
                <tr>
                    <td><?php echo $sl; ?></td> 
                    <td><?php echo htmlspecialchars_decode($value->article1_en); ?></td>
                    <td><?php echo $value->cat_name_en ?></td>
                    <td><?php echo esc($value->position_serial); ?></td>
                    <td>
                        <a href="<?php echo base_url("admin/cms/edit-page-content/$value->article_id") ?>" class="btn btn-info btn-sm" title="Update"><i class="hvr-buzz-out fas fa-pencil-alt"></i></a>
                        <a href="<?php echo base_url("admin/cms/delete-page-content/$value->article_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" title="Delete "><i class="hvr-buzz-out fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php $sl++; } } ?>  
            </tbody>
        </table>
        <?php echo htmlspecialchars_decode($pager); ?>
    </div> 
</div>

