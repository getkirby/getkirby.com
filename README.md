# Kirby Website

This repo contains the whole <getkirby.com> website.

## Requirements

- Local development server running PHP 7.1+ (e.g. Apache, nginx, MAMP).
- Node.js 10+ (LTS release) + NPM

## Installation and setup

### Step 1: Clone the repo into an empty folder:

```
git clone git@github.com:getkirby/getkirby.com.git
```

### Step 2: Install Dependencies

```
npm install
```

### Step 3: Configuration

We are using [Laravel Mix](https://laravel.com/docs/5.6/mix) as our build tool,
which also provides BrowserSync for an optimal developer experience. By default,
it expects a copy of the site to run at `http://getkirby.test`. The document root
of the site is the subfolder `www/`.

You can override the default domain if you prefer to run the site
at a different domain. To do so, just copy `config.default.js` to a file
named `config.js`. You can define a custom domain that new file.

## Start the build tool for development

```
cd [root folder of this repo]
npm start
```

This will run BrowserSync and watch your CSS, JS and template files for changes.

Stop the server by pressing `CRTL+C` or by closing the CLI window.

## Build for production

Before committing anything back to the repo, make sure to run a production build,
as our server does not build assets by itself. It’s always a good idea to lint
your code, before committing anything to the repo. You can do so, by running the
dedicated lint task:

```
npm run lint
```

If the linters do not produce any errors, you can create a production build, as
follows:

```
npm run build
```
