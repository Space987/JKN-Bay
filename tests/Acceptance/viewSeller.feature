Feature: viewSeller
  In order to view seller profiles
  As a buyer
  I need to click on the view seller button

  Scenario: try viewing "Natan"
    Given I am logged in as "Julien" and "1234" 
    And I click "View Seller"
    Then I see "Natan"    