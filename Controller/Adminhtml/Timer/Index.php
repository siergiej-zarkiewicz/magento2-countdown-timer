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

namespace Zarkiewicz\CountdownTimer\Controller\Adminhtml\Timer;

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
    const ADMIN_RESOURCE = 'Zarkiewicz_CountdownTimer::timer';

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
        /** @var Page $resultPage */
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Zarkiewicz_CountdownTimer::timer');
        $resultPage->addBreadcrumb(__('Timers'), __('Timers'));
        $resultPage->addBreadcrumb(__('Manage Timers'), __('Manage Timers'));
        $resultPage->getConfig()->getTitle()->prepend(__('Timer'));

        return $resultPage;
    }
}
