<?php

declare(strict_types=1);

namespace GhostZero\BitinflowAccounts\Tests\TestCases;

use GhostZero\BitinflowAccounts\BitinflowAccounts;
use GhostZero\BitinflowAccounts\Result;

/**
 * @author René Preuß <rene@preuss.io>
 */
abstract class ApiTestCase extends TestCase
{

    protected static $rateLimitRemaining = null;

    protected function setUp(): void
    {
        parent::setUp();
        if (!$this->getClientId()) {
            $this->markTestSkipped('No Client-ID given');
        }
        if (self::$rateLimitRemaining !== null && self::$rateLimitRemaining < 3) {
            $this->markTestSkipped('Rate Limit exceeded (' . self::$rateLimitRemaining . ')');
        }
        $this->getClient()->setClientId($this->getClientId());
    }

    protected function registerResult(Result $result): Result
    {
        self::$rateLimitRemaining = $result->rateLimit('remaining');

        return $result;
    }

    protected function getClientId()
    {
        return getenv('CLIENT_ID');
    }

    protected function getClientSecret()
    {
        return getenv('CLIENT_KEY');
    }

    protected function getToken()
    {
        return getenv('CLIENT_ACCESS_TOKEN');
    }

    public function getClient(): BitinflowAccounts
    {
        return app(BitinflowAccounts::class);
    }
}