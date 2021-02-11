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
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('template-type');?></th>
                            <th><?php echo display('template-name');?></th>
                            <th><?php echo display('template-english');?></th>
                            <th><?php echo display('template-french');?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($template_list)) ?>
                        <?php $sl = 1; foreach ($template_list as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td> 
                            <td><?php echo strip_tags($value->sms_or_email); ?></td>
                            <td><?php echo display($value->template_name); ?></td>
                            <td><?php echo strip_tags($value->template_en); ?></td>
                            <td><?php echo strip_tags($value->template_fr); ?></td>
                            <td>
                                <a href="<?php echo base_url("admin/setting/template-update/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="hvr-buzz-out far fa-edit" aria-hidden="true"></i> </a>
                            </td>
                        </tr>
                        <?php } ?>  
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>