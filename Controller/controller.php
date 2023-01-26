<?php

$address1 = $_REQUEST["address1"];
$address2 = $_REQUEST["address2"];
$city = $_REQUEST["city"];
$state = $_REQUEST["state"];
$zipcode = $_REQUEST["zipcode"];

$baseurl = 'https://secure.shippingapis.com/ShippingAPI.dll?API=Verify&XML=';
$data = ["<AddressValidateRequest USERID='823GALAX3237'>
<Revision>1</Revision>
<Address ID='0'>
<Address1>".$address1."</Address1>
<Address2>".$address2."</Address2>
<City>".$city."</City>
<State>".$state."</State>
<Zip5>".$zipcode."</Zip5>
<Zip4/>
</Address>
</AddressValidateRequest>"];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseurl.=http_build_query($data)); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch);  

if(str_contains($output, 'Invalid')){
    echo "error";
}
else{
    $xml=simplexml_load_string($output) or die("Error: Cannot create object");
    $res_address1 = $xml->Address->Address1;
    $res_address2 = $xml->Address->Address2;
    $res_city = $xml->Address->City;
    $res_state = $xml->Address->State;
    $res_zip = $xml->Address->Zip5;


    $res["address1"] = $res_address1;
    $res['address2'] = $res_address2;
    $res['city'] = $res_city;
    $res['state'] = $res_state;
    $res['zip'] = $res_zip;

    echo json_encode($res);
    $output = json_encode($res);

    curl_close($ch);

}

?>