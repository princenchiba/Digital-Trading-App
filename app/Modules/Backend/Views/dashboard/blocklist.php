<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty(esc($title))?esc($title):null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
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
                                <a href="<?php echo base_url("backend/dashboard/security/delete_blocklist/$value->id")?>" class="btn btn-danger btn-sm">Remove Blocklist</a>
                            </td>
                        </tr>
                        <?php } ?>  
                    </tbody>
                </table>
                <?php echo htmlspecialchars_decode($links); ?>
            </div> 
        </div>
    </div>
</div>

 