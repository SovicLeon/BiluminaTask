<?php

// to do:
// -sorting

/*class Ad
{
    public static function all()
    {
        // From URL to get webpage contents.
        $url = "https://egi.bilumina.com/mw/api/v1/items/get?key=bf84d5ef-7fe2-4609-8b75-49279dd3271e";

        // Initialize a CURL session.
        $ch = curl_init();

        // Return Page contents.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //grab URL and pass it to the variable.
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);

        $data = json_decode($result, true);

        $json_raw = json_decode($result, true);

        $data = $json_raw['rootGroup']['groups'][2]['items'];

        return $data;
    }
}*/

class Ad
{
    public static function all($sort = null)
    {
        $url = "https://egi.bilumina.com/mw/api/v1/items/get?key=bf84d5ef-7fe2-4609-8b75-49279dd3271e";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);

        $json_raw = json_decode($result, true);

        $data = $json_raw['rootGroup']['groups'][2]['items'];

        if ($sort === 'priceAsc') {
            usort($data, function ($a, $b) {
                return $a['price'] <=> $b['price'];
            });
        }

        if ($sort === 'priceDesc') {
            usort($data, function ($a, $b) {
                return $b['price'] <=> $a['price'];
            });
        }

        return $data;
    }
}
