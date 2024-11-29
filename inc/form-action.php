<?php
/**
 * Form Action File
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
} else if (empty($_POST["last_name"])) {
  $output_data = [
    "message" => "Last name is required.",
    "status" => "warning",
  ];
} else if (empty($_POST["email_id"])) {
  $output_data = [
    "message" => "A valid Email address is required.",
    "status" => "warning",
  ];
} else if (!filter_var($_POST["email_id"], FILTER_VALIDATE_EMAIL)) {
  $output_data = [
    "message" => "A valid Email address is required.",
    "status" => "warning",
  ];
} else if (empty($_POST["captcha_res"])) {
  $output_data = [
    "message" => "Form not submitted beacuse of security concerns.",
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
  $recaptchaData = json_decode($recaptcha);
  $output_data = [
    "message" => "Sorry, some problems occurred. Please try again.",
    "status" => "warning",
  ];
  if ($recaptchaData->score < 0.5) {
    $output_data = [
      "message" => "Sorry, some problems occurred. Please try again.",
      "status" => "warning",
    ];
  } else {
    // Zoho API Module
    $api_url = 'https://www.zohoapis.com/crm/v2/Leads';
    $access_token = "";
    $refresh_token = '1000.78ff8c9693fc8c268c60340e00bcc9a6.822fe10e2b03832268a68472f06f8b07';
    $refresh_url = 'https://accounts.zoho.com/oauth/v2/token';
    $refresh_data = http_build_query(array(
        'refresh_token' => $refresh_token,
        'client_id' => '1000.7GD06RTPB7IE75CQ02EVXU4I4ARC5L',
        'client_secret' => '51cf21995299b7039a750e8b2062a7b59ffd65dc57',
        'grant_type' => 'refresh_token'
    ));
    
    $ch = curl_init($refresh_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $refresh_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $response_data = json_decode($response, true);
    if (isset($response_data['access_token'])) {
        $access_token = $response_data['access_token'];
    } else {
        $output_data = [
          "message" => "Sorry, there is a connection problem",
          "status" => "warning",
        ];
    }

    $lead_data = array(
        'data' => [
          [
            "First_Name" => $_POST["first_name"],
            "Last_Name" => $_POST["last_name"],
            "Phone" => $_POST["contact_no"],
            "Email" => $_POST["email_id"],
            "Offer_Price" => $_POST["offer_price"],
            "Cell_Phone_Opted_In" => isset($_POST["opt_in"]) ? true : false,
            "Street" => $_POST["street"],
            "City" => $_POST["city"],
            "State" => $_POST["state"],
            "Zip_Code" => $_POST["zipcode"],
            "Country" => $_POST["country"],
            "Looking_for" => $_POST["lookingfor"],
            "Description" => $_POST["message"],
            "Currency" => $_POST["currency"],
            "Lead_Source" => $_POST["source"],
          ]
        ]
    );

    $lead_data_json = json_encode($lead_data);
    $headers = array(
        'Authorization: Zoho-oauthtoken ' . $access_token,
        'Content-Type: application/json'
    );

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $lead_data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);
    $response_output = json_decode($response, true);
    if (isset($response_output['data']) && $response_output['data'][0]['status'] === "success") {
      if ($product_id = $_POST["product_id"]) {
        $lead_count = get_field('lead_count', $product_id) ?: 0;
        update_field('lead_count', ++$lead_count, $product_id);
      }
      $output_data = [
        "message" => "Thank you for contacting us; we will respond as soon as possible.",
        "status"  => "success",
      ];
    } else {
      $to = "cyril@coastmachinery.com";
      $from = "noreply@coastmachinery.com";
      $fields = [
        "First_Name" => $_POST["first_name"],
        "Last_Name" => $_POST["last_name"],
        'Phone' => $_POST["contact_no"],
        'Email' => $_POST["email_id"],
        'Offer Price' => $_POST["offer_price"],
        'Street' => $_POST["street"],
        'City' => $_POST["city"],
        'State' => $_POST["state"],
        'Zip Code' => $_POST["zipcode"],
        'Country' => $_POST["country"],
        'Looking for' => $_POST["lookingfor"],
        'Description' => $_POST["message"],
        'Currency' => $_POST["currency"],
        'Lead source' => $_POST["source"],
      ];

      $headers = [
        'From' => $from,
        'Reply-To' => $_POST["email_id"],
        'Content-type' => 'text/html; charset=iso-8859-1',
      ];
      $subject = "You have a new lead from " . $_POST["first_name"] ." ". $_POST["last_name"];

      $body = "<h4>Here is the message details: </h4>";
      foreach ($fields as $a => $b) {
        $body .= sprintf("<p>%20s: %s </p>", $a, $b);
      }

      if (mail($to, $subject, $body, $headers)) {
        $output_data = [
          "message" =>
            "Thank you for contacting me; I will respond you as soon as possible.",
          "status" => "success",
        ];
      } else {
        $output_data = [
          "message" => "Sorry, some problems occurred. Please try again.",
          "status" => "warning",
        ];
      }
    }
  }
}
echo json_encode($output_data);