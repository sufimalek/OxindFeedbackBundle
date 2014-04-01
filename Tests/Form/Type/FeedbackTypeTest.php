<?php

namespace Oxind\FeedbackBundle\Tests\Form\Type;

use Symfony\Component\Form\Test\TypeTestCase;
use Oxind\FeedbackBundle\Form\Type\FeedbackType;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//use Oxind\FeedbackBundle\Tests\WebTestCase\OxindWebTestCase;

/**
 * Description of FeedbackTypeTest
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
class FeedbackTypeTest extends TypeTestCase
{

    public function testSubmitValidData()
    {
        $asFormData = $this->getValidData();
        $obType = new FeedbackType('Oxind\FeedbackBundle\Entity\Feedback');

        $obForm = $this->factory->create($obType);
        $obForm->submit($asFormData);

        $this->assertTrue($obForm->isSynchronized());
        $obView = $obForm->createView();
        $children = $obView->children;

        foreach (array_keys($asFormData) as $key)
        {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function getValidData()
    {
        $asData = array('title' => 'feedback 1',
            'content' => 'Hello this is form test feedback.');
        return $asData;
    }

}
