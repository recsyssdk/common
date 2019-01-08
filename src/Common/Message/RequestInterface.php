<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Common\Message;

interface RequestInterface extends MessageInterface
{
    /**
     * Initialize request with parameters.
     *
     * @param array $parameters The parameters to send
     */
    public function initialize(array $parameters = []);

    /**
     * Get all request parameters.
     *
     * @return array
     */
    public function getParameters();

    /**
     * Get the response to this request (if the request has been sent).
     *
     * @return ResponseInterface
     */
    public function getResponse();

    /**
     * Send the request.
     *
     * @return ResponseInterface
     */
    public function send();

    /**
     * Send the request with specified data.
     *
     * @param mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data);
}
