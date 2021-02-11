<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div  class="card-body table-responsive">
                <table id="example" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="50"><?php echo display('sl_no')?></th>
                            <th><?php echo display('user_id')?></th>
                            <th><?php echo display('amount')?></th>
                            <th><?php echo display('comment')?></th>
                            <th width="50" class="text-center"><?php echo display('action')?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if($credit_info != NULL){ 
                            $i=1;
                            foreach ($credit_info as $key => $value) {  
                        ?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo esc($value->user_id);?></td>
                            <td><?php echo esc($value->amount);?></td>
                            <td><?php echo esc($value->comment);?></td>
                            <td class="text-center">
                                <a class="btn btn-success" href="<?php echo base_url()?>/admin/finance/credit-details/<?php echo esc($value->id);?>"><?php echo display('view');?></a>
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
                <?php echo  htmlspecialchars_decode($pager); ?>
            </div>
        </div>
    </div>
</div>