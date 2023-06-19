<?php

namespace Lishun\EasyTencentIm\Param\MsgParam;


class SendChatMsgBodyParam
{

    /**
     * 必填
     * TIM 消息对象类型，目前支持的消息对象包括：
     * TIMTextElem（文本消息）
     * TIMLocationElem（位置消息）
     * TIMFaceElem（表情消息）
     * TIMCustomElem（自定义消息）
     * TIMSoundElem（语音消息）
     * TIMImageElem（图像消息）
     * TIMFileElem（文件消息）
     * TIMVideoFileElem（视频消息）
     * @var string
     */
    public string $MsgType = '';

    /**
     * 消息体
     * @var ?object
     */
    public ?object $MsgContent = null;

    /**
     * 该条消息是否需要已读回执，0为不需要，1为需要，默认为0
     * @var ?int
     */
    public ?int $IsNeedReadReceipt = 0;//该条消息是否需要已读回执，0为不需要，1为需要，默认为0
}