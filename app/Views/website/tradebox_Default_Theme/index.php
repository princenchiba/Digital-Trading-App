<?php echo view('website/'.$addTemplate->name.'/header') ?>
<?php
    try{

        $path               = 'App\Modules\"'.$module.'"\Views\"'.$page.'"';
        $withourbackpath    = str_replace('/\/', '/', $path);
        $viewpath           = str_replace('"', '', $withourbackpath);
        echo view($viewpath);

    } catch (Exception $e){
        
        echo "<pre><code>$e</code></pre>";
    }
?>
<?php echo view('website/'.$addTemplate->name.'/footer') ?>