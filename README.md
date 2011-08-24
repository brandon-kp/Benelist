Benelist: PHP/MySQL List Management app, built using Codeigniter
=================================================================

* Author:  Brandon Probst (<brandonkprobst@gmail.com>);
* Date:    August, 2011
* Version: 0.0.3
* Github:  https://github.com/brandon-kp/Benelist

Feel free to use or modify, just don't lie about using it.

The purpose of this application is to allow users to create, share,
modify, clone, and collaborate on lists. 

Being someone who makes lists of everything from things I need,
to what I eat on an average day, I particularly enjoyed building this.

Implemented Features
---------------------
* Creation of lists. Lists are stored as plain text in the database
  and parsed programatically so as to reserve resources in MySQL.
* Password protected modification of lists. This doesn't require the
  user to set up an account, only that they use a password.
* Cloning of lists. Want to contribute something to a list? Clone it.
  The revisions will be linked directly under the original.

Planned Features
-----------------
* Like one revision better than another? Vote it up. Those with the
  most votes will be shown higher.
* Merging. If you like a revision of your list enough, merge them 
  together.