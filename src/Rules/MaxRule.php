<?php

namespace Jmdistributions\JmValidator\Rules;

class MaxRule extends Rule
{
    public function __construct(private mixed $max)
    {
        $this->errorMessage = 'the input should be ' . $this->max . ' or less';
    }

    public function validate(mixed $value): bool
    {
        if (is_numeric($value)) {
            return $this->max >= $value;
        }

        return $this->max >= mb_strlen($value);
    }
}
