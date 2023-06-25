<?php
/**
 * User: liShun
 */
declare (strict_types=1);

namespace Lishun\EasyTencentIm\Api;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Lishun\EasyTencentIm\Exception\TencentImException;
use Lishun\EasyTencentIm\Param\RecentContactParam\CreateContactGroupParam;
use Lishun\EasyTencentIm\Param\RecentContactParam\DeleteParam;
use Lishun\EasyTencentIm\Param\RecentContactParam\GetListParam;
use Lishun\EasyTencentIm\Param\RecentContactParam\UpdateContactGroupParam;
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

    /**
     * 创建会话分组数据
     * @param CreateContactGroupParam|array $contactGroupParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function createContactGroup(
        CreateContactGroupParam|array $contactGroupParam
    ): array {

        if (is_array($contactGroupParam)) {
            $postData = $contactGroupParam;
        } else {
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($contactGroupParam));

            //处理item
//            $groupContactItem = $postData['GroupContactItem'];
//            foreach ($groupContactItem as $key => $value) {
//                $tmp = $value['ContactItemParam'];
//                $groupContactItem[$key]['ContactItemParam'] = [];
//
//                //构造ContactItem
//                foreach ($tmp as $k => $v) {
//                    $tmpV = [
//                        'To_Account' => $k,
//                        'Type' => $v
//                    ];
//                    $groupContactItem[$key]['ContactItemParam'][] = $tmpV;
//                }
//            }
//            $postData['GroupContactItem'] = $groupContactItem;
        }

        $uri = '/v4/recentcontact/create_contact_group';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }


    /**
     * 删除会话分组数据
     * @param string $From_Account 请求方uid
     * @param string|string[] $GroupName 当前仅支持单个删除
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function delContactGroup(
        string       $From_Account = '',
        string|array $GroupName = ''
    ): array {

        $postData = [
            'From_Account' => $From_Account,
            'GroupName' => is_array($GroupName) ? $GroupName : [$GroupName]
        ];

        $uri = '/v4/recentcontact/del_contact_group';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }

    /**
     * 更新会话分组数据
     * @param UpdateContactGroupParam|array $contactGroupParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function updateContactGroup(
        UpdateContactGroupParam|array $contactGroupParam
    ): array {

        if (is_array($contactGroupParam)) {
            $postData = $contactGroupParam;
        } else {
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($contactGroupParam));
        }

        $uri = '/v4/recentcontact/update_contact_group';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }
}
