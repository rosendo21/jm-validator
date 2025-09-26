<?php

namespace Jmdistributions\Tests\JmValidator;

use Jmdistributions\JmValidator\Rules\MaxRule;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MaxRuleTest extends TestCase
{
    #[Test]
    public function itValidatesCorrectMax(): void
    {
        $emailRule = new MaxRule(20);
        $result = $emailRule->validate(20);
        $this->assertTrue($result);
    }

    #[Test]
    public function itDontValidatesValueGreatherThanMax(): void
    {
        $emailRule = new MaxRule(20);
        $result = $emailRule->validate(30);
        $this->assertFalse($result);
    }

    #[Test]
    public function itValidatesStringWithCorrectChars(): void
    {
        $emailRule = new MaxRule(4);
        $result = $emailRule->validate('tre');
        $this->assertTrue($result);
    }

    #[Test]
    public function itDontValidatesStringWithMoreChars(): void
    {
        $emailRule = new MaxRule(4);
        $result = $emailRule->validate('cadenagrande');
        $this->assertFalse($result);
    }

    #[Test]
    public function itDontValidatesValueStringGreatherThanMax(): void
    {
        $emailRule = new MaxRule(50);
        $result = $emailRule->validate('51');
        $this->assertFalse($result);
    }

    #[Test]
    public function itValidatesValueStringLessThanMax(): void
    {
        $emailRule = new MaxRule(50);
        $result = $emailRule->validate('5');
        $this->assertTrue($result);
    }

    #[Test]
    public function itReturnExpectedMessage(): void
    {
        $emailRule = new MaxRule(40);
        $this->assertEquals('the input should be 40 or less', $emailRule->getErrorMessage());
    }
}
