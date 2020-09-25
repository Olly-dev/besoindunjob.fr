Feature: Send application
    Scenario: As job seeker I want to send my application to job offer so that I can hope to be recruit
        Given I want to send my application to a job offer
        When I write and send my application
        Then my application is on pending and recruiter can process it