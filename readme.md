# Traveling Stanzas Emerge - Web / Amplify

This applicaiton is built/follows standards of [Laravel 5.7](https://laravel.com/docs/5.7) & the Laravel ecosystem.

### Server Requirements

Server requirements can be found [in the documentation](https://laravel.com/docs/5.7#server-requirements). When provisioning a cloud server from scratch, we recommend installing all the software that is included in the official [Laravel Homesatead](https://laravel.com/docs/5.7/homestead) Vagrant Box.

### 3rd Party Services

Below is a list of 3rd party services utilized in the poets.org instance of Emerge along with it's purpose and any out-of-box Laravel supported alternatives. If another unlisted alternative is required, there is almost certianly a package on [Packagist](https://packagist.org) that adds support.

| Service | Purpose                            | Out-of-the-box Alternatives |
| ------- | ---------------------------------- | --------------------------- |
| Twilio  | MMS when Poems are created.        | N/A                         |
| Mailgun | Send various transactional emails. | SMTP, Mandrill, SES         |
| AWS S3  | Cloud Storage                      | Rackspace                   |

### Administraiton

The administration section is built on [Laravel Nova](https://nova.laravel.com) and can be accessed at `/admin`. This route is configurable in `config/nova.php`. Currently, we have things setup so Collections, Source Texts & Poems can be managed. Laravel Nova is super easily extensible / configurable for any outstanding use cases.

### Getting it Running

Getting this application running on a server follows a similar process to what you'd see in the RoR world _I think_. After provisioning the server & pulling in the repository to a [propertly configured Nginx directory](https://laravel.com/docs/5.7/deployment#server-configuration), follow these steps to get things running:

1. Copy `.env.example` to `.env` and add enviroment variables. We added some comments in the example file to help out.
2. Install composer dependencies with `composer install`.
3. Install NPM dependencies with `yarn install` or `npm install`.
4. Build front-end assets with `yarn production` or `npm run production`.
5. Migrate the database with `php artisan migrate`.
6. Optionally, seed the database with `php artisan db:seed`.

### A High Level Overview How Emerge Works

Here's a quick high-level overview of how things work / how things are managed in the admin panel: [Watch Video](https://www.dropbox.com/s/ceeakvv8uostm9b/Screen%20Recording%202019-05-10%20at%203.08.31%20PM.mov?dl=0). There's not a lot of detail in the video but hopefully will provide some help

### Points of Discussion / Things to Figure Out

-   How should we lock this down for folks only coming from Amplify? We could leverage a simple signed url system for this.
-   How do we want to handle collections / do we want to utilize subdomains?

### Access the Sandbox

We spun up a seperate instance of Emerge for Web here: https://e2amp.travelingstanzas.com/.

You can access "random" collections by visting https://e2amp.travelingstanzas.com/random, which will redirect to one of the collections in the database.

You can also access the admin portion of the website by visiting https://e2amp.travelingstanzas.com/admin and logging in with these credentials.

u: amplify@travelingstanzas.com

p: ThV5PXFk
