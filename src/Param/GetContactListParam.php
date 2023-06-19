<?php

namespace Lishun\EasyTencentIm\Param;


class GetContactListParam
{

    /**
     * 填 UserID，请求拉取该用户的会话列表
     * @var string
     */
    public string $From_Account = '';

    /**
     * 普通会话的起始时间，第一页填 0
     * @var int
     */
    public int $TimeStamp = 0;

    /**
     * 普通会话的起始位置，第一页填 0
     * @var int
     */
    public int $StartIndex = 0;

    /**
     * 置顶会话的起始时间，第一页填 0
     * @var int
     */
    public int $TopTimeStamp = 0;

    /**
     * 置顶会话的起始位置，第一页填 0
     * @var int
     */
    public int $TopStartIndex = 0;

    /**
     * 会话辅助标志位:
     * bit 0 - 是否支持置顶会话
     * bit 1 - 是否返回空会话
     * bit 2 - 是否支持置顶会话分页
     * 8421
     * 0111 = 7
     * @var int
     */
    public int $AssistFlags = 7;

}