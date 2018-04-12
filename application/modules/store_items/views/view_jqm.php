<?php 

//echo Modules::run('templates/_draw_breadcrumbs',$breadcrumbs_data);
if(isset($flash))
{
	echo $flash;
}

?>
<style >
	.ui-bar{
		border:1px silver solid;
	}
</style>
<div class="ui-body">
	<h3 style="margin-top: 0px; margin-bottom: 4px;"><?= $item_title ?></h3>
	<div class="row">
		<div class="ui-grid-d">
		<img src="<?= base_url() ?>big_pics/<?= $big_pic ?>" width="100%">
					
		</div><!-- /grid-c -->
		<h2>Our Price <?= $currency_symbol.$item_price_desc ?></h2>
		   <div style="clear:both;">
		  <?= nl2br($item_description) ?>
		   </div>
	</div>
</div>