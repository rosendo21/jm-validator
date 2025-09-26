<?php

namespace Jmdistributions\Tests\JmValidator;

use Jmdistributions\JmValidator\Rules\RequiredRule;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RequiredRuleTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectMail(): void
    {
        $emailRule = new RequiredRule();
        $result = $emailRule->validate('value');
        $this->assertTrue($result);
    }

    #[Test]
    public function itValidatesIncorrectMail(): void
    {
        $emailRule = new RequiredRule();
        $result = $emailRule->validate('');
        $this->assertFalse($result);
    }

    #[Test]
    public function itReturnExpectedMessage(): void
    {
        $emailRule = new RequiredRule();
        $this->assertEquals('the input is required', $emailRule->getErrorMessage());
    }
}
