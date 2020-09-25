Feature: Delete offer
    Scenario: As recruiter I want to delete offer so that job seeker cannot applay for the job
        Given I want to delete an offer
        When I select the offer to delete it
        Then job seekers will no longer be able to applay for the job offer