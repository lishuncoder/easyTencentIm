<?php
declare(strict_types=1);
namespace Lishun\EasyTencentIm\Param\RelationshipsParam\FriendUpdate;

use Lishun\EasyTencentIm\Param\RelationshipsParam\FriendUpdate\UpdateItem\SnsItem;

class UpdateItem
{

    /**
     * 必填
     * 需要为该 UserID 添加好友
     * @var string
     */
    public string $To_Account = '';

    /**
     * @var SnsItem
     */
    public SnsItem $SnsItem;
}