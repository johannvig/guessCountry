# Guess Country Game

Welcome to the **Guess Country Game**! This is a simple web-based game where users can guess countries based on various categories such as flags, currencies, languages, locations, and capitals.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Game Modes](#game-modes)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Contributing](#contributing)
- [License](#license)

## Installation

### Prerequisites

- [XAMPP](https://www.apachefriends.org/index.html) (or any other PHP and MySQL development environment)

### Steps

1. Clone the repository to your local machine:
    ```bash
    git clone https://github.com/johannvig/guess-country-game.git
    ```

2. Move the project directory to your web server's root directory. For XAMPP, it would be `C:\xampp\htdocs\`:
    ```bash
    mv guess-country-game C:\xampp\htdocs\guessCountry
    ```

3. Start the Apache and MySQL servers from the XAMPP control panel.

4. Create a MySQL database named `guess_country` and import the provided `guess_country.sql` file:
    ```sql
    CREATE DATABASE guess_country;
    USE guess_country;
    SOURCE path_to_sql_file/guess_country.sql;
    ```

5. Open your web browser and navigate to `http://localhost/guessCountry/public/index.php`.

## Usage

1. On the login page, you can either register a new account or play without an account.
2. Once logged in, choose a game mode from the menu.
3. Follow the prompts to guess the correct answers based on the selected game mode.

## Game Modes

- **Guess the Flag**: Identify the country based on its flag.
- **Guess the Currency**: Identify the currency used by the country.
- **Guess the Language**: Identify the official language of the country.
- **Guess the Location**: Identify the country based on its geographical coordinates.
- **Guess the Capital**: Identify the capital city of the country.

## Features

- User registration and login
- Play as a guest
- Different game modes
- Track user statistics
- Responsive design

## Technologies Used

- PHP
- MySQL
- HTML
- CSS
- JavaScript (jQuery)
- [RestCountries API](https://restcountries.com/)

## Contributing

1. Fork the repository.
2. Create a new branch:
    ```bash
    git checkout -b feature-branch
    ```
3. Make your changes and commit them:
    ```bash
    git commit -m "Description of changes"
    ```
4. Push to the branch:
    ```bash
    git push origin feature-branch
    ```
5. Create a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

![image](https://github.com/user-attachments/assets/5538171f-6c08-4708-bec9-230fa256eec9)
![image](https://github.com/user-attachments/assets/417d1c37-19a3-4b53-ab36-d269af325e2d)
![image](https://github.com/user-attachments/assets/d5e54977-2cb6-491c-b34c-5c69c749c0ab)
![image](https://github.com/user-attachments/assets/53ba2d76-896c-43b6-a048-a96defeabbf0)
![image](https://github.com/user-attachments/assets/5fad9587-d613-4fda-853f-ac5d2a4734fd)
![image](https://github.com/user-attachments/assets/fc8a4f0a-8239-4a2e-b625-6c7d8f52ab9d)
![image](https://github.com/user-attachments/assets/f11d8868-2cea-4030-a853-08b4c3fe531f)
![image](https://github.com/user-attachments/assets/5a082857-97b4-42d1-bffd-5ad1d535d2be)
![image](https://github.com/user-attachments/assets/82a1adcd-4711-4bd5-96c7-07087d89dcfb)
![image](https://github.com/user-attachments/assets/4bc8634c-d820-4b90-8ecb-0248c61a919a)







