<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ContentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sulu_content');

        // add config preview interval
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('search')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('mapping')
                            ->useAttributeAsKey('structure_type')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('index')->info('Name of index to use')->isRequired()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('types')
                    ->addDefaultsIfNotSet()
                    ->children()
                    ->arrayNode('smart_content')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('template')
                                ->defaultValue('SuluContentBundle:Template:content-types/smart_content.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('internal_links')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('template')
                                ->defaultValue('SuluContentBundle:Template:content-types/internal_links.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('single_internal_link')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('template')
                                ->defaultValue('SuluContentBundle:Template:content-types/single_internal_link.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('phone')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('template')
                                    ->defaultValue('SuluContentBundle:Template:content-types/phone.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('password')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('template')
                                    ->defaultValue('SuluContentBundle:Template:content-types/password.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('url')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('template')
                                    ->defaultValue('SuluContentBundle:Template:content-types/url.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('email')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('template')
                                    ->defaultValue('SuluContentBundle:Template:content-types/email.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('date')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('template')
                                    ->defaultValue('SuluContentBundle:Template:content-types/date.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('time')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('template')
                                    ->defaultValue('SuluContentBundle:Template:content-types/time.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('color')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('template')
                                    ->defaultValue('SuluContentBundle:Template:content-types/color.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('checkbox')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('template')
                                ->defaultValue('SuluContentBundle:Template:content-types/checkbox.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('multiple_select')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('template')
                                ->defaultValue('SuluContentBundle:Template:content-types/multiple_select.html.twig')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('single_select')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('template')
                            ->defaultValue('SuluContentBundle:Template:content-types/single_select.html.twig')
                        ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
