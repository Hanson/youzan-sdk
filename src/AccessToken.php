<?php


namespace Hanson\Youzan;


use Hanson\Foundation\AbstractAccessToken;

class AccessToken extends AbstractAccessToken
{

    /**
     * Youzan client id.
     *
     * @var
     */
    protected $clientId;

    /**
     * Youzan secret.
     *
     * @var string
     */
    protected $secret;

    /**
     * key of token in json.
     *
     * @var string
     */
    protected $tokenJsonKey = 'access_token';

    /**
     * key of expires in json.
     *
     * @var string
     */
    protected $expiresJsonKey = 'expires_in';

    /**
     * Youzan kdt id.
     *
     * @var string
     */
    protected $kdtId;

    /**
     * Youzan sdk type.
     *
     * @var
     */
    protected $type;

    /**
     * cache prefix.
     *
     * @var string
     */
    protected $prefix = 'youzan.cache.';

    const TOKEN_API = 'https://open.youzan.com/oauth/token';

    public function __construct($clientId, $secret, $kdtId = null)
    {
        $this->clientId = $clientId;
        $this->secret = $secret;
        $this->kdtId = $kdtId;
        $this->appId = $clientId.$kdtId;
    }

    /**
     * Get token from remote server.
     *
     * @return mixed
     */
    public function getTokenFromServer()
    {
        $params = $this->type === Youzan::PERSONAL ? $this->personalTokenParams() : $this->platformTokenParams();

        $response = $this->getHttp()->post(self::TOKEN_API, $params);

        return json_decode(strval($response->getBody()), true);
    }

    private function personalTokenParams()
    {
        return [
            'client_id' => $this->clientId,
            'client_secret' => $this->secret,
            'grant_type' => 'silent',
            'kdt_id' => $this->kdtId,
        ];
    }

    private function platformTokenParams()
    {
        $params = [
            'client_id' => $this->clientId,
            'client_secret' => $this->secret,
            'grant_type' => 'authorize_platform',
        ];

        return $this->kdtId ? array_merge($params, ['kdt_id' => $this->kdtId]) : $params;
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

    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $kdtId
     */
    public function setKdtId($kdtId)
    {
        $this->appId = $this->kdtId = $kdtId;
    }

    public function getKdtId()
    {
        return $this->kdtId;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }
}