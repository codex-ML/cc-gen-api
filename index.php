<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://bincheck.org/{bin}',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
    'Accept-Language: en-US,en;q=0.5',
    'Accept-Encoding: gzip, deflate, br',
    'Alt-Used: bincheck.org',
    'Connection: keep-alive',
    'Referer: https://bincheck.org/',
    'Cookie: _bins_session=d0dqMWo3OEplOUp5RCswWTlCMVRvMmoxNVBheHRFQUJpQm5tRXNDWW4vclNMOG9Gc2lWbGNGaXZoOHEvTVlZMGN1K0k4bk91MjBPZEpJYWxiZjg0RXlaNGhwdlNDSGlrRFBQbjRqNVVMWHMzek9JalJ5bmJIaWczU21sNXNkVHJzb2llcDZqdGF5WXcveGhOdmJFMS93PT0tLVl6L0Z6NlFPRlYyQXo5aS9PbGh0ZEE9PQ%3D%3D--0dcdb9ece6fe5c85efa9ea5d1206a3f9f7e68577; sb_main_6ba56ed57a6c774e56669284e8ac89a0=1; sb_count_6ba56ed57a6c774e56669284e8ac89a0=1; _bins_session=a1FFTlNCUG5mVWIxNzg5WFpnUStRb3VWR3oyeitKdm9keWFmdUhaNER3bjJSSDdodEFxMXVVTmJkSmpxSG1zckhHTGxPa3U3Tm9VQXJDUkV4cUhsV3BwRkxrUmtKSDZ6aWdNaVZheTR4VVhaaDdDa1J5SGl3N2N0RU5Qamd4TmtJVXB4THFkTmJjRzlvaXlZMXAvMTF3PT0tLVBiSEhJaGdoQ3piV1oyaXVENDlOcnc9PQ%3D%3D--831ef699d3b5b18ff8b60e6775f26c86f2f4703b',
    'Upgrade-Insecure-Requests: 1',
    'Sec-Fetch-Dest: document',
    'Sec-Fetch-Mode: navigate',
    'Sec-Fetch-Site: same-origin',
    'Sec-Fetch-User:?1',
    'TE: trailers'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$dom = new DOMDocument();
@$dom->loadHTML($response);

$tables = $dom->getElementsByTagName('table');

$data = array();

foreach ($tables as $table) {
  $rows = $table->getElementsByTagName('tr');
  foreach ($rows as $row) {
    $cols = $row->getElementsByTagName('td');
    $rowData = array();
    foreach ($cols as $col) {
      $rowData[] = trim($col->nodeValue);
    }
    $data[] = $rowData;
  }
}

$jsonData = array();

foreach ($data as $row) {
  $jsonRow = array();
  foreach ($row as $key => $value) {
    $jsonRow[$key] = $value;
  }
  $jsonData[] = $jsonRow;
}

echo json_encode($jsonData, JSON_PRETTY_PRINT);

?>
