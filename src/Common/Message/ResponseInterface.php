<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Common\Message;

interface ResponseInterface extends MessageInterface
{
    /**
     * Get the original request which generated this response.
     *
     * @return RequestInterface
     */
    public function getRequest();

    /**
     * Is the response successful?
     *
     * @return bool
     */
    public function isSuccessful();

    /**
     * Response Message.
     *
     * @return string|null A response message from the payment gateway
     */
    public function getMessage();

    /**
     * Response code.
     *
     * @return string|null A response code from the payment gateway
     */
    public function getCode();
}
