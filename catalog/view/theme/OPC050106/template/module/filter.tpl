<div class="box sidebarFilter box-content">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="filterbox">
  <div class="list-group">
    <?php foreach ($filter_groups as $filter_group) { ?>
    <div class="list-group-item"><?php echo $filter_group['name']; ?></div>
    <div class="list-group-item">
      <div id="filter-group<?php echo $filter_group['filter_group_id']; ?>">
        <?php foreach ($filter_group['filter'] as $filter) { ?>
       <div>
	   <label>
		<div class="checkbox">
            <?php if (in_array($filter['filter_id'], $filter_category)) { ?>
            <input type="checkbox" name="filter[]" value="<?php echo $filter['filter_id']; ?>" checked="checked" />
            <?php echo $filter['name']; ?></div></label></div>
            <?php } else { ?>
           <div><label> <div class="checkbox">
 <input type="checkbox" name="filter[]" value="<?php echo $filter['filter_id']; ?>" />
            <?php echo $filter['name']; ?></div></label></div>
            <?php } ?>
          
        <?php } ?>
      </div>
    </div>
    <?php } ?> 
  <div class="panel-footer text-left">
    <button type="button" id="button-filter" class="btn btn-primary"><?php echo $button_filter; ?></button>
  </div>
   </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	filter = [];	
	$('input[name^=\'filter\']:checked').each(function(element) {
		filter.push(this.value);
	});
	location = '<?php echo $action; ?>&filter=' + filter.join(',');
});
//--></script> 
