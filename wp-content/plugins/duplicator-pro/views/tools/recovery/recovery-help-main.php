<?php
defined('ABSPATH') || defined('DUPXABSPATH') || exit;
?>
<h3><?php DUP_PRO_U::esc_html_e('Recovery Point Description'); ?></h3>
<p>
    <?php DUP_PRO_U::esc_html_e('The Recovery Point is a special package that allows one to quickly revert the system should it become corrupted during a maintenance operation such as a plugin/theme update or an experimental file change.'); ?>
</p>
<p>
    <?php DUP_PRO_U::esc_html_e('The advantage of setting a Recovery Point is that you can very quickly restore a backup without having to worry about uploading a package and setting the parameters such as database credentials or site paths.'); ?>
</p>


<h3><?php DUP_PRO_U::esc_html_e('Using the Recovery Point'); ?></h3>
<p>
    <?php DUP_PRO_U::esc_html_e('There can only be a single Recovery Point defined at any one time and must be associated with a package that retains all WordPress core files and all database tables.'); ?>
</p>
<p>
    <?php DUP_PRO_U::esc_html_e('When you set a Recovery Point, the chosen package is prepared and a special URL (the "Recovery URL") is generated.'); ?>
</p>
<p>
    <?php DUP_PRO_U::esc_html_e('The Recovery URL in turn, is used to launch a streamlined installer which will restore the system quickly in the event of a system catastrophe.'); ?>
</p>
