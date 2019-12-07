<?php
/**
 * Zarkiewicz\CountdownTimer
 *
 * @package Zarkiewicz\CountdownTimer
 * @author Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @copyright Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @license Open Software License (OSL 3.0)
 */
namespace Zarkiewicz\CountdownTimer\Model\Timers;

use Magento\Framework\EntityManager\EntityManager;
use Zarkiewicz\CountdownTimer\Model\ResourceModel\Timers\Loader;
use Zarkiewicz\CountdownTimer\Model\TimerFactory;
use Zarkiewicz\CountdownTimer\Api\TimersProviderInterface;

/**
 * Class Provider
 * @package Zarkiewicz\CountdownTimer\Model\Timers
 */
class Provider implements TimersProviderInterface
{
    /**
     * @var  EntityManager
     */
    private $entityManager;

    /**
     * @var  Loader
     */
    private $loader;

    /**
     * @var  TimerFactory
     */
    private $timerFactory;

    /**
     * Provider constructor.
     *
     * @param EntityManager $entityManager
     * @param Loader $loader
     * @param TimerFactory $timerFactory
     */
    public function __construct
    (
        EntityManager $entityManager,
        Loader $loader,
        TimerFactory $timerFactory
    ) {
        $this->entityManager = $entityManager;
        $this->loader = $loader;
        $this->timerFactory = $timerFactory;
    }

    /**
     * @inheritdoc
     */
    public function getTimers($product)
    {
        $timers = [];
        $ids = $this->loader->getIdsByProductId($product);

        foreach ($ids as $id) {
            $timer = $this->timerFactory->create();
            $timers[] = $this->entityManager->load($timer, $id);
        }

        return $timers;
    }
}
