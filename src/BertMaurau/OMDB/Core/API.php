<?php

namespace BertMaurau\OMDB\Core;

/**
 * Description of API
 * Handles the main HTTP GET request to the OMDB API.
 *
 * @author Bert Maurau
 */
class API
{

    // the API base URL
    const BASE_URL = "http://www.omdbapi.com/";

    // your personal API key
    private static $apiKey;

    /**
     * Set the API key on construct
     * @param type $apiKey
     * @throws \Exception
     */
    public function __construct($apiKey)
    {
        if (empty($apiKey)) {
            throw new \Exception("OMDB API key is required!");
        }
        self::setApiKey($apiKey);
    }

    /**
     * Send the GET request
     * @param string $parameter
     * @param string $value
     * @param array $arguments
     * @return array
     * @throws \Exception
     */
    public static function GET($parameter, $value, $arguments = array())
    {
        // check if API key is set
        if (!isset(self::$apiKey)) {
            throw new \Exception("No API key set!");
        } else {
            // add it to the list of arguments
            $arguments['apikey'] = self::$apiKey;
        }


        // build the endpoint with the arguments and values
        $endpoint = self::BASE_URL . ((!strpos($parameter, '?')) ? '?' : '') . $parameter . '=' . $value . '&' . http_build_query($arguments, '', '&');

        // begin the curl
        $request = curl_init();
        curl_setopt($request, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($request, CURLOPT_URL, $endpoint);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);

        // Send the request
        $response = curl_exec($request);
        $response_info = curl_getinfo($request);

        // Close cURL
        curl_close($request);

        // Validate..
        if ($response_info["http_code"] !== 200) {
            throw new \Exception("Unexpected HTTP code: " . $response_info["http_code"] . ". " . json_encode($response));
        }

        $response = json_decode($response);

        // check for response itself
        if (!property_exists($response, 'Response')) {
            throw new \Exception("Invalid response");
        }

        return $response;
    }

    /**
     * Set the API Key
     * @param string $apiKey
     * @return $this
     */
    public static function setApiKey($apiKey)
    {
        self::$apiKey = (string) $apiKey;
    }

}
