<?php
/**
 * Zarkiewicz\CountdownTimer
 *
 * @package Zarkiewicz\CountdownTimer
 * @author Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @copyright Siergiej Zarkiewicz <ssiergiej.zarkiewicz@gmail.com>
 * @license Open Software License (OSL 3.0)
 */
declare(strict_types=1);

namespace Zarkiewicz\CountdownTimer\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);

        $this->pageFactory = $pageFactory;
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        // Get the params that were passed from our Router
        $firstParam = $this->getRequest()->getParam('first_param', null);
        $secondParam = $this->getRequest()->getParam('second_param', null);

        return $this->pageFactory->create();
    }
}
