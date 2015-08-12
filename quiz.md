# GumGum Web Engineering - PHP Test
# Quiz

General
-------
- What do you like the most and dislike the most about PHP?
 - The thing I like the most about php is that I can return anything from a function without specifying like in java.
The things I dislike the most are array indexes, because they don't have to be in order.
- What blogs, books or resources you tend to have always available when working
with PHP?
 - I use google, stackoverflow, and the php documentation. 
- We all use PHP reference from time to time, do you still go to PHP.net or what
do you use?
 - I use php.net the most. Its my favorite resource to learn from.
- What do you use to code PHP? An IDE? A text editor? a mix?
 - I use sublime text editor most of the time. I use several packages to go along with it. I would like to try php storm for the syntax correction.
- How do you usually check the basic functionaly of your code? Any special tool?
 - I test basic functionality using php console. Using the command php -a. Then its simple to enter commands. 
- What about debugging? How do you do it?
 - Since I mostly work with frameworks, I test my code with the built in error logging. I also use apache error logging.
- Do you have a PHP stack available in your home/personal computer? What kind?
 - I have standard LAMP stack. Also one with postgres. As for frameworks I have worked with cakephp, codeigniter, and recently laravel.
- Have you worked with a PHP that its not "local local", maybe a VM, a container
or a remote machine? What kind?
 - Virtualbox with ubuntu 12.04 and 14.04 for different versions of php. 
I have experience connecting through ssh to our company servers that run centos.


PHP and the Browser
-------------------
- What is the difference between session and cookies? What's their relation?
 - Sessions are server side client info whereas cookies are client side. They are both used to identify specific users. 
- Why do we need to declare a domain to our cookies?
 - Browsers don't allow cookies without domains because it would be a security risk. Requiring a domain encapsulate it to te site.
- You're asked to build a CRUD form for a books inventory system.
 - How would you start? What questions you would need to do to the owner?
  - I would start by asking the owner what they want and need. If they need a desktop only site or a mobile friendly site. If they want input on the ui. If they want specific technologies. If they want me to handle the entire project. One most of the questions are answered I would start with the techonolgies. Then defining the database scheme.
 - How do you design the FORM? What method and input types/names you choose?
  - I would design it using ajax to allow users to easily edit the data. Create more of an application rather than a site.
 - How do you process it on the server?
  - Send the data to a controller then validate the data. Once the data is validated I would be save it to the database. If an error occurs I would notif the user.

PHP and the Server
------------------
- Have you used PHP with Nginx? as FastCGI script? Ever configured it?
 - No I have not. I'm used to using php with apache. I have configured it on server applications and feel comfortable with it. 
- You're coding a report that reads a MySQL database, returning 5xx errors.
No PHP errors are shown in the page. What do you do? How do you debug it?
 - I would check if the database is up and running. After that I would check the server error logs. If neither shows any error I would then start to insert logging commands.
- The PHP script that process a shopping basket form is not working as expected.
The request shows correct in your browser debugging tools. What could it be?
 - It could be that the code is wrong and processes the data incorrectly but returns a successful response.
- Is it possible to write a git hook in PHP? What is needed to be done?
 - It is possible to write a git hook in PHP. You would need to make one of the hooks under .git/hooks/ execute a php script.
- Is it possible to create a real-time app with PHP? Meaning, the connection is
never closed? What would you use?
 - It is possible. You would need to use web sockets or a server that supports web sockets.
- How would you use your composer-loaded app from the CLI?
 - I would use composer install to install the app. Or composer update if the application is already installed.

PHP and the Network
-------------------
- How do you optimize for bandwidth in PHP?
 - I would enable caching. To build on that I would enable gzip and minifiers.
- You need to scrape a website, what would be your basic tools?
 - A basic tool would be curl. Without using libraries I would use php string functions to parse through the data.
- You're required to build an API, what are your initial questions about it?
 - I would ask what they want to be able to do with the api. If they want to be able to modify or just retrieve data.
