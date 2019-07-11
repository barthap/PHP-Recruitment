# PHP-Recruitment

This is a simple KohanaPHP-based (v3.3) recruitment system. It is just an idea, prototype, not a production-ready application.

Whole website is wrote in Polish language, designed to work with Polish school system

`database.sql` contains SQL database schema and some random-generated example data.
Database connection config: application/config/database.php

Features:
* User can apply for school with or without creating account
* If he creates account, he can watch his recruitment progress and make corrections to his personal data [if mistaken].
* He can download application PDF with his personal data auto-filled.
* Admin panel for recruiter, allowing to accept or decline student applications, add comments etc.

To do:
* E-mail notifications
* Statistics
* I don't know

This project is no longer developed by me, I abandoned it. It needs some code cleanup.

### Installation
This project uses [KohanaPHP v3.3](https://kohanaframework.org) which is now deprecated.
Look at their website, and/or `Installation.md` for more instructions. There is also install.php.bak (remove .bak extension).
Then look at `application/bootstrap.php` file and `application/config` directory for basic configuration.
