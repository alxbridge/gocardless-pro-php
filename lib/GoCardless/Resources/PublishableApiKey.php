<?php
/**
  * WARNING: Do not edit by hand, this file was generated by Crank:
  *
  * https://github.com/gocardless/crank
  */

namespace GoCardless\Resources;

/**
  *  Publishable API keys are designed to be used by the [js
  *  flow](https://developer.gocardless.com/pro/#api-endpoints-customer-bank-account-tokens).
  *  You should generate a key and then use it to make requests to the API. They
  *  do not expire, but can be disabled.
  *  
  *  Publishable API keys only
  *  have permissions to create [customer bank account
  *  tokens](https://developer.gocardless.com/pro/#api-endpoints-customer-bank-account-tokens).
  */
class PublishableApiKey
{
  
    
    private $data;
    private $response;

    public function __construct($data, $response = null)
    {
      if ($data === null)
      {
        throw new \Exception('Data cannot be null');
      }
      $this->response = $response;
      $this->data = $data;
    }
  
    
    
    public function created_at()
    {
      return $this->data->created_at;
    }
  
    
    public function enabled()
    {
      return $this->data->enabled;
    }
  
    
    public function id()
    {
      return $this->data->id;
    }
  
    
    public function key()
    {
      return $this->data->key;
    }
  
    
    public function name()
    {
      return $this->data->name;
    }
  
    
    public function response() {
      return $this->response;
    }


}
