<?php

namespace Rithis\NumberMatcher;

class NumberMatcher
{
    private $pattern;
    private $regex;

    public function __construct($pattern)
    {
        $this->pattern = $pattern;
    }

    public function getRegex()
    {
        if (!$this->regex) {
            $this->compileRegex();
        }

        return $this->regex;
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function match($number)
    {
        return preg_match(sprintf('/^%s$/', $this->getRegex()), $number);
    }

    private function compileRegex()
    {
        $this->regex = '';
        $stack = array();

        foreach (preg_split('//', $this->pattern) as $char) {
            if ("X" == $char) {
                $this->regex .= '\d';
            } else if (preg_match('/^[A-Z]$/', $char)) {
                if (isset($stack[$char])) {
                    $this->regex .= '\\' . $stack[$char];
                } else {
                    if (count($stack) > 0) {
                        $defines = implode("|", array_map(function ($d) { return '\\' . $d; }, $stack));
                        $this->regex .= sprintf('((?!%s)\d)', $defines);
                    } else {
                        $this->regex .= '(\d)';
                    }

                    $stack[$char] = count($stack) + 1;
                }
            } else {
                $this->regex .= $char;
            }
        }
    }
}
