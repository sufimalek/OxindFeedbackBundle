<?php

namespace Oxind\FeedbackBundle\Tests\WebTestCase;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
//use Symfony\Component\DomCrawler\Form;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\BrowserKit\Cookie;

/**
 * Description of OxindWebTestCase
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
abstract class OxindWebTestCase extends WebTestCase
{

    /**
     * @var ObjectManager
     */
    protected $obEm;

    /**
     * @var AccessToken
     */
    protected $accessToken;

    /**
     *
     * @var \Symfony\Component\HttpKernel\Kernel 
     */
    protected $obKernel;

    /**
     *
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    protected $obClient;

    /**
     *
     * @var \Symfony\Component\DependencyInjection\Container
     */
    protected $obContainer;

    /**
     *
     * @var \Symfony\Component\DependencyInjection\Container 
     */
    protected $obClientContainer;

    /**
     *
     * @var \Symfony\Component\Security\Core\SecurityContext 
     */
    protected $obSecurityContext;

    /**
     *
     * @var \FOS\UserBundle\Doctrine\UserManager  
     */
    protected $obUserManager;

    /**
     *
     * @var \FOS\UserBundle\Security\LoginManager  
     */
    protected $obLoginManager;

    /**
     *
     * @var \Symfony\Component\Security\Http\Firewall 
     */
    protected $ssFirewallName;

    /**
     *
     * @var Session 
     */
    protected $obSession;

    /**
     *
     * @var 
     */
    protected $obUser;

    /**
     * Test setup
     */
    protected function setUp()
    {
        $this->obKernel = static::createKernel();
        $this->obClient = static::createClient(array('environment' => 'test'));
        $this->obClientContainer = $this->obClient->getContainer();
        $this->obKernel->boot();
        $this->obContainer = $this->obKernel->getContainer();
        $this->obEm = $this->obContainer->get('doctrine.orm.entity_manager');
        $this->accessToken = null;
        $this->obSecurityContext = $this->obContainer->get('security.context');
        $this->obUserManager = $this->obClientContainer->get('fos_user.user_manager');
        $this->obLoginManager = $this->obClientContainer->get('fos_user.security.login_manager');
        $this->obSession = $this->obClientContainer->get('session');
        $this->ssFirewallName = $this->obClientContainer->getParameter('fos_user.firewall_name');
        parent::setUp();
    }

    /**
     * Function to get Repository object
     * @param string $ssRepositoryName
     * @return object|boolean
     */
    public function getRepository($ssRepositoryName)
    {
        return (!empty($ssRepositoryName) ? $this->obEm->getRepository($ssRepositoryName) : false);
    }

    /**
     * Helpes to save crawler html as a file.
     * @param string $fileFullPath
     * @param string $html
     */
    public function writeHtml($fileFullPath, $html)
    {
        $handle = fopen($fileFullPath, 'w+');
        fwrite($handle, $html);
        fclose($handle);
    }

    /**
     * Function to get user data
     * @param array $asParams
     * @return boolean
     */
    public function getUserData($asParams)
    {
        if (!empty($asParams))
            return $this->obUser = $this->obUserManager->findUserBy($asParams);
        else
            return false;
    }

    /**
     * Function to check Login functionality
     * @return \Symfony\Component\Security\Core\SecurityContext
     */
    public function checkLogin()
    {

        if (!empty($this->obUser))
        {

            $this->obLoginManager->loginUser($this->ssFirewallName, $this->obUser);

            // save the login token into the session and put it in a cookie
            $this->obSession->set('_security_' . $this->ssFirewallName, serialize($this->obClientContainer->get('security.context')->getToken()));
            $this->obSession->save();
            $this->obClient->getCookieJar()->set(new Cookie($this->obSession->getName(), $this->obSession->getId()));

            return $this->obClientContainer->get('security.context');
        }
        return NULL;
    }

    public function getAccountData($snIdAccount)
    {
        if (!empty($snIdAccount) && is_integer($snIdAccount))
        {
            return $obAccount = $this->getRepository('OxindCoreBundle:Account')->findById($snIdAccount);
        }
        return false;
    }

    public function getManager($ssServiceName)
    {
        if ($ssServiceName != '')
        {
            return $this->obContainer->get($ssServiceName);
        }
        return false;
    }

}