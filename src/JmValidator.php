<?php

namespace Jmdistributions\JmValidator;

class JmValidator
{
    private $errors = [];
    private $errosData = [];
    public function validateInput($input, array $rules = []): bool
    {
        foreach ($rules as $rule) {
            $rule = RuleFactory::create($rule);

            if (!$rule->validate($input)) {
                $this->setError($rule->getErrorMessage());
            }
        }

        return count($this->getErrors()) === 0;
    }

    public function validateData($data, $rules): bool
    {
        foreach ($rules as $key => $rule) {
            $validation = $this->validateInput($data[$key], $rule);

            if (!$validation) {
                $this->errosData[$key] = $this->getErrors();
            }

            $this->errors = [];
        }

        $this->errors = $this->errosData;
        return count($this->errosData) === 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setError($errorMessage): void
    {
        $this->errors[] = $errorMessage;
    }
}
