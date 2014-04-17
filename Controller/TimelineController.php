<?php
namespace Oxind\FeedbackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of TimelineController
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 * @Route("/feedback_timeline")
 * @Method( { "GET" } )
 */
class TimelineController extends Controller
{
    /**
     * @Route("/", name="oxind_feedback_timeline")
     */
    public function indexAction($divId)
    {
        $timelineManager = $this->get('oxind_feedback.manager.timeline');
        $timeline = $timelineManager->findTimelineByTitle('main');
        $feedbacksDisplayManager = $this->get('oxind_feedback.manager.feedbackdisplay');
        $feedbackDisplays = $feedbacksDisplayManager->findFeedbackDisplayByTimelineSorted($timeline);
        return $this->render('OxindFeedbackBundle:Timeline:timeline.js.twig',
                array('feedbackDisplays' => $feedbackDisplays,'div_id'=>$divId));
    }
}
