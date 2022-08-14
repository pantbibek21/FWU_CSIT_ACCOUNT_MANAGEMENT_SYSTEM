<-----------------------------What is inside this Index Folder?------------------------>
Index/index.php
Index/loginResponse.php
Index/registration.php
Index/registrationForm.css
Index/validateRegistration.js
Index/sendRecoveryEmail.php
Index/recoveryPassword.php

________DESCRIPTION OF WORKFLOW___________

1. index.php
    This file will generate interface through which user can enter their email and password to 
    login. If the credentials are verified, successful login will be done. Else appropriate error
    message will be displayed.
    In order to login user must have created account. Link to registration and forget password Link
    are provided in login page as well.

2. loginResponse.php
    This file is reponsible to do all the backend work in order to successfully direct the user 
    after login. First, it will make a database connection, verify if the user exists or not. If 
    exists then credentials checked. Upon successful matching user will be redirected to their respective
    profile interface.

3. registration.php
    In order to login, first the user have to create their account. Now since this is multiple userType
    web app so, students, account, librarian, lecturers and Head of Department can make respective registration 
    with the help of same common form only field selection will vary. Upon the submission of form first,
    it will be validated in the client side itself using JavaScript. This will ensure the data submitted from 
    client side is correct with respective to form. Using JavaScript for client side validation doesn't require any
    server request which helps to optimize the performace of server as well.
    However, it might be possible that client/user have turned off the JavaScript in the browser. So, to avoid any mess 
    of having incorrect details in database, server side validation is also used with php. We cannot take risk of having
    JavaScript turned on the client brower.

4. sendRecoveryEmail.php
    This script will be executed when use clicks on forget password. This file provides a interface in which we can
    enter the registered email for resetting the password. Here, user verification is also done to ensure the email 
    provided is registered, otherwise, appropriate error message will be shown. 
    Here, the realtime recovery email will be send with the help of PHPMailer and Gmail SMTP server.
    Appropriate message will be shown in case of any errors.

5. recoveryPassword.php
    This file will be executed on clicking the recovery link that user will get upon submitting a verified email in
    sendRecoveryEmail.php file. This file will provide interface for resetting the password. In order to 
    idenity the correct user, token is also being attached in link which helps to reset the respective users email.
    Upon successful registration, user will be redirected to login page. 

Addtional files

6. registrationForm.css
    This file contains css rules for styling the registration form.

7. validateRegistration.js 
    This file contains JavaScript code for validating form data in the client side itself.


________________________END___________________________________________________________________________________