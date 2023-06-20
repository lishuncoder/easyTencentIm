<?php
declare(strict_types=1);
namespace Lishun\EasyTencentIm\Param\Relationships\FriendUpdate;

use Lishun\EasyTencentIm\Param\Relationships\FriendUpdate\UpdateItem\SnsItem;

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