## Task statement

Our supermarket guests for global reach has promted us to open new supermarket - we sell only 3 product:

|  Product code  |  Product name  | Price
--------------------------------------------
| FR1            | Fruit tee      |$3.11
| SR1            | Strawberries   |$5.00
| SF1            | Coffee         |$11.23

The CEO is big fan of buy one get one free offers and of fruit tee. He wants us to add a rule to do this.
The COO, though, likes low prices and wants people to buying strawberries  to get a price discount for bulk purchases.
If you buy 3 or more strawberries price should drop to $4.50
Our checkout can scan product in any order and because CEO and COO change their mind often it needs to be flexible,
regarding our pricing riles.
The interface of our checkout look like this:
$co = new Checkout($pricing_rules);
$co->scan($item);
$co->scan($item);
$sum = $co->total;
Implement a checkout system that fulfil this requirements:
Test data
_______________________________
Basket: FR1, SR1, FR1, FR1, SF1
Total sum expected: $22.45

Basket: FR1, FR1, 
Total sum expected: $3.11

Basket: SR1, SR1, FR1, SR1
Total sum expected: $16.61


## Task solution

Table Products:
id, code, name, price

Session saves cart(scaned) products.

home page:
------------------------------------
Product name (price)  Scan  Remove
Product name (price)  Scan  Remove
Product name (price)  Scan  Remove
------------------------------------
Remove all

Scaned produces:
 Code:Quantity
 Code:Quantity
 Code:Quantity

Total:  Sum
  
-------------------------------------

To seed Product table with products run:
   php artisan migrate:refresh --seed


