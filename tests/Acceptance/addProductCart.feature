Feature: addProductCart
  In order to add products to buyer cart
  As a buyer
  I need to enter the product item into my cart 
  and click the cart button

  Scenario: try adding "Dell Inspire Pro"
    Given I am logged in as "Julien" and "1234" 
    And I click "Add to Cart"
    And I click "Cart"
    Then I see "Dell Inspire Pro"