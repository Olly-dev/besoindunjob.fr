Feature: Show interest
    Scenario: As a recruiter I want to show interest for a job seeker
        Given I want to show interest for a job seeker
        When I send my interest to  the job seeker
        Then I can see the list of job seekers with the best compatibility with my job offer