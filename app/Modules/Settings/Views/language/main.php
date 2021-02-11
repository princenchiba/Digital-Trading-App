<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fs-17 font-weight-600 mb-0">&nbsp;</h6>
            </div>
            <div class="text-right">
                <div class="actions">
                    <a class="btn btn-success" href="<?php echo base_url("admin/setting/phrase") ?>"> <i class="fa fa-plus"></i> Add Phrase</a> 
                </div>
            </div>
        </div>
    </div>
    <div class="card-body"> 
      <table class="table table-striped">
        <thead>
            <tr class="bnone" >
                <?php echo form_open('admin/setting/add-language', 'class="form-inline"') ?> 
                <td width="300">
                    <div class="form-group">
                        <label class="sr-only" for="addLanguage"> <?php echo display('language_name');?></label>
                        <input name="language" type="text" class="form-control" id="addLanguage" placeholder="Language Name">
                    </div>
                </td>
                <td colspan="2" ><button type="submit" class="btn btn-primary btn-lg lge-btn"><?php echo display('save');?></button></td>
                <?php echo form_close(); ?>
            </tr>
            <tr>
                <td><i class="fa fa-th-list"></i></td>
                <td><?php echo display('language');?></td>
                <td><i class="fa fa-cogs"></i></td>
            </tr>
            
        </thead>

        <tbody>

            <?php 
                if (!empty($languages)) { 
                $sl = 1; foreach ($languages as $key => $language) {
            ?>
                <tr>
                    <td><?php echo $sl++ ?></td>
                    <td><?php echo esc($language) ?></td>
                    <td><a href="<?php echo base_url("admin/setting/edit-phrase/$key") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>  
                    </td> 
                </tr>
                <?php } } ?>
        </tbody>
      </table>
    </div>
  
</div>

