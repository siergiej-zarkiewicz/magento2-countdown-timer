<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Zarkiewicz\CountdownTimer\Model\ResourceModel\Timers;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\EntityManager\MetadataPool;
use Zarkiewicz\CountdownTimer\Api\Data\TimerInterface;

/**
 * Class Loader
 *
 * @package Zarkiewicz\CountdownTimer\Model\ResourceModel\Timers
 */
class Loader
{
    /**
     * @var  MetadataPool
     */
    private $metadataPool;

    /**
     * @var  ResourceConnection
     */
    private $resourceConnection;

    /**
     * Loader constructor.
     *
     * @param MetadataPool $metadataPool
     * @param ResourceConnection $resourceConnection
     */
    public function __construct
    (
        MetadataPool $metadataPool,
        ResourceConnection $resourceConnection
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @param ProductInterface $product
     *
     * @return array
     * @throws \Exception
     */
    public function getIdsByProductId($product)
    {
        $metadata = $this->metadataPool->getMetadata(TimerInterface::class);
        $connection = $this->resourceConnection->getConnection();

        $select = $connection
            ->select()
            ->from($metadata->getEntityTable(), TimerInterface::ENTITY_ID)
            ->where(TimerInterface::PRODUCT_ID . ' = ?', $product->getId());
        $ids = $connection->fetchCol($select);

        return $ids ?: [];
    }
}