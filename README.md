# Surveys Portal - Readme
<details>
  <summary>❓Why my commits often have no names and I'm not using branches❓</summary>
  <ul>
    <li>I often create with bursts many things at once</li>
    <li>I don't plan things ahead, I just create things that seems good at that moment</li>
    <li>Sometimes I have bad internet connection and it is troublesome to send commits</li>
    <li>I'm coding alone so creating branches and describing commits is not useful for me</li>
  <ul>
</details>

## Table of Contents
- [Informations](#informations)
- [Project requirements](#project-requirements)
   - [By page](#by-page)
   - [By role](#by-role)
- [Technologies](#technologies)
- [Features](#features)
- [Setup](#setup)
- [Database](#database)
- [User interface](#user-interface)

<br>

## Informations
The primary goal of the project is to provide users with the ability to participate in surveys, create them, and collect data on the results based on the provided answers. To avoid storing and displaying inappropriate content to users, the site will have moderator and administrator roles. Additionally, there will be a super administrator role who is the owner of the site.

<br>

## Project requirements

### By page

#### Each page
- Return to the home page
- Navigation to the login/registration page if the user is not logged in
- Access to the public survey search page
- Access to the profile and logging out if the user is logged in
- Contact to the portal owner (except admin panel)

#### Home page
- Information about the portal
- The most popular and recently created public surveys with the option to open them

After login or register:
- Access to surveys for logged-in users
- Ability to create their own surveys

#### Public survey search page
- Search for a given string in the title, description, and questions
- Filter by tags
- Sort search results in ascending or descending order by popularity, creation date, rating, number of respondents, and number of questions
- Navigation through paginated results

#### Login page
- Navigation to the registration page
- Logging in an existing user
- Remember the user
- Reset the password (link to password reset page should be sent to email address)
- Redirection to home page after successful login

#### Password reset page
- Set a new password

#### Registration page
- Navigate to the login page
- Create new user account (if form is filled correctly, activation link should be sent to provided email address)
- Redirection to home page after successful registration

#### Profile page
- Link to the admin panel if the user has moderator, administrator or owner permissions
- List of user created surveys with the option to open them

#### Survey creation page
- A title
- A description
- Final information
- At least one tag
- At least one question with at least one answer
- Start and end dates
- The option to allow non-logged-in users to vote
- The option to set a password required for voting (private voting)

A survey question can contain answers of one of the following types:
- Single choice
- Multiple choice
- Text field
- Range

After successfully creating a survey, the user should be redirected to the survey page.

#### Survey page
- Display a password entry form if the survey is private
- Display basic information about the survey and allow participation if it is public or if the correct password has been entered
- Allow the survey owner to navigate to the survey editing page and the statistics page of the given answers

#### Survey editing page 
- Editing the survey (similar to survey creation)
  
#### Survey completion page 
- Progress of completing the survey
- Questions with the ability to answer them
- Option to submit the answers and rate survey
- Final information after filling the survey

#### Admin panel
- For moderator:
  - Review reports and forward them to administrators if they violate the rules
  - Review data in the database
- For administrator:
  - Do everything a moderator can do
  - Ban users
  - Block surveys
- For the owner:
  - Do everything an administrator can do
  - Review contact messages
  - Assign rights to users
  - Delete and edit all data in the database

----------------------------------

### By role

#### System
- Display appropriate pages
- Store user data
- Calculate statistics from survey answers
- Send emails with activation codes
- Send emails with password reset links

#### Guest
- Create an account
- Log into the account
- Search for public surveys
- Display information about public surveys
- Participate in public and private surveys available to non-logged-in users

#### User
- Everything a guest can do
- Reset the password
- Create surveys
- Display the list of their own surveys
- Display statistics of their own surveys from the provided answers
- Edit their own surveys
- Report surveys
- Participate in public and private surveys available to logged-in users

#### Moderator
- Everything a user can do
- Display data contained in the database
- Forward reported surveys to the administration for blocking
- Forward users to the administration for banning

#### Administrator
- Everything a moderator can do
- Block surveys
- Ban users

### Owner
- Everything an administrator can do
- Read contact messages
- Assign rights to users
- Delete and edit all data in the database

<br>

## Technologies
Languages:
- HTML
- CSS
- JS
- PHP 8.1.12

Libraries and frameworks:
- [Laravel 10.2.0](https://laravel.com/docs/10.x)
- [Tailwind CSS 3.2.7](https://tailwindcss.com/docs/installation)
- [Font Awesome 6.3.0](https://fontawesome.com/docs)
- [Google Fonts](https://developers.google.com/fonts/docs/getting_started#a_quick_example)
  
Programs:
- [VSCode](https://code.visualstudio.com)
- [XAMPP 8.1.12](https://www.apachefriends.org/download.html)
- [Node.js v18.13.0](https://nodejs.org/en)

<br>

## Features
- Login and register:

<br>

> [!NOTE]  
> Room for improvements:
> - Password reset
> - Password reminder
> - Account activation via email confirmation
> - Survey statistics
> - Specific FAQ on the homepage
> - User banning and unbanning
> - Survey blocking and unblocking
> - Specific dashboard in the admin panel
> - Specific and consistent seeding
> - Survey search
> - Deletion of users, questions, answers, user responses, tags, and bans
> - User and tag creation from the admin panel
> - Navigation from user management to user ban data, user rating data, user survey response data
> - Navigation from survey management to survey rating data, user response data
> - Navigation from question management to the survey containing the question and all responses to that question
> - Navigation from answer management to the user who provided the answer, the question to which the answer is given, and the survey containing it

<br>

## Setup
To run the application, you need to have installed:
- XAMPP 8.1.12
- Composer 2.5.4
- Node.js v18.13.0

Then, you need to:
- Place the project on your disk
- Create a database named 'surveys_portal' in phpmyadmin
- Save the `.env.example` file as `.env` in the project folder
- In the project folder, run the following commands:
  - `composer install`
  - `php artisan migrate`
  - `php artisan db:seed`
  - `php artisan key:generate`
  - `php artisan storage:link`

After that, start the project with the following commands:
- `php artisan serve`
- `npm run dev`

<br>

## Database
![erd diagram](/_for_readme/erd_diagram.jpg)

The most important tables providing basic functionality in the database are:
- `users` – user data
- `surveys` – survey information, start, end, access, survey blocking
- `questions` – survey question information
- `users_answers` – user responses to survey questions

Tables offering other functionalities are:
- `bans` – user bans
- `roles` – user roles
- `reports` – survey or user reports
- `ratings` – survey ratings
- `surveys_tags` and `tags` – survey tags
- `answers` – prepared answer choices for surveys
- `question_types` – types of survey answers
- `contact` – contact with the site owner

The connection between the application and the database is defined in the `app/config/database.php` file using the data contained in the `.env` file.

![erd diagram](/_for_readme/env_file_content.png)

<br>

