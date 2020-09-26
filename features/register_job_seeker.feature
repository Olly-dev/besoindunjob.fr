Feature: Register
    Scenario: As a job seeker, i want to register so that to look for a new job
        Given I need to register to look for a new job
        When I fill in the registration form
        Then I can log in with my new account