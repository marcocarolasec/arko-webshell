<!-- PROJECT LOGO -->
<div align="center">
  <a href="https://github.com/othneildrew/Best-README-Template">
<img width="400" alt="Figure-1-Simple-PHP-Web-shell-example-V2" src="https://github.com/marcocarolasec/arko-webshell/assets/58811847/86241247-c254-46f4-b684-6cd4295400dc">  </a>

</div>


## README

### Description
The **Arko-WebShell** is a project which seeks to protect a php backdoor through secure authentication. Every 5 failed attempts, it will block the ability to continue entering passwords for 30 seconds, preventing brute force attacks. The webshell has a graphical and interactive shell and has file upload functionality, which facilitates post-exploitation.

### Key Features

1. **User Authentication:**
   - Authentication is performed using a predefined password.
   - After 5 failed attempts, the system locks access for 30 seconds.
   - Once authenticated, the user can access the web shell to execute commands.




2. **Change Default Password:**
```
// Define the expected password
$expectedPassword = 'Arquero99.+';
```
   - The user can enter a new password that will replace the default password for future sessions.

### Usage Instructions
1. **Login:**
   - When accessing the application, a login form is displayed requesting the password.
   - The user must enter the default password to access the web shell.
   - After 5 failed attempts, access is locked for 30 seconds.

2. **Web Shell:**
   - Once authenticated, an interactive web shell is displayed.
   - The user can enter commands in the input field and execute them.
   - The output of the commands is displayed below the input field.

3. **Change Password:**
   - After authentication, an additional field is displayed to enter a new password.
   - If the user wishes to change the default password, they can enter a new password and submit the form.
   - The new password will be set as the password for future sessions.

4. **Logout:**
   - The user can log out at any time by clicking the "Logout" button.
   - Upon logging out, the session is destroyed, and the user is redirected to the login form.

### Technologies Used
- PHP: For backend development and server-side logic.
- HTML/CSS: For the structure and styling of the user interface.
- PHP Sessions: To manage user authentication and lockout after multiple failed attempts.
- Linux Shell: To execute commands on the server.

### Important Notes
- It is crucial to protect the default password and ensure that only authorized users have access.
- It is strongly recommended to change the default password after the first login to enhance system security.
- The lockout system after multiple failed attempts protects against unauthorized access attempts and brute-force attacks.

### Author
This project was developed by MarcoCarolaSec
