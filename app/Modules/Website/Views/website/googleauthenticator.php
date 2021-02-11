        <div class="authenticator">
            <!-- alert message -->
            <?php if ($session->get('message') != null) {  ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $session->get('message'); ?>
            </div> 
            <?php } ?>
                
            <?php if ($session->get('exception') != null) {  ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $session->get('exception'); ?>
            </div>
            <?php } ?>
            <?php echo form_open('googleauth','id="googleauth" '); ?>
                <h5>1. <?php echo display('install_google_authentication'); ?> <a target="_blank" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2">(Install here)</a> OR <a target="_blank" href="https://chrome.google.com/webstore/detail/authenticator/bhghoamapcdpbohphigoooaddinpkbai?hl=en-US">Chrome Extension</a> OR <a target="_blank" href="https://addons.mozilla.org/en-US/firefox/addon/auth-helper/">Firefox Add-ons</a> OR <a target="_blank" href="https://www.microsoft.com/en-bd/p/authenticator-extension/9p0fd39wffmk?ocid=badge&rtc=1#activetab=pivot:overviewtab">Microsoft(edge)</a></h5>
                <h5>2. <?php echo display('scan_this_barcode_using'); ?><?php echo display('google_authentication'); ?></h5>
                <div class="qr-code-scan">
                    <img src="<?php echo esc($qrCodeUrl) ?>" class="img-fluid" alt="">
                </div>
                <p><?php display('if_you_are_unable_to_scan_the_qr_code_please_enter_this_code_manually_into_the_app') ?></p>
                <div class="qr-code"><?php echo esc($secret) ?></div>
                <h5>3. <?php echo display('auth_code'); ?></h5>
                <div class="form-group">
                    <input type="text" class="form-control" id="token" name="token" aria-describedby="token" placeholder="123 456" required>
                    <input type="hidden" value="<?php echo esc($secret) ?>" name="secret"> 
                </div>
                <button type="submit" class="btn btn-kingfisher-daisy" name="<?php echo (esc($btnenable)==0)?'disable':'enable'; ?>" class="btn btn-block btn-kingfisher-daisy"><?php echo (esc($btnenable)==0)?'Disable':'Enable'; ?></button>
            <?php echo form_close();?>
        </div>
        <!-- /.End of authenticator -->