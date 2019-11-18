<?php

namespace lipseys\apiintegration;


use http\Url;

class LipseysClient
{
    private $BaseUrl = "https://api.lipseys.com/api/";

    private $Email = "";
    private $Password = "";

    private $Account;
    private $Token;

    public function __construct($email, $password)
    {
        if( !extension_loaded('curl') ){
            throw new Exception("This method requires the php curl extension.");
        }

        $this->Email = $email;
        $this->Password = $password;
    }

    private function RequestBuilder($options){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($curl, $options);
        return $curl;
    }

    private function PostRequestBuilder($url, $model){
        $curl = $this->RequestBuilder(array(
            CURLOPT_URL => "{$this->BaseUrl}{$url}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($model),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Token: {$this->Token}",
            ),
        ));
        return $curl;
    }
    private function GetRequestBuilder($url){
        $curl = $this->RequestBuilder(array(
            CURLOPT_URL => "{$this->BaseUrl}{$url}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Token: {$this->Token}",
                "cache-control: no-cache"
            ),
        ));
        return $curl;
    }

    private function InvalidLoginResponse(){
        return array(
            "authorized" => false,
            "success" => false,
            "errors" => array(
                "Error logging in - Check Creds"
            )
        );
    }
    private function RequestError(){
        return array(
            "authorized" => false,
            "success" => false,
            "errors" => array(
                "Error making http request"
            )
        );
    }

    public function Catalog(){
        if(!$this->Token){
            if($this->login() != 1){
                return $this->InvalidLoginResponse();
            }
        }

        $curl = $this->GetRequestBuilder("integration/items/CatalogFeed");
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError();
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                if($this->login() != 1){
                    return $this->InvalidLoginResponse();
                }

                $curl = $this->GetRequestBuilder("integration/items/CatalogFeed");
                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    return $this->RequestError();
                } else {
                    $decode = json_decode($response, true);
                    if ($decode["authorized"] == false) {
                        return $this->InvalidLoginResponse();
                    }
                    return $decode;
                }
            }
            return $decode;
        }
    }
    public function CatalogItem($itemNumber){
        if(!$this->Token){
            if($this->login() != 1){
                return $this->InvalidLoginResponse();
            }
        }

        if(!$itemNumber || strlen($itemNumber) < 1){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Item number not provided"
                )
            );
        }

        $curl = $this->PostRequestBuilder("integration/items/CatalogFeed/Item", $itemNumber);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError();
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                if($this->login() != 1){
                    return $this->InvalidLoginResponse();
                }

                $curl = $this->PostRequestBuilder("integration/items/CatalogFeed/Item", $itemNumber);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError();
                } else {
                    $decode = json_decode($response, true);
                    if($decode["authorized"] == false){
                        return $this->InvalidLoginResponse();
                    }
                    return $decode;
                }
            }
            return $decode;
        }
    }
    public function PricingAndQuantity(){
        if(!$this->Token){
            if($this->login() != 1){
                return $this->InvalidLoginResponse();
            }
        }

        $curl = $this->GetRequestBuilder("integration/items/PricingQuantityFeed");
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError();
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                if($this->login() != 1){
                    return $this->InvalidLoginResponse();
                }
                $curl = $this->GetRequestBuilder("integration/items/PricingQuantityFeed");
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError();
                } else {
                    $decode = json_decode($response, true);
                    if($decode["authorized"] == false){
                        return $this->InvalidLoginResponse();
                    }
                    return $decode;
                }
            }
            return $decode;
        }
    }
    public function ValidateItem($itemNumber){
        if(!$this->Token){
            if($this->login() != 1){
                return $this->InvalidLoginResponse();
            }
        }

        if(!$itemNumber || strlen($itemNumber) < 1){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Item number not provided"
                )
            );
        }

        $curl = $this->PostRequestBuilder("integration/items/validateitem", $itemNumber);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError();
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                if($this->login() != 1){
                    return $this->InvalidLoginResponse();
                }

                $curl = $this->PostRequestBuilder("integration/items/validateitem", $itemNumber);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError();
                } else {
                    $decode = json_decode($response, true);
                    if($decode["authorized"] == false){
                        return $this->InvalidLoginResponse();
                    }
                    return $decode;
                }
            }
            return $decode;
        }
    }

    public function Order($order){
        if(!$this->Token){
            if($this->login() != 1){
                return $this->InvalidLoginResponse();
            }
        }

        if(!$order || !array_key_exists("Items", $order) || count($order["Items"]) < 1){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "No Items Provided"
                )
            );
        }
        foreach ($order["Items"] as &$value) {
            if(!array_key_exists("ItemNo", $value["ItemNo"]) || strlen($value["ItemNo"]) < 1 || !$value["Quantity"] || $value["Quantity"] < 1){
                return array(
                    "authorized" => true,
                    "success" => false,
                    "errors" => array(
                        "One or more line item was missing item number or had less than 1 quantity"
                    )
                );
            }
        }

        $curl = $this->PostRequestBuilder("integration/order/apiorder", $order);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError();
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                if($this->login() != 1){
                    return $this->InvalidLoginResponse();
                }

                $curl = $this->PostRequestBuilder("integration/order/apiorder", $order);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError();
                } else {
                    $decode = json_decode($response, true);
                    if($decode["authorized"] == false){
                        return $this->InvalidLoginResponse();
                    }
                    return $decode;
                }
            }
            return $decode;
        }
    }
    public function DropShipAccessories($order){
        if(!$this->Token){
            if($this->login() != 1){
                return $this->InvalidLoginResponse();
            }
        }

        if(!$order || !array_key_exists("Items", $order) || count($order["Items"]) < 1){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "No Items Provided"
                )
            );
        }
        foreach ($order["Items"] as &$value) {
            if(!array_key_exists("ItemNo", $value) || strlen($value["ItemNo"]) < 1 || !array_key_exists("Quantity", $value) || $value["Quantity"] < 1){
                return array(
                    "authorized" => true,
                    "success" => false,
                    "errors" => array(
                        "One or more line item was missing item number or had less than 1 quantity"
                    )
                );
            }
        }


        $curl = $this->PostRequestBuilder("integration/order/dropship", $order);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError();
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                if($this->login() != 1){
                    return $this->InvalidLoginResponse();
                }

                $curl = $this->PostRequestBuilder("integration/order/dropship", $order);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError();
                } else {
                    $decode = json_decode($response, true);
                    if($decode["authorized"] == false){
                        return $this->InvalidLoginResponse();
                    }
                    return $decode;
                }
            }
            return $decode;
        }
    }

    public function OneDaysShipping($date){
        if(!$this->Token){
            if($this->login() != 1){
                return $this->InvalidLoginResponse();
            }
        }

        if(!$date){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "date not provided"
                )
            );
        }

        $curl = $this->PostRequestBuilder("integration/shipping/oneday", $date);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError();
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                if($this->login() != 1){
                    return $this->InvalidLoginResponse();
                }

                $curl = $this->PostRequestBuilder("integration/shipping/oneday", $date);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError();
                } else {
                    $decode = json_decode($response, true);
                    if($decode["authorized"] == false){
                        return $this->InvalidLoginResponse();
                    }
                    return $decode;
                }
            }
            return $decode;
        }
    }

    private function login(){
        $model = array(
            "Email" => $this->Email,
            "Password" => $this->Password
        );
        $curl = $this->PostRequestBuilder("integration/authentication/login", $model);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return 0;
        } else {
            $decode = json_decode($response, true);
            if(array_key_exists("token", $decode) && array_key_exists("econtact", $decode) && $decode["econtact"]["success"] == 1){
                $this->Account = $decode;
                $this->Token = $decode["token"];
                return 1;
            }
        }
        return 0;
    }
}