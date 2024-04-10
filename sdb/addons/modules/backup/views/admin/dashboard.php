<script type="text/javascript">
//<![CDATA[
	var html = '';

	//html = '<p class="blue ico ico_info"><?=lang('data_backup_dashboard')?><?php if (!empty($last_backup_date)) { ?>  (<?=lang('data_last_backup').' '.$last_backup_date?>)<?php } ?>.</p>';
	
	// put it in the notification bar
	//$('#notification').html(html);
//]]>
</script>
<?php

echo '<p class="blue ico ico_info">'.lang('data_backup_dashboard').'';

if (!empty($last_backup_date)) {
    echo lang('data_last_backup').$last_backup_date;
    }
    
echo '</p>';


?>
