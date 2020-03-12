<?php
//run the following to setup autoloading
//composer dump-autoload -o
require_once('vendor/autoload.php'); //only needed if not run anywhere else


use lipseys\ApiIntegration\LipseysClient;


$client = new LipseysClient("username", "password");


//print_r($client->Catalog());
//print_r($client->CatalogItem("RU1022RB"));
//print_r($client->PricingAndQuantity());
//print_r($client->ValidateItem("RU1022RB"));
/*print_r($client->Order(array(
    "PONumber" => "Po Number",
    "EmailConfirmation" => true,
    "DisableEmail" => true,
    "Items" => array(
        array(
            "ItemNo" => "RULCP",
            "Quantity" => 1,
            "Note" => "note"
        )
    )
)));*/
/*
print_r($client->DropShipAccessories(array(
    "PoNumber" => "PoNumber",
    "BillingName" => "BillingName",
    "BillingAddressLine1" => "BillingAddressLine1",
    "BillingAddressLine2" => "BillingAddressLine2",
    "BillingAddressCity" => "BillingAddressCity",
    "BillingAddressState" => "LA",
    "BillingAddressZip" => "70764",
    "ShippingName" => "ShippingName",
    "ShippingAddressLine1" => "ShippingAddressLine1",
	"ShippingAddressLine2" => "ShippingAddressLine2",
	"ShippingAddressCity" => "Baton Rouge",
	"ShippingAddressState" => "LA",
	"ShippingAddressZip" => "70764",
	"MessageForSalesExec" => "Thanks",
    "DisableEmail" => true,
    "Overnight" => false,
    "Items" => array(
        array(
            "ItemNo" => "LP171714",
            "Quantity" => 1,
            "Note" => ""
        )
    )
)));*/

/*print_r($client->DropShipFirearms(array(
    "Ffl" => "123123123123123",
    "Name" => "Po Number",
    "Po" => "Billing Name",
    "Phone" => "1234 Street Dr.",
    "DelayShipping" => false,
    "DisableEmail" => true,
    "Items" => array(
        array(
            "ItemNo" => "RU1022RB",
            "Quantity" => 1,
            "Note" => "note"
        )
    )
)));*/

$date = new DateTime();
$date->modify('-5 day');
//print_r($client->OneDaysShipping($date->format("m/d/y")));