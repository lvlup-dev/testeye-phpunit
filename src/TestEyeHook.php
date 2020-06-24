<?php

namespace Lvlup\TestEye;

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
    private $endpoint = "https://2f58e3b96ad5.ngrok.io";
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
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
            'outcome' => 'incomplete',
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
            'outcome' => 'failure',
            'test' => $test,
            'message' => $message,
            'time' => $time,
        ];
    }

    public function executeAfterLastTest(): void
    {
        $client = new Client();
        $client->post($this->endpoint . '/' . $this->token, $this->tests);
    }
}
