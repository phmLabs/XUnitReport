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
     * @return string
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
        $errorCount = 0;
        $time = 0;

        foreach ($this->testCases as $testCaseElement) {

            $testCase = $xml->createElement('testcase');
            $testCase->setAttribute('classname', $testCaseElement->getClassname());
            $testCase->setAttribute('name', $testCaseElement->getName());
            // $testCase->setAttribute('assertions', '1');
            $testCase->setAttribute('time', $testCaseElement->getTime());

            if ($testCaseElement->isSkipped()) {
                $testCase->setAttribute('skipped', 'skipped');
            }

            $time += (float)$testCaseElement->getTime();

            foreach ($testCaseElement->getFailures() as $failure) {
                $failureCount++;
                $testFailure = $xml->createElement('failure');
                $testCase->appendChild($testFailure);
                $testFailure->setAttribute('type', $failure->getType());

                $message =  $xml->createElement('message');
                $text = $xml->createTextNode($failure->getMessage());
                $message->appendChild($text);

                $testFailure->appendChild($message);
            }

            foreach ($testCaseElement->getErrors() as $error) {
                $errorCount++;
                $testError = $xml->createElement('error');
                $testCase->appendChild($testError);
                $testError->setAttribute('type', $error->getType());
                $text = $xml->createTextNode($error->getMessage());
                $testError->appendChild($text);
            }

            if ($testCaseElement->hasSystemOut()) {
                $systemOut = $xml->createElement('system-out');
                $testCase->appendChild($systemOut);
                $text = $xml->createTextNode($testCaseElement->getSystemOut());
                $systemOut->appendChild($text);
            }

            if ($testCaseElement->hasSystemErr()) {
                $systemErr = $xml->createElement('system-err');
                $testCase->appendChild($systemErr);
                $text = $xml->createTextNode($testCaseElement->getSystemErr());
                $systemErr->appendChild($text);
            }

            $testSuite->appendChild($testCase);
        }

        $testSuite->setAttribute('name', $this->name);
        $testSuite->setAttribute('tests', count($this->testCases));
        $testSuite->setAttribute('failures', $failureCount);
        $testSuite->setAttribute('errors', $errorCount);
        $testSuite->setAttribute('time', $time);

        return $xml->saveXML();
    }
}