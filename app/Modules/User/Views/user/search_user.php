<div class="row">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="card-body">
            <div class="row">
               <div class="col-sm-12">
                  <?php echo form_open("admin/user/user-details") ?>
                  <div class="form-group row">
                     <label for="user_id" class="col-sm-1 col-form-label font-weight-600 text-left">User ID: </label>
                     <div class="col-xs-2 col-sm-6 col-md-4">
                        <input name="user_id" class="form-control" type="search" id="user_id" value="<?php echo esc(@$user->user_id) ?>">
                     </div>
                     <div class="col-xs-2 col-sm-4 col-md-4 m-b-20">
                        <button type="submit" class="btn btn-success">Search</button>
                     </div>
                  </div>
                  <?php echo form_close() ?>
               </div>
            </div>
            <ul class="nav nav-pills mb-4 mt-3" id="pills-tab2" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="pills-home2-tab" data-toggle="pill" href="#tab1" role="tab" aria-controls="pills-home2" aria-selected="true"><?php echo display('user_profile') ?></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="pills-contact2-tab" data-toggle="pill" href="#tab2" role="tab" aria-controls="pills-contact2" aria-selected="false">Balance</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="pills-contact2-tab" data-toggle="pill" href="#tab3" role="tab" aria-controls="pills-contact2" aria-selected="false">Transaction Log</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="pills-contact2-tab" data-toggle="pill" href="#tab4" role="tab" aria-controls="pills-contact2" aria-selected="false">Trade History</a>
               </li>
            </ul>
            <div class="tab-content" id="pills-tabContent2">
               <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="pills-home2-tab">
                  
                     <table class="table table-bordered table-hover table-striped">
                        <tbody>
                           <tr>
                              <th width="200" class="text-right"><?php echo display('user_id') ?></th>
                              <th width="50" class="text-center">:</th>
                              <td class="text-left"><?php echo esc(@$user->user_id) ?></td>
                           </tr>
                           <tr>
                              <th width="200" class="text-right"><?php echo display('referral_id') ?></th>
                              <th width="50" class="text-center">:</th>
                              <td class="text-left"><?php echo esc(@$user->referral_id) ?></td>
                           </tr>
                           <tr>
                              <th width="200" class="text-right"><?php echo display('language') ?></th>
                              <th width="50" class="text-center">:</th>
                              <td class="text-left"><?php echo esc(@$user->language) ?></td>
                           </tr>
                           <tr>
                              <th width="200" class="text-right"><?php echo display('firstname') ?></th>
                              <th width="50" class="text-center">:</th>
                              <td class="text-left"><?php echo esc(@$user->first_name) ?></td>
                           </tr>
                           <tr>
                              <th width="200" class="text-right"><?php echo display('lastname') ?></th>
                              <th width="50" class="text-center">:</th>
                              <td class="text-left"><?php echo esc(@$user->last_name) ?></td>
                           </tr>
                           <tr>
                              <th width="200" class="text-right"><?php echo display('email') ?></th>
                              <th width="50" class="text-center">:</th>
                              <td class="text-left"><?php echo esc(@$user->email) ?></td>
                           </tr>
                           <tr>
                              <th width="200" class="text-right"><?php echo display('mobile') ?></th>
                              <th width="50" class="text-center">:</th>
                              <td class="text-left"><?php echo esc(@$user->phone) ?></td>
                           </tr>
                           <tr>
                              <th width="200" class="text-right"><?php echo display('registered_ip') ?></th>
                              <th width="50" class="text-center">:</th>
                              <td class="text-left"><?php echo esc(@$user->ip) ?></td>
                           </tr>
                           <tr>
                              <th width="200" class="text-right"><?php echo display('status') ?></th>
                              <th width="50" class="text-center">:</th>
                              <td class="text-left"><?php echo (esc(@$user->status)==1)?display('active'):display('inactive'); ?></td>
                           </tr>
                           <tr>
                              <th width="200" class="text-right">Registered Date</th>
                              <th width="50" class="text-center">:</th>
                              <td class="text-left">
                                 <?php 
                                    $date=date_create(@$user->created);
                                    echo date_format($date,"jS F Y");  
                                    ?>
                              </td>
                           </tr>
                        </tbody>
                     </table>
               </div>
               <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="pills-contact2-tab">
                  <table id="example" class="datatable1 table table-bordered table-hover table-striped">
                     <thead>
                        <tr>
                           <th><?php echo display('sl_no')?></th>
                           <th><?php echo display('name')?></th>
                           <th><?php echo display('balance')?></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $i=1;  foreach ($balance as $key => $value) { ?>
                        <tr>
                           <td><?php echo $i; ?></td>
                           <td>
                              <div class="d-flex marks-ico">
                                 <img src="<?php echo base_url("$value->image") ?>" alt="">
                                 <font><?php echo esc($value->symbol); ?></font>
                                 <span class="text-muted">(<?php echo esc($value->coin_name); ?>)</span>
                              </div>
                           </td>
                           <td><?php echo esc($value->balance); ?></td>
                        </tr>
                        <?php $i++; } ?>
                     </tbody>
                  </table>
               </div>
               <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="pills-disabled-tab">
                  <table class="datatable1 table table-bordered table-hover table-striped">
                     <thead>
                        <tr class="table-bg">
                           <th>SL</th>
                           <th>Transaction</th>
                           <th>Amount</th>
                           <th>Fees</th>
                           <th>Crypto/Dollar Currency</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $i=1;  foreach ($user_balanceLog as $key => $value) { ?>
                        <tr>
                           <td><?php echo $i ?></td>
                           <td><?php echo esc($value->transaction_type) ?></td>
                           <td><?php echo esc($value->transaction_amount) ?></td>
                           <td><?php echo esc($value->transaction_fees) ?></td>
                           <td>
                              <div class="d-flex marks-ico">
                                 <img src="<?php echo base_url("$value->image") ?>" alt="" >
                                 <font><?php echo esc($value->symbol); ?></font>
                                 <span class="text-muted">(<?php echo esc($value->coin_name); ?>)</span>
                              </div>
                           </td>
                        </tr>
                        <?php $i++; } ?>
                     </tbody>
                  </table>
               </div>
               <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="pills-disabled-tab">
                  <div id="user_tradelist"></div>
                  <span id="pagination_link"></span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>