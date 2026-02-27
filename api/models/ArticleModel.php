<?php

require_once "utils/sort/SortUtils.php";

class Article
{
    public static function all(?string $sort = null): array
    {
        $url = "https://egi.bilumina.com/mw/api/v1/items/get?key=bf84d5ef-7fe2-4609-8b75-49279dd3271e";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
        ]);

        $result = curl_exec($ch);

        if ($result === false) {
            throw new RuntimeException("Curl error: " . curl_error($ch));
        }

        $jsonRaw = json_decode($result, true);

        if (!isset($jsonRaw['rootGroup']['groups'][2]['items'])) {
            return [];
        }

        $items = $jsonRaw['rootGroup']['groups'][2]['items'];

        return SortUtils::sortByPrice($items, $sort);
    }
}
