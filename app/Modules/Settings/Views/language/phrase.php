<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fs-17 font-weight-600 mb-0">&nbsp;</h6>
            </div>
            <div class="text-right">
                <div class="actions">
                    <a class="btn btn-primary" href="<?php echo base_url("admin/setting/language") ?>"> <i class="fa fa-list"></i>  Language List </a> 
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
             
            <tr class="bnone">
                <?php echo form_open('admin/setting/add-phrase', ' class="form-inline" ') ?> 
                    <td width="300">
                        <div class="form-group">
                            <label class="sr-only" for="addphrase"><?php echo display('_phrase_name');?></label>
                            <input name="phrase[]" type="text" class="form-control" id="addphrase" placeholder="Phrase Name">
                        </div>
                    </td>
                    <td colspan="2"><button type="submit" class="btn btn-success btn-lg"><?php echo display('save');?></button></td>
                <?php echo form_close(); ?>
            </tr>
            <tr>
                <th><i class="fa fa-th-list"></i></th>
                <th><?php echo display('phrase');?></th> 
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($phrases)) {?>
                <?php $sl = 1 ?>
                <?php foreach ($phrases as $value) {?>
                <tr>
                    <td><?php echo $sl++ ?></td>
                    <td><?php echo esc($value->phrase) ?></td>
                </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr><td colspan="2"><?php echo htmlspecialchars_decode($pager) ?></td></tr>
        </tfoot>
      </table>
    </div>
</div>

