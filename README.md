# clinicaWebsite 🏥
A responsive clinic management website developed using **HTML**, **CSS**, **PHP**, **MySQL**, **JavaScript** and **Bootstrap**. This project allows for user registration for admin(doctors) and patients, appointment scheduling, patient record management, and clinic staff organization.

## 📋 Project Overview

The **Clinic Management Website** includes the following features:
- **Patient Management**: Register patients and store personal details, medical appointments and prescriptions.
- **Staff Management**: Admins can edit clinic staff details, such as doctors and nurses.
- **Appointment Scheduling**: Admins can add, edit or delete appointments with patients.
- **Prescription Management**: Admins can add, edit or delete patient's prescriptions.
- **Users Registration**: Saves the username and password for the Login credentials.
- **Responsive Design**: Built with **Bootstrap** for compatibility across all devices.

## 🛠️ Technologies Used

- **PHP**: Server-side scripting for dynamic page generation.
- **MySQL**: Backend database for managing patient, staff, and appointment records.
- **Bootstrap**: Front-end framework for responsive web design.
- **HTML5 & CSS3**: Core web development technologies.
- **JavaScript**: For interactivity and client-side validation.

## 💻 Setup Instructions

1. Clone this repository.
2. Set up a local or remote server (e.g., **XAMPP**, **WAMP**, or **LAMP**).
3. Import the `clinic_database.sql` file from the [clinicaDatabase](https://github.com/tatianafrsousa/clinicaDatabase) repository into your **MySQL** server.
4. Configure the database connection in the `db_connect.php` file:
   ```php
   <?php
   $servername = "localhost";
   $username = "your_username";
   $password = "your_password";
   $dbname = "clinica";
   ?>
5. Run the website on your server.

## 📚 Course Information
This project was developed as part of the  **Specialist Technician in Information Systems for Management Applications** course.

## 🔗 Related Projects
[clinicaDatabase](https://github.com/tatianafrsousa/clinicaDatabase) — The MySQL database used for storing patient, appointment, and clinic staff records.

## 📝 License
Feel free to use and modify this project for educational purposes.
