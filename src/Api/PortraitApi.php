<?php
/**
 * User: liShun
 */
declare (strict_types=1);

namespace Lishun\EasyTencentIm\Api;

use JsonException;
use Lishun\EasyTencentIm\Exception\TencentImException;
use GuzzleHttp\Exception\GuzzleException;
use Lishun\EasyTencentIm\Param\PortraitParam\PortraitGetParam;
use Lishun\EasyTencentIm\Param\PortraitParam\PortraitSetParam;
use Lishun\EasyTencentIm\Util\EasyTencentImHelper;

class PortraitApi extends Base
{
    /**
     * 设置资料
     * @param string $unqId
     * @param PortraitSetParam|array|null $fields
     * @param array $customPortrait
     * @return array|null
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function portraitSet(
        string                      $unqId = '',
        array|PortraitSetParam|null $fields = null,
        array                       $customPortrait = [],
    ): array {
        $profileItem = [];

        if (!$fields && !$customPortrait) {
            throw new TencentImException('portraitSet 参数错误');
        }

        //标配资料
        if ($fields instanceof PortraitSetParam) {
            $fields = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($fields));
        }
        if ($fields) {
            foreach ($fields as $key => $value) {
                $profileItem[] = [
                    'Tag' => $key,
                    'Value' => $value
                ];
            }
        }

        //自定义资料
        if ($customPortrait) {
            foreach ($customPortrait as $k => $v) {
                $profileItem[] = [
                    'Tag' => $k,
                    'Value' => $v
                ];
            }
        }

        $uri = '/v4/profile/portrait_set';

        $postData['From_Account'] = $unqId;
        $postData['ProfileItem'] = $profileItem;

        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 获取用户资料
     * @param string[] $unqId
     * @param array|PortraitGetParam|null $fields
     * @param array $customPortrait
     * @return array|null
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function portraitGet(
        array                       $unqId = [],
        array|PortraitGetParam|null $fields = null,
        array                       $customPortrait = [],
    ): array {

        if (!$fields && !$customPortrait) {
            throw new TencentImException('portraitSet 参数错误');
        }

        $need = [];
        if ($fields instanceof PortraitGetParam) {
            $fields = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($fields));
            if ($fields) {
                foreach ($fields as $key => $value) {
                    $need[] = $key;
                }
            }else{
                //如果不传，则全部获取
                $obj = new PortraitGetParam();
                $obj = EasyTencentImHelper::toArray($obj);
                foreach ($obj as $k => $v) {
                    $need[] = $k;
                }
            }
        } else {
            $fields && ($need = $fields);
        }

        if ($customPortrait) {
            foreach ($customPortrait as $v) {
                $need[] = $v;
            }
        }

        $postData['To_Account'] = array_map('strval', $unqId);
        $postData['TagList'] = $need;

        $uri = '/v4/profile/portrait_get';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 获取一个用户的资料，自定义字段手动填入
     * 默认全部标配资料字段
     * @param string $unqId
     * @param array|PortraitGetParam|null $fields
     * @param array $customPortrait
     * @return array|null
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function portraitOneGet(
        string                      $unqId = '',
        array|PortraitGetParam|null $fields = null,
        array                       $customPortrait = [],
    ): array {
        if (!$fields) {
            $fields = [];
            $obj = new PortraitGetParam();
            $obj = EasyTencentImHelper::toArray($obj);
            foreach ($obj as $k => $v) {
                $fields[] = $k;
            }
        }
        return $this->portraitGet([$unqId], $fields, $customPortrait);
    }
}
