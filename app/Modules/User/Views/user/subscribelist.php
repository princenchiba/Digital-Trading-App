<div class="card">
    <div class="card-body">
        <table id="example" class="table table-bordered table-hover">
            <thead>
                <tr> 
                    <th width="80"><?php echo display('sl_no') ?></th>
                    <th><?php echo display('email') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if($subscriber != NULL){ 
                    $i=1;
                    foreach ($subscriber as $key => $value) {  
                ?>
                    <tr>
                        <td width="80"><?php echo $i++;?></td>
                        <td><?php echo esc($value->email);?></td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
        <?php echo htmlspecialchars_decode($pager); ?>
    </div>
</div> 