<?php

namespace Lishun\EasyTencentIm\Param\MsgParam\MsgContent;


class MsgContentLocationParam
{
    /**
     * @var string|null
     */
    public ?string $Desc = null;


    /**
     * 纬度。
     * @var float|null
     */
    public ?float $Latitude = null;

    /**
     * 经度。
     * @var float|null
     */
    public ?float $Longitude = null;


}