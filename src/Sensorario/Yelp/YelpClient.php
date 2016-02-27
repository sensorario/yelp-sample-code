<?php

namespace Sensorario\Yelp;

use Exception;
use OAuthConsumer;
use OAuthRequest;
use OAuthSignatureMethod_HMAC_SHA1;
use OAuthToken;

class YelpClient
{
    public function __construct()
    {
        $this->configuration = (new Configuration())
            ->getConfig();
    }

    public function requestPath($path) {
        $host = $this->configuration['yelp']['api_host'];

        $unsignedUrl = "https://" . $host . $path;

        $token = new OAuthToken(
            $this->configuration['yelp']['api_keys']['token'],
            $this->configuration['yelp']['api_keys']['token_secret']
        );

        $consumer = new OAuthConsumer(
            $this->configuration['yelp']['api_keys']['consumer_key'],
            $this->configuration['yelp']['api_keys']['consumer_secret']
        );

        $signatureMethod = new OAuthSignatureMethod_HMAC_SHA1();

        $oauthrequest = OAuthRequest::from_consumer_and_token(
            $consumer, 
            $token, 
            'GET', 
            $unsignedUrl
        );
        
        $oauthrequest->sign_request(
            $signatureMethod,
            $consumer,
            $token
        );
        
        $url = $oauthrequest->to_url();
        
        try {
            $ch = curl_init($url);

            if (FALSE === $ch) {
                throw new Exception(
                    'Failed to initialize'
                );
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);

            if (FALSE === $data) {
                throw new Exception(
                    curl_error($ch),
                    curl_errno($ch)
                );
            }

            $httpStatus = curl_getinfo(
                $ch,
                CURLINFO_HTTP_CODE
            );

            if (200 != $httpStatus) {
                throw new Exception(
                    $data,
                    $httpStatus
                );
            }

            curl_close($ch);
        } catch(Exception $e) {
            trigger_error(
                sprintf(
                    'Curl failed with error #%d: %s',
                    $e->getCode(), $e->getMessage()
                ),
                E_USER_ERROR
            );
        }
        
        return $data;
    }
}
