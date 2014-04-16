<?php

namespace Oxind\FeedbackBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('oxind_feedback');
        
        $supportedDrivers = array('orm');

        $rootNode
            ->children()
                ->scalarNode('db_driver')
                    ->validate()
                        ->ifNotInArray($supportedDrivers)
                        ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
                    ->end()
                    ->cannotBeOverwritten()
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('feedback_per_page')->defaultValue('10')->end()
                ->scalarNode('model_manager_name')->defaultNull()->end()
                ->scalarNode('user_class')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('fixtures')->isRequired()->cannotBeEmpty()->end()
                ->arrayNode('class')->isRequired()
                    ->children()
                        ->arrayNode('model')->isRequired()
                            ->children()
                                ->scalarNode('feedback')->isRequired()->end()
                                ->scalarNode('feedbacktype')->isRequired()->end()
                                ->scalarNode('timeline')->isRequired()->end()
                                ->scalarNode('feedbackdisplay')->isRequired()->end()
                                ->scalarNode('vote')->isRequired()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('form')->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('feedback')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('oxind_feedback_feedback')->end()
                                ->scalarNode('name')->defaultValue('oxind_feedback_feedback')->end()
                            ->end()
                        ->end()           
                    ->end()
                ->end()
                
                ->arrayNode('service')->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('manager')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('feedback')->cannotBeEmpty()->defaultValue('oxind_feedback.manager.feedback.default')->end()
                                ->scalarNode('feedbacktype')->cannotBeEmpty()->defaultValue('oxind_feedback.manager.feedbacktype.default')->end()
                                ->scalarNode('vote')->cannotBeEmpty()->defaultValue('oxind_feedback.manager.vote.default')->end()
                                ->scalarNode('timeline')->cannotBeEmpty()->defaultValue('oxind_feedback.manager.timeline.default')->end()
                                ->scalarNode('feedbackdisplay')->cannotBeEmpty()->defaultValue('oxind_feedback.manager.feedbackdisplay.default')->end()
                            ->end()
                        ->end()
                        ->arrayNode('form_factory')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('feedback')->cannotBeEmpty()->defaultValue('oxind_feedback.form_factory.feedback.default')->end()
                            ->end()
                        ->end()
                        ->scalarNode('markup')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
