Feature: Credit Card Application

  As a new Customer
  I want to open a credit card
  So that I can have my coupon discount

  @focus
  Scenario Outline: New Customer
    Given that I am on the homepage
    When I enter <classification>
    Then my discount is <discount>

Examples:
| classification  | discount  |
| New Customer    | 15        |
| Loyalty Card    | 12        |
| Coupon          | 20        |
