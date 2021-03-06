<?php

namespace Oxind\FeedbackBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OxindFeedbackExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        // load db driver xml file
        $loader->load(sprintf('%s.xml', $config['db_driver']));        
        
        // for now only one service file "services.xml"
        foreach (array('services','form','events') as $basename) {
            $loader->load(sprintf('%s.xml', $basename));
        }
        
        $container->setParameter('oxind_feedback.model_manager_name', $config['model_manager_name']);
        $container->setAlias('oxind_feedback.manager.feedback', $config['service']['manager']['feedback']);
        $container->setAlias('oxind_feedback.manager.feedbacktype', $config['service']['manager']['feedbacktype']);
        $container->setAlias('oxind_feedback.manager.vote', $config['service']['manager']['vote']);
        $container->setAlias('oxind_feedback.manager.timeline', $config['service']['manager']['timeline']);
        $container->setAlias('oxind_feedback.manager.feedbackdisplay', $config['service']['manager']['feedbackdisplay']);
        $container->setAlias('oxind_feedback.form_factory.feedback', $config['service']['form_factory']['feedback']);
        
        $container->setParameter('oxind_feedback.model.feedback.class', $config['class']['model']['feedback']);
        $container->setParameter('oxind_feedback.model.feedbacktype.class', $config['class']['model']['feedbacktype']);
        $container->setParameter('oxind_feedback.model.vote.class', $config['class']['model']['vote']);
        $container->setParameter('oxind_feedback.model.timeline.class', $config['class']['model']['timeline']);
        $container->setParameter('oxind_feedback.model.feedbackdisplay.class', $config['class']['model']['feedbackdisplay']);
        
        $container->setParameter('oxind_feedback.form.feedback.type', $config['form']['feedback']['type']);
        $container->setParameter('oxind_feedback.form.feedback.name', $config['form']['feedback']['name']);
        
        $container->setParameter('oxind_feedback.fixtures', $config['fixtures']);
        $container->setParameter('oxind_feedback.feedback_per_page', $config['feedback_per_page']);

    }
}