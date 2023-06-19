<?php
/**
 * User: liShun
 */

namespace Lishun\EasyTencentIm\Api;


use Lishun\EasyTencentIm\Exception\TencentImException;
use GuzzleHttp\Exception\GuzzleException;

class Profile extends Base
{

    protected string $version = 'v4';

    /**
     * 设置资料
     * https://cloud.tencent.com/document/product/269/1640
     * {
     * "From_Account":"id",
     * "ProfileItem":
     * [
     * {
     * "Tag":"Tag_Profile_IM_Nick",
     * "Value":"MyNickName"
     * }
     * ]
     * }
     * @param string $unqId
     * @param array $fields
     * @return array|null
     * @throws GuzzleException
     * @throws TencentImException
     */
    public function setProfile(string $unqId = '', array $fields = []): ?array
    {
        $profileItem = [];
        foreach ($fields as $key => $value) {
            $profileItem[] = [
                'Tag'   => $key,
                'Value' => $value
            ];
        }

        $uri   = '/v4/profile/portrait_set';
        $unqId = (string)$unqId;

        $postData['From_Account'] = $unqId;
        $postData['ProfileItem']  = $profileItem;

        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 获取用户资料
     * {
     * "To_Account":["id1"],
     * "TagList":
     * [
     * "Tag_Profile_IM_Nick",
     * "Tag_Profile_IM_AllowType",
     * "Tag_Profile_IM_SelfSignature",
     * "Tag_Profile_Custom_Test"
     * ]
     * }
     * @param mixed $unqId
     * @param array $fields
     * @return array|null
     * @throws GuzzleException
     * @throws TencentImException
     */
    public function getProfile(mixed $unqId = '', array $fields = []): ?array
    {
        $uri = '/v4/profile/portrait_get';

        $postData['To_Account'] = is_array($unqId) ? array_map('strval', $unqId) : [(string)$unqId];
        if (!$fields) {
            $fields = [
                'Tag_Profile_IM_Nick',
                'Tag_Profile_IM_Role'
            ];
        }
        $postData['TagList'] = $fields;

        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }
}
