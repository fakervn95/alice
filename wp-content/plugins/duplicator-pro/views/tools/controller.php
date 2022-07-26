<?php
defined("ABSPATH") or die("");
DUP_PRO_Handler::init_error_handler();
DUP_PRO_U::hasCapability('manage_options');

global $wpdb;
$global = DUP_PRO_Global_Entity::get_instance();

//COMMON HEADER DISPLAY
require_once(DUPLICATOR_PRO_PLUGIN_PATH.'/assets/js/javascript.php');
require_once(DUPLICATOR_PRO_PLUGIN_PATH.'/views/inc.header.php');

$current_tab = isset($_REQUEST['tab']) ? sanitize_text_field($_REQUEST['tab']) : 'diagnostics';
if ('d' == $current_tab) {
    $current_tab = 'diagnostics';
}
?>

<style>
    div.dpro-sub-tabs {padding: 10px 0 10px 0; font-size: 14px}
</style>

<div class="wrap">
    <?php duplicator_pro_header(DUP_PRO_U::__("Tools")) ?>

    <h2 class="nav-tab-wrapper">
        <a href="?page=duplicator-pro-tools&tab=diagnostics" class="nav-tab <?php echo ($current_tab == 'diagnostics') ? 'nav-tab-active' : '' ?>"> <?php DUP_PRO_U::esc_html_e('Diagnostics'); ?></a>
        <a href="?page=duplicator-pro-tools&tab=templates" class="nav-tab <?php echo ($current_tab == 'templates') ? 'nav-tab-active' : '' ?>"> <?php DUP_PRO_U::esc_html_e('Templates'); ?></a>
        <?php if (!DUP_PRO_CTRL_import_installer::isDisallow()) { ?>
            <a href="?page=duplicator-pro-tools&tab=import" class="nav-tab <?php echo ($current_tab == 'import') ? 'nav-tab-active' : '' ?>"> <?php DUP_PRO_U::esc_html_e('Import'); ?></a> 
            <?php
        }
        if (!DUP_PRO_CTRL_recovery::isDisallow()) {
            ?> 
            <a href="<?php echo esc_url(DUP_PRO_CTRL_recovery::getRecoverPageLink()); ?>" class="nav-tab <?php echo ($current_tab == 'recovery') ? 'nav-tab-active' : '' ?>"> <?php DUP_PRO_U::esc_html_e('Recovery'); ?></a>
        <?php } ?>
    </h2> 	

    <?php
    switch ($current_tab) {
        case 'import':
            DUP_PRO_CTRL_import::controller();
            break;
        case 'templates':
            include(dirname(__FILE__).'/templates/main.php');
            break;
        case 'diagnostics':
            include(dirname(__FILE__).'/diagnostics/main.php');
            break;
        case 'recovery':
            DUP_PRO_CTRL_recovery::controller();
            break;
    }
    ?>
</div>
<?php
require_once DUPLICATOR_PRO_PLUGIN_PATH.'/views/parts/ajax-loader.php';
