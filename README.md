# Fminor
Generate a simple web page with a single command.

##Set up
To set up a new project based on Fminor you just need composer and run:
```
$ composer create-project lexcast/fminor 1.0-dev
```
and that's it, now you have a very basic structure to start your project.

##Usage
Out-of-the-box you can simply open your terminal, go to the web folder and run the PHP built-in server (or if you want with a real server) and then in your browser go to 127.0.0.1:8000/hello/your-name and you will receive a page saying hello to you.

###Looking inside
But that is a useless web page, probably you will have to create more routes and controllers, so let me explain the structure a little bit:
In the root you have two folder, `web` and `src`. In the first one there will be all your public files: scripts, images, css and, of course, the frontal controller called `app.php`.
But the interesting part is in the `src` folder where there are:

- App: with controllers, and other own classes you create.
- Config: with all your configuration files, mainly the `routes.php`.
- Resources: with your templates and layouts.

##Generate a project
The fun part of this mini-project is the idea to generate fragments to build a simple web page just based on a yaml file.

There is already a `chords.yml` file in the root with a functional example to build a web page, just type in your terminal:
```
$ php tuner build --force
```
and this command will generate all templates, routes and controllers needed.

###How it works?
This command just get two files. The `chords.yml` has all the information about what do you want (menus, pages, etc.) and validates it. Then in `src/Config/repertoires.php` look for all repertoires (plugins) you have, and inside of these look for Chords (are like parts or fragments, i.e. menu, section) and Generators (to generate controllers, routes, views, etc.). Finally will send requests to all registered generators whom will generate the code needed.

##About this project
This was developed just to learn more about the Symfony components and for now there is only one repertoire available with just a few basic fragments. Check it: [lexcast/fminor-repertoire](github.com/lexcast/fminor-repertoire).

If you want to collaborate with more fragments, feel free to do it. The idea is to generate simple web pages easily.

The author of this project is Daniel Alejandro Cast ([@lexcast](github.com/lexcast)).
