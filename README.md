# PHP-Form

In this Project, We get the values from the user and validate the user inputs. Then we use <a href="https://www.google.com/recaptcha/about/">Google's recaptcha</a> for security against Malicious Software. We would then store User Inputs into MySql 8 Database and perform CRUD operations.

## Technologies Used:

<a href="https://www.w3schools.com/html/" target="_blank"><img title="HTML 5" height="64" width="64" src="https://cdn.svgporn.com/logos/html-5.svg" /></a>&nbsp;&nbsp;&nbsp;<a href="https://www.w3schools.com/css/" target="_blank"><img title="CSS" height="64" width="64" src="https://cdn.svgporn.com/logos/css-3.svg" /></a>&nbsp;&nbsp;&nbsp;<a href="https://getbootstrap.com/" target="_blank"><img title="Bootstrap 4.5.3" height="64" width="64" src="https://cdn.svgporn.com/logos/bootstrap.svg" /></a>&nbsp;&nbsp;&nbsp;<a href="https://jquery.com/" target="_blank"><img title="JQuery" height="64" width="120" src="https://cdn.svgporn.com/logos/jquery.svg" /></a>&nbsp;&nbsp;&nbsp;<a href="https://www.php.net/" target="_blank"><img title="PHP 7.3.21" height="64" width="94" src="https://cdn.svgporn.com/logos/php.svg" /></a>&nbsp;&nbsp;&nbsp;<a href="https://www.google.com/recaptcha/about/" target="_blank"><img title="Google's recaptcha" height="64" width="54" src="https://cdn.svgporn.com/logos/google-developers-icon.svg" /></a>&nbsp;&nbsp;&nbsp;<a href="https://www.mysql.com/" target="_blank"><img title="MySQL 8" height="64" width="64" src="https://cdn.svgporn.com/logos/mysql.svg" /></a>

## Objective:

1. Create a simple BootStrap form with fields Name, Email, Phone No., Date of Birth, Age.
2. Auto populate the age using date of birth entered.
3. Implement Google Captcha for the form.
4. On submit, capture all data and display it in a table.
5. Give option to delete any added record.
6. Give "Edit" option to change email alone.
7. Technology stack should be HTML/CSS/PHP/MySQL/BootStrap.

## Validations that are Looked Into:

### 1. Name Validation:
 ##### NOT_NULL, MAX_LENGTH = 50 Characters (Including Blankspaces)
 
### 2. Email Validation:
 ##### NOT_NULL, RegEx (Regular Expression) = "/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/"
 
### 3. Contact Number Validation:
 ##### NOT_NULL, MAX_LENGTH & MIN_LENGTH = 10 Characters 
 
### 4. Date of Birth (DOB) Validation:
 ##### NOT_NULL, MIN_DATE = 1937-01-01, MAX_DATE = 2016-12-31
 
### 5. Age Validation:
 ##### READ-ONLY, Derived From DOB, Age must be in the range of 3 - 79 Years

## Screenshots:

<img width="400" alt="php-form-2" src="https://user-images.githubusercontent.com/66553883/99062325-da3c3d80-25c8-11eb-8aca-3e56acfba3b2.png">

<img width="400" alt="php-form-3" src="https://user-images.githubusercontent.com/66553883/99062683-5afb3980-25c9-11eb-9877-a11236576c63.png">

<img width="400" alt="php-form-4" src="https://user-images.githubusercontent.com/66553883/99063182-1b811d00-25ca-11eb-83a3-be01f4fd504f.png">

<img width="400" alt="php-form-6" src="https://user-images.githubusercontent.com/66553883/99140312-c0e9ce80-2666-11eb-9375-58ce0b4761a1.png">

## Deployment Instructions:

1. Install a Server Application for PHP like WAMP or XAMP.
2. Clone or Download the Zip File of the Source Code.
3. Move the Source Code Folder to wamp\www folder if you are using WAMP or to xamp\htdocs if you are using XAMP.
4. In the URL, type "http://localhost/your_source_code_folder_name/index.php".
