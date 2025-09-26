<?php

namespace Jmdistributions\Tests\JmValidator;

use Jmdistributions\JmValidator\Rules\EmailRule;
use Jmdistributions\JmValidator\Rules\UrlRule;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class UrlRuleTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectUrl(): void
    {
        $rule = new UrlRule();
        $result = $rule->validate('http://midomini.com/user/all');
        $this->assertTrue($result);
    }

    #[Test]
    public function itValidatesIncorrectUrl(): void
    {
        $rule = new UrlRule();
        $result = $rule->validate('email');
        $this->assertFalse($result);
    }

    #[Test]
    public function itReturnExpectedMessage(): void
    {
        $emailRule = new UrlRule();
        $this->assertEquals('the input must be a url', $emailRule->getErrorMessage());
    }
}
