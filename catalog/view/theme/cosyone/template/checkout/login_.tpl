<div class="left">
<div class="content">
  <h2><?php echo $text_new_customer; ?></h2>
  <p><?php echo $text_checkout; ?></p>
  <label for="register">
    <?php if ($account == 'register') { ?>
    <input type="radio" name="account" value="register" id="register" checked="checked" />
    <?php } else { ?>
    <input type="radio" name="account" value="register" id="register" />
    <?php } ?>
    <?php echo $text_register; ?></label>
  <br />
  <?php if ($guest_checkout) { ?>
  <label for="guest">
    <?php if ($account == 'guest') { ?>
    <input type="radio" name="account" value="guest" id="guest" checked="checked" />
    <?php } else { ?>
    <input type="radio" name="account" value="guest" id="guest" />
    <?php } ?>
    <?php echo $text_guest; ?></label>
  <br />
  <?php } ?>
  <br />
  <p><?php echo $text_register_account; ?></p>
  </div>
  <input type="button" value="<?php echo $button_continue; ?>" id="button-account" class="button" />
   
</div>
<div id="login" class="right">
<div class="content form last">
  <h2><?php echo $text_returning_customer; ?></h2>
  <p><?php echo $text_i_am_returning_customer; ?></p>
  <div class="input_field_full">
  <b><?php echo $entry_email; ?></b>
  <input type="text" name="email" value="" />
  </div>
  <div class="input_field_full">
  <b><?php echo $entry_password; ?></b>
  <input type="password" name="password" value="" />
 </div>
 </div>
  <a href="<?php echo $forgotten; ?>" class="forgotten"><?php echo $text_forgotten; ?></a>
  <input type="button" value="<?php echo $button_login; ?>" id="button-login" class="button" /><br />
</div>