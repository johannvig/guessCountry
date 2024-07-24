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


