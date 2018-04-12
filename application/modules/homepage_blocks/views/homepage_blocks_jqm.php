
<?php
$count = 0;
$this->load->module('homepage_offers');
$this->load->module('site_settings');
$items_segments = $this->site_settings->_get_item_segments();
$currency_symbol = $this->site_settings->_get_currency_symbol();
foreach($query->result() as $row) {
$count++;
$block_id = $row->id;
$num_items_on_block = $this->homepage_offers->count_where('block_id', $block_id);
if ($num_items_on_block>0) {

      if ($count>4) {
        $count = 1; 
      }
      ?>
      <h3 class="ui-bar ui-bar-a"><?= $row->block_title ?></h3>
      <d
            <?php
            $block_data['block_id'] = $block_id;
            $block_data['item_segments'] = $items_segments;
            $block_data['currency_symbol'] = $currency_symbol;
            $this->homepage_offers->_draw_offers($block_data, TRUE);
            ?>

      <?php
      }

}
?>