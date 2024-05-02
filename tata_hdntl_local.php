<?php
// Check if URL parameter is provided
if (!isset($_GET['url'])) {
    echo 'Error: URL parameter is missing';
    exit;
}

// Get the URL parameter
$url = $_GET['url'];
$userAgent = 'Mozilla/5.0';

// Initialize cURL session
$curl = curl_init();

// Set cURL options
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, true); // Include header in output
curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);

// Execute the request
$response = curl_exec($curl);

// Check for errors
if ($response === false) {
    echo 'Error: ' . curl_error($curl);
} else {
    // Split response into header and body
    list($header, $body) = explode("\r\n\r\n", $response, 2);

    // Extract and print the Set-Cookie header
    preg_match('/Set-Cookie:\s*(.*?);/', $header, $matches);
    if (isset($matches[1])) {
        echo '' . $matches[1];
    } else {
        echo 'Set-Cookie header not found';
    }
}

// Close cURL session
curl_close($curl);
?>
