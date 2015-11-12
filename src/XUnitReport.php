<?php

namespace phmLabs\XUnitReport;

use phmLabs\XUnitReport\Elements\TestCase;

class XUnitReport
{
    private $name;

    /**
     * @var TestCase[]
     */
    private $testCases;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addTestCase(TestCase $testCase)
    {
        $this->testCases[] = $testCase;
    }

    /**
     * @return \DOMDocument
     */
    public function toXml()
    {
        $xml = new \DOMDocument('1.0', 'UTF-8');

        $xml->formatOutput = true;

        $xmlRoot = $xml->createElement('testsuites');
        $xml->appendChild($xmlRoot);

        $testSuite = $xml->createElement('testsuite');
        $xmlRoot->appendChild($testSuite);

        $failureCount = 0;
        $time = 0;

        foreach ($this->testCases as $testCaseElement) {

            $testCase = $xml->createElement('testcase');
            $testCase->setAttribute('classname', $testCaseElement->getClassname());
            $testCase->setAttribute('name', $testCaseElement->getName());
            $testCase->setAttribute('assertions', '1');
            $testCase->setAttribute('time', $testCaseElement->getTime());

            $time += $testCaseElement->getTime();

            if ($testCaseElement->hasFailure()) {

                $failureCount++;
                $testFailure = $xml->createElement('failure');
                $testCase->appendChild($testFailure);
                $testFailure->setAttribute('type', $testCaseElement->getFailure()->getType());
                $text = $xml->createTextNode($testCaseElement->getFailure()->getMessage());
                $testFailure->appendChild($text);
            }

            $testSuite->appendChild($testCase);
        }

        $testSuite->setAttribute('name', $this->name);
        $testSuite->setAttribute('tests', count($this->testCases));
        $testSuite->setAttribute('failures', $failureCount);
        $testSuite->setAttribute('time', $time);

        return $xml->saveXML();
    }
}