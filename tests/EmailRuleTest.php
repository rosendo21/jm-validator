<?php

namespace Jmdistributions\Tests\JmValidator;

use Jmdistributions\JmValidator\Rules\EmailRule;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class EmailRuleTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectMail(): void
    {
        $emailRule = new EmailRule();
        $result = $emailRule->validate('juan@email.com');
        $this->assertTrue($result);
    }

    #[Test]
    public function itValidatesIncorrectMail(): void
    {
        $emailRule = new EmailRule();
        $result = $emailRule->validate('juan');
        $this->assertFalse($result);
    }

    #[Test]
    public function itReturnExpectedMessage(): void
    {
        $emailRule = new EmailRule();
        $this->assertEquals('the input must be a email', $emailRule->getErrorMessage());
    }
}
