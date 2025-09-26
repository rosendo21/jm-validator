<?php

namespace Jmdistributions\JmValidator\Rules;

abstract class Rule implements RuleInterface
{
    protected string $errorMessage = '';

    public function __construct()
    {
        //
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
