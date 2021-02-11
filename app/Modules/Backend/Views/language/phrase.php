  <div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <a class="mb-2 mr-2 btn btn-info text-white" href="<?php echo base_url("dashboard/language") ?>"> <i class="fa fa-list"></i>  Language List </a> 
                </div>
            </div>
            <div class="panel-body"> 

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td></td>

                        </tr>
                        <tr>
                            <td colspan="2">
                                <?php echo  form_open('dashboard/add_phrase', ' class="form-inline" ') ?> 
                                <div class="form-group">
                                    <label class="sr-only" for="addphrase"> Phrase Name</label>
                                    <input name="phrase[]" type="text" class="form-control" id="addphrase" placeholder="Phrase Name">
                                </div>

                                <button type="submit" class=" btn btn-success">Save</button>
                                <?php echo  form_close(); ?>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-th-list"></i></th>
                            <th>Phrase</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($phrases)) {?>
                            <?php $sl = 1 ?>
                            <?php foreach ($phrases as $value) {?>
                                <tr>
                                    <td><?php echo  $sl++ ?></td>
                                    <td><?php echo  $value['phrase'] ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td> </td>
                            
                        </tr>
                    </tfoot>
                </table>  
                <div class="d-flex justify-content-end .dataTables_wrapper">
                    <?php echo $pager->makeLinks((!empty($page_num)?$page_num:1), 10, (!empty($total_phrase->total)?$total_phrase->total:0), 'default_full') ?>
                </div>
            </div>
        </div>
    </div>
</div>