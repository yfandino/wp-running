<?php ShareaholicAdmin::show_header(); ?>
<div class='wrap'>
  <h2><?php _e('Advanced Settings', 'shareaholic'); ?></h2>
  <div style="margin-top:10px;"></div>
  
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <?php echo sprintf(__('You rarely should need to edit the settings on this page.', 'shareaholic')); ?> <?php _e('After changing any Shareaholic advanced setting, it is good practice to clear any WordPress caching plugins (if you are using one, like W3 Total Cache or WP Super Cache).', 'shareaholic'); ?>
      
        <form name='advanced_settings' method='post' action='<?php echo $action ?>'>
        <?php wp_nonce_field($action, 'nonce_field') ?>
        <input type='hidden' name='already_submitted' value='Y'>
          <div class='clear'>
            <div class="app">
              <h2><?php _e('Advanced', 'shareaholic'); ?></h2>
              <p class="app-content">
                <input type='checkbox' id='og_tags' name='shareaholic[disable_og_tags]' class='check'
                  <?php if (isset($settings['disable_og_tags'])) { ?>
                    <?php echo ($settings['disable_og_tags'] == 'on' ? 'checked' : '') ?>
                    <?php } ?>>
                  <label class="font-normal" for="og_tags"> <?php echo sprintf(__('Disable <code>Open Graph</code> tags', 'shareaholic')); ?> <?php echo sprintf(__('(it is recommended NOT to disable open graph tags)', 'shareaholic')); ?></label>
                  <br />
                <input type='checkbox' id='admin_bar' name='shareaholic[disable_admin_bar_menu]' class='check'
                  <?php if (isset($settings['disable_admin_bar_menu'])) { ?>
                    <?php echo ($settings['disable_admin_bar_menu'] == 'on' ? 'checked' : '') ?>
                    <?php } ?>>
                  <label class="font-normal" for="admin_bar"> <?php echo sprintf(__('Disable Admin Bar Menu (requires page refresh)', 'shareaholic')); ?></label>
                <br/>
                <input type='checkbox' id='debugger' name='shareaholic[disable_debug_info]' class='check'
                  <?php if (isset($settings['disable_debug_info'])) { ?>
                    <?php echo ($settings['disable_debug_info'] == 'on' ? 'checked' : '') ?>
                    <?php } ?>>
                  <label class="font-normal" for="debugger"> <?php echo sprintf(__('Disable Debugger (it is recommended NOT to disable the debugger)', 'shareaholic')); ?></label>
                <br/>
                <input type='checkbox' id='share_counts' name='shareaholic[disable_internal_share_counts_api]' class='check'
                  <?php if (isset($settings['disable_internal_share_counts_api'])) { ?>
                    <?php echo ($settings['disable_internal_share_counts_api'] == 'on' ? 'checked' : '') ?>
                    <?php } ?>>
                  <label class="font-normal" for="share_counts"> <?php echo sprintf(__('Disable server-side Share Counts API', 'shareaholic')); ?> <?php echo sprintf(__('(This GDPR feature uses server resources. When "enabled" share counts will appear for <a href="https://github.com/shareaholic/shareaholic-api-docs/blob/master/api_share.md" target="_blank">additional social networks</a>.)', 'shareaholic')); ?></label>
                <p>
                  <input type='submit' class="btn btn-primary btn-medium" onclick="this.value='<?php echo sprintf(__('Saving Changes...', 'shareaholic')); ?>';" value='<?php echo sprintf(__('Save Changes', 'shareaholic')); ?>'>
                </p>
              </p>
            </div>
          </div> 
        </form>
    
        <div class='clear'></div>  
    
        <div class="app">
          <h2><?php _e('Server Connectivity', 'shareaholic'); ?></h2>
          <p class="app-content">
          <?php if (ShareaholicUtilities::connectivity_check() == "SUCCESS") { ?>
            <span class="key-status passed"><i class="fa fa-circle" aria-hidden="true" class="green"></i> <?php  _e('All Shareaholic servers are reachable', 'shareaholic'); ?></span>
            <p class="key-description"><?php _e('Shareaholic should be working correctly.', 'shareaholic'); ?> <?php _e('All Shareaholic servers are accessible.', 'shareaholic'); ?></p>  
          <?php } else { // can't connect to any server ?>
            <span class="key-status failed"><i class="fa fa-circle" aria-hidden="true" class="red"></i> <?php _e('Unable to reach any Shareaholic server', 'shareaholic'); ?></span> <a href="#" onClick="window.location.reload(); this.innerHTML='<?php _e('Checking...', 'shareaholic'); ?>';"><?php _e('Re-check', 'shareaholic'); ?></a>
            <p class="key-description"><?php echo sprintf( __('A network problem or firewall is blocking all connections from your web server to Shareaholic.com.  <strong>Shareaholic cannot work correctly until this is fixed.</strong>  Please contact your web host or firewall administrator and give them <a href="%s" target="_blank">this information about Shareaholic and firewalls</a>. Let us <a href="#" onclick="%s">know</a> too, so we can follow up!'), 'http://blog.shareaholic.com/shareaholic-hosting-faq/', 'SnapEngage.startLink();','</a>'); ?></p>
          <?php } ?>
          </p>
          <p>
          <?php if (ShareaholicUtilities::share_counts_api_connectivity_check() == 'SUCCESS') { ?>
            <span class="key-status passed"><i class="fa fa-circle" aria-hidden="true" class="green"></i> <?php  _e('Server-side Share Counts API is reachable', 'shareaholic'); ?></span>
            <p class="key-description"><?php _e('The server-side Share Counts API should be working correctly.', 'shareaholic'); ?> <?php _e('All servers and services needed by the API are accessible.', 'shareaholic'); ?></p>
          <?php } else { // can't connect to any server ?>
            <span class="key-status failed"><i class="fa fa-circle" aria-hidden="true" class="red"></i> <?php _e('Unable to reach the server-side Share Count API', 'shareaholic'); ?></span> <a href="#" onClick="window.location.reload(); this.innerHTML='<?php _e('Checking...', 'shareaholic'); ?>';"><?php _e('Re-check', 'shareaholic'); ?></a>
            <p class="key-description"><?php echo sprintf( __('A network problem or firewall is blocking connections from your web server to various Share Count APIs.  <strong>The API cannot work correctly until this is fixed.</strong>  If you continue to face this issue, please contact <a href="#" onclick="%s">us</a> and we will follow up! In the meantime, if you disable the server-side Share Counts API from the Advanced options above, Shareaholic will default to using client-side APIs for share counts successfully -- so nothing to worry about!'), 'SnapEngage.startLink();'); ?></p>
          <?php } ?>
          </p>
        </div>
    
        <div class='clear'></div>
    
        <div class="app">
          <h2><?php _e('Your Shareaholic Site ID', 'shareaholic'); ?></h2>
          <p class="app-content">
            <?php if (ShareaholicUtilities::get_option('api_key')){
              echo '<code style="font-size: 16px;">'.ShareaholicUtilities::get_option('api_key').'</code>';
            } else {
              _e('Not set.', 'shareaholic');
            } ?>
          </p>
        </div>
    
        <div class='clear'></div>
    
        <form name='reset_settings' method='post' action='<?php echo $action ?>'>
          <?php wp_nonce_field($action, 'nonce_field') ?>
          <input type='hidden' name='reset_settings' value='Y'>
          <div class="app">
            <h2><?php _e('Reset Plugin', 'shareaholic'); ?></h2>
            <p class="app-content">
              <?php _e('This will reset all of your settings and start you from scratch. This can not be undone.', 'shareaholic'); ?>
              <p>
                <input class="btn btn-danger btn-medium" type='submit' onclick="this.value='<?php _e('Resetting Plugin...', 'shareaholic'); ?>';" value='<?php _e('Reset Plugin', 'shareaholic'); ?>'>
              </p>
            </p>  
          </div>
      
          <div class='clear' style="padding-bottom:15px;"></div>
      
        </form>
      </div>
    </div>
  </div>
</div>

<?php ShareaholicAdmin::show_footer(); ?>
<?php ShareaholicAdmin::include_snapengage(); ?>