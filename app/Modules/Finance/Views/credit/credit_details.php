<?php
  $session = session();
  $uri = current_url(true);
  $total_segment = $uri->getTotalSegments();

  $segment_1 = (($total_segment == 1)?$uri->getSegment(1):'');
  $segment_2 = (($total_segment == 2)?$uri->getSegment(2):'');
  $segment_3 = (($total_segment == 3)?$uri->getSegment(3):'');
  $segment_4 = (($total_segment == 4)?$uri->getSegment(4):'');
  $segment_5 = (($total_segment == 5)?$uri->getSegment(5):'');

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body"  id="printableArea">
                <div class="row">
                    <div class="col-sm-6">
                        <img src="<?php echo base_url(!empty($settings->logo)?$settings->logo:"assets/images/icons/logo.png"); ?>" class="img-responsive" alt="">
                        <br>
                        <address>
                            <strong><?php echo esc($settings->title) ?></strong><br>
                            <?php echo htmlspecialchars_decode($settings->description);?><br>
                            
                        </address>
                        
                    </div>
                    <div class="col-sm-6 text-right">
                        <h1 class="m-t-0">Credit No : <?php echo $segment_5; ?></h1>
                        <div><?php echo date('d-M-Y');?></div>
                        <address>
                            <strong><?php echo esc($credit_info->first_name).' '.esc($credit_info->last_name);?></strong><br>
                            <?php echo esc($credit_info->email); ?><br>
                            <?php echo esc($credit_info->phone); ?><br>
                            <abbr title="Phone"><?php echo display('account')?> :</abbr> <?php echo esc($credit_info->user_id) ;?>
                        </address>
                    </div>
                </div> <hr>
               
                    <table class="table table-border table-bordered ">
                        <thead>
                            <tr>
                                <th><?php echo display('user_id')?></th>
                                <th><?php echo display('amount')?></th>
                                <th><?php echo display('date')?></th>
                                <th><?php echo display('comments')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div><strong><?php echo esc(@$credit_info->user_id);?></strong></div>
                                <td><?php echo esc(@$credit_info->currency_symbol)." ".esc(@$credit_info->amount);?></td>
                                <td><?php echo esc(@$credit_info->deposit_date);?></td>
                                <td><?php echo esc(@$credit_info->comment);?></td>
                            </tr>
                           
                        </tbody>
                    </table>
                    <?php 
                        if (!esc(@$credit_info->user_id)) {
                            echo "<h1>User Not Found !!!</h1>";
                        }  
                    ?>                 
               
            </div>

            <div class="panel-footer text-right pr-4 pb-4">
               <button type="button" class="btn btn-info" onclick="printContent('printableArea')"><span class="fa fa-print"></span></button>
            </div>
        </div>
    </div>
</div>
