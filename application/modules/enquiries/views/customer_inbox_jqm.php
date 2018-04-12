<div class="ui-body ui-body-a ui-corner-all">
<?php
if (isset($flash)) {
  echo $flash;
}
  $this->load->module('site_settings');
  $this->load->module('store_accounts');
  $this->load->module('timedate');
  $team_name = $this->site_settings->_get_support_team_name();
$create_msg_url = base_url()."yourmessages/create";

?>
	<h3>Your Inbox </h3>
	<?php 
		foreach($query->result() as $row) {

          $view_url = base_url()."yourmessages/view/".$row->code;

          $customer_data['firstname'] = $row->firstname;
          $customer_data['lastname'] = $row->lastname;
          $customer_data['company'] = $row->company;
          $opened = $row->opened;
          if ($opened==1) {
            $icon = 'background-color: gray';
          } else {
            $icon = 'background-color: orange';
          }

          $date_sent = $this->timedate->get_nice_date($row->date_created, 'mini');

          if ($row->sent_by==0) {
            $sent_by = $team_name;
          } else {
            $sent_by = $this->store_accounts->_get_customer_name($row->sent_by, $customer_data);
          }
      ?>

	<table>
		<tr>
			<td><a href="<?= $view_url ?>" style="<?= $icon ?>;" class="ui-btn ui-shadow ui-corner-all ui-icon-mail ui-btn-icon-notext">Open</a></td>
			<td style="padding-left: 15px;padding-bottom: 15px;">
				<p>
					<b><a href="<?= $view_url ?>"><?= $row->subject ?></a></b>
					<br><?= $date_sent ?><br>
					<span style="font-size: 0.6em;"><?= $row->message ?></span>
				</p>
			</td>
		</tr>
		<?php
      }
      ?>
	</table>
</div>