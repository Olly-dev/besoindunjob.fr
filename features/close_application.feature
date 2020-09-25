Feature: Close application 
    Scenario: As a recruiter I want to close an application that was accepted so that i can stop the recruitment process
        Given I want to close an application
        When I cose it
        Then the recruitment process is stopped