<?php
/**
 * Zarkiewicz\CountdownTimer
 *
 * @package Zarkiewicz\CountdownTimer
 * @author Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @copyright Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @license Open Software License (OSL 3.0)
 */

namespace Zarkiewicz\CountdownTimer\Ui\DataProvider\Product;

use Magento\Framework\Data\Collection;
use Magento\Ui\DataProvider\AddFieldToCollectionInterface;
use Zarkiewicz\CountdownTimer\Model\ResourceModel\Timer;
use Zarkiewicz\CountdownTimer\Api\Data\TimerInterface;

/**
 * Class AddTimerFieldToCollection
 *
 * @api
 */
class AddTimerFieldToCollection implements AddFieldToCollectionInterface
{
    /**
     * {@inheritdoc}
     */
    public function addField(Collection $collection, $field, $alias = null)
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $collection */
        $collection->joinField(
            TimerInterface::FROM_DATE,
            Timer::TABLE_NAME_TIMER,
            TimerInterface::FROM_DATE,
            TimerInterface::PRODUCT_ID . '=' . 'entity_id',
            null,
            'left'
        );
    }
}
