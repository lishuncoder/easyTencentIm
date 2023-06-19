<?php
/**
 * User: liShun
 */

namespace Lishun\EasyTencentIm\Api;


class Operating extends Base
{

    protected string $version = 'v4';

    //查看最近30天运营状态
    public function getAppInfo(array $requestField = [])
    {
        $uri = '/v4/openconfigsvr/getappinfo';
        return $this->postJsonRequest($this->buildGetData($uri), ['RequestField' => $requestField]);
    }
}
