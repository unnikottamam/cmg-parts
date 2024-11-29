<?php
/**
 * Form Action File
 *
 * @package bch-birdfeeders
 */

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
} else {
  $ragic_url = "https://na3.ragic.com/CoastMachineryGroup/ragicmarketing/10003?api&doFormula=true&doDefaultValue=true&doFormula=true&doWorkflow=true";

  $data_to_ragic = [
        '1001018' => $_POST["first_name"] . ' ' . $_POST["last_name"],
        '2000174' => $_POST["email_id"],
        // Add other fields as per your Ragic's API requirements
  ];

  $json_data_to_ragic = json_encode($data_to_ragic);

  $ch = curl_init($ragic_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data_to_ragic);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Basic ckVtak4ya3pURk00SVA3bm5PU0ltcmc0WjRNUkZTbXJnNmhmVEpMbmxrU1BOdHZWY3FSa0dBbDJmOTFvdlFORGlFdEwySHVmMk1FPQ=="
  ]);

  $ragic_response = curl_exec($ch);

  if(curl_error($ch)){
    echo 'Curl error: ' . curl_error($ch);
  }

  curl_close($ch);

  $decoded_ragic_response = json_decode($ragic_response, true);
  if (isset($decoded_ragic_response['status']) && $decoded_ragic_response['status'] == 'ok') {
    $output_data = [
        "message" => "Thank you for contacting us; we will respond as soon as possible.",
        "status" => "success",
    ];
  } else {
    $output_data = [
      "message" =>
        "Sorry, something unexpected happened. Please try again or send us an email.",
      "status" => "warning",
    ];
  }
}

echo json_encode($output_data);
?>
