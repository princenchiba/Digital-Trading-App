<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <?php echo  form_open('dashboard/update_phrase') ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="languageList">

                        <thead>
                            <tr>
                                <th><i class="fa fa-th-list"></i></th>
                                <th>Phrase</th>
                                <th>Label</th> 
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="2"> 
                                    <button type="reset" class="btn btn-danger">Reset turan</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>

                    </table>
                    <input type="hidden" name="language_name" id="language" value="<?php echo $language;?>">
                </div>
                <?php echo form_close() ?>
                <input type="hidden" id="base_url" name="" value="<?php echo base_url();?>">
            </div>
        </div>
    </div>
</div>
