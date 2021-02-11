<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 lobipanel-parent-sortable ui-sortable" data-lobipanel-child-inner-id="2jd65zBuH9">
        <div class="panel panel-bd lobidrag lobipanel lobipanel-sortable" data-inner-id="2jd65zBuH9" data-index="0">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title">
                    <h4><?php echo display('commission_setup');?></h4>
                </div>
            </div>
            <?php echo form_open('backend/dashboard/setting/commission_update')?>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        
                        <thead>
                            <tr>
                                <th><?php echo display('level')?></th>
                                <th><?php echo display('personal_investment')?></th>
                                <th><?php echo display('total_investment')?></th>
                                <th><?php echo display('team_bonous')?></th>
                                <th><?php echo display('referral_bonous')?>%</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if($setup_commission != NULL){ 
                                foreach ($setup_commission as $key => $value) {  
                            ?>
                            <input type="hidden" name="id[]" value="<?php echo esc($value->level_id);?>">
                            <tr>
                                <td><input class="form-control" type="number" name="level[]" value="<?php echo esc($value->level_name);?>"></td>
                                <td><input class="form-control" type="number" name="personal_invest[]" value="<?php echo esc($value->personal_invest);?>"></td>
                                <td><input class="form-control" type="number" name="total_invest[]" value="<?php echo esc($value->total_invest);?>"></td>
                                <td><input class="form-control" type="number" name="team_bonous[]" value="<?php echo esc($value->team_bonous);?>"></td>
                                <td><input class="form-control" type="number" name="referral_bonous[]" value="<?php echo esc($value->referral_bonous);?>"></td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                    <button class="btn btn-success pull-right"> <?php echo display('update');?></button>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>