<?php

namespace phmLabs\XUnitReport\Elements;


class TestCase
{
    private $failures = array();
    private $errors = array();
    private $skipped = false;

    private $classname = '';
    private $name = '';
    private $systemOut = '';
    private $systemErr = '';
    private $time = '';

    public function __construct($classname, $name, $time)
    {
        $this->classname = $classname;
        $this->name = $name;
        $this->time = $time;
    }

    public function addFailure(Failure $failure)
    {
        $this->failures[] = $failure;
    }

    public function hasFailure()
    {
        return $this->hasFailures();
    }

    public function hasFailures()
    {
        return count($this->failures) !== 0;
    }

    /**
     * @return Failure
     */
    public function getFailures()
    {
        return $this->failures;
    }

    /**
     * @param Error $error
     */
    public function addError(Error $error)
    {
        $this->errors[] = $error;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count($this->errors) !== 0;
    }

    /**
     * @return array of Error
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getClassname()
    {
        return $this->classname;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param boolean $skipped
     */
    public function setSkipped($skipped)
    {
        $this->skipped = $skipped;
    }

    /**
     * @return bool
     */
    public function isSkipped()
    {
        return $this->skipped;
    }


    /**
     * @param string $systemOut
     */
    public function setSystemOut($systemOut)
    {
        $this->systemOut = $systemOut;
    }

    /**
     * @return string
     */
    public function getSystemOut()
    {
        return $this->systemOut;
    }

    /**
     * @return bool
     */
    public function hasSystemOut()
    {
        return strlen($this->systemOut) !== 0;
    }

    /**
     * @param string $systemErr
     */
    public function setSystemErr($systemErr)
    {
        $this->systemErr = $systemErr;
    }


    /**
     * @return bool
     */
    public function hasSystemErr()
    {
        return strlen($this->systemErr) !== 0;
    }

    /**
     * @return string
     */
    public function getSystemErr()
    {
        return $this->systemErr;
    }

}