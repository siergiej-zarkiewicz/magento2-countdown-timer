<?php
/**
 * Zarkiewicz\CountdownTimer\ViewModel\Product\Timer ViewModel file.
 *
 * @package Zarkiewicz\CountdownTimer\ViewModel\Product
 * @author Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @copyright Siergiej Zarkiewicz <ssiergiej.zarkiewicz@gmail.com>
 * @license Open Software License (OSL 3.0)
 */

namespace Zarkiewicz\CountdownTimer\ViewModel\Product;

use Magento\Catalog\Helper\Data;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\Escaper;

/**
 * Product timer view model.
 */
class Timer extends DataObject implements ArgumentInterface
{
    /**
     * Catalog data.
     *
     * @var Data
     */
    private $catalogData;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @var TimezoneInterface
     */
    private $timezone;

    /**
     * @param Data $catalogData
     * @param ScopeConfigInterface $scopeConfig
     * @param Json|null $json
     * @param Escaper|null $escaper
     * @param TimezoneInterface $timezone
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __construct(
        Data $catalogData,
        ScopeConfigInterface $scopeConfig,
        Json $json = null,
        Escaper $escaper = null,
        TimezoneInterface $timezone
    ) {
        parent::__construct();

        $this->catalogData = $catalogData;
        $this->scopeConfig = $scopeConfig;
        $this->escaper = $escaper ?: ObjectManager::getInstance()->get(Escaper::class);
        $this->timezone = $timezone;
    }

    /**
     * Returns category URL suffix.
     *
     * @return mixed
     */
    public function getCategoryUrlSuffix()
    {
        return $this->scopeConfig->getValue(
            'catalog/seo/category_url_suffix',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Checks if categories path is used for product URLs.
     *
     * @return bool
     */
    public function isCategoryUsedInProductUrl(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'catalog/seo/product_use_categories',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Returns product name.
     *
     * @return string
     */
    public function getProductName(): string
    {
        return $this->catalogData->getProduct() !== null
            ? $this->catalogData->getProduct()->getName()
            : '';
    }

    /**
     * Returns breadcrumb json with html escaped names
     *
     * @return string
     */
    public function getJsonConfigurationHtmlEscaped(): string
    {
        return json_encode(
            [
                [
                    'label' => 'Current Date',
                    'value' => $this->timezone->formatDateTime(null, \IntlDateFormatter::FULL, \IntlDateFormatter::FULL)
                ]
            ]
        );
    }

    /**
     * Returns breadcrumb json.
     *
     * @return string
     * @deprecated 103.0.0 in favor of new method with name {suffix}Html{postfix}()
     */
    public function getJsonConfiguration()
    {
        return $this->getJsonConfigurationHtmlEscaped();
    }
}
