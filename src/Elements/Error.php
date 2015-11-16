<?php

namespace phmLabs\XUnitReport\Elements;


class Error
{
    private $type;
    private $message;

    /**
     * @param $type
     * @param $message
     */
    public function __construct($type, $message)
    {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }


}