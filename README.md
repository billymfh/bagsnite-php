# bagsnite-php
A system to track FortniteBR Stats for our clan and notify on those sweet, sweet wins

## About
This is a really rough draft for a clan site. The code is sloppy and the overall design pattern is that of "partially digested spaghetti". 
Don't judge me. 

## Installation
There are a few composer requirements, and eventually this will all be available as a sweet AF composer install itself. Make sure you get shose.

You'll also need to sort out your own slack webhook.
And sort out your google OAuth API stuff (I'll update with better directions later, maybe)
MySQL, that's a thing you should have. This is all written around access to an Azure MySQL instance. So it's kind of jacked up for most of the real world. Sorry bruh. 
DB Schema is in here, you're welcome.

There are "daemon" scripts that you should run.

And you'll need to probably add `win-dbprep.php` to your cron.

## Contributing
Yeah, that's probably a thing you can do. I wouldn't recommend it though. Probably better off doing it yourself. 