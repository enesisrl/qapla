<?php

namespace Enesisrl\Qapla;

use Enesisrl\Qapla\RestClient;

class Api extends RestClient {

    public function __construct(array $options = []){

        $default_options = [
            'headers' => [],
            'parameters' => [],
            'curl_options' => [],
            'build_indexed_queries' => FALSE,
            'api_version' => '1.2',
            'api_key' => null,
            'sandbox' => null,
            'user_agent' => "Enesi QaplaClient/1.0",
            'base_url' => "https://api.qapla.it/",
            'format' => NULL,
            'format_regex' => "/(\w+)\/(\w+)(;[.+])?/",
            'decoders' => [
                'json' => 'json_decode',
                'php' => 'unserialize'
            ],
            'username' => NULL,
            'password' => NULL
        ];

        $final_settings = array_merge($default_options, $options);
        $final_settings['base_url'] = implode('/',[rtrim($final_settings['base_url'],"/"),$final_settings['api_version']]);
        parent::__construct($final_settings);
    }

    /**
     * @return mixed
     */
    public function getApiKey(){
        return $this->options['api_key'];
    }

    /**
     * @return mixed
     */
    public function getApiVersion(){
        return $this->options['api_version'];
    }

    /**
     * @return mixed
     */
    public function getSandbox(){
        return $this->options['sandbox'];
    }

    public function pushOrder($order=[], $origin=null){
        $data = [
            'apiKey' => $this->getApiKey(),
            'pushOrder' => $order
        ];

        if ($origin) {
            $data['origin'] = $origin;
        }
        return $this->post('pushOrder', $data);
    }

    public function deleteOrder($reference){
        $data = [
            'apiKey' => $this->getApiKey(),
            'reference' => $reference
        ];
        return $this->delete('deleteOrder', $data);
    }

    public function undeleteOrder($reference){
        $data = [
            'apiKey' => $this->getApiKey(),
            'reference' => $reference
        ];
        return $this->patch('undeleteOrder', $data);
    }

    public function updateOrder($order){
        $order['updatedAt'] = date("Y-m-d H:i:s");
        return $this->pushOrder($order);
    }

}