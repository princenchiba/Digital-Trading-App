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
                           <a class="btn btn-success w-md m-b-5 pull-right" href="<?php echo base_url("admin/exchanger/cryptocoin-add") ?>"><i class="fa fa-plus" aria-hidden="true"></i> Coin</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table id="ajaxcointable" class="table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('coin_icon');?></th>                            
                            <th><?php echo display('coin_name');?></th>
                            <th><?php echo display('full_name');?></th>
                            <th><?php echo display('symbol');?></th>
                            <th><?php echo display('home_page/serial');?></th>
                            <th><?php echo display('rank');?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>    
                    <tbody>

                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>
