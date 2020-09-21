# Snippets
<a href="https://travis-ci.com/rich-jowett/snippets"><img src="https://travis-ci.com/rich-jowett/snippets.svg?branch=master" alt="Build Status"></a>
<img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License">

## About Snippets
This project will help developers store their code-snippets and scratch files in one central place.  

I am expecting that the architecture of the finished project will be very different to what's in this repo right now.  One
of the motivations for this project is to learn Laravel.  Eventually, I would expect to separate out the front and back
end logic and probably use a front-end like Angular.

## Installing and Setup
A Makefile exists to aid setup.  You should be able to do this:
```shell script
$ make build
$ make install
$ make setup
```

Note, that the `install` command of the Makefile to work on Mac OSX you must use GnuSed (rather than the default once available on OSX)
```shell script
$ brew install gnu-sed
```

## Roadmap
I'm going to build code in this order:

- [ ] build up an OpenAPI spec of what the objects and endpoints are going to look like
- [ ] create the routes, controllers and models using Eloquent ORM
- [ ] build a basic front end with form

I intend to manage the project in https://github.com/rich-jowett/snippets/projects

## Disclaimer!
This project is a work-in-progress, but I'll endeavour to keep the README.md accurate.
