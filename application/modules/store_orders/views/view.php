<h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
if (isset($flash)) {
  echo $flash;
}
?>

<p>
  <a href="" style="text-align: right;">
    <button class="btn btn-info" >
      View Invioces
    </button>
  </a>
</p>

<?php

  echo Modules:: run('paypal/_display_summary_info', $paypal_id);
    // for options of Upload image ,Order Status Option color ,Order Status Option size ,Order Status Option catagories,delete Order Status Option
if (is_numeric($update_id)) { ?>
<div class="row-fluid sortable">
  <div class="box span12">
      <div class="box-header" data-original-title>
          <h2><i class="halflings-icon white edit"></i><span class="break"></span>Order Status <?= $status_title ?></h2>
          <div class="box-icon">
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
          </div>
      </div>
      <div class="box-content">
      		<p>To update an order please choose an option from status option and hit the submit button</p>
        <?php
          $form_location = base_url()."store_orders/submit_order_status/".$update_id;
          ?>
            <form class="form-horizontal" method="post" action="<?= $form_location ?>">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="typeahead">Order Status</label>
                  <div class="controls">
                    <?php
                    $additional_dd_code = 'id="selectError3"';
                    echo form_dropdown('order_status', $options, $order_status, $additional_dd_code);
                    ?>

                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                  <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
                </div>
              </fieldset>
            </form>   
       </div>
  </div><!--/span-->
</div><!--/row-->
<?php
}
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span>Order Status </h2>
            <div class="box-icon">
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
        <p style="text-align: right;"><a href="<?= base_url() ?>store_accounts/create/<?= $shopper_id ?>">
          <button type="button" class="btn btn-info">Edit Account Details</button>
        </a></p>
        <table class="table table-striped table-bordered">
        	<tr>
        		<td class="span3">Firstname</td>
        		<td><?= $store_accounts_data['firstname']?></td>
        	</tr>
        	<tr>
        		<td>lastname</td>
        		<td><?= $store_accounts_data['lastname']?></td>
        	</tr>
        	<tr>
        		<td>Company</td>
        		<td><?= $store_accounts_data['company']?></td>
        	</tr>
        	<tr>
        		<td>Phone Number</td>
        		<td><?= $store_accounts_data['telnum']?></td>
        	</tr>
        	<tr>
        		<td>Email Address</td>
        		<td><?= $store_accounts_data['email']?></td>
        	</tr>
        	<tr>
        		<td style="valign: top;">Customer Address</td>
        		<td style="valign: top;"><?= $customer_address ?></td>
        	</tr>
        </table>
        </div>
    </div><!--/span-->

</div><!--/row-->
<?php
$user_type = 'admin';
echo Modules::run('cart/_draw_cart_contents', $query_cc, $user_type);
