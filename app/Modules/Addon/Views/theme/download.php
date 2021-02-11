<link href="<?php echo base_url('app/Modules/Addon/assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<!-- Add new link page start -->
       <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 font-weight-600 mb-0"><?php echo (!empty($title)?$title:null) ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                   <a href="<?php echo base_url('admin/addon/theme')?>" class="btn btn-success"><i class="ti-align-justify"> </i> <?php echo display('themes')?></a> 
                                    <a href="" class="action-item"><i class="ti-reload"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>            
                    <div class="card-body">
                          <?php echo form_open('#', array('id' => 'purchase')); ?>
                        <div class="row" align="center">
                            <div class="col-md-12 col-md-offset-2">
                                
                                <div id="purchase_key_box" class="form-group has-success">
                                    <div class="form-group row">
                                        <label class="form-control-label col-md-3" for="purchase_key">Purchase Key</label>
                                        <input type="text" class="form-control form-control-success col-md-8" id="purchase_key" placeholder="Enter your purchase key">
                                   
                                    </div>
                                     <div class="form-feedback">Success! Almost done it.</div>
                                    <small class="text-muted">You got a purchase key after purchasing this item</small>
                                    <br>
                                    <input type="hidden" name="itemtype" id="itemtype" value="theme">
                                </div>
                                <div class="form-group">
                                    <a href="<?php echo base_url('admin/addon/theme'); ?>" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                                    <button type="submit" class="btn btn-success" id="download_now">Download Now</button>
                                </div>
                                
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                        <div id="loading" class="text-center none">
                            <img id="loading-image" src="<?php echo base_url('app/Modules/Addon/assets/img/load.gif')?>" alt="Loading..." width="100"  />
                        </div>
                        <div class="row waitmsg none">
                            <div class="col-md-12">
                                <h3 class="text-center">Downloading... Please wait for <span id="wait"> 20</span> Seconds.</h3>
                            </div> 
                        </div>
            
                    </div>
                </div>
            </div>
        </div>


<script src="<?php echo base_url().'/app/Modules/Addon/assets/ajaxs/addons/download_theme.js' ?>"></script>
