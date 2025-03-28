<?php
function getTangoStreamInfo($streamId) {
    $url = "https://gateway.lemonshcherbet.com/stream/social/v1/{$streamId}/info";
    
    $params = [
        "includeStream" => "false",
        "includeAnchor" => "false",
        "includeAnchorPoints" => "false",
        "includeViewerCount" => "false",
        "includeLikeCount" => "false",
        "includePostId" => "false",
        "includeTotalPointsInStream" => "false",
        "includeUniqueViewerCount" => "false",
        "includeBlps" => "false",
        "includeStickers" => "true"
    ];

    $queryString = http_build_query($params);
    $fullUrl = "{$url}?{$queryString}";

    $headers = [
        "Accept-Encoding: gzip",
        "Authorization: Bearer YOUR",
        "Connection: Keep-Alive",
        "foreground_id: YOUR",
        "Host: gateway.lemonshcherbet.com",
        "interaction_id: YOUR",
        "tg-carrier-country: cn",
        "tg-loc-country: TR",
        "tg-loc-language: tr",
        "tg-vpn: 1",
        "User-Agent: YOUR",
        "X-APP-AB: v=1;proxy=0;referrer=webgoodeta.com;pcidss=0",
        "X-App-Client-Session-Id: YOUR"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $fullUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");

    $response = curl_exec($ch);
    
    // Hata kontrolü
    if (curl_errno($ch)) {
        return ['error' => true, 'message' => "cURL Error: ".curl_error($ch)];
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode != 200) {
        return ['error' => true, 'message' => "HTTP Error: $httpCode"];
    }

    // Hex'e çevirerek binary içinde URL ara
    $hexResponse = bin2hex($response);
    $urlPattern = '68747470733a2f2f63696e656d612d'; // "https://cinema-" hex karşılığı
    $urls = [];
    $position = 0;

    while (($pos = strpos($hexResponse, $urlPattern, $position)) !== false) {
        $urlHex = substr($hexResponse, $pos, 600); // URL'ler ~300 karakteri geçmiyor
        $url = hex2bin($urlHex);
        
        // URL'yi sonlandıran ilk boşluk/control karakterini bul
        preg_match('/https:\/\/[^\s\x00-\x1F]+/i', $url, $matches);
        if (!empty($matches[0])) {
            $cleanUrl = filter_var($matches[0], FILTER_SANITIZE_URL);
            
            // URL'yi expire_at parametresine göre düzenle
            $urlParts = parse_url($cleanUrl);
            parse_str($urlParts['query'], $queryParams);
            
            if (isset($queryParams['expire_at'])) {
                // Sadece rakam karakterlerini al
                $cleanExpireAt = preg_replace('/[^0-9]/', '', $queryParams['expire_at']);
                $queryParams['expire_at'] = $cleanExpireAt;
                
                // Güncellenmiş URL'yi oluştur
                $newQuery = http_build_query($queryParams);
                $cleanUrl = $urlParts['scheme'] . '://' . $urlParts['host'] . $urlParts['path'] . '?' . $newQuery;
                
                $urls[] = $cleanUrl;
            }
        }
        $position = $pos + 1;
    }

    $urls = array_unique($urls);
    return ['error' => !count($urls), 'urls' => array_values($urls)];
}

header('Content-Type: application/json');

if (isset($_GET['streamid'])) {
    $result = getTangoStreamInfo($_GET['streamid']);
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
} else {
    echo json_encode(
        ['error' => true, 'message' => 'Missing streamid parameter'],
        JSON_PRETTY_PRINT
    );
}
?>
