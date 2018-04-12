 <?php 
    $first_bit = $this->uri->segment(1);
 ?>
 <div class="ui-body">
	<ul data-role="listview">
		<?php
            $grand_total = 0;
            foreach($query->result() as $row) {
                $sub_total = $row->price*$row->item_qty;
                $sub_total_desc = number_format($sub_total, 2);
                $grand_total = $grand_total+$sub_total;
            ?>

            <li>
	    	<a href="" class="caes" id="bmfw">
	    			<?php
                    if ($row->small_pic!='') { ?>
                        <img src="<?= base_url(); ?>small_pics/<?= $row->small_pic ?>">
                    <?php
                    } else {
                        echo "No image preview available";
                    }
                    ?>
	    			<h2><?= $row->item_title ?></h2><br>
	    			Item Number: <?= $row->item_id ?><br>
	    			Item Price: <?= $currency_symbol.$row->price ?><br>
	    			QUANTITY: <?= $row->item_qty ?><br>
				<p><?= $currency_symbol.$sub_total_desc ?></p>
			</a>
		</li>
		<?php
            }
          ?>
	</ul>
</div>

<div class="ui-body ui-body-a ui-corner-all">
	<p>Sum Total: <?= $currency_symbol.$sub_total_desc ?></p>
	<p>Shipping: <?php
	    $grand_total = $grand_total+$shipping;
	    ?></p>
	 <p>
	 Grand Total: <?php
       $grand_total_desc = number_format($grand_total, 2);
        echo $currency_symbol.$grand_total_desc;
        ?></p>
</div>





