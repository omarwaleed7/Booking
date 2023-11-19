# Booking
This is Booking API using Laravel and MySQL, this API allows you to easily reserve rooms, post your own, and rate experiences. User authentication is smooth, and a handy search box simplifies managing your stay.
# Booking API

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Database](#database)
- [Contributing](#contributing)

## Features

### Room Management

- **Add Room**: Effortlessly create new room listings, providing details such as room description, facilities, and availability.
- **Edit Room**: Modify room information and details to keep listings up-to-date.
- **Delete Room**: Remove room listings that are no longer available.
- **List All Rooms**: View a comprehensive list of all available rooms.

### User Management

- **User Authentication:** Secure access with JWT (JSON Web Tokens) authentication.
- **Update Profile:** Allow users to easily modify their profile information.
- **Delete Profile**: Provide an option for users to remove their account.

### Room Reviews

- **Add Review:** Enable users to leave feedback on room experiences.
- **Edit Review:** Modify room reviews for accuracy.
- **Delete Review:** Remove reviews as needed.
- **List Reviews**: View reviews associated with specific rooms.

### Room Reservations

- **Make Reservation**: Allow users to book and reserve rooms.
- **View My Listed Rooms**: Easily see a list of rooms you've posted.
- **View My Reservations**: Access a list of rooms you've reserved.

### Room Search and Sorting
**Search Rooms:** Find specific rooms by entering relevant keywords.
**Sort by Oldest:** Arrange rooms based on the earliest availability date.
**Sort by Newest:** Arrange rooms based on the latest availability date.
**Sort by Lowest Price:** Arrange rooms from the lowest to highest price.
**Sort by Highest Price:** Arrange rooms from the highest to lowest price.

## Installation

To get started with the Blog API, follow these steps:
1. **Clone the Repository:**
git clone https://github.com/omarwaleed7/Booking.git
2. **Navigate to the Project Directory:**
cd Booking
3. **Install Dependencies:**
composer install
4. **Create a `.env` File:**
Create a copy of the `.env.example` file and name it `.env`. Update the database connection settings and other environment variables as needed.
5. **Generate Application Key:**
php artisan key:generate
6. **Run Database Migrations:**
php artisan migrate 
7. **Start the Development Server:**
php artisan serve
8. **Access the API:**
The API should now be running at `http://localhost:8000`. You can explore the API endpoints and start using the Blog API.
9. **Documentation:**
For detailed API documentation and usage instructions, please refer to the provided [documentation](https://documenter.getpostman.com/view/29356608/2s9Ye8fuRs).

## Database

The Booking API uses MySQL as its underlying database system. You can configure the database connection by updating the `.env` file with your database credentials.

Click the image below to view the database schema:

<a href="https://drive.google.com/file/d/1Cm24x7gsLe1fAcRJ27RmnXmZE6_ekxQx/view" target="_blank">
    Database Schema
</a>

## Contributing

Contributions to the Booking API are welcome and encouraged. To contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix: `git checkout -b feature-name`.
3. Make your changes and commit them: `git commit -m 'Add some feature'`.
4. Push to the branch: `git push origin feature-name`.
5. Create a pull request.

Please ensure that your code follows the project's coding standards and practices. Also, make sure to update any relevant documentation and tests.
