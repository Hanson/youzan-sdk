<?php
/**
 * Created by PhpStorm.
 * User: HanSon
 * Date: 2017/2/23
 * Time: 9:52
 */

namespace Hanson\Youzan\Core;

use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

class Http
{
    /**
     * Http client.
     *
     * @var HttpClient
     */
    protected $client;

    /**
     * Return GuzzleHttp\Client instance.
     *
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        if (!($this->client instanceof HttpClient)) {
            $this->client = new HttpClient();
        }
        return $this->client;
    }

    /**
     * POST request.
     *
     * @param string       $url
     * @param array|string $options
     *
     * @return string
     */
    public function post($url, $options = [])
    {
        $key = is_array($options) ? 'form_params' : 'body';
        return $this->request($url, 'POST', [$key => $options]);
    }

    /**
     * Upload file.
     *
     * @param string $url
     * @param array $files
     * @param array $form
     * @param array $queries
     * @return string
     */
    public function upload($url, array $form = [], array $files = [], array $queries = [])
    {
        $multipart = [];
        foreach ($files as $name => $path) {
            if (is_array($path)){
                foreach ($path as $item) {
                    $multipart[] = [
                        'name' => $name . '[]',
                        'contents' => fopen($item, 'r'),
                    ];
                }
            }else{
                $multipart[] = [
                    'name' => $name,
                    'contents' => fopen($path, 'r'),
                ];
            }
        }
        foreach ($form as $name => $contents) {
            $multipart[] = compact('name', 'contents');
        }

        return $this->request($url, 'POST', ['query' => $queries, 'multipart' => $multipart]);
    }

    /**
     * Make a request.
     *
     * @param string $url
     * @param string $method
     * @param array $options
     * @return string
     */
    public function request($url, $method = 'GET', $options = [])
    {
        $response = $this->getClient()->request($method, $url, $options);
        return $response->getBody()->getContents();
    }

}