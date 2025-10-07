<?php

namespace Jmdistributions\Tests\JmValidator;

use InvalidArgumentException;
use Jmdistributions\JmValidator\JmValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class JmValidatorTest extends TestCase
{
    public static function validInputProvider(): array
    {
        return [
            ['email@email.com', []],
            ['email@email.com', ['email']],
            ['juan', ['required']],
            ['juan@email.com', ['required', 'email']],
            [8, ['required', 'max:10']],
        ];
    }

    public static function invalidInputProvider(): array
    {
        return [
            ['@email.com', ['email']],
            ['', ['required']],
            ['juan', ['required', 'email']],
            [20, ['required', 'max:10']],
        ];
    }

    public static function validDataProvider(): array
    {
        return [
            [
                [
                    'email' => 'juanito@email.com',
                    'password' => 'test12',
                ],  [
                    'email' => ['required', 'email'],
                    'password' => ['required', 'max:8'],
                ],
            ],
        ];
    }

    public static function invalidDataProvider(): array
    {
        return [
            [
                [
                    'email' => 'email.com',
                    'password' => 'test123',
                ],  [
                    'email' => ['required', 'email'],
                    'password' => ['required', 'max:8'],
                ],
            ],
        ];
    }

    #[Test]
    #[DataProvider('validInputProvider')]
    public function itValidatesCorrectInput($input, $rules): void
    {
        $validator = new JmValidator();
        $result = $validator->validateInput($input, $rules);

        $this->assertTrue($result);
    }

    #[Test]
    #[DataProvider('invalidInputProvider')]
    public function itDontValidatesIncorrectInput($input, $rules): void
    {
        $validator = new JmValidator();
        $result = $validator->validateInput($input, $rules);

        $this->assertFalse($result);
    }

    #[Test]
    #[DataProvider('validDataProvider')]
    public function itValidatesCorrectData($data, $rules): void
    {
        $validator = new JmValidator();
        $result = $validator->validateData($data, $rules);

        $this->assertTrue($result);
    }

    #[Test]
    #[DataProvider('invalidDataProvider')]
    public function itDontValidatesIncorrectData($data, $rules): void
    {
        $validator = new JmValidator();
        $result = $validator->validateData($data, $rules);

        $this->assertFalse($result);
    }

    #[Test]
    public function itRuleNotHasThrowExeption(): void
    {
        $validator = new JmValidator();
        $this->expectException(InvalidArgumentException::class);

        $this->expectExceptionMessage("No se encontro la validacion invalid");
        $validator->validateInput('juan', ['invalidrule']);
    }

    #[Test]
    public function itValidatesErrors(): void
    {
        $validator = new JmValidator();
        $validator->validateInput('', ['required', 'email']);

        $errors = $validator->getErrors();
        $this->assertContains('the input must be a email', $errors);
        $this->assertContains('the input is required', $errors);
    }

    #[Test]
    #[DataProvider('invalidDataProvider')]
    public function itValidatesDataErrors($data, $rules): void
    {
        $validator = new JmValidator();
        $result = $validator->validateData($data, $rules);

        $errors = $validator->getErrors();

        $this->assertFalse($result);
        $this->assertArrayHasKey('email', $errors);
        $this->assertEquals('the input must be a email', $errors['email'][0]);
    }
}
