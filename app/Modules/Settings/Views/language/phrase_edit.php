<?php $request = \Config\Services::request(); ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fs-17 font-weight-600 mb-0"> 
                    <a class="btn btn-success" href="<?php echo base_url("admin/setting/phrase") ?>"> <i class="fa fa-plus"></i> Add Phrase</a>
                </h6>
            </div>
            <div class="text-right">
                <div class="actions">
                    <a class="btn btn-primary" href="<?php echo base_url("admin/setting/language") ?>"> <i class="fa fa-list"></i>  Language List </a> 
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
       
        <?php echo form_open('admin/setting/search/'.$request->uri->setSilent()->getSegment(4)); ?>
            <div class="row mb-20">
                <div class="col-sm-7">
                    <input class="form-control" type="text" name="search_box" placeholder="Search Phrase OR Label" required>
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-info search-btn"><i class="fa fa-search-plus"></i></button>
                </div>
            </div>
        <?php echo form_close(); ?>

        <?php echo form_open('admin/setting/add-lebel') ?>
        <table class="table table-striped">
            <thead> 
                <tr>
                    <td colspan="3"> 
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </td>
                </tr>
                <tr>
                    <th><i class="fa fa-th-list"></i></th>
                    <th>Phrase</th>
                    <th>Label</th> 
                </tr>
            </thead>
            <tbody>
                <?php echo  form_hidden('language', $language) ?>
                <?php 
          
                    $sl = 1;
                    if (!empty($phrases)) {
                ?>
                  

                    <?php if($search_result){ ?>

                    <tr class="green-yellow">
                        <td class="pt-20"><?php echo  esc($sl++) ?></td>
                        <td class="pt-20 blink">
                           
                                <span class="search-text"><?php echo  esc($search_result->phrase) ?></span>
                                <input type="hidden" name="phrase[]" value="<?php echo  esc($search_result->phrase) ?>" class="form-control" readonly>
                           
                        </td>
                        <td><input type="text" name="lang[]" value="<?php echo  esc($search_result->$language) ?>" class="form-control"></td> 
                    </tr>

                    <?php } ?>

                    <?php foreach ($phrases as $value) { ?>
                
                        <?php if(!empty($search_lang_id) && $search_lang_id==$value->id){ continue; }?>
                        <tr class="<?php echo  (empty($value->$language)?"bg-danger":null) ?> ">
                            <td><?php echo  esc($sl++) ?></td>
                            <td><input type="text" name="phrase[]" value="<?php echo  esc($value->phrase) ?>" class="form-control" readonly></td>
                            <td><input type="text" name="lang[]" value="<?php echo esc($value->$language) ?>" class="form-control"></td> 
                        </tr>
                    <?php } } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="1"> 
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </td>
                    <td colspan="2">
                        <?php echo htmlspecialchars_decode($pager) ?>
                    </td>
                </tr>
            </tfoot>
        </table>
        <?php echo form_close() ?>
    </div>
</div>