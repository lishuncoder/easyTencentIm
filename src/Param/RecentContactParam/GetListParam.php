<?php
declare(strict_types=1);

namespace Lishun\EasyTencentIm\Param\RecentContactParam;

class GetListParam
{
    /**
     * 必填
     * 填 UserID，请求拉取该用户的会话列表
     * @var string
     */
    public string $From_Account = '';

    /**
     * 必填
     * 普通会话的起始时间，第一页填 0
     * @var int
     */
    public int $TimeStamp = 0;

    /**
     * 必填
     * 普通会话的起始位置，第一页填 0
     * @var int
     */
    public int $StartIndex = 0;

    /**
     * 必填
     * 置顶会话的起始时间，第一页填 0
     * @var int
     */
    public int $TopTimeStamp = 0;

    /**
     * 必填
     * 置顶会话的起始位置，第一页填 0
     * @var int
     */
    public int $TopStartIndex = 0;

    /**
     * 必填
     * 会话辅助标志位：填固定值 15
     * @var int
     */
    public int $AssistFlags = 15;
}