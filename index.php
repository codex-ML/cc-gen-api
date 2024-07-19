<?php

// Check if accessed directly at the root path '/'
if ($_SERVER['REQUEST_URI'] === '/') {
    // HTML content to display
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CC GEN API</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <h1>CC GEN API Usage Example</h1>
        <p>This page demonstrates how to use an API to retrieve data:</p>
        <ul>
            <li>To retrieve data, provide parameters in the URL:</li>
            <li><code>bin</code>: Specify the BIN (Bank Identification Number).</li>
            <li><code>s_date</code>: Start date for data retrieval (optional).</li>
            <li><code>year</code>: Year for data retrieval (optional).</li>
            <li><code>number</code>: Number of records to retrieve (optional).</li>
            <li><code>format</code>: Desired format of the retrieved data (optional). <code>pipe , csv , xml , json , sql</code></li>
        </ul>
        <p>Example usage: <code>/script.php?bin=123456&s_date=2023-01-01&number=10&format=csv</code></p>
        <p>The script will make a POST request to the API and display the retrieved data.</p>
    </body>
    </html>
    <?php
    exit; // Stop further execution
}

// Retrieve parameters from the URL
$bin = $_GET['bin'] ?? '';         // Default to empty string if 'bin' parameter is not provided
$s_date = $_GET['s_date'] ?? '';   // Default to empty string if 's_date' parameter is not provided
$year = $_GET['year'] ?? '';       // Default to empty string if 'year' parameter is not provided
$number = $_GET['number'] ?? '';   // Default to empty string if 'number' parameter is not provided
$format = $_GET['format'] ?? '';   // Default to empty string if 'format' parameter is not provided

$curl = curl_init();

// Prepare the POST fields with retrieved parameters
$post_fields = http_build_query(array(
    'type' => '3',
    'bin' => $bin,
    'date' => 'on',
    's_date' => $s_date,
    'year' => $year,
    'csv' => 'on',
    's_csv' => '',
    'number' => $number,
    'format' => $format
));

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://namsogen.org/ajax.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $post_fields,
  CURLOPT_HTTPHEADER => array(
    'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0',
    'Accept: */*',
    'Accept-Language: en-US,en;q=0.5',
    'Accept-Encoding: gzip, deflate, br',
    'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
    'X-Requested-With: XMLHttpRequest',
    'Origin: https://namsogen.org',
    'Connection: keep-alive',
    'Referer: https://namsogen.org/',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'TE: trailers'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$response_data = explode("\n", $response);

echo "<pre>";

foreach ($response_data as $row) {

    $columns = explode("|", $row);

    echo implode(" | ", $columns) . "\n";

}

echo "</pre>";
?>
