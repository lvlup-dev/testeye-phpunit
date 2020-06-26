<?php

namespace Lvlup\TestEye;

use Exception;
use GuzzleHttp\Client;
use PHPUnit\Runner\AfterIncompleteTestHook;
use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\AfterRiskyTestHook;
use PHPUnit\Runner\AfterSkippedTestHook;
use PHPUnit\Runner\AfterSuccessfulTestHook;
use PHPUnit\Runner\AfterTestErrorHook;
use PHPUnit\Runner\AfterTestFailureHook;
use PHPUnit\Runner\AfterTestWarningHook;

class TestEyeHook implements AfterIncompleteTestHook, AfterRiskyTestHook, AfterSkippedTestHook, AfterSuccessfulTestHook, AfterTestErrorHook, AfterTestFailureHook, AfterTestWarningHook, AfterLastTestHook
{
    private $tests;
    private $endpoint;
    private $token;

    public function __construct($token, $endpoint)
    {
        $this->token = $token;
        $this->endpoint = $endpoint;
    }

    public function executeAfterRiskyTest(string $test, string $message, float $time): void
    {
        $this->tests[] = [
            'outcome' => 'risky',
            'test' => $test,
            'message' => $message,
            'time' => $time,
        ];
    }

    public function executeAfterSkippedTest(string $test, string $message, float $time): void
    {
        $this->tests[] = [
            'outcome' => 'skipped',
            'test' => $test,
            'message' => $message,
            'time' => $time,
        ];
    }

    public function executeAfterIncompleteTest(string $test, string $message, float $time): void
    {
        $this->tests[] = [
            'outcome' => 'incomplete',
            'test' => $test,
            'message' => $message,
            'time' => $time,
        ];
    }

    public function executeAfterSuccessfulTest(string $test, float $time): void
    {
        $this->tests[] = [
            'outcome' => 'successful',
            'test' => $test,
            'time' => $time,
        ];
    }

    public function executeAfterTestError(string $test, string $message, float $time): void
    {
        $this->tests[] = [
            'outcome' => 'error',
            'test' => $test,
            'message' => $message,
            'time' => $time,
        ];
    }

    public function executeAfterTestFailure(string $test, string $message, float $time): void
    {
        $this->tests[] = [
            'outcome' => 'failure',
            'test' => $test,
            'message' => $message,
            'time' => $time,
        ];
    }

    public function executeAfterTestWarning(string $test, string $message, float $time): void
    {
        $this->tests[] = [
            'outcome' => 'warning',
            'test' => $test,
            'message' => $message,
            'time' => $time,
        ];
    }

    public function executeAfterLastTest(): void
    {
        $system = [];
        $system['version'] = PHP_MAJOR_VERSION . "." . PHP_MINOR_VERSION;

        $system['os'] = php_uname('s');
        $isLinux = strtolower(substr($system['os'], 0, 5)) === 'linux';
        if ($isLinux) {
            $system['os'] = $this->guessLinuxDistributionName();
        }

        $client = new Client();

        try {
            $client->post($this->endpoint . '/' . $this->token, [
                'form_params' => [
                    'tests' => $this->tests,
                    'system' => $system,
                ],
            ]);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }

    private function guessLinuxDistributionName(): string
    {
        try {
            $etcOsRelease = file('/etc/os-release');

            $prettyNameRow = array_filter($etcOsRelease, function ($line) {
                return strpos($line, "PRETTY_NAME") !== false;
            });

            if (!isset($prettyNameRow[0])) {
                throw new Exception();
            }

            $prettyNameRow = $prettyNameRow[0];

            $prettyName = explode("=", $prettyNameRow);

            return trim($prettyName[1], "\"\r\n\t");

        } catch (\Exception $e) {
            echo "TestEye : Could not determine Linux distribution.\n";
            return '';
        }
    }
}
