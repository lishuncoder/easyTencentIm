<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Param\RelationshipsParam\FriendAdd;

class AddFriendItemParam
{
    /**
     * 必填
     * 好友的 UserID
     * @var string
     */
    public string $To_Account = '';


    /**
     * 选填
     * From_Account 对 To_Account 的好友备注，详情可参见 标配好友字段 https://cloud.tencent.com/document/product/269/1501#.E6.A0.87.E9.85.8D.E5.A5.BD.E5.8F.8B.E5.AD.97.E6.AE.B5
     * @var string|null
     */
    public ?string $Remark = null;

    /**
     * 选填
     * From_Account 对 To_Account 的分组信息，添加好友时只允许设置一个分组，因此使用 String 类型即可，详情可参见 标配好友字段
     * @var string|null
     */
    public ?string $GroupName = null;

    /**
     * 必填
     * 加好友来源字段，详情可参见 标配好友字段
     * @var string
     */
    public string $AddSource = '';

    /**
     * 选填
     * From_Account 和 To_Account 形成好友关系时的附言信息，详情可参见 标配好友字段
     * @var string|null
     */
    public ?string $AddWording = null;
}