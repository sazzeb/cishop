 <div class="ui-body">
	<ul data-role="listview">
		<?php
		foreach($query->result() as $row) {
		$item_title = $row->item_title;
		$small_pic = $row->small_pic;
		$item_price = $row->item_price;
		$was_price = $row->was_price;
		$small_pic_path = base_url()."small_pics/".$small_pic;
		$item_page = base_url().$item_segments.$row->item_url;
		$item_price = number_format($row->item_price, 2);
		$item_price = str_replace('.00', '', $item_price);
    ?>
	    <li>
	    	<a href="<?= $item_page ?>" rel="external" class="cars" id="bmw">
	    		<img src="<?= $small_pic_path ?>" alt="<?= $item_title ?>">
	    			<h2><?= $item_title ?></h2>
				<p>Our Price <?= $currency_symbol.$item_price ?></p>
			</a>
		</li>
   <?php
}
?>
	</ul>
</div>



