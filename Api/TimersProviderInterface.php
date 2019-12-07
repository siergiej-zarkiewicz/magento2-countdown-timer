<?php
/**
 * Zarkiewicz\CountdownTimer
 *
 * @package Zarkiewicz\CountdownTimer
 * @author Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @copyright Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @license Open Software License (OSL 3.0)
 */
namespace Zarkiewicz\CountdownTimer\Api;

use Magento\Catalog\Api\Data\ProductInterface;

interface TimersProviderInterface
{
    /**
     * @param ProductInterface $product
     * @return array
     */
    public function getTimers($product);
}