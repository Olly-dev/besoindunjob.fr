Feature: Register
    Scenario: As a recruiter, i want to register so that recruit new employees
        Given I need to register to recruit new employees
        When I fill in the registration form
        Then I can log in with my new account