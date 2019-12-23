Documentation can be found at https://api.lipseys.com

Package install is through composer at 


**Example Implimentation**

run in project to setup autoloading

````composer dump-autoload -o````

````
<?php
//run the following to setup autoloading
//composer dump-autoload -o
require_once('vendor/autoload.php'); //only needed if not run anywhere else


use lipseys\ApiIntegration\LipseysClient;


$client = new LipseysClient("email@email.com", "password");


//print_r($client->Catalog());

//print_r($client->CatalogItem("RU1022RB"));

//print_r($client->PricingAndQuantity());

//print_r($client->ValidateItem("RU1022RB"));

/*print_r($client->Order(array(
    "PoNumber" => "Po Number", //Required
    "EmailConfirmation" => true,
    "Items" => array( //Required: at least one item
        array(
            "ItemNo" => "RULCP", //Required
            "Quantity" => 1, //Required: at least 1
            "Note" => "note"
        )
    )
)));*/

/*print_r($client->DropShipAccessories(array(
    "PoNumber" => "Po Number", //Required
    "BillingName" => "Billing Name", //Required
    "BillingAddressLine1" => "1234 Street Dr.", //Required
    "BillingAddressLine2" => "Room 3",
    "BillingAddressCity" => "Baton Rouge", //Required
    "BillingAddressState" => "LA", //Required
    "BillingAddressZip" => "70403", //Required
    "ShippingName" => "Shipping Name", //Required
    "ShippingAddressLine1" => "5678 Other st", //Required
	"ShippingAddressLine2" => "floor 2",
	"ShippingAddressCity" => "Metarie", //Required
	"ShippingAddressState" => "LA", //Required
	"ShippingAddressZip" => "70001", //Required
	"MessageForSalesExec" => "Thanks", //Required
    "Overnight" => false,
    "Items" => array( //Required: at least one item
        array(
            "ItemNo" => "RULCP", //Required
            "Quantity" => 1, //Required: at least 1
            "Note" => "note"
        )
    )
)));*/
__

$date = new DateTime();
$date->modify('-5 day');
//print_r($client->OneDaysShipping($date->format("m/d/y")));
````