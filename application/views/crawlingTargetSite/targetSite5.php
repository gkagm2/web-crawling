<?php
    
// We will check current Bitcoin price via API.0
$request = new \cURL\Request('http://smartstore.naver.com/vv8788/products/528910613?NaPm=ct%3Djd44r9z4%7Cci%3D05d57826b2fb08fdbd613c6db919c089bc81b0e1%7Ctr%3Dsls%7Csn%3D356103%7Chk%3Dc48e2b59fcc8bbbcc1e1ac1c3fc9479a09ebef88');
//$request = new \cURL\Request('http://smartstore.naver.com/vv8788/products/528910613?NaPm=ct%3Djd44r9z4%7Cci%3D05d57826b2fb08fdbd613c6db919c089bc81b0e1%7Ctr%3Dsls%7Csn%3D356103%7Chk%3Dc48e2b59fcc8bbbcc1e1ac1c3fc9479a09ebef88');
$request->getOptions()
    ->set(CURLOPT_TIMEOUT, 5)
    ->set   (CURLOPT_RETURNTRANSFER, true);
$response = $request->send();
$feed = json_decode($response->getContent(), true);
echo "Current Bitcoin price: " . $feed['data']['rate'] . " " . $feed['data']['code'] . "\n";
?>