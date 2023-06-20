<?php
declare(strict_types=1);

namespace Lishun\EasyTencentIm\Param\Relationships;

use Lishun\EasyTencentIm\Param\Relationships\FriendGetList\TagList;

class FriendGetListParam
{
    /**
     * 必填
     * 指定要拉取好友数据的用户的 UserID
     * @var string
     */
    public string $From_Account = '';

    /**
     * 好友的 UserID 列表
     * 建议每次请求的好友数不超过100，避免因数据量太大导致回包失败
     * @var string[]
     */
    public array $To_Account = [];


    /**
     * @var TagList
     */
    public TagList $TagList;

    public array $AllCustomTagList = [];
}