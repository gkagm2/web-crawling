<?php

  include_once FCPATH . 'vendor/autoload.php';
    
        use Goutte\Client;
        
        $client = new Client();
        // Go to the symfony.com website
        $crawler = $client->request('GET', 'http://www.smtech.go.kr/front/ifg/no/notice01_list.do');



    use GuzzleHttp\Client as GuzzleClient;

    $goutteClient = new Client();
    $guzzleClient = new GuzzleClient(array(
        'timeout' => 60,
    ));
    $goutteClient->setClient($guzzleClient);


//     // Click on the "Security Advisories" link
// $link = $crawler->selectLink('Security Advisories')->link();
// $crawler = $client->click($link);

// Get the latest post in this category and display the titles
$crawler->filter('h2 > a')->each(function ($node) {
    print $node->text()."\n";
});
?>