<?php
/**
 * Created by PhpStorm.
 * User: nils.langner
 * Date: 11.11.15
 * Time: 20:54
 */

namespace phmLabs\XUnitReport\Elements;


class TestCase
{
    private $failure = null;

    private $classname;
    private $name;
    private $time;

    public function __construct($classname, $name, $time)
    {
        $this->classname = $classname;
        $this->name = $name;
        $this->time = $time;
    }

    public function setFailure(Failure $failure)
    {
        $this->failure = $failure;
    }

    public function hasFailure()
    {
        return !is_null($this->failure);
    }

    /**
     * @return Failure
     */
    public function getFailure()
    {
        return $this->failure;
    }

    /**
     * @return mixed
     */
    public function getClassname()
    {
        return $this->classname;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }


}