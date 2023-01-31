Feature: addProduct
  In order to add products to the database
  As a seller
  I need to enter the product item into 
  and click the submit button

  Scenario: try adding "Jordan 1"
    Given I am logged in as "Natan" and "1234" 
    And I click " New Product"
    When I input "Jordan 1" in "input[name=name]" 
    And I input "hello" in "description" 
    And I input "100" in "price" 
    And I input "3" in "quantity"
    And I click "input[type=radio][id=state_new]"
    And I click "Add your new Product"
    And I am on "/Product/index"
    Then I see "Jordan 1"