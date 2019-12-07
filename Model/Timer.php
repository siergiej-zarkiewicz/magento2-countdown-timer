<?php
/**
 * Zarkiewicz\CountdownTimer
 *
 * @package Zarkiewicz\CountdownTimer
 * @author Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @copyright Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @license Open Software License (OSL 3.0)
 */
namespace Zarkiewicz\CountdownTimer\Model;

use Magento\Downloadable\Model\ComponentInterface;
use Magento\Framework\Model\AbstractExtensibleModel as AbstractExtensibleModel;
use Zarkiewicz\CountdownTimer\Api\Data\TimerInterface;
use Zarkiewicz\CountdownTimer\Model\ResourceModel\Timer as TimerResourceModel;

/**
 * Class ExternalLink
 * @package Zarkiewicz\CountdownTimer\Model
 */
class Timer extends AbstractExtensibleModel implements TimerInterface
{
    /**
     * @var  int
     */
    protected $storeId;

    /**
     * @var  int
     */
    protected $productId;

    /**
     * @var string
     */
    protected $fromDate;

    /**
     * @var string
     */
    protected $toDate;

    /**
     * @var  array
     */
    protected $extensionAttributes;

    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init(TimerResourceModel::class);
    }

    /**
     * @inheritdoc
     */
    public function setStoreId($storeId)
    {
        return $this->setData(TimerInterface::STORE_ID, $storeId);
    }

    /**
     * Returns store_id
     *
     * @return int|null
     */
    public function getStoreId()
    {
        return $this->getData(TimerInterface::STORE_ID);
    }

    /**
     * @inheritdoc
     */
    public function getProductId()
    {
        return $this->getData(TimerInterface::PRODUCT_ID);
    }

    /**
     * @inheritdoc
     */
    public function setProductId($productId)
    {
        return $this->setData(TimerInterface::PRODUCT_ID, $productId);
    }

    /**
     * @inheritdoc
     */
    public function getFromDate()
    {
        return $this->getData(TimerInterface::FROM_DATE);
    }

    /**
     * @inheritdoc
     */
    public function setFromDate($fromDate)
    {
        return $this->setData(TimerInterface::FROM_DATE, $fromDate);
    }

    /**
     * @inheritdoc
     */
    public function getToDate()
    {
        return $this->getData(TimerInterface::TO_DATE);
    }

    /**
     * @inheritdoc
     */
    public function setToDate($toDate)
    {
        return $this->setData(TimerInterface::TO_DATE, $toDate);
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(
        \Zarkiewicz\CountdownTimer\Api\Data\TimerExtensionInterface $extensionAttributes
    )
    {
        $this->extensionAttributes = $extensionAttributes;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getExtensionAttributes()
    {
        return $this->extensionAttributes;
    }
}
