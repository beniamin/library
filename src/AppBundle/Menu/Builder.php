<?php

// src/AppBundle/Menu/Builder.php
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Home', array('route' => 'homepage'));

        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();

        $menu->addChild('Books', array('route' => 'book_index'));
        $menu->addChild('Authors', array('route' => 'author_index'));
        $menu->addChild('Genres', array('route' => 'genre_index'));

        return $menu;
    }
}