<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0"></h6>
                    </div>
                    <div class="text-right">
                        <div class="actions">
                            <a href="#" class="action-item"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="border_preview">
                        <?php echo form_open_multipart("admin/cms/web-language-list") ?>
                        <?php echo form_hidden('id', $language->id) ?> 
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label font-weight-600"><?php echo display('name') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-10">
                                <input name="name" value="<?php echo htmlspecialchars($language->name) ?>" class="form-control" placeholder="Ex: French" type="text" id="name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="flag" class="col-sm-2 col-form-label font-weight-600"><?php echo display('flag') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-10">
                                <input name="flag" value="<?php echo strtolower($language->flag) ?>" class="form-control" placeholder="<?php echo display('for_flag_use_country_code_bellow_table') ?>" type="text" id="flag">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label font-weight-600"></label>
                            <div class="col-sm-10">
                                <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                                <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo display("update"); ?></button>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('code') ?></th>
                            <th><?php echo display('name') ?></th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php  $sl = 1; foreach ($country as $v) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td> 
                                <td><?php echo strtolower(esc($v->iso)); ?></td>
                                <td><?php echo ucwords(strtolower(esc($v->name))); ?></td>
                            </tr>
                        <?php } ?>  
                    </tbody>
                </table>
                <?php echo htmlspecialchars_decode($pager) ?>
            </div>
        </div>
    </div>
</div>