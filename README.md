# Who Wants to Be a Millionaire?

This is a simple implementation of the classic TV game show "Who Wants to Be a Millionaire?" using PHP, MySQL, HTML, CSS, and JavaScript.

- Randomly generated questions from a database of thousands of possible questions
- Three lifelines: "50/50", "Phone a Friend", and "Ask the Audience"
- 15 levels of increasing difficulty, with corresponding cash prizes
- High score tracking for each player
- Admin panel for managing users, questions, and game settings


## Requirements

To run this project, you'll need the following software installed on your computer:

> Apache web server <br>
> PHP 8 or later <br>
> MySQL 10 or later <br>
> A web browser <br>

## Installation

1. Clone this repository to your local machine:
```sh
git clone https://github.com/Corrbase/Who-want-to-be-a-millionaire.git
```
2. Create a new MySQL database for the project.

3. Import the database schema from the `database.sql` file in the project's root directory.

4. Edit the `settings.php` file to include your database connection details.

5. Upload the project files to your web server.

6. Access the project in your web browser.

## Usage

Once you have the project up and running, you can use it to play a virtual version of "Who Wants to Be a Millionaire?".

To play the game:

1. Navigate to the project in your web browser.

2. Click the "Play Now" button on the home page.

3. Answer the questions to the best of your ability.

4. Earn as much money as possible before answering a question incorrectly.

5. Enjoy the thrill of the game!


## Admin Panel
The admin panel provides a user interface for managing users, questions, and game settings. Only authorized administrators have access to the admin panel.

Features:
- User management: view, edit, and delete user accounts
- Question management: add, edit, and delete questions from the database
- Game settings: adjust the lifeline usage and cash prize amounts for each level of difficulty
- Access control: only authorized administrators can access the admin panel

Login and pass:

> login: admin <br>
> pass: admin


## Contributing

If you find any bugs or issues with the project, feel free to submit an issue on GitHub or fork the project and submit a pull request.

## Author
Corrbase
