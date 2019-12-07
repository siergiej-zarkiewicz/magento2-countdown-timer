<?php

namespace Zarkiewicz\CountdownTimer\Api;

/**
 * Interface TimerRepositoryInterface
 *
 * @package Zarkiewicz\CountdownTimer\Api
 * @api
 */
interface TimerRepositoryInterface
{
    /**
     * Update timer of the given product
     *
     * @param \Zarkiewicz\CountdownTimer\Api\Data\TimerInterface $timer
     *
     * @return \Zarkiewicz\CountdownTimer\Api\Data\TimerInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Zarkiewicz\CountdownTimer\Api\Data\TimerInterface $timer);

    /**
     * Update timer of the given product
     *
     * @param int $entityId
     *
     * @return \Zarkiewicz\CountdownTimer\Api\Data\TimerInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($entityId);

    /**
     * List of timers with associated samples
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Zarkiewicz\CountdownTimer\Api\Data\TimerSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete timer
     *
     * @param \Zarkiewicz\CountdownTimer\Api\Data\TimerInterface $timer
     *
     * @return bool Will returned True if deleted
     */
    public function delete(\Zarkiewicz\CountdownTimer\Api\Data\TimerInterface $timer);

    /**
     * List of timers with associated samples
     *
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     *
     * @return \Zarkiewicz\CountdownTimer\Model\ResourceModel\Timer\Collection
     */
    public function getTimersByProduct(\Magento\Catalog\Api\Data\ProductInterface $product);


}
