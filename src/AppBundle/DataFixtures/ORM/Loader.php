<?php

namespace Acme\AppBundle\DataFixtures\ORM;

use Acme\AppBundle\Entity\BlogPost;
use Acme\AppBundle\Entity\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

/**
 * @author Yann Eugoné <yeugone@prestaconcept.net>
 */
class Loader implements FixtureInterface
{
    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $this->loadPages($manager);
        $this->loadBlogPosts($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadPages(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 1000; $i++) {
            $page = new Page();
            $page->setTitle(
                $faker->sentence($faker->numberBetween(3, 6))
            );
            $page->setSlug(
                $faker->unique()->slug()
            );

            $manager->persist($page);
        }

        $manager->flush();
        $manager->clear(Page::class);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadBlogPosts(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 1000; $i++) {
            $post = new BlogPost();
            $post->setTitle(
                $faker->sentence($faker->numberBetween(3, 6))
            );
            $post->setSlug(
                $faker->unique()->slug()
            );

            $manager->persist($post);
        }

        $manager->flush();
        $manager->clear(BlogPost::class);
    }
}