<?php

namespace Morgz\Bundle\QueueBundle\EventListener;

use \Morgz\Bundle\QueueBundle\Entity\BlogPost;
use Doctrine\ORM\Event\LifecycleEventArgs;

class QueueProducer
{
    private $queue;

    private $queueUrl;

    private $serializer;

    public function setQueue($queue)
    {
        $this->queue = $queue;
    }

    public function setQueueUrl($queueUrl)
    {
        $this->queueUrl = $queueUrl;
    }

    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $entityManager = $args->getEntityManager();

        if ($entity instanceof BlogPost) {

            $blogPostJson = $this->serializer->serialize($entity, 'json');

            $this->queue->send_message($this->queueUrl, $blogPostJson);
        }
    }
}
