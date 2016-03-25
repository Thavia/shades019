<?php 
$_['d_social_login_setting'] = array(
    "name" => "",
    "size" => "icon", 
    "base_url" => "", 
    "return_page" => "viewed",
    "return_url" => "",
    "background_img" => "data/d_social_login/d_social_login_bg.png",
    "providers" => array ( 

      "Google" => array ( 
        "enabled" => true,
        "keys"    => array ( "id" => "", "secret" => "" ), 
        "id"  => 'google',
        "sort_order" => 1,
        "icon" => 'icon-google-plus',
        "background_color" => '#dd4b39',
        "background_color_active" => '#be3e2e',
      ),

      "Facebook" => array ( 
        "enabled" => true,
        "keys"    => array ( "id" => "", "secret" => "" ), 
        "id"  => 'facebook',
        "sort_order" => 2,
        "icon" => 'icon-facebook',
        "background_color" => '#4864b4',
        "background_color_active" => '#3a5192',
      ),

      "Twitter" => array ( 
        "enabled" => true,
        "keys"    => array ( "key" => "", "secret" => "" ),
        "id"  => 'twitter',
        "sort_order" => 3,
        "icon" => 'icon-twitter-bird',
        "background_color" => '#00ceff',
        "background_color_active" => '#03b3dd',
      ),

      // windows live
      "Live" => array ( 
        "enabled" => true,
        "keys"    => array ( "id" => "", "secret" => "" ),
        "id"  => 'live',
        "sort_order" => 4,
        "icon" => 'icon-windows-live',
        "background_color" => '#2672ec',
        "background_color_active" => '#205dbf',
      ),

      "LinkedIn" => array ( 
        "enabled" => true,
        "keys"    => array ( "key" => "", "secret" => "" ),
        "id"  => 'linkedin',
        "sort_order" => 5,
        "icon" => 'icon-linkedin',
        "background_color" => '#2a72b6',
        "background_color_active" => '#21588d',
      ),

      "Vkontakte" => array (
        "enabled" => true,
        "keys"    => array ( "id" => "", "secret" => "" ),
        "id"  => 'vkontakte',
        "sort_order" => 6,
        "icon" => 'icon-vkontakte',
        "background_color" => '#5b82ab',
        "background_color_active" => '#466382',
      ),
      // "Odnoklassniki" => array (
      //   "enabled" => false,
      //   "keys"    => array ( "id" => "", "secret" => "" ),
      //   "id"  => 'odnoklassniki',
      //   "sort_order" => 6,
      //   "background_color" => '#f87f00';
      //   "background_color_active" => '#d06b00';
      // ),
      // "Mailru" => array (
      //   "enabled" => false,
      //   "keys"    => array ( "id" => "", "key" => "", "secret" => "" ),
      //   "id"  => 'mailru',
      //   "sort_order" => 8,
      //   "background_color" => '#2162c0';
      //   "background_color_active" => '#184376';
      // ),
      "Yandex" => array (
        "enabled" => true,
        "keys"    => array ( "id" => "", "secret" => "" ),
        "id"  => 'yandex',
        "sort_order" => 7,
        "icon" => 'icon-yandex',
        "background_color" => '#d83933',
        "background_color_active" => '#a62d29',
      ),
      "Paypal" => array (
        "enabled" => true,
        "keys"    => array ( "id" => "", "secret" => "" ),
        "id"  => 'paypal',
        "sort_order" => 8,
        "icon" => 'icon-paypal',
        "background_color" => '#179bd7',
        "background_color_active" => '#222d65',
      ),
      "Instagram" => array (
        "enabled" => true,
        "keys"    => array ( "id" => "", "secret" => "" ),
        "id"  => 'instagram',
        "sort_order" => 9,
        "icon" => 'icon-instagrem-square',
        "background_color" => '#568fba',
        "background_color_active" => '#5d84a1',
      ),
      "Tumblr" => array (
        "enabled" => true,
        "keys"    => array ( "key" => "", "secret" => "" ),
        "id"  => 'tumblr',
        "sort_order" => 10,
        "icon" => 'icon-tumblr',
        "background_color" => '#365572',
        "background_color_active" => '#2f404f',
      ),
      // "Yahoo" => array (
      //   "enabled" => true,
      //   "keys"    => array ( "key" => "", "secret" => "" ),
      //   "id"  => 'yahoo',
      //   "sort_order" => 11,
      //   "background_color" => '#500095',
      //   "background_color_active" => '#3d026f',
      // ),
    ),
    'fields' => array('firstname' => array('id' => 'firstname', 'enabled' => true, 'sort_order' => 1, 'type' => 'text'),
                      'lastname' => array('id' => 'lastname', 'enabled' => true, 'sort_order' => 2, 'type' => 'text'),
                      'phone' => array('id' => 'phone', 'enabled' => true, 'sort_order' => 3, 'type' => 'text', 'mask' => '9(999) 9999-9999?9'),
                      'address_1' => array('id' => 'address_1', 'enabled' => true, 'sort_order' => 4, 'type' => 'text'),
                      'address_2' => array('id' => 'address_2', 'enabled' => true, 'sort_order' => 5, 'type' => 'text'),
                      'city' => array('id' => 'city', 'enabled' => true, 'sort_order' => 6, 'type' => 'text'),
                      'postcode' => array('id' => 'postcode', 'enabled' => true, 'sort_order' => 7, 'type' => 'text'),
                      'country_id' => array('id' => 'country_id', 'enabled' => true, 'sort_order' => 8, 'type' => 'select'),
                      'zone_id' => array('id' => 'zone_id', 'enabled' => true, 'sort_order' => 9, 'type' => 'select'),
                      'company' => array('id' => 'company', 'enabled' => true, 'sort_order' => 10, 'type' => 'text'),
                      'company_id' => array('id' => 'company_id', 'enabled' => true, 'sort_order' => 11, 'type' => 'text'),
                      'tax_id' => array('id' => 'tax_id', 'enabled' => true, 'sort_order' => 12, 'type' => 'text'),
                      'password' => array('id' => 'password', 'enabled' => true, 'sort_order' => 13, 'type' => 'password'),
                      'confirm' => array('id' => 'confirm', 'enabled' => true, 'sort_order' => 14, 'type' => 'password')
    ),
    "debug_mode" => false,
    "base_url_index" => true,

    "debug_file" => "logs/d_social_login.txt",  
  );

?>