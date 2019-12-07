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
use Magento\Ui\DataProvider\AddFilterToCollectionInterface;

/**
 * @api
 */
class AddTimerFilterToCollection implements AddFilterToCollectionInterface
{
    /**
     * {@inheritdoc}
     */
    public function addFilter(Collection $collection, $field, $condition = null)
    {
        if (isset($condition['eq']) && $condition['eq']) {
            /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $collection  */
            $collection->addFieldToFilter($field, $condition);
        }
    }
}
