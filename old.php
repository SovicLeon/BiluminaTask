<?php

header('Content-Type: application/json');

// From URL to get webpage contents.
$url = "https://egi.bilumina.com/mw/api/v1/items/get?key=bf84d5ef-7fe2-4609-8b75-49279dd3271e";

// Initialize a CURL session.
$ch = curl_init();

// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);

$result = curl_exec($ch);

$decoded_json = json_decode($result, true);

var_dump(json_encode($decoded_json['rootGroup']['groups'][0]['items']['745735'], JSON_PRETTY_PRINT));

//echo $result; 

//-----------------

/*$test = $test = $test = '{
  "success": true,
  "cdnUrl": {
    "grid": "https://cdn.babycenter.si/products/250x250",
    "itemSmall": "https://cdn.babycenter.si/products/705x705",
    "itemBig": "https://cdn.babycenter.si/products/1200x1200"
  },
  "rootGroup": {
    "id": 30179,
    "code": "W013",
    "name": "Vozički",
    "groups": [
      {
        "id": 30286,
        "nameSmall": "Sedežne enote",
        "parentId": 30195,
        "items": [
          {
            "id": 9001,
            "name": "Sedež Premium",
            "price": 199.99,
            "sku": "SED-PREM-001"
          },
          {
            "id": 9002,
            "name": "Sedež Comfort",
            "price": 149.99,
            "sku": "SED-COMF-002"
          }
        ]
      },
      {
        "id": 30281,
        "nameSmall": "Sedežne enot2",
        "parentId": 30193,
        "items": [
          {
            "id": 9010,
            "name": "Sedež Basic",
            "price": 99.99,
            "sku": "SED-BASIC-010"
          },
          {
            "id": 9011,
            "name": "Sedež Deluxe",
            "price": 179.99,
            "sku": "SED-DELUX-011"
          }
        ]
      }
    ]
  }
}';


$parsed = json_decode($test, true);

$data = $parsed['rootGroup']['groups'][0];

$json_string = json_encode($data, JSON_PRETTY_PRINT);

var_dump($data);

echo "----------------------------------";

var_dump($data['items'][0]);
*/
