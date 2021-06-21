# BDO Store

## Prerequisites

 - Local
 - Node

## Setup

Go to where you store your websites.

In Terminal, run:

    git clone https://github.com/Hamilton-Brown-Digital/bdo-store.git

Follow the below instructions to create your Local setup:

[https://localwp.com/help-docs/getting-started/how-to-import-a-wordpress-site-into-local/](https://localwp.com/help-docs/getting-started/how-to-import-a-wordpress-site-into-local/)
*Note: Copy the `.git` folder and the `.gitignore` and `.gitignoredeploy` files along with the above in the root of your folder, at the same level as `wp-content`.*

Once Local setup is complete, go back to Terminal and run:

    cd app/public/wp-content/themes/bdostore/build

Then run:

    npm install

**You should now be fully setup.**

## Development

In Terminal, go the the sites folder and then run:

    cd app/public/wp-content/themes/bdostore/build

Then run:

    npm run dev

The site will now watch changes to SASS and JS live. Just refresh the page.
