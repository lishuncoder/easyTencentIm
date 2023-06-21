<?php
/**
 * User: liShun
 */
declare(strict_types=1);

namespace Lishun\EasyTencentIm\Api;


use JsonException;
use Lishun\EasyTencentIm\Constants\RelationshipsConst;
use Lishun\EasyTencentIm\Exception\TencentImException;
use GuzzleHttp\Exception\GuzzleException;
use Lishun\EasyTencentIm\Param\RelationshipsParam\FriendAddParam;
use Lishun\EasyTencentIm\Param\RelationshipsParam\FriendGetListParam;
use Lishun\EasyTencentIm\Param\RelationshipsParam\FriendImportParam;
use Lishun\EasyTencentIm\Param\RelationshipsParam\FriendUpdateParam;
use Lishun\EasyTencentIm\Util\EasyTencentImHelper;

/**
 * 好友关系链
 * https://cloud.tencent.com/document/product/269/1643
 */
class RelationshipsApi extends Base
{

    /**
     * 添加好友
     * @param array|FriendAddParam $addFriends
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function friendAdd(
        array|FriendAddParam $addFriends = []
    ): array {

        if (is_array($addFriends)) {
            $postData = $addFriends;
        } else {
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($addFriends));
        }
        $uri = '/v4/sns/friend_add';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 导入好友
     * @param array|FriendImportParam $friendImportParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function friendImport(
        array|FriendImportParam $friendImportParam = []
    ): array {

        if (is_array($friendImportParam)) {
            $postData = $friendImportParam;
        } else {
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($friendImportParam));

            //处理tag
            $addFriendItem = $postData['AddFriendItemParam'];
            foreach ($addFriendItem as $key => $value) {
                $tmp = $value['CustomItem'];
                $addFriendItem[$key]['CustomItem'] = [];

                //构造tag
                foreach ($tmp as $k => $v) {
                    $tmpV = [
                        'Tag' => $k,
                        'Value' => $v
                    ];
                    $addFriendItem[$key]['CustomItem'][] = $tmpV;
                }
            }
            $postData['AddFriendItemParam'] = $addFriendItem;

        }
        $uri = '/v4/sns/friend_import';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }


    /**
     * 更新好友
     * @param array|FriendUpdateParam $friendUpdateParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function friendUpdate(
        array|FriendUpdateParam $friendUpdateParam = []
    ): array {

        if (is_array($friendUpdateParam)) {
            $postData = $friendUpdateParam;
        } else {
            //tag处理
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($friendUpdateParam));
            $updateItems = $postData['UpdateItemParam'];
            foreach ($updateItems as $key => $value) {
                $tmp = $value['SnsItemParam'];
                $updateItems[$key]['SnsItemParam'] = [];

                //构造tag
                foreach ($tmp as $k => $v) {
                    $tmpV = [
                        'Tag' => $k,
                        'Value' => $v
                    ];
                    $updateItems[$key]['SnsItemParam'][] = $tmpV;
                }
            }
            $postData['UpdateItemParam'] = $updateItems;
        }

        $uri = '/v4/sns/friend_update';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 删除好友
     * @param string $From_Account
     * @param array $To_Account
     * @param string|null $DeleteType
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function friendDelete(
        string  $From_Account,
        array   $To_Account,
        ?string $DeleteType = null
    ): array {

        $To_Account = array_map('strval', $To_Account);
        $postData = [
            'From_Account' => $From_Account,
            'To_Account' => $To_Account,
        ];
        if ($DeleteType === null) {
            $postData['DeleteType'] = RelationshipsConst::DeleteType_BOTH;
        }
        $uri = '/v4/sns/friend_delete';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 删除所有好友
     * @param string $From_Account
     * @param string|null $DeleteType
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function friendDeleteAll(
        string  $From_Account,
        ?string $DeleteType = null
    ): array {

        $postData = [
            'From_Account' => $From_Account,
        ];
        if ($DeleteType === null) {
            $postData['DeleteType'] = RelationshipsConst::DeleteType_BOTH;
        }
        $uri = '/v4/sns/friend_delete_all';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 校验好友
     * @param string $From_Account
     * @param string[] $To_Account
     * @param string $CheckType
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function friendCheck(
        string $From_Account,
        array  $To_Account,
        string $CheckType
    ): array {

        $To_Account = array_map('strval', $To_Account);
        $postData = [
            'From_Account' => $From_Account,
            'To_Account' => $To_Account,
            'CheckType' => $CheckType,
        ];

        $uri = '/v4/sns/friend_check';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }


    /**
     * 分页获取好友
     * @param string $From_Account
     * @param int $StartIndex 分页的起始位置
     * @param int|null $StandardSequence 上次拉好友数据时返回的 StandardSequence，如果 StandardSequence 字段的值与后台一致，后台不会返回标配好友数据
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function friendGet(
        string $From_Account = '',
        int    $StartIndex = 0,
        ?int   $StandardSequence = null
    ): array {

        $postData = [
            'From_Account' => $From_Account,
            'StartIndex' => $StartIndex,
        ];
        if ($StandardSequence !== null) {
            $postData['StandardSequence'] = $StandardSequence;
        }

        $uri = '/v4/sns/friend_get';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }


    /**
     * 拉取指定好友
     * @param FriendGetListParam|array $friendGetListParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function friendGetList(
        FriendGetListParam|array $friendGetListParam
    ): array {
        if (is_array($friendGetListParam)) {
            $postData = $friendGetListParam;
        } else {
            //tag处理
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($friendGetListParam));
            $tagList = $postData['TagListParam'];
            $postData['TagListParam'] = [];
            if ($tagList) {
                foreach ($tagList as $key => $value) {
                    $postData['TagListParam'][] = $key;
                }
            } else {
                $allTagList = EasyTencentImHelper::toArray($friendGetListParam);
                foreach ($allTagList as $key => $value) {
                    $postData['TagListParam'][] = $key;
                }
            }
            if ($postData['AllCustomTagList']) {
                $postData['TagListParam'] = array_merge($postData['TagListParam'], $postData['AllCustomTagList']);
            }
            unset($postData['AllCustomTagList']);
        }

        $uri = '/v4/sns/friend_get_list';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }


    /**
     * 添加黑名单
     * @param string $From_Account
     * @param array $To_Account
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function blackListAdd(
        string $From_Account = '',
        array  $To_Account = [],
    ): array {

        $To_Account = array_map('strval', $To_Account);
        $postData = [
            'From_Account' => $From_Account,
            'To_Account' => $To_Account,
        ];

        $uri = '/v4/sns/black_list_add';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }


    /**
     * 删除黑名单
     * @param string $From_Account
     * @param array $To_Account
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function blackListDelete(
        string $From_Account = '',
        array  $To_Account = [],
    ): array {

        $To_Account = array_map('strval', $To_Account);
        $postData = [
            'From_Account' => $From_Account,
            'To_Account' => $To_Account,
        ];

        $uri = '/v4/sns/black_list_delete';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }


    /**
     * 分页拉取黑名单
     * @param string $From_Account 需要拉取该 UserID 的黑名单
     * @param int $StartIndex 拉取的起始位置
     * @param int $MaxLimited 每页最多拉取的黑名单数
     * @param int $LastSequence 上一次拉黑名单时后台返回给客户端的 Seq，初次拉取时为0；（Rest API 接口拉取填 0 即可）
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function blackListGet(
        string $From_Account = '',
        int    $StartIndex = 0,
        int    $MaxLimited = 0,
        int    $LastSequence = 0
    ): array {

        $postData = [
            'From_Account' => $From_Account,
            'StartIndex' => $StartIndex,
            'MaxLimited' => $MaxLimited,
            'LastSequence' => $LastSequence,
        ];

        $uri = '/v4/sns/black_list_get';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }


    /**
     * 校验黑名单
     * @param string $From_Account
     * @param string[] $To_Account
     * @param string $CheckType
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function blackListCheck(
        string $From_Account = '',
        array  $To_Account = [],
        string $CheckType = RelationshipsConst::BlackCheckTye_Both,
    ): array {

        $To_Account = array_map('strval', $To_Account);
        $postData = [
            'From_Account' => $From_Account,
            'To_Account' => $To_Account,
            'CheckType' => $CheckType,
        ];

        $uri = '/v4/sns/black_list_check';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }


    /**
     * 添加分组
     * @param string $From_Account 需要为该 UserID 添加新分组
     * @param string[] $GroupName 新增分组列表
     * @param array|null $To_Account 需要加入新增分组的好友的 UserID 列表
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function groupAdd(
        string $From_Account = '',
        array  $GroupName = [],
        ?array $To_Account = null,
    ): array {

        $GroupName = array_map('strval', $GroupName);
        $postData = [
            'From_Account' => $From_Account,
            'GroupName' => $GroupName,
        ];
        if ($To_Account !== null) {
            $postData['To_Account'] = $To_Account;
        }

        $uri = '/v4/sns/group_add';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }


    /**
     * 删除分组
     * @param string $From_Account
     * @param string[] $GroupName
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function groupDelete(
        string $From_Account = '',
        array  $GroupName = [],
    ): array {

        $GroupName = array_map('strval', $GroupName);
        $postData = [
            'From_Account' => $From_Account,
            'GroupName' => $GroupName,
        ];

        $uri = '/v4/sns/group_delete';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 拉取分组
     * @param string $From_Account 指定要拉取分组的用户的 UserID
     * @param array|null $GroupName 要拉取的分组名称
     * @param string|null $NeedFriend 是否需要拉取分组下的 User 列表, Need_Friend_Type_Yes: 需要拉取, 不填时默认不拉取, 只有 GroupName 为空时有效
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function groupGet(
        string  $From_Account = '',
        ?array  $GroupName = null,
        ?string $NeedFriend = null
    ): array {

        $postData = [
            'From_Account' => $From_Account,
        ];

        if ($GroupName !== null) {
            $GroupName = array_map('strval', $GroupName);
            $postData['GroupName'] = $GroupName;
        }

        if ($NeedFriend !== null) {
            $postData['NeedFriend'] = $NeedFriend;
        }

        $uri = '/v4/sns/group_get';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

}
