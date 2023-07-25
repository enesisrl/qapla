<?php

namespace Enesisrl\Qapla;

use Curl\Curl;

class Api extends Curl {

    protected $options;

    public function __construct(array $options = []){

        $default_options = [
            'api_version' => '1.2',
            'api_key' => null,
            'sandbox' => null,
            'base_url' => "https://api.qapla.it/"
        ];

        $this->options = array_merge($default_options,$options);
        parent::__construct($this->options['base_url']);
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

    public function getUrl($path = null){
        $urlParts = [];
        $urlParts[] = rtrim($this->options['base_url'],"/");
        $urlParts[] = $this->getApiVersion();
        if ($path){
            $urlParts[] = ltrim(rtrim($path,"/"),"/")."/";
        }
        return implode('/',$urlParts);
    }

    public function pushOrder($order=[], $origin=null){
        $data = [
            'apiKey' => $this->getApiKey(),
            'pushOrder' => [$order]
        ];

        if ($origin) {
            $data['origin'] = $origin;
        }
        return $this->post($this->getUrl('pushOrder'), json_encode($data));
    }

    public function deleteOrder($reference){
        $data = [
            'apiKey' => $this->getApiKey(),
            'reference' => $reference
        ];
        return $this->delete($this->getUrl('deleteOrder'),[], json_encode($data));
    }

    public function undeleteOrder($reference){
        $data = [
            'apiKey' => $this->getApiKey(),
            'reference' => $reference
        ];
        return $this->patch($this->getUrl('undeleteOrder'), json_encode($data));
    }

    public function updateOrder($order){
        $order['updatedAt'] = date("Y-m-d H:i:s");
        return $this->pushOrder($order);
    }

    public function getShipment($reference){
        $data = [
            'apiKey' => $this->getApiKey(),
            'reference' => $reference
        ];
        return $this->get($this->getUrl('getShipment'),json_encode($data));
    }

}