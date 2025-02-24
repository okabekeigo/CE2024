<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use League\CommonMark\CommonMarkConverter;

class KitchenController extends Controller
{
    /**
     * Show the kitchen page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('kitchen');
    }

    public function generateRecipe(Request $request)
    {
        $userInput = $request->input('ingredients'); // フォームからの入力値を取得
        $systemInput = 'あなたはシェフです。食材のリストが与えられます。それを使って料理のレシピを生成する必要があります。';

        $style = $request->input('style'); // スタイルの値を取得

        switch ($style) {
            case '和風':
                $systemInput .= ' 和風の料理を考えてください。';
                break;
            case '洋風':
                $systemInput .= ' 洋風の料理を考えてください。';
                break;
            case '中華風':
                $systemInput .= ' 中華風の料理を考えてください。';
                break;
            default:
                $systemInput .= ' 料理のスタイルが指定されていません。';
                break;
        }

        $htmlResult = $this->generateChatCompletion($systemInput, $userInput);

        return view('kitchen', ['value' => $htmlResult]);
    }

    private function generateChatCompletion($systemInput, $userInput)
    {
        $url = 'https://api.openai.com/v1/chat/completions';
        $apiKey = env('OPENAI_API_KEY'); // 環境変数からAPIキーを取得

        $client = new Client(); // GuzzleHTTPクライアントを作成

        $data = [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => $systemInput],
                ['role' => 'user', 'content' => $userInput],
            ],
            'max_tokens' => 10000,
        ];

        $response = $client->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);

        $json = json_decode($response->getBody(), true);
        $jsonResult = $json['choices'][0]['message']['content'] ?? ''; // 生成されたテキストを取得

        $converter = new CommonMarkConverter();
        $htmlResult = $converter->convert($jsonResult);

        return $htmlResult;
    }
}
