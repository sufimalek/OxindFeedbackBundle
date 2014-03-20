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
        foreach (array('services', 'form') as $basename) {
            $loader->load(sprintf('%s.xml', $basename));
        }
        
        $container->setParameter('oxind_feedback.form.issue.type', $config['form']['issue']['type']);
        $container->setParameter('oxind_feedback.form.issue.name', $config['form']['issue']['name']);

    }
}