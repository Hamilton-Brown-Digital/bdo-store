## Getting Started

- Download [Local](https://localwp.com/releases/)
- Clone this repo to your desktop (or anywhere) `git clone git@github.com:Hamilton-Brown-Digital/bdo-store.git`
- Open the folder where te site is cloned. Add a backup of the SQL file to the root of this folder
- Zip the content of the folder. Drag into Local.
- Follow the steps in Local. Let it do its thing.
- Make sure to edit wp-config.php to activate debugging `define( 'WP_DEBUG', true );`
- Activate Timber and ACFPro to begin editing.

> Please make sure to activate Timber and ACFPro before you begin

### Prerequisites

- Download and install Node Version Manager `curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.11/install.sh | bash`
- Then install node `nvm install node`
- Then tell it to use the installed version `nvm use node`
- It would be beneficial to also [install avn](https://github.com/wbyoung/avn), which will auto switch your node version when you cd into the project
- Download and install the latest npm `npm install npm@latest -g`

### Installing

Change directory into the build folder

`cd bdo-store/build`

Run npm to install packages

`npm i`

### Coding style tests

You code will be linted on every save, the output will appear in your terminal window to let you know if you have done anything wrong. Errors will also appear as an overlay in your browser window to alert you.

## Development Workflow

`cd` into the build folder and run the build task to compile your JS/SCSS and spin up a webpack-dev-server

`npm run dev`

### Naming conventions

We're using a combination of BEMIT and SMACSS

The aim is to write modular CSS and HTML and by using a common naming system, where we can see links between elements, which might not be obvious at first.

### Code

We're using the Timber plugin so we can use the twig templating language within WordPress

## Deployment

- `git checkout develop`
- `git pull`
- `git checkout master`
- `git pull`
- `git merge develop`
- `npm run prod`
- `git add .`
- `git commit -m "Merged develop"`
- `git push`
