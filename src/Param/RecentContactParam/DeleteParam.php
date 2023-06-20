<?php
declare(strict_types=1);

namespace Lishun\EasyTencentIm\Param\RecentContactParam;

class DeleteParam
{
    /**
     * 必填
     * 填 UserID，请求拉取该用户的会话列表
     * @var string
     */
    public string $From_Account = '';

    /**
     * 必填
     * 会话类型：1 表示 C2C 会话；2 表示 G2C 会话
     * @var int
     */
    public int $Type = 0;

    /**
     * 选填
     * C2C 会话才赋值，C2C 会话方的 UserID
     * @var ?string
     */
    public ?string $To_Account = null;

    /**
     * 选填
     * G2C 会话才赋值，G2C 会话的群 ID
     * @var string|null
     */
    public ?string $ToGroupid = null;

    /**
     * 选填
     * 是否清理漫游消息：1 表示清理漫游消息；0 表示不清理漫游消息
     * @var int
     */
    public int $ClearRamble = 1;


}