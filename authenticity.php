<?php

class Authenticity
{

    public function get (int $inn)
    {
        $postData = http_build_query(
            [
                'mode'           => 'quick',
                'page'           => 1,
                'pageSize'       => 10,
                'query'          => $inn
            ]
        );

        $opts = ['http' =>
                    [
                        'method'  => 'POST',
                        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n" .
                            "Accept: application/json, text/javascript, */*;\r\n" .
                            "User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n",
                        'content' => $postData
                    ]
                ];

        $context  = stream_context_create($opts);
        $result = json_decode(file_get_contents('https://pb.nalog.ru/search-proc.json', false, $context), true);
        $isAuthentic = true;

        foreach ($result as $element) {
            if (!empty($element['data'])) {
                $isAuthentic = false;
                break;
            }
        }

        $message = ($isAuthentic) ? 'По заданным критериям поиска сведений не найдено.' : 'Наличие признака недостоверности';
        $return = [
            'inn' => $inn,
            'message' => $message,
            'authenticity' => json_encode($isAuthentic)
        ];

        return $return;
    }
}
