<?php

namespace Jmdistributions\JmValidator\Rules;

class EmailRule extends Rule
{
    public function __construct()
    {
        $this->errorMessage = 'the input must be a email';
    }

    public function validate($value): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }
}
