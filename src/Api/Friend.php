<?php
/**
 * User: liShun
 */

namespace Lishun\EasyTencentIm\Api;


use Lishun\EasyTencentIm\Constants\FriendConst;
use Lishun\EasyTencentIm\Exception\TencentImException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 好友关系链
 * https://cloud.tencent.com/document/product/269/1643
 */
class Friend extends Base
{

    protected string $version = 'v4';

    /**
     * 添加好友 统一添加 无法单独定义某个好友的某个字段
     * {
     * "From_Account":"id",
     * "AddFriendItem":
     * [
     * {
     * "To_Account":"id1",
     * "Remark":"remark1",
     * "GroupName":"同学", // 添加好友时只允许设置一个分组，因此使用 String 类型即可
     * "AddSource":"AddSource_Type_XXXXXXXX",
     * "AddWording":"I'm Test1"
     * }
     * ],
     * "AddType":"Add_Type_Both",
     * "ForceAddFlags":1
     * }
     * @param string $unqId
     * @param mixed $friendUnqId
     * @param array $fields
     * @return array|null
     * @throws GuzzleException
     * @throws TencentImException
     */
    public function addFriend(string $unqId = '', mixed $friendUnqId = '', array $fields = []): ?array
    {
        $postData['From_Account'] = $unqId;
        if (is_array($friendUnqId)) {
            foreach ($friendUnqId as $value) {
                $postData['AddFriendItem'][] = $this->buildAddFriendData($value, $fields);
            }
        } else {
            $postData['AddFriendItem'][] = $this->buildAddFriendData($friendUnqId, $fields);
        }
        if ($fields['ForceAddFlags'] ?? false) {
            $postData['ForceAddFlags'] = (int)$fields['ForceAddFlags'];
        }

        $uri      = '/v4/sns/friend_add';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * @param mixed $friendUnqId
     * @param array $fields
     * @return array
     */
    private function buildAddFriendData(mixed $friendUnqId, array $fields): array
    {
        $friend = [
            'To_Account' => (string)$friendUnqId,
        ];
        if ($fields['Remark'] ?? false) {
            $friend['Remark'] = (string)$fields['Remark'];
        }
        if ($fields['GroupName'] ?? false) {
            $friend['GroupName'] = (string)$fields['GroupName'];
        }
        if ($fields['AddWording'] ?? false) {
            $friend['AddWording'] = (string)$fields['AddWording'];
        }
        if ($fields['AddType'] ?? false) {
            $friend['AddType'] = (string)$fields['AddType'];
        }
        $friend['AddSource'] = 'AddSource_Type_System';
        return $friend;
    }

    /**
     * 更新好友 统一更新 无法单独更新某个好友的某个字段
     * {
     * "From_Account":"id",
     * "UpdateItem":
     * [
     * {
     * "To_Account":"id1",
     * "SnsItem":
     * [
     * {
     * "Tag":"Tag_SNS_IM_Remark",
     * "Value":"remark1"
     * }
     * ]
     * }
     * ]
     * }
     * @param string $unqId
     * @param mixed $friendUnqId
     * @param array $fields
     * @return array|null
     * @throws GuzzleException
     * @throws TencentImException
     */
    public function updateFriend(string $unqId = '', mixed $friendUnqId = '', array $fields = [])
    {
        $postData['From_Account'] = $unqId;
        if (is_array($friendUnqId)) {
            foreach ($friendUnqId as $value) {
                $postData['UpdateItem'][] = $this->buildUpdateFriendData($value, $fields);
            }
        } else {
            $postData['UpdateItem'][] = $this->buildUpdateFriendData($friendUnqId, $fields);
        }

        $uri      = '/v4/sns/friend_update';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    //构造更新好友字段
    private function buildUpdateFriendData(mixed $friendUnqId, array $fields)
    {
        $friend['To_Account'] = (string)$friendUnqId;
        foreach ($fields as $k => $v) {
            $tmp['Tag']          = $k;
            $tmp['Value']        = $v;
            $friend['SnsItem'][] = $tmp;
        }
        return $friend;
    }

    /**
     * 分页拉取全量好友数据
     * @param string $unqId
     * @param int $startIndex
     * @param int $standardSequence
     * @param int $customSequence
     * @return array|null
     * @throws GuzzleException
     * @throws TencentImException
     */
    public function getFriendList(string $unqId = '', int $startIndex = 0, int $standardSequence = 0, int $customSequence = 0)
    {
        $postData['From_Account'] = $unqId;
        $postData['StartIndex']   = $startIndex;
        if ($standardSequence) {
            $postData['StandardSequence'] = $startIndex;
        }
        if ($customSequence) {
            $postData['CustomSequence'] = $customSequence;
        }

        $uri      = '/v4/sns/friend_get';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * @param string $unqId
     * @param mixed $friendUnqId
     * @param array $tagList
     * @return array|null
     * @throws GuzzleException
     * @throws TencentImException
     */
    public function getOneFriendInfo(string $unqId = '', mixed $friendUnqId = '', array $tagList = []): ?array
    {
        $postData['From_Account'] = $unqId;
        $postData['To_Account']   = is_array($friendUnqId) ? array_map('strval', $friendUnqId) : [(string)$friendUnqId];
        if (!$tagList) {
            $tagList = [
                "Tag_Profile_IM_Image",
                "Tag_Profile_IM_Nick",
                "Tag_SNS_IM_Remark",
                "Tag_SNS_IM_Group",
                "Tag_SNS_Custom_RltTyle"
            ];
        }
        $postData['TagList'] = $tagList;

        $uri      = '/v4/sns/friend_get_list';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    //删除好友关系
    public function deleteFriend(string $unqId = '', mixed $delFriendUnqId = '', string $type = '')
    {
        if (!$type) {
            $type = FriendConst::DELETE_BOTH;
        }
        $postData['From_Account'] = $unqId;
        $postData['To_Account']   = is_array($delFriendUnqId) ? array_map('strval', $delFriendUnqId) : [(string)$delFriendUnqId];
        $postData['DeleteType']   = $type;

        $uri      = '/v4/sns/friend_delete';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 双向删除所有好友
     * @param string $unqId
     * @param string $type
     * @return array|null
     * @throws GuzzleException
     * @throws TencentImException
     */
    public function deleteAllFriend(string $unqId = '', string $type = '')
    {
        if (!$type) {
            $postData['DeleteType'] = FriendConst::DELETE_BOTH;
        }
        $postData['From_Account'] = $unqId;

        $uri      = '/v4/sns/friend_delete_all';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    public function addBlack(string $unqId = '', mixed $blackUnqId = '')
    {
        $postData['From_Account'] = $unqId;
        $postData['To_Account']   = is_array($blackUnqId) ? array_map('strval', $blackUnqId) : [(string)$blackUnqId];

        $uri      = '/v4/sns/black_list_add';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    public function deleteBlack(string $unqId = '', mixed $blackUnqId = '')
    {
        $postData['From_Account'] = $unqId;
        $postData['To_Account']   = is_array($blackUnqId) ? array_map('strval', $blackUnqId) : [(string)$blackUnqId];

        $uri      = '/v4/sns/black_list_delete';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

}
