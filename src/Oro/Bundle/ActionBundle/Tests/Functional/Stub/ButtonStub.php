<?php

namespace Oro\Bundle\ActionBundle\Tests\Functional\Stub;

use Oro\Bundle\ActionBundle\Button\ButtonContext;
use Oro\Bundle\ActionBundle\Button\ButtonInterface;

class ButtonStub implements ButtonInterface
{
    const TITLE = 'Stub button title';
    const LABEL = 'Stub button label';

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return __DIR__ . '/button.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplateData(array $customData = [])
    {
        return [
            'title' => self::TITLE,
            'label' => self::LABEL
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getButtonContext()
    {
        return new ButtonContext();
    }

    /**
     * {@inheritdoc}
     */
    public function getGroup()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'test_name';
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'test label';
    }

    /**
     * {@inheritdoc}
     */
    public function getIcon()
    {
        return 'test_icon';
    }

    /**
     * {@inheritdoc}
     */
    public function getTranslationDomain()
    {
        return 'test_domain';
    }
}
