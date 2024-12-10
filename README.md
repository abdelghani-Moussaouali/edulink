# edulink API  

The **edulink API** is a backend solution built with Laravel to develop a web application to facilitate the management of assignments, allowing teachers to propose projects, students to apply and form pairs, and the administration to supervise the entire process in a smooth and transparent manner. 



## Getting Started  

Follow the instructions below to set up and run the edulink API on your local machine.


### Prerequisites  

Make sure your system meets the following requirements:  
- **PHP:** 8.1 or later  
- **MySQL/MariaDB:** 10.4 or later  
- **Composer:** Dependency manager for PHP  
- **Git:** Version control for cloning the repository  



### Clone the Repository  

1. Open your terminal and run:  
   ```bash
   git clone https://github.com/abdelghani-Moussaouali/edulink.git
   ```



## Installation Steps  

1. **Install Dependencies:**  
   In the project directory, run:
   ```bash
   composer install
   ```

2. **Configure Environment Variables:**  
   Copy the example `.env` file and generate an application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Update the `.env` file with your MySQL credentials:  
   ```
   DB_DATABASE=your_database_name  
   DB_USERNAME=your_username  
   DB_PASSWORD=your_password  
   ```

3. **Run Migrations:**  
   Create the necessary tables in the database:
   ```bash
   php artisan migrate
   ```

4. **Seed the Database (Optional):**  
   Populate the database with sample data:
   ```bash
   php artisan db:seed
   ```



### Running the API  

1. **Start the Laravel Development Server:**  
   Run the following command to start the server:
   ```bash
   php artisan serve
   ```

2. **Access the API:**  
   The API will be available at:  
   ```
   http://127.0.0.1:8000
   ```



## Quick Commands  

For quick setup and run on **Linux**:  
```bash
git clone https://github.com/abdelghani-Moussaouali/edulink.git && \
cd edulink && \
composer install && \
cp .env.example .env && \
php artisan key:generate && \
php artisan migrate && \
php artisan serve
```



## API Usage  

Use tools like **Postman** or **cURL** to test API endpoints during development. For example:  
```bash
curl http://127.0.0.1:8000/api/
```


## Contributors  

- [Abdelghani moussaouali](https://github.com/abdelghani-Moussaouali)  


If you'd like to join the team or contribute to the project, follow the instructions in the [Contributing](#contributing) section.


## Contributing
Contributions are welcome! If you'd like to contribute to this project, please follow these steps:
1. Fork the repository.
2. Create a new branch with a descriptive name.
3. Make your changes and commit them.
4. Push to your forked repository.
5. Open a pull request.

## License
This project is open-source under the [MIT License](LICENSE.md) file for details.

---

<div align="center">   
    <!-- <img src="./public/logo.png" width="170"> -->
    <p>&copy; 2024 , All rights reserved to - edulink </p> 
</div>