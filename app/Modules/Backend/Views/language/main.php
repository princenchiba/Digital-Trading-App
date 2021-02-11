  <div class="row">
            <div class="col-sm-12">
                <div class="card card-bd lobidrag">
                    <div class="card-header">
                        <div class="card-title">
                             <a class="btn btn-success text-white" href="<?php echo base_url("dashboard/phrases") ?>"> <i class="fa fa-plus"></i> Add Phrase</a> 
                        </div>
                    </div>
             <div class="card-body">

                <!-- language -->  
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td colspan="3">
                                <?php echo  form_open('dashboard/add_language', ' class="form-inline" ') ?> 
                                    <div class="form-group">
                                        <label class="sr-only" for="addLanguage"> Language Name</label>
                                        <input name="language" type="text" class="form-control" id="addLanguage" placeholder="Language Name">
                                    </div>
                                      
                                    <button type="submit"  class="form-control btn btn-success">Save</button>
                                <?php echo  form_close(); ?>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-th-list"></i></th>
                            <th>Language</th>
                            <th><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>


                    <tbody>
                      <?php if (!empty($languages)) {?>
                            <?php $sl = 1 ?>
                            <?php foreach ($languages as $key => $language) {?>
                            <tr>
                                <td><?php echo  $sl++ ?></td>
                                <td><?php echo  $language ?></td>
                                <td><a href="<?php echo  base_url("dashboard/edit_phrase/$key") ?>" class="btn-icon btn btn-info"><i class="fa fa-edit"></i></a>  
                                </td> 
                            </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody> 
                </table>  
  
 
            </div>
        </div>
    </div>
</div>

