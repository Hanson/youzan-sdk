<?php


namespace Hanson\Youzan\Personal;


use Hanson\Foundation\AbstractAccessToken;

class AccessToken extends AbstractAccessToken
{

    protected $clientId;

    protected $secret;

    private $kdtId;

    protected $tokenJsonKey = 'access_token';

    protected $expiresJsonKey = 'expires_in';

    protected $shopId;

    protected $prefix = 'youzan.personal.';

    const TOKEN_API = 'https://open.youzan.com/oauth/token';

    public function __construct($clientId, $secret, $kdtId)
    {
        $this->appId = $this->clientId = $clientId;
        $this->secret = $secret;
        $this->kdtId = $kdtId;
    }

    /**
     * Get token from remote server.
     *
     * @return mixed
     */
    public function getTokenFromServer()
    {
        $params = [
            'client_id' => $this->clientId,
            'client_secret' => $this->secret,
            'grant_type' => 'silent',
            'kdt_id' => $this->kdtId,
        ];

        $response = $this->getHttp()->post(self::TOKEN_API, $params);

        return json_decode(strval($response->getBody()), true);
    }

    /**
     * Throw exception if token is invalid.
     *
     * @param $result
     * @return mixed
     * @throws \Exception
     */
    public function checkTokenResponse($result)
    {
        if (isset($result['error'])) {
            throw new \Exception($result['error_description']);
        }
    }

    /**
     * @param mixed $shopId
     */
    public function setShopId($shopId)
    {
        $this->appId = $this->shopId = $shopId;
    }
}