# Project Setup Instructions

## Requirements

- [XAMPP](https://www.apachefriends.org/index.html)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)

---

## Installation Steps

### 1. Install Laravel Project

1. Ensure XAMPP and Composer are installed.
2. Open a terminal window in the `htdocs` folder located at:
   - **Windows**: `C:\Xampp\htdocs`
   - **Mac**: `/opt/lampp/htdocs`
3. Run the following command to create a new Laravel project:

   ```bash
   composer create-project --prefer-dist laravel/laravel PROJECT_NAME
   ```

4. After the project installation, move all the files from the GitHub repository into the project's directory and **replace all files**.

---

### 2. Set Up a Virtual Host

1. Edit the `hosts` file:
   - **Windows**: `C:/Windows/System32/drivers/etc/hosts`
   - **Mac**: `/etc/hosts`

   Add the following lines:
   ```
   127.0.0.1    localhost
   127.0.0.1    PROJECT_NAME.test
   ```

2. Edit the `httpd-vhosts.conf` file:
   - **Windows**: `C:/xampp/apache/conf/extra/httpd-vhosts.conf`
   - **Mac**: `/opt/lampp/etc/extra/httpd-vhosts.conf`

   Add the following configurations:

   **Windows:**
   ```apache
   <VirtualHost *:80>
       DocumentRoot "C:/xampp/htdocs"
       ServerName localhost
   </VirtualHost>

   <VirtualHost *:80>
       DocumentRoot "C:/xampp/htdocs/PROJECT_NAME/public"
       ServerName PROJECT_NAME.test
   </VirtualHost>
   ```

   **Mac:**
   ```apache
   <VirtualHost *:80>
       DocumentRoot /opt/lampp/htdocs
       ServerName localhost
       ServerAlias www.localhost
   </VirtualHost>

   <VirtualHost *:80>
       DocumentRoot /opt/lampp/htdocs/PROJECT_NAME/public
       ServerName PROJECT_NAME.test
       ServerAlias www.PROJECT_NAME.test
   </VirtualHost>
   ```

3. Start the SQL and Apache servers in XAMPP.
4. Open **phpMyAdmin** and create a database named `peer_tutor`.

---

### 3. Install Tailwind CSS

1. Run the following commands in the project's root directory:
   ```bash
   npm install -D tailwindcss postcss autoprefixer
   npx tailwindcss init -p
   ```

2. Add the required configurations to the `tailwind.config.js` file (as highlighted in your project documentation).

3. Run the following commands:
   ```bash
   npm run dev
   php artisan migrate --seed
   ```

   - The `php artisan migrate --seed` command will import all required tables and seed the database with test tutors and users.

---

## Test Accounts

The following accounts can be used to log in. All accounts have the password `test`:

- **Tutoree User**: `test@example.com`
- **Admin User**: `admin@example.com`
- **Tutor User**: `tutor@example.com`

---

## Accessing the Application

Visit the application at:

- **Windows**: [http://PROJECT_NAME.test](http://PROJECT_NAME.test)
- **Mac**: [http://PROJECT_NAME.test:8080](http://PROJECT_NAME.test:8080)
#   N R G - H a c k s - P B V R - 2  
 #   N R G - H a c k s - P B V R - 2  
 