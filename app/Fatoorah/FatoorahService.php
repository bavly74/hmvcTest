<?php
namespace App\Fatoorah;
use GuzzleHttp\Client ;
use GuzzleHttp\Psr7\Request ;

class FatoorahService{
    private $base_url ;
    private $request_client ;
    private $headers ;

    public function __construct(Client $request_client) {
        $this->request_client = $request_client ;
        $this->base_url = env('fatoorah_base_url') ;
        $this->headers=[
            'Content-Type'=>'application/json' ,
            'authorization'=>'Bearer '.env('fatoorah_token')
            ];
    }

    public function buildRequest($uri , $method , $data=[]) {
        $request = new Request($method ,$this->base_url . $uri ,$this->headers) ;
        if(!$data){
            return false ;
        }
        $response =$this->request_client->send($request,[
            'json'=>$data
        ]) ;
        if($response->getStatusCode()!=200){
            return false;
        }
        return $response = json_decode($response->getBody(),true) ;

        //  if ($response['IsSuccess'] && isset($response['Data']['InvoiceURL'])) {
        //         return redirect()->away($response['Data']['InvoiceURL']);
        //     }

    }

    public function sendPayment($data) {
       return $response = $this->buildRequest('v2/sendPayment','POST' ,$data) ;
    }


}
