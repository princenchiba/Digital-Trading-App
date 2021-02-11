
<link href="<?php echo base_url('app/Modules/Addon/assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<!-- Add new link page start -->
        <?php view('template/messages'); ?>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <?php echo form_open('#', array('id' => 'purchase')); ?>
                        <div class="row" align="center">
                        <div class="col-md-12 col-md-offset-2">
                            <?php echo form_open('#', array('id' => 'purchase')); ?>
                            <div id="purchase_key_box" class="form-group has-success">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-3" for="purchase_key">Purchase Key</label>
                                    <input type="text" class="form-control form-control-success col-md-8" id="purchase_key" placeholder="Enter your purchase key">
                                </div>
                                <div class="form-feedback">Success! Almost done it.</div>
                                <small class="text-muted">You got a purchase key after purchasing this item</small>
                                <br>
                                <input type="hidden" name="itemtype" id="itemtype" value="module">
                            </div>
                            <div class="form-group">
                                <a href="<?php echo base_url('admin/addon'); ?>" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                                <button type="submit" class="btn btn-success" id="download_now">Download Now</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        </div>

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
<script src="<?php echo base_url().'/app/Modules/Addon/assets/ajaxs/addons/download.js' ?>"></script>

