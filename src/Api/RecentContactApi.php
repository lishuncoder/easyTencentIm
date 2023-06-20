<?php
/**
 * User: liShun
 */
declare (strict_types=1);

namespace Lishun\EasyTencentIm\Api;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Lishun\EasyTencentIm\Exception\TencentImException;
use Lishun\EasyTencentIm\Param\RecentContactParam\DeleteParam;
use Lishun\EasyTencentIm\Param\RecentContactParam\GetListParam;
use Lishun\EasyTencentIm\Util\EasyTencentImHelper;

class RecentContactApi extends Base
{

    /**
     * 拉取会话列表
     * @param GetListParam|array $getListParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function getList(
        GetListParam|array $getListParam
    ): array {

        if (is_array($getListParam)) {
            $postData = $getListParam;
        } else {
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($getListParam));
        }

        $uri = '/v4/recentcontact/get_list';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }


    /**
     * 删除单个会话
     * @param DeleteParam|array $getListParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function delete(
        DeleteParam|array $getListParam
    ): array {

        if (is_array($getListParam)) {
            $postData = $getListParam;
        } else {
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($getListParam));
        }

        $uri = '/v4/recentcontact/delete';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }

}
