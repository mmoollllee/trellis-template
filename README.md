## Installation

1. Create empty repository on GitHub and clone it to your local machine.
2. Add [Trellis](https://github.com/roots/trellis) as subtree
    ```sh
    $ git remote add -f trellis https://github.com/roots/trellis.git
    $ git subtree add --prefix trellis trellis master --squash
    // OR
    $ git read-tree --prefix=trellis/ -u trellis/master
    $ git commit -m "add trellis subtree"
    ```
2. Add [this repo](https://github.com/mmoollllee/trellis-template) as sub-tree:
    ```sh
    $ git remote add -f trellis-template git@github.com:mmoollllee/trellis-template.git
    $ git subtree add --prefix site trellis-template master --squash
    // OR
    $ git read-tree --prefix=site/ -u trellis-template/master
    $ git commit -m "add trellis-template subtree"
    ```
3. Add `.env`. Actually get's overwritten when running trellis, but we need it for ACF_PRO_KEY to run Composer Install. See `composer.json` for packages and install them.
    ```sh
    $ cd site && cp .env.example .env && code .env
    $ composer install
    ```
4. Configure Local Domain in `trellis/group_vars/development/wordpress_sites.yml` and add following
    ```
    site_title: Example
    admin_user: example
    ```
5. Configure Local Domain in `trellis/group_vars/development/vault.yml`
6. Vagrant Up:
    ```sh
    $ cd ../trellis && vagrant up
    ```
    If Local `ERR_EMPTY_RESPONSE` do (see [Trellis Troubleshooting](https://roots.io/trellis/docs/troubleshooting/))
    ```sh
    $ SKIP_GALAXY=true ANSIBLE_TAGS=wordpress vagrant reload --provision
    $ vagrant hostmanager
    ```
7. Deploy with [Bedrock Deployer](https://github.com/mmoollllee/bedrock-deployer):
    1. Create GitHub Repo
    2. Setup Plesk Environment (bin/bash, add SSH-Key)
    3. Allow fingerprint by connectin to Environment via SSH.
    3. Create SSH key on Webserver and add pub key to GitHub Repo Deploy Keys
    4. Setup deploy.php
    5. Change Wordpress Admin PW
    6. Run
    ```sh
    $ dep deploy <environemt>
    ```
    7. Make changes on stage and ...
    ```sh
    $ dep pull <environemt>
    ```

### PHP Settings

PHP Settings can be changed in `trellis/group_vars/development/php.yml`. See [this blog-post by Jasper Frumau](https://imwz.io/custom-php-settings-in-trellis/).

```yml
php_memory_limit: 256M
php_post_max_size: 256M
php_upload_max_filesize: 256M
```

### Updates

To update Wordpress:

```sh
$ composer require johnpbloch/wordpress 5.2.x
cd ../trellis && vagrant ssh
$ wp core update-db
```

Update Plugins:

```sh
$ composer update
```
    
Update Trellis:

```sh
$ git fetch trellis master
$ git merge -X subtree=trellis/ --squash trellis/master
$ git commit -m "Update trellis from trellis/master"
```
    
To update this repo from current [Bedrock](https://github.com/roots/bedrock):

```sh
$ git remote add -f bedrock https://github.com/roots/bedrock.git
$ git merge --no-commit --allow-unrelated-histories bedrock/master
```

To update your repo from this repo
```sh
$ git fetch trellis-template
$ git merge -X subtree=site/ --squash --no-commit --allow-unrelated-histories trellis-template/master
```

## Documentation

Bedrock documentation is available at [https://roots.io/bedrock/docs/](https://roots.io/bedrock/docs/).

Good Guide is available at [https://css-tricks.com/intro-bedrock-wordpress/](https://css-tricks.com/intro-bedrock-wordpress/).

Git Subtree Trellis Workflow by [chrisknightindustries.com/2015/24/11/git-subtrees-for-trellis-workflow.html](http://chrisknightindustries.com/2015/24/11/git-subtrees-for-trellis-workflow.html).

## Contributing

Contributions are welcome from everyone. We have [contributing guidelines](https://github.com/roots/guidelines/blob/master/CONTRIBUTING.md) to help you get started.

## Bedrock sponsors

Help support our open-source development efforts by [becoming a patron](https://www.patreon.com/rootsdev).

<a href="https://kinsta.com/?kaid=OFDHAJIXUDIV"><img src="https://cdn.roots.io/app/uploads/kinsta.svg" alt="Kinsta" width="200" height="150"></a> <a href="https://carrot.com/"><img src="https://cdn.roots.io/app/uploads/carrot.svg" alt="Carrot" width="200" height="150"></a> <a href="https://www.c21redwood.com/"><img src="https://cdn.roots.io/app/uploads/c21redwood.svg" alt="C21 Redwood Realty" width="200" height="150"></a> <a href="https://wordpress.com/"><img src="https://cdn.roots.io/app/uploads/wordpress.svg" alt="WordPress.com" width="200" height="150"></a>

## Community

Keep track of development and community news.

- Participate on the [Roots Discourse](https://discourse.roots.io/)
- Follow [@rootswp on Twitter](https://twitter.com/rootswp)
- Read and subscribe to the [Roots Blog](https://roots.io/blog/)
- Subscribe to the [Roots Newsletter](https://roots.io/subscribe/)
- Listen to the [Roots Radio podcast](https://roots.io/podcast/)
