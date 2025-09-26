<?php

namespace Jmdistributions\JmValidator\Rules;

class UrlRule extends Rule
{
    public function __construct()
    {
        $this->errorMessage = 'the input must be a url';
    }

    public function validate($value): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            return false;
        }

        return true;
    }
}
