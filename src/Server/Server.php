<?php


namespace Hanson\Youzan\Server;


use Hanson\Youzan\Core\AccessToken;
use Hanson\Youzan\Core\Exceptions\SignatureException;

class Server
{
    protected $accessToken;

    /**
     * Server constructor.
     * @param AccessToken $accessToken
     */
    public function __construct(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * listen the youzan push
     *
     * @return mixed
     */
    public function serve()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($data){
            var_dump(['code' => 0, 'msg' => 'success']);
        }

        $this->checkSignature($data);

        return json_decode(urldecode($data['msg']),true);
    }

    /**
     * check the signature and throw exception while invalid
     *
     * @param $data
     * @throws SignatureException
     */
    private function checkSignature($data)
    {
        $msg = $data['msg'];

        $sign = md5($this->accessToken->appId.$msg.$this->accessToken->secret);

        if($sign != $data['sign']){
            throw new SignatureException('invalid signature');
        }
    }

}