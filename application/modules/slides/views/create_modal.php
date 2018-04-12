<p style="margin-top: 30px;">


<a href="<?= base_url() ?>slides/create/<?= $parent_id ?>"><button type="button" class="btn btn-default">Previous Page</button></a>


<!-- Button to trigger modal -->
<a href="#myModal" role="button" class="btn btn-info" data-toggle="modal">Create New Slides</a>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Create Slides</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" action="<?= $form_location ?>" method="post">
    <p>
    <div class="control-group">
      <label class="control-label" for="typeahead">Target Url</label>
      <div class="controls">
        <input type="text" class="span6" name="target_url" placeholder="Enter the Target Url here">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="typeahead">Subject</label>
      <div class="controls">
        <input type="text" class="span6" name="alt_text" placeholder="Enter the Alt_text here">
      </div>
    </div>         

    </p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" name="submit" value="Submit" type="text">Submit</button>
  </div>
  <?php
  echo form_hidden('parent_id', $parent_id);
  ?>
  </form>  
</div>




</p>