@api.navigation
Feature: Navigation
  In order have navigation on frontend
  As a visitor
  I want to be able to have access to Navigation REST API

  Scenario: Navigation API is working
    Given Script access api_aisel_navigationmenu route
    Then Navigation response should contain valid JSON