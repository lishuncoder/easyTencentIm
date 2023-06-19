<?php

namespace Lishun\EasyTencentIm\Param;

class GetOamMsgParam
{
    /**
     * 会话其中一方的 UserID，以该 UserID 的角度去查询消息
     * @var string
     */
    public string $Operator_Account = '';

    /**
     * 会话的另一方 UserID
     * @var string
     */
    public string $Peer_Account = '';

    /**
     * 请求的消息条数
     * @var int
     */
    public int $MaxCnt = 100;

    /**
     * 请求的消息时间范围的最小值
     * @var int
     */
    public int $MinTime = 0;

    /**
     * 请求的消息时间范围的最大值
     * @var int
     */
    public int $MaxTime = 0;

    /**
     * 最后一条消息的msgKey
     * @var string
     */
    public string $LastMsgKey = '';

}