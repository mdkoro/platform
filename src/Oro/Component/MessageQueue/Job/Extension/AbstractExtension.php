<?php

namespace Oro\Component\MessageQueue\Job\Extension;

use Oro\Component\MessageQueue\Job\Job;

/**
 * Abstract MQ job extension
 */
abstract class AbstractExtension implements ExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function onPreRunUnique(Job $job)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function onPostRunUnique(Job $job, $jobResult)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function onPreCreateDelayed(Job $job)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function onPostCreateDelayed(Job $job, $createResult)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function onPreRunDelayed(Job $job)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function onPostRunDelayed(Job $job, $jobResult)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function onCancel(Job $job)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function onError(Job $job)
    {
    }
}
