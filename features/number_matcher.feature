Feature: Number matcher
    Scenario Outline: Compiling patterns
        When I have pattern "<pattern>"
        Then I should have "<regex>" regex
        And Regex should match "<should>"
        And Regex should not match "<should_not>"

        Examples:
            | pattern | regex                               | should  | should_not |
            | XXX     | \d\d\d                              | 123     | ABC        |
            | 911-XXX | 911-\d\d\d                          | 911-123 | 9111-123   |
            | AAA     | (\d)\1\1                            | 111     | 123        |
            | ABC     | (\d)((?!\1)\d)((?!\1\|\2)\d)        | 123     | 112        |
            | ABC-ABC | (\d)((?!\1)\d)((?!\1\|\2)\d)-\1\2\3 | 123-123 | 123-121    |
