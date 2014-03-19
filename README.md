OxindFeedbackBundle
===================

Symfony2 feedback bundle 

Installation steps:
-------------------------------------------------------------------------------
Add OxindFeedbackBundle in your composer.json file as below :

"require": {
    ...
    "oxind/feedback":"dev-master"
}

-------------------------------------------------------------------------------
Add following repository Url in composer.json file as below:

"repositories" : [{
        "type" :  "vcs",
        "url" : "https://github.com/Oxind/OxindFeedbackBundle.git" }],
-------------------------------------------------------------------------------
Update/install with this command:


php composer.phar update oxind/feedback


-------------------------------------------------------------------------------
Enable the bundle : 


public function registerBundles()
{
    $bundles = array(
        ...
        new Oxind\FeedbackBundle\OxindFeedbackBundle(),
);

-------------------------------------------------------------------------------



