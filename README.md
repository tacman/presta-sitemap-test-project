## Install

**Require dependencies**

```bash 
git clone git@github.com:tacman/presta-sitemap-test-project.git presta && cd presta
composer install
```

**Prepare database entities**

The default database is sqlite, so just create it. In production, use postgres and migrations.

```bash
bin/console doctrine:schema:update --force --complete
bin/console doctrine:fixtures:load --no-interaction
bin/console presta:sitemaps:dump
symfony server:start -d
symfony open:local
```

**Dump your sitemap**

The bundle does not require it(??), but you should definitively dump the sitemaps instead of generating it at every request.

```bash
bin/console presta:sitemaps:dump
```

**Run built-in server**

Follow symfony web server [documentation](https://symfony.com/doc/current/setup/symfony_server.html) to start your app.

Now you can visit [http://127.0.0.1/](http://127.0.0.1/).

Urls of sitemaps :

- [sitemap.xml](http://127.0.0.1/sitemap.xml)
- [sitemap.default.xml](http://127.0.0.1/sitemap.default.xml)
- [sitemap.blog.xml](http://127.0.0.1/sitemap.blog.xml)
- [sitemap.misc.xml](http://127.0.0.1/sitemap.misc.xml)
- [sitemap.yml.xml](http://127.0.0.1/sitemap.yml.xml)
