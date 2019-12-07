<?php

namespace Zarkiewicz\CountdownTimer\Model\Product\Timer;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Zarkiewicz\CountdownTimer\Api\Data\TimerInterface;
use Zarkiewicz\CountdownTimer\Api\TimerRepositoryInterface;

/**
 * Class UpdateHandler
 *
 * @package Zarkiewicz\CountdownTimer\Model\Product\Timer
 */
class UpdateHandler implements ExtensionInterface
{
    /**
     * @var TimerRepositoryInterface
     */
    private $timerRepository;

    /**
     * UpdateHandler constructor.
     *
     * @param TimerRepositoryInterface $timerRepository
     */
    public function __construct(
        TimerRepositoryInterface $timerRepository
    ) {
        $this->timerRepository = $timerRepository;
    }

    /**
     * Update product timers
     *
     * @param ProductInterface $product
     * @param array $arguments
     *
     * @return ProductInterface
     * @throws \Exception
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute($product, $arguments = [])
    {
        $extensionAttributes = $product->getExtensionAttributes();
        /** @var TimerInterface[] $newTimers */
        $newTimers = $extensionAttributes->getProductTimers() ?: [];
        /** @var \Zarkiewicz\CountdownTimer\Model\ResourceModel\Timer\Collection $oldTimers */
        $oldTimers = $this->timerRepository->getTimersByProduct($product)->load();
        $updatedTimers = [];

        /** @var TimerInterface $timer */
        foreach ($newTimers as $timer) {
            if ($timer->getEntityId()) {
                $updatedTimers[$timer->getEntityId()] = true;
            }
            $timer->setProductId($product->getId());
            $this->timerRepository->save($timer);
        }

        foreach ($oldTimers as $timer) {
            if (!isset($updatedTimers[$timer->getEntityId()])) {
                $this->timerRepository->delete($timer);
            }
        }

        return $product;
    }
}
