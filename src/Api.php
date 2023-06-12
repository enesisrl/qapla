<?php

namespace Enesisrl\Qapla;

use Enesisrl\Qapla\RestClient;

class Api extends RestClient {
    protected $api_version;

    protected $api_key;

    protected $sandbox;

    public function __construct(array $options = []){
        parent::__construct($options);

        if (isset($options['api_version'])) {
            $this->setApiVersion($options['api_version']);
        }
        if (isset($options['api_key'])) {
            $this->setApiKey($options['api_key']);
        }
        if (isset($options['sandbox'])) {
            $this->setSandbox($options['sandbox']);
        }
    }

    /**
     * @return mixed
     */
    public function getApiKey(){
        return $this->api_key;
    }
    /**
     * @param mixed $api_key
     */
    public function setApiKey($api_key){
        $this->api_key = $api_key;
    }

    /**
     * @return mixed
     */
    public function getApiVersion(){
        return $this->api_version;
    }

    /**
     * @param mixed $api_version
     */
    public function setApiVersion($api_version){
        $this->api_version = $api_version;
    }

    /**
     * @return mixed
     */
    public function getSandbox(){
        return $this->sandbox;
    }
    /**
     * @param mixed $sandbox
     */
    public function setSandbox($sandbox){
        $this->sandbox = $sandbox;
    }
}