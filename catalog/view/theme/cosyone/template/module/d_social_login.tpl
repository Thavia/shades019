
<?php if (!$islogged) { ?>

<style>
<?php foreach($providers as $provider){ ?>
#dsl_<?php echo $provider['id']; ?>_button{
  border:1px solid <?php echo $provider['background_color']; ?>;
  color: <?php echo $provider['background_color']; ?>;
}
#dsl_google_button:active{
  background: <?php echo $provider['background_color_active']; ?>;
}
<?php } ?>

#d_social_login .dsl-button{
  font-size: 16px;
  text-decoration: none;
  display: inline-block;
  box-sizing: border-box;
  margin: 2px 4px 2px 0px;
  margin-bottom: 5px;
  padding:0px;
}

#d_social_login .dsl-button.dsl-button-medium .l-side,
#d_social_login .dsl-button .l-side{
  padding: 5px 5px 0px 5px;
  background-color: #fff;
  display: inline-block;
  font-size: 17px;
  vertical-align: middle;
  box-sizing: border-box;
  position: relative;
}
#d_social_login .dsl-button.dsl-button-medium .r-side,
#d_social_login .dsl-button .r-side{
  padding: 6px 10px 6px 10px;
  display: inline-block;
  font-size: 12px;
  vertical-align: middle;
  box-sizing: border-box;
}
#d_social_login .dsl-button.dsl-button-huge .l-side {
  font-size: 26px;
  padding: 8px 10px 0px 8px;
}
#d_social_login .dsl-button.dsl-button-huge .r-side {
  font-size: 15px;
  padding: 12px 20px 11px 20px;
}
#d_social_login .dsl-button.dsl-button-large .l-side {
  font-size: 20px;
  padding: 6px 6px 0px 6px;
}
#d_social_login .dsl-button.dsl-button-large .r-side {
  font-size: 13px;
  padding: 8px 16px 7px 16px;
}
#d_social_login .dsl-button.dsl-button-small .l-side {
  font-size: 14px;
  padding: 4px 4px 0px 4px;
}
#d_social_login .dsl-button.dsl-button-small .r-side {
  font-size: 10px;
  padding: 4px 5px 3px 5px;
}

#d_social_login .dsl-button.dsl-button-icons .l-side {
  font-size: 17px;
  padding: 5px 5px 0px 5px;
  border: none;
}
#d_social_login .dsl-button.dsl-button-icons .r-side {
  display: none;
}
a [class*="dsl-icon-"],
[class*="dsl-icon-"],
[class*="dsl-icon-"]:before{
  margin:0px !important;
  background-image:none !important;
}
.dsl-label {
  display: none;
  vertical-align: middle;
}
.dsl-label-icons{
  display: inline-block;
}
.dsl-hide-icon{
  opacity: 0
}
</style>

<div id="d_social_login" style="display:none;">
  <span class="info dsl-label dsl-label-<?php echo $size; ?>"><?php echo $button_sign_in; ?></span>
  <?php foreach($providers as $key => $provider){ ?><?php if ($provider['enabled']) { ?><a id="dsl_<?php echo $provider['id']; ?>_button" class="dsl-button dsl-button-<?php echo $size; ?>" href="index.php?route=module/d_social_login/provider_login&provider=<?php echo $key; ?>"><span class="l-side"><span class="dsl-icon dsl-icon-<?php echo $provider['id']; ?>"></span></span><span class="r-side"><?php echo $provider['heading']; ?></span></a><?php }  ?><?php } ?>
</div>
<script>
$( document ).ready(function() {

// Move module to content //
$('#content #d_social_login').appendTo($('#social_login_content_holder'));
$('.footer_modules #d_social_login').appendTo($('#social_login_header_holder'));
			
  $('.dsl-button').on('click', function(){
    $('.dsl-button').find('.l-side').spin(false);
    $(this).find('.l-side').spin('<?php echo $size; ?>', '#999999');
    
    $('.dsl-button').find('.dsl-icon').removeClass('dsl-hide-icon');
    $(this).find('.dsl-icon').addClass('dsl-hide-icon');
  })
})
</script>
<?php } ?>