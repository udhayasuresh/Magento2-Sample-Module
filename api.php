<?php
function sign($method, $url, $data, $consumerSecret, $tokenSecret)
{
    $url = urlEncodeAsZend($url);

    $data = urlEncodeAsZend(http_build_query($data, '', '&'));
    $data = implode('&', [$method, $url, $data]);

    $secret = implode('&', [$consumerSecret, $tokenSecret]);

    return base64_encode(hash_hmac('sha1', $data, $secret, true));
}

function urlEncodeAsZend($value)
{
    $encoded = rawurlencode($value);
    $encoded = str_replace('%7E', '~', $encoded);
    return $encoded;
}

// REPLACE WITH YOUR ACTUAL DATA OBTAINED WHILE CREATING NEW INTEGRATION
$consumerKey = 'kx6v6759u3kco9tkd9oj5y3wwlkppkl4';
$consumerSecret = 'vg7j4o966nknzod1hmtlggldyttzw57x';
$accessToken = 'amd2qr0lvijd6i4fg9tmbrvs5tokuj0x';
$accessTokenSecret = 'tp2maivj55v6pdj2nypc3bgowz93msv4';

$method = 'GET';
$url = 'http://localhost/Magento/rest/V1/products/1001';

//
$data = [
    'oauth_consumer_key' => $consumerKey,
    'oauth_nonce' => md5(uniqid(rand(), true)),
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_timestamp' => time(),
    'oauth_token' => $accessToken,
    'oauth_version' => '1.0',
];

$data['oauth_signature'] = sign($method, $url, $data, $consumerSecret, $accessTokenSecret);

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_HTTPHEADER => [
        'Authorization: OAuth ' . http_build_query($data, '', ',')
    ]
]);

$result = curl_exec($curl);
curl_close($curl);
echo '<pre>';print_r(json_decode($result));