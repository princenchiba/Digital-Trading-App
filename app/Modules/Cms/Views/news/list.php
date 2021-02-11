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
                            <a href="<?php echo base_url('admin/cms/add-news'); ?>" class="btn btn-success w-md m-b-5 pull-right"><i class="fa fa-plus" aria-hidden="true"></i> News</a>
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
                            <th><?php echo display('headline')." ".$web_language->name ?></th>
                            <th><?php echo display('category') ?></th>
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($article)) ?>
                        <?php $sl = 1; foreach ($article as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td> 
                            <td><?php echo esc($value->headline_en); ?></td>
                            <td><?php echo esc($value->headline_fr); ?></td>
                            <td><?php echo esc($value->cat_name_en); ?></td>
                            <td class="d-flex">
                                <a href="<?php echo base_url("admin/cms/edit-news/$value->article_id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="hvr-buzz-out fas fa-pencil-alt"></i></a>&nbsp;&nbsp;
                                <a href="<?php echo base_url("admin/cms/delete-news/$value->article_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete"><i class="hvr-buzz-out fas fa-trash"></i></a>
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

 