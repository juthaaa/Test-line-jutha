<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '3HybiCTMChuEZhNmEk3HntMDNMggKiL5LFVMpXmhuN9xTdleCAmYz1hLQGO4F8co/IQJG0/jX7OFyEu3rJdkYaDofcwGDPrq+8GppxkB/ZdugXt+h70LpxINX+f0WF74e8iTMa3qO6fVkV8mIcl8bQdB04t89/1O/w1cDnyilFU='; 



$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array



if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];
        $text = $event['message']['text'];

        $test2= { "type": "bubble",
                 "body": {
                 "type": "box",
                 "layout": "vertical",
                "contents": [
                 {
                  "type": "text",
                  "text": $event['message']['text'],
                    "weight": "bold",
                    "size": "xl"
                  },
                  {
                    "type": "box",
                    "layout": "vertical",
                    "margin": "lg",
                    "spacing": "sm",
                    "contents": [
                      {
                        "type": "box",
                        "layout": "baseline",
                        "spacing": "sm",
                        "contents": [
                          {
                            "type": "text",
                            "text": "Dead",
                            "color": "#aaaaaa",
                            "size": "sm",
                            "flex": 1
                          },
                          {
                            "type": "text",
                            "text": "100",
                            "wrap": true,
                            "color": "#666666",
                            "size": "sm",
                            "flex": 5
                          }
                        ]
                      },
                      {
                        "type": "box",
                        "layout": "baseline",
                        "spacing": "sm",
                        "contents": [
                          {
                            "type": "text",
                            "text": "Time",
                            "color": "#aaaaaa",
                            "size": "sm",
                            "flex": 1
                          },
                          {
                            "type": "text",
                            "text": "10:00 - 23:00",
                            "wrap": true,
                            "color": "#666666",
                            "size": "sm",
                            "flex": 5
                          }
                        ]
                      }
                    ]
                  }
                ]
              }
            };
        
        
        
        
        
        
        
        
        $data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'text', 'text' => $text2]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
        
    }
}

echo "OK3";




function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>
