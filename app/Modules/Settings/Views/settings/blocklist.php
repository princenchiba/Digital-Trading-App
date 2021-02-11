<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="datatable2 table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('ip') ?></th>
                            <th><?php echo display('action') ?></th>
                            
                        </tr>
                    </thead> 
                    <tbody>
                        <?php if (!empty($blocklist)) ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($blocklist as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td>
                            <td><?php echo esc($value->ip_mail); ?></td>
                            <td width="150px">
                                <a href="<?php echo base_url("admin/setting/delete-block/$value->id")?>" class="btn btn-danger btn-sm">Remove Blocklist</a>
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

 