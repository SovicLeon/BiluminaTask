<?php

require_once "utils/sort/SortUtils.php";

class Article
{

    private const MAIN_GROUP_INDEX = 3;

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

        if (!isset($jsonRaw['rootGroup']['groups'][self::MAIN_GROUP_INDEX]['items'])) {
            return [];
        }

        $items = $jsonRaw['rootGroup']['groups'][self::MAIN_GROUP_INDEX]['items'];

        return SortUtils::sortByPrice($items, $sort);
    }
}
