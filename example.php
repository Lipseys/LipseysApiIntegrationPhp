<?php

include('src/LipseysClient.php');
use lipseys\ApiIntegration\LipseysClient;


$client = new LipseysClient("username@email.com", "password");


//print_r($client->Catalog());
//print_r($client->CatalogItem("RU1022RB"));
//print_r($client->PricingAndQuantity());
//print_r($client->ValidateItem("RU1022RB"));
/*print_r($client->Order(array(
    "PONumber" => "Po Number",
    "EmailConfirmation" => true,
    "Items" => array(
        array(
            "ItemNo" => "RULCP",
            "Quantity" => 1,
            "Note" => "note"
        )
    )
)));*/
/*print_r($client->DropShipAccessories(array(
    "Warehouse" => "",
    "PONumber" => "Po Number",
    "BillingName" => "Billing Name",
    "BillingAddressLine1" => "1234 Street Dr.",
    "BillingAddressLine2" => "Room 3",
    "BillingAddressCity" => "Baton Rouge",
    "BillingAddressState" => "LA",
    "BillingAddressZip" => "70403",
    "ShippingName" => "Shipping Name",
    "ShippingAddressLine1" => "5678 Other st",
	"ShippingAddressLine2" => "floor 2",
	"ShippingAddressCity" => "Metarie",
	"ShippingAddressState" => "LA",
	"ShippingAddressZip" => "70001",
	"MessageForSalesExec" => "Thanks",
    "Overnight" => false,
    "Items" => array(
        array(
            "ItemNo" => "RULCP",
            "Quantity" => 1,
            "Note" => "note"
        )
    )
)));*/

$date = new DateTime();
$date->modify('-5 day');
//print_r($client->OneDaysShipping($date->format("m/d/y")));