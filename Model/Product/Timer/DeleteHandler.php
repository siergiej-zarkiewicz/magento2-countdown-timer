<?php

namespace Zarkiewicz\CountdownTimer\Model\Product\Timer;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Zarkiewicz\CountdownTimer\Api\Data\TimerInterface;
use Zarkiewicz\CountdownTimer\Api\TimerRepositoryInterface;

/**
 * Class DeleteHandler
 */
class DeleteHandler implements ExtensionInterface
{
    /**
     * @var TimerRepositoryInterface
     */
    private $timerRepository;

    /**
     * @param TimerRepositoryInterface $timerRepository
     */
    public function __construct(
        TimerRepositoryInterface $timerRepository
    ) {
        $this->timerRepository = $timerRepository;
    }

    /**
     * @inheritdoc
     */
    public function execute($entity, $arguments = [])
    {
        /** @var ProductInterface $entity */
        /** @var TimerInterface[] $timers */
        $timers = $entity->getExtensionAttributes()->getProductTimers() ?: [];

        foreach ($timers as $timer) {
            $this->timerRepository->delete($timer);
        }

        return $entity;
    }
}
