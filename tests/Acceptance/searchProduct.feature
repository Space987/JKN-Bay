Feature: searchProduct
  In order to search a products on the index
  As a user
  I need to search for a product item and get a result back

  Scenario: try searching "Dell Inspire Pro"
    Given I am on "/Buyer/index"
    When I input "Dell Inspire Pro" in "input[name=searchbar]"
    And I click "button[name=action]"
    Then I see "Dell Inspire Pro"