<?php


namespace Hanson\Youzan\Oauth;


use Hanson\Youzan\AccessToken as BaseAccessToken;
use Symfony\Component\HttpFoundation\Request;

class AccessToken extends BaseAccessToken
{

    /**
     * @var Request
     */
    protected $request;

    protected $redirectUri;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }

    /**
     * @return mixed
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

}