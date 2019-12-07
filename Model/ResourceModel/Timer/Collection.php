<?php
declare(strict_types=1);

namespace Zarkiewicz\CountdownTimer\Model\ResourceModel\Timer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Zarkiewicz\CountdownTimer\Model\ResourceModel\Timer as TimerResourceModel;
use Zarkiewicz\CountdownTimer\Model\Timer as TimerModel;

/**
 * Timers collection
 *
 * @api
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(TimerModel::class, TimerResourceModel::class);
    }
}
