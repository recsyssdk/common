<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Common;

/**
 * Interface GatewayInterface.
 *
 * @method \Recsys\Common\Message\RequestInterface reportItems(array $options = array())   批量上传物料
 * @method \Recsys\Common\Message\RequestInterface reportItem($itemId)                     上传单个物料
 * @method \Recsys\Common\Message\RequestInterface removeItems(array $itemIds = array())   批量删除物料
 * @method \Recsys\Common\Message\RequestInterface removeItem($itemId)                     删除单个物料
 * @method \Recsys\Common\Message\RequestInterface findItems(array $itemIds = array())     批量查询物料
 * @method \Recsys\Common\Message\RequestInterface findItem($itemId)                       查询单个物料
 * @method \Recsys\Common\Message\RequestInterface reportActions(array $options = array()) 批量上报用户行为记录
 * @method \Recsys\Common\Message\RequestInterface reportAction($option)                   上报单挑用户行为记录
 * @method \Recsys\Common\Message\RequestInterface recommend(array $options = array())     推荐
 */
interface GatewayInterface
{
    /**
     * Initialize gateway with parameters.
     *
     * @return $this
     */
    public function initialize(array $parameters = []);

    /**
     * Get all gateway parameters.
     *
     * @return array
     */
    public function getParameters();
}
