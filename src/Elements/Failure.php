<?php
/**
 * Created by PhpStorm.
 * User: nils.langner
 * Date: 11.11.15
 * Time: 20:54
 */

namespace phmLabs\XUnitReport\Elements;


class Failure
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
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }


}