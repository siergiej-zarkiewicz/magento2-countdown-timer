<?php
/**
 * Zarkiewicz\CountdownTimer
 *
 * @package Zarkiewicz\CountdownTimer
 * @author Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @copyright Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @license Open Software License (OSL 3.0)
 */
namespace Zarkiewicz\CountdownTimer\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface CountdownTimerInterface
 *
 * @api
 */
interface TimerInterface extends ExtensibleDataInterface
{
    /**
     * Entity Id
     */
    const ENTITY_ID = 'entity_id';

    /**
     * Store Id
     */
    const STORE_ID = 'store_id';

    /**
     * Product Id
     */
    const PRODUCT_ID = 'product_id';

    /**
     * Timer from date
     */
    const FROM_DATE = 'from_date';

    /**
     * Timer to date
     */
    const TO_DATE = 'to_date';

    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId);

    /**
     * Set Store Id for further updates
     *
     * @param int $storeId
     * @return self
     */
    public function setStoreId($storeId);

    /**
     * Retrieve store id
     *
     * @return int
     */
    public function getStoreId();

    /**
     * Set Product Id for further updates
     *
     * @param int $productId
     * @return self
     */
    public function setProductId($productId);

    /**
     * Retrieve product id
     *
     * @return int
     */
    public function getProductId();

    /**
     * Get from date
     *
     * @return string
     */
    public function getFromDate();

    /**
     * Set from date
     *
     * @param string $fromDate
     * @return bool
     */
    public function setFromDate($fromDate);

    /**
     * Get to date
     *
     * @return string
     */
    public function getToDate();

    /**
     * Set to date
     *
     * @param string $toDate
     * @return bool
     */
    public function setToDate($toDate);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Zarkiewicz\CountdownTimer\Api\Data\TimerExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Zarkiewicz\CountdownTimer\Api\Data\TimerExtensionInterface|null $extensionAttributes
     *
     * @return $this
     */
    public function setExtensionAttributes(
        \Zarkiewicz\CountdownTimer\Api\Data\TimerExtensionInterface $extensionAttributes
    );
}
