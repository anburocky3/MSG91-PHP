<?php

namespace Anburocky3\Msg91\Contracts;

/**
 * Interface Options
 * @package Anburocky3\Msg91\Contracts
 */
interface Options
{
    /**
     * Get the options's array
     * @return array
     */
    public function toArray(): array;

    /**
     * Set the receipient(s)
     * @param int|string|array|null $mobile recipients
     * @return $this
     */
    public function to($mobile = null);

    /**
     * Set the message content
     * @param string|null $message
     * @return $this
     */
    public function message(?string $message = ''): Options;

    /**
     * Merge options with new options
     * @param null $options
     * @return $this;
     */
    public function mergeWith($options = null): Options;

    /**
     * Set the sender
     * @param string|null sender id
     * @return $this
     */
    public function from($sender_id = null): Options;
}
