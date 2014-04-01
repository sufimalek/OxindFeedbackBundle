<?php

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oxind\FeedbackBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Oxind\FeedbackBundle\DependencyInjection\OxindFeedbackExtension;
use Symfony\Component\Yaml\Parser;


/**
 * Description of OxindFeedbackExtensionTest
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
class OxindFeedbackExtensionTest extends \PHPUnit_Framework_TestCase
{

    protected $configuration;

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testFeedbackLoadThrowsExceptionUnlessDatabaseDriverSet()
    {
        $loader = new OxindFeedbackExtension();

        $config = $this->getEmptyConfig();
        unset($config['db_driver']);
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testFeedbackLoadThrowsExceptionUnlessDatabaseDriverIsValid()
    {
        $loader = new OxindFeedbackExtension();
        $config = $this->getEmptyConfig();
        $config['db_driver'] = 'foo';
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testFeedbackLoadThrowsExceptionUnlessUserModelClassSet()
    {
        $loader = new OxindFeedbackExtension();
        $config = $this->getFullConfig();
        unset($config['user_class']);
        $loader->load(array($config), new ContainerBuilder());
    }

    public function testDriver()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new OxindFeedbackExtension();
        $config = $this->getEmptyConfig();
        $config['db_driver'] = 'orm';
        $config['user_class'] = 'Oxind\UserBundle\Entity\User';
        $config['class']['model']['feedback'] = 'Oxind\DashboardBundle\Entity\Feedback';
        $config['class']['model']['feedbacktype'] = 'Oxind\DashboardBundle\Entity\FeedbackType';

        $loader->load(array($config), $this->configuration);
        $this->assertEquals('oxind_feedback', $loader->getAlias());
        
    }

    /**
     * getEmptyConfig
     *
     * @return array
     */
    protected function getEmptyConfig()
    {
        $yaml = <<<EOF
db_driver: orm
user_class: Oxind\UserBundle\Entity\User
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

    /**
     * Get Full config
     * @return type
     */
    protected function getFullConfig()
    {
        $yaml = <<<EOF
db_driver: orm
oxind_feedback:
    db_driver: orm
    user_class: Oxind\UserBundle\Entity\User
    class:
        model:
            feedback: Oxind\DashboardBundle\Entity\Feedback
            feedbacktype: Oxind\DashboardBundle\Entity\FeedbackType
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

}
