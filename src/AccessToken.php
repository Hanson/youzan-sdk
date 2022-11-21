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
    protected $expiresJsonKey = 'expires';

    /**
     * Youzan kdt id.
     *
     * @var string
     */
    protected $kdtId;

    /**
     * cache prefix.
     *
     * @var string
     */
    protected $prefix = 'youzan.cache.';

    const TOKEN_API = 'https://open.youzanyun.com/auth/token';

    public function __construct(Youzan $app)
    {
        $this->app = $app;
        $config = $app->getConfig();

        $this->clientId = $app->getDev() ? $config['dev_client_id'] : $config['client_id'];
        $this->secret = $app->getDev() ? $config['dev_client_secret'] : $config['client_secret'];
        $this->kdtId = $config['kdt_id'] ?? null;
        $this->appId = $this->clientId.$this->kdtId;
    }
    
    public function getToken($forceRefresh = false)
    {
        return $this->token ?: parent::getToken($forceRefresh);
    }

    /**
     * Get token from remote server.
     *
     * @return mixed
     */
    public function getTokenFromServer()
    {
        $response = $this->getHttp()->json(self::TOKEN_API, [
            'client_id' => $this->clientId,
            'client_secret' => $this->secret,
            'authorize_type' => 'silent',
            'grant_id' => $this->kdtId,
        ]);

        return json_decode(strval($response->getBody()), true)['data'];
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
