<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-paycharge" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-paycharge" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="paycharge_status" id="input-status" class="form-control">
                <?php if ($paycharge_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><span data-toggle="tooltip" title="<?php echo $help_sort_order; ?>"><?php echo $entry_sort_order; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="paycharge_sort_order" value="<?php echo $paycharge_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
          <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left"><?php echo $column_rules; ?></td>
                <td class="text-left"><span data-toggle="tooltip" title="<?php echo $help_charge; ?>"><?php echo $column_charge; ?></span></td>
                <td class="text-left"><?php echo $column_description; ?></td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-left" style="width:30%;vertical-align:top;">
                  <select name="paycharge[0][payment_method]" class="form-control">
                    <?php foreach ($payments as $payment) { ?>
                    <?php if ($payment['code'] == $paycharge['payment_method']) { ?>
                    <option value="<?php echo $payment['code']; ?>" selected="selected"><?php echo $payment['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $payment['code']; ?>"><?php echo $payment['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </td>
                <td class="text-left" style="width:30%;vertical-align:top;">
                  <div class="input-group">
                    <span class="input-group-addon" style="min-width:40px;"><?php echo $entry_percentage[0]; ?></span>
                    <input type="text" name="paycharge[0][valuep]" value="<?php echo $paycharge['valuep']; ?>" placeholder="<?php echo $entry_percentage[1]; ?>" class="form-control" />
                  </div>
                </td>
                <td class="text-left" style="width:30%;vertical-align:top;">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span><input type="text" name="paycharge[0][description][<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($paycharge['description'][$language['language_id']]) ? $paycharge['description'][$language['language_id']]['name'] : ''; ?>" class="form-control" /></div>
                  <?php } ?>
                </td>
                <td class="text-left"><button type="button" onclick="upgrade();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3"></td>
                <td class="text-left"><button type="button" onclick="upgrade();" data-toggle="tooltip" title="<?php echo $button_paycharge_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
              </tr>
            </tfoot>
          </table>
          </div>
        </form>
      </div>
    </div>
    <div style="text-align:right;padding:0 20px;"><?php echo $fs_version; ?></div>
  </div>
</div>
<script type="text/javascript">
function upgrade() {
	var upPayCharge = confirm('Upgrade Your PayCharge to get all features!\n- More rules\n- Fixed Value\n- Tax Classes\n- More options');

	if (upPayCharge) {
		window.location.href = 'http://www.opencart.com/index.php?route=extension/extension&filter_username=fabiom7';
	}
}
</script>
<?php echo $footer; ?>