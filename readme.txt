App Name: Jezel Book Shop

Description: This is an ecommerce app for selling books with afordable price.
             This simple web-based app can be used in real business site like big websites such as lazada, shoppee and etc.
             The site holds two users which are "admin" and "customer".
             Admin Role can create, update and delete books and can approve payment that would be submitted by the customer.
             The site menus and pages are "Home", "Books", "MY CART", "MY PROFILE", "ORDERS", "LOGIN/LOGOUT", "Register", "Lost Password"
             Customer Role can pick books by adding it to his/her cart and then if he/she is fine with that. He/she can submit his/her order 
             and it will redirect to "PAYMENT PROCEDURE" page which bank details of the seller are provided.
             The customer need to pay through bank transfer and need to upload an image as a proof of payment.
             In that way the seller will verify if the payment is real, when everythings fine, the admin can now approve the payment and
             the customer now can download the book that he/she bought as "PDF File".
             Add to cart books is availble only for logged in customers, so it is required to have an account on the site.

Author: Jezel Leotilla

App Github Url: https://github.com/jezelleotilla/jezelbookshop

Instructions:
  1. Download app on github
  2. Setup your local server, suggested server is xampp, open xampp and start apache and mysql
  3. extract the app and place it on xampp/htdocs/
  4. rename the app folder to jezelbookshop
  5. open phpmyadmin and create database jezelbookshop_db
  6. click on the database and look on the import tab
  7. find the label "File to import:" and click the "Choose File" button
  8. A window popup will show and find the database stored on xampp/htdocs/jezelbookshop/jezelbookshop_db.sql.zip
  9. open any browser you like and type localhost/jezelbookshop on the url search bar

Users Account:
  Admin: 
    username: admin
    password: admin123
  Customer: 
    username: jezel05
    password: PROGRAMMER

Screenshots: xampp/htdocs/jezelbookshop/screenshots

Known Issue: 
  only for css and javascript files
  1. if you clone or download it on github, make sure rename the folder to jezelbookshop (because it is jezelbookshop-master renamed by github)
  2. Codeigniter ignore vendor files as default so css and javascript files are not included at my first push. but now it fixed already.