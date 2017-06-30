<?php

namespace AppBundle\Component\Response\Model;


class ApiErrorResponse
{
    /**
     * @var string
     */
    public $message;
    
    /**
     * @return string
     */
    function getMessage() {
        return $this->message;
    }

    /**
     * @param string $message
     * @return ApiErrorResponse
     */
    function setMessage($message) {
        $this->message = $message;
        return $this;
    }
}