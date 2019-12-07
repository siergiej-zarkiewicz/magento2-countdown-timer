<?php

namespace Zarkiewicz\CountdownTimer\Model;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Zarkiewicz\CountdownTimer\Api\Data\TimerInterface;
use Zarkiewicz\CountdownTimer\Api\Data\TimerInterfaceFactory;
use Zarkiewicz\CountdownTimer\Api\TimerRepositoryInterface;
use Zarkiewicz\CountdownTimer\Model\ResourceModel\Timer as TimerResource;
use Zarkiewicz\CountdownTimer\Model\ResourceModel\Timer\CollectionFactory;

/**
 * Class TimerRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class TimerRepository implements TimerRepositoryInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var TimerInterfaceFactory
     */
    protected $timerFactory;

    /**
     * @var TimerResource
     */
    private $timerResource;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param CollectionProcessorInterface $collectionProcessor
     * @param CollectionFactory $collectionFactory
     * @param ProductRepositoryInterface $productRepository
     * @param TimerInterfaceFactory $timerFactory
     * @param ResourceModel\Timer $timerResource
     */
    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory,
        ProductRepositoryInterface $productRepository,
        TimerInterfaceFactory $timerFactory,
        TimerResource $timerResource
    ) {
        $this->productRepository = $productRepository;
        $this->timerFactory = $timerFactory;
        $this->timerResource = $timerResource;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @inheritdoc
     */
    public function getTimersByProduct(ProductInterface $product)
    {
        $collection = $this->collectionFactory->create();
        $collection->addFilter(TimerInterface::PRODUCT_ID, $product->getId());

        return $collection;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $collection->setSearchCriteria($searchCriteria);

        return $collection;
    }

    /**
     * @inheritdoc
     */
    public function get($timerId)
    {
        /** @var Timer $timer */
        $timer = $this->timerFactory->create();
        $this->timerResource->load($timer, $timerId);

        if (!$timer->getId()) {
            throw new NoSuchEntityException(__('The timer with the "%1" ID doesn\'t exist.', $timer));
        }

        return $timer;
    }

    /**
     * @inheritdoc
     */
    public function save(TimerInterface $timer)
    {
        try {
            $this->timerResource->save($timer);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __(
                    'Could not save timer: %1',
                    $e->getMessage()
                ),
                $e
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function delete(TimerInterface $timer)
    {
        try {
            $this->timerResource->delete($timer);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(
                __(
                    'Could not delete the timer with id %1',
                    $timer->getId()
                ),
                $e
            );
        }

        return true;
    }
}
