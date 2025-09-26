<?php

namespace Jmdistributions\JmValidator\Rules;

class RequiredRule extends Rule
{
    public function __construct()
    {
        $this->errorMessage = 'the input is required';
    }

    public function validate($value): bool
    {
        if (is_null($value) || $value === '') {
            return false;
        }

        return true;
    }
}
