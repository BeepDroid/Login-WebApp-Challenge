# Login-WebApp-Challenge

This is a PHP Web application that has a user-end login and sign up page that utilizes REST endpoints to allow users to login, sign up and logout securely. As this is only a mockup, it only has the respective user input forms and two confirmation pages, one of which will allow users to terminate their token session and logout. 

## Files 
<center>Some notes about the files included in the repository:</center>
<br><br>
         <b>API Testing Documentation:</b>
         <ul>
              <li>This file contains a small collection for Postman testing and screnshots of JSON return testing I was doing in app. </li>
              <li>The code is also full of comments pointing out the print out lines I used for this purpose. They are commented out for the final version, but I did not remove them and have comments pointing them out. </li>
        </ul>
               <br>
        <b>Postgresql Scripts:</b>
        <ul>
              <li>This folder contains the SQL script files for the databse and table creation that the app references.</li>
        </ul>
        <b>LoginChallenge:</b>
        <ul>
              <li>This folder contains the main files for the project.</li>
              <li>index.php - This is the Web page sign in and login form.</li>
              <li>Users folder - This contains the PHP files for the POST, GET and SESSION methods.</li>
              <li>Object folder - This contains the PHP file that has our User object defined with appropriate methods.</li>
              <li>Config folder - This has the methods for our database connection string. Editing may be necessary as it uses login credentials for Postgres. </li>
        </ul>

 ## Environment Details       
 This program was made using Apache HTTP Server 2.4.59 with XAMPP for PHP environment configuration. It is run on localhost, with PID 1316, 16680 and listening port 80. 
 <br>
 Postgresql Database is utilized to store the User information for the POST and GET calls. 
 This is a PHP Web application that was made and compiled through Netbeans and was testing through opening in Microsoft Edge. 
<br>
Upon running successfully, the LoginChallenge folder should appear in the htdocs folder in Xampp; however, addding the Api folder first may be necessary to properly connect the API Endpoints.
<br>

            
