<?php

namespace Jmdistributions\JmValidator;

use InvalidArgumentException;
use Jmdistributions\JmValidator\Rules\Rule;

class RuleFactory
{
    public static function create(string $rule): Rule
    {
        if (preg_match("/^[a-z0-9]+:[a-z0-9]+$/", $rule)) {
            [$ruleName, $ruleValue] = explode(":", $rule);
            $ruleName = $ruleName;
        } else {
            $ruleName = $rule;
        }

        $ruleName = ucfirst(strtolower($ruleName));
        $className = 'Jmdistributions\\JmValidator\\Rules\\' . $ruleName . 'Rule';

        if (!class_exists($className)) {
            throw new InvalidArgumentException("No se encontro la validacion " . strtolower($ruleName));
        }

        if (isset($ruleValue)) {
            return new $className($ruleValue);
        } else {
            return new $className();
        }
    }
}
