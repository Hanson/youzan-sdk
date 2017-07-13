<?php


namespace Hanson\Youzan\Platform;


use Hanson\Foundation\AbstractAccessToken;

class AccessToken extends AbstractAccessToken
{

    protected $clientId;

    protected $secret;

    protected $tokenJsonKey = 'access_token';

    protected $expiresJsonKey = 'expires_in';

    protected $shopId;

    protected $prefix = 'youzan.platform.';

    const TOKEN_API = 'https://open.youzan.com/oauth/token';

    public function __construct($clientId, $secret, $shopId = null)
    {
        $this->appId = $this->clientId = $clientId;
        $this->secret = $secret;
        $this->appId = $this->shopId = $shopId;
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
            'grant_type' => 'authorize_platform',
        ];

        $params = $this->shopId ? array_merge($params, ['kdt_id' => $this->shopId]) : $params;

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