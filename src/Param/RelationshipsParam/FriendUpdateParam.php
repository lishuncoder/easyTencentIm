<?php
declare(strict_types=1);
namespace Lishun\EasyTencentIm\Param\RelationshipsParam;

use Lishun\EasyTencentIm\Param\RelationshipsParam\FriendUpdate\UpdateItem;

class FriendUpdateParam
{
    /**
     * 必填
     * 需要为该 UserID 添加好友
     * @var string
     */
    public string $From_Account = '';

    /**
     * 必填
     * 需要更新的好友对象数组
     * @var UpdateItem[]
     */
    public array $UpdateItem = [];


}