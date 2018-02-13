<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

/**
 * @author Yann Eugoné <yeugone@prestaconcept.net>
 */
class Loader extends Fixture
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

        $images = [];
        for ($i = 1; $i <= 10; $i++) {
            $images[] = sprintf('http://lorempixel.com/400/200/technics/%s/', $i);
        }

        $videos = [
            'https://www.youtube.com/watch?v=j6IKRxH8PTg',
            'https://www.youtube.com/watch?v=JugaMuswrmk',
            'https://www.youtube.com/watch?v=ozMI_m8lQGw',
        ];

        for ($i = 1; $i <= 1000; $i++) {
            $post = new BlogPost();
            $post->setTitle(
                $faker->sentence($faker->numberBetween(3, 6))
            );
            $post->setSlug(
                $faker->unique()->slug()
            );
            $post->setImages(
                $faker->randomElements($images, $faker->numberBetween(0, 4))
            );
            if ($faker->boolean(30)) {
                $post->setVideo(
                    $faker->randomElement($videos)
                );
            }

            $manager->persist($post);
        }

        $manager->flush();
        $manager->clear(BlogPost::class);
    }
}
