<?php

namespace AppBundle\Component\Response\Model;

/**
 * ApiErrorResponse
 * @author F.Bourbigot
 */
class ApiErrorResponse
{
    /**
     * @var string
     */
    public $message;
    
    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return ApiErrorResponse
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}
