<div class="card">
    <div class="card-body">
        <table id="example" class="table table-bordered table-hover">
            <thead>
                <tr> 
                    <th><?php echo display('sl_no') ?></th>
                    <th><?php echo display('user_id') ?></th>
                    <th><?php echo display('fullname') ?></th>
                    <th><?php echo display('email') ?></th>
                    <th><?php echo display('mobile') ?></th>
                    <th><?php echo display('action') ?></th> 
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($users as $key => $value) { ?>
                 <tr>
                     <td><?php echo $i ?></td>
                     <td><?php echo esc($value->user_id) ?></td>
                     <td><?php echo esc($value->first_name)." ".esc($value->last_name) ?></td>
                     <td><?php echo esc($value->email) ?></td>
                     <td><?php echo esc($value->phone) ?></td>
                     <td><a href="<?php echo base_url("admin/user/pending-user-verification/$value->user_id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-id="left" title="Update"><i class="hvr-buzz-out far fa-edit"></i></a></td>
                 </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php echo htmlspecialchars_decode($pager); ?>
    </div>
</div> 