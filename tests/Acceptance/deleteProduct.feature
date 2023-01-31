Feature: deleteProduct
  In order to delete products from the database
  As a seller
  I need to click the delete button next to the item and delete it from the database

  Scenario: try deleting "Dell Inspire Pro"
    Given I am logged in as "Natan" and "1234" 
    When I click " Delete"
    Then I can not see "Dell Inspire Pro"