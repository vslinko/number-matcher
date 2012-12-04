<?php

use Behat\Behat\Context\BehatContext;
use Rithis\NumberMatcher\NumberMatcher;

class FeatureContext extends BehatContext
{
    /**
     * @var \Rithis\NumberMatcher\NumberMatcher
     */
    private $numberMatcher;

    /**
     * @When /^I have pattern "([^"]*)"$/
     */
    public function iHavePattern($pattern)
    {
        $this->numberMatcher = new NumberMatcher($pattern);
    }

    /**
     * @Then /^I should have "([^"]*)" regex$/
     */
    public function iShouldHaveRegex($regex)
    {
        $compiledRegex = $this->numberMatcher->getRegex();

        if ($regex != $compiledRegex) {
            throw new Exception(sprintf('Compiled "%s"', $compiledRegex));
        }
    }

    /**
     * @Then /^Regex should match "([^"]*)"$/
     */
    public function regexShouldMath($number)
    {
        if (!$this->numberMatcher->match($number)) {
            throw new Exception(sprintf('Not matched "%s"', $number));
        }
    }

    /**
     * @Then /^Regex should not match "([^"]*)"$/
     */
    public function regexShouldNotMath($number)
    {
        if ($this->numberMatcher->match($number)) {
            throw new Exception(sprintf('Matched "%s"', $number));
        }
    }
}
