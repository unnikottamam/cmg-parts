<?php
/**
 * Sign Up Form
 *
 * @package Coast_Machinery
 */

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
require_once $parse_uri[0] . 'wp-load.php';
$output_data = [];
if (empty($_POST["first_name"])) {
  $output_data = [
    "message" => "First name is required.",
    "status" => "warning",
  ];
} elseif (empty($_POST["last_name"])) {
  $output_data = [
    "message" => "Last name is required.",
    "status" => "warning",
  ];
} elseif (empty($_POST["shop_name"])) {
  $output_data = [
    "message" => "Shop name is required.",
    "status" => "warning",
  ];
} elseif (empty($_POST["email_id"])) {
  $output_data = [
    "message" => "A valid Email address is required.",
    "status" => "warning",
  ];
} elseif (!filter_var($_POST["email_id"], FILTER_VALIDATE_EMAIL)) {
  $output_data = [
    "message" => "A valid Email address is required.",
    "status" => "warning",
  ];
} elseif (email_exists($_POST["email_id"])) {
  $output_data = [
    "message" => "This email is already registered.",
    "status" => "warning",
  ];
} elseif (empty($_POST["username"])) {
  $output_data = [
    "message" => "Username is required.",
    "status" => "warning",
  ];
} elseif (username_exists($_POST["username"])) {
  $output_data = [
    "message" => "This username is already exists, try a different one.",
    "status" => "warning",
  ];
} elseif (empty($_POST["password"])) {
  $output_data = [
    "message" => "A strong password is required.",
    "status" => "warning",
  ];
} elseif (strlen($_POST["password"]) < 5) {
  $output_data = [
    "message" => "Password length is too short, try to use a strong password.",
    "status" => "warning",
  ];
} elseif (empty($_POST["captcha_res"])) {
  $output_data = [
    "message" => "Form not submitted because of security concerns.",
    "status" => "warning",
  ];
} else {
  // Build POST request:
  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
  $recaptcha_secret = '6Ler7IQaAAAAANZehnhmPBRUIqXhkzH3dXkeYzWP';
  $captcha_res = $_POST["captcha_res"];

  // Make and decode POST request:
  $recaptcha = file_get_contents(
    $recaptcha_url .
      '?secret=' .
      $recaptcha_secret .
      '&response=' .
      $captcha_res
  );
  $recaptcha = json_decode($recaptcha);

  if ($recaptcha->score < 0.5) {
    $output_data = [
      "message" => "Sorry, some problems occurred. Please try again.",
      "status" => "warning",
    ];
  } else {
    $userdata = [
      'user_login' => $_POST["username"],
      'user_pass' => $_POST["password"],
      'user_email' => $_POST["email_id"],
      'first_name' => $_POST["first_name"],
      'last_name' => $_POST["last_name"],
      'role' => "vendor",
    ];
    $user_id = wp_insert_user($userdata);
    if (!is_wp_error($user_id)) {
      update_user_meta($user_id, 'pv_shop_name', $_POST["shop_name"]);
      update_user_meta($user_id, '_wcv_store_country', $_POST["country"]);
      update_user_meta($user_id, 'billing_country', $_POST["country"]);
      update_user_meta($user_id, '_wcv_store_state', $_POST["state"]);
      update_user_meta($user_id, 'billing_state', $_POST["state"]);
      update_user_meta($user_id, '_wcv_store_phone', $_POST["cellnumber"]);
      update_user_meta($user_id, 'billing_phone', $_POST["cellnumber"]);
      update_user_meta($user_id, '_wcv_store_address1', $_POST["street"]);
      update_user_meta($user_id, 'billing_address_1', $_POST["street"]);
      update_user_meta($user_id, '_wcv_store_postcode', $_POST["zipcode"]);
      update_user_meta($user_id, 'billing_postcode', $_POST["zipcode"]);
      update_user_meta($user_id, '_wcv_store_city', $_POST["city"]);
      update_user_meta($user_id, 'billing_city', $_POST["city"]);
      $output_data = [
        "message" =>
          "You are successfully registered as a vendor. Login to your account to add machines.",
        "status" => "success",
      ];

      $to = $_POST["email_id"];
      $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Coast Machinery Group <online@coastmachinery.com>',
      ];
      $title = "Welcome to Coast Machinery Group.";
      $headingtext = "Welcome to Coast Machinery Group.";
      $bodytext1 =
        "Hi " .
        $_POST['first_name'] .
        " " .
        $_POST['last_name'] .
        ", your vendor dashboard is ready to use.<br />Please add your machine(s) into your dashboard.<br /><strong>Your username is " .
        $_POST["username"] .
        "</strong><br /><strong>Your Password is " .
        $_POST["password"] .
        "</strong><br /><br /><strong>Tips to help your product get noticed;</strong>";
      $bullet = "<span style='color: #00548c;'>&#10148;</span>";
      $bodytext2 = "<p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px; line-height: 1.4;'>$bullet Provide clear, well lit photos of your machine(s) with<br />full image, close ups, angles including parts / manuals<br /></p><p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px; line-height: 1.4;'>$bullet Ensure your machine is cleaned and without clutter<br /></p><p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px; line-height: 1.4;'>$bullet Take a video of the machine(s) running <br />with material processed through<br /></p><p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px; line-height: 1.4;'>$bullet Enter as much details as possible about the<br />use, issues and recent repairs<br /></p><p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px; line-height: 1.4;'>$bullet Add any equipment specifications of the<br />machine you may have (Voltage etc)<br /></p><p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; line-height: 1.4;'>$bullet Highlight as many features and benefits as possible</p>";
      $bodytext3 =
        "Any item you are unable to obtain we will find through our resources";
      $btnlink = "https://www.coastmachinery.com/used-machinery-vendor";
      $btntext = "Add Your Products";
      ob_start();
      include './email-template.php';
      $message = ob_get_contents();
      ob_end_clean();
      wp_mail($to, $title, $message, $headers);

      // Internal Emails
      $to = "online@coastmachinery.com";
      $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Coast Machinery Group <online@coastmachinery.com>',
        'Cc: mitch@coastmachinery.com',
      ];
      $title = "New vendor - " . $_POST["shop_name"] . " registered.";
      $headingtext = "New vendor - " . $_POST["shop_name"] . " registered.";
      $bodytext1 =
        "New Vendor <strong>" .
        $_POST["shop_name"] .
        "</strong>, registered in the website.<br /><strong>Username is " .
        $_POST["username"] .
        "</strong><br /><strong>Password is " .
        $_POST["password"] .
        "</strong>";
      $bodytext2 =
        "<p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; line-height: 1.4;'>Verify the user and assign a vendor number</p>";
      $bodytext3 = "";
      $btnlink = "https://www.coastmachinery.com/wp-admin/user-edit.php?user_id=$user_id#wpseo_user_schema_worksFor";
      $btntext = "Assign Vendor Number";
      ob_start();
      include './email-template.php';
      $message = ob_get_contents();
      ob_end_clean();
      wp_mail($to, $title, $message, $headers);
    } else {
      $output_data = [
        "message" => "Sorry, some problems occurred. Please try again.",
        "status" => "warning",
      ];
    }
  }
}
echo json_encode($output_data);