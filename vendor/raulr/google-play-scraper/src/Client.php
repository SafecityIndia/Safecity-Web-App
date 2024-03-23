<?php

namespace Raulr\GooglePlayScraper;

use Goutte\Client as BaseClient;
use Symfony\Component\BrowserKit\Response;

class Client extends BaseClient
{
    protected function filterResponse($response)
    {
        
        $content = str_replace(chr(0), '', $response->getContent());
        $headers = $response->getHeaders();
        // $status = $response->getStatus();

        // echo "<pre>";
        // print_r($status);
        // exit;
        $newResponse = new Response(
            $content,
            200,
            $response->getHeaders()
        );

        return $newResponse;
    }
}
