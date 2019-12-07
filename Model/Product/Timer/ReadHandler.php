<?php

namespace Zarkiewicz\CountdownTimer\Model\Product\Timer;

use Magento\Catalog\Api\Data\ProductInterface;
use Zarkiewicz\CountdownTimer\Api\Data\TimerInterface;
use Zarkiewicz\CountdownTimer\Api\TimerRepositoryInterface;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;

/**
 * Class ReadHandler
 */
class ReadHandler implements ExtensionInterface
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
     * @param object $entity
     * @param array $arguments
     *
     * @return ProductInterface|object
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute($entity, $arguments = [])
    {
        /** @var $entity ProductInterface */
        /** @var TimerInterface[] $timers */
        $entityExtension = $entity->getExtensionAttributes();
        $collection = $this->timerRepository->getTimersByProduct($entity);

        $timers = [];
        foreach ($collection as $item) {
            $timers[] = $item;
        }

        $entityExtension->setProductTimers($timers);
        $entity->setExtensionAttributes($entityExtension);

        return $entity;
    }
}
