<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\CouponLink\Controller\Cart;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Data\Form\FormKey\Validator as FormKeyValidator;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Checkout\Controller\Cart as Action;
use Magento\Checkout\Helper\Cart as CartHelper;
use Magento\Checkout\Model\Cart as CustomerCart;
use Magento\Checkout\Model\Session;
use Magento\SalesRule\Model\CouponFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Quote\Api\CartRepositoryInterface;
use Psr\Log\LoggerInterface;
use Eriocnemis\CouponLink\Model\CompositeValidator;

/**
 * Apply coupon controller
 */
class Coupon extends Action
{
    /**
     * Sales quote repository
     *
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * Coupon code validator
     *
     * @var CompositeValidator
     */
    protected $validator;

    /**
     * Escaper
     *
     * @var Escaper
     */
    protected $escaper;

    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Initialize controller
     *
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Session $checkoutSession
     * @param StoreManagerInterface $storeManager
     * @param FormKeyValidator $formKeyValidator
     * @param CustomerCart $cart
     * @param CartRepositoryInterface $quoteRepository
     * @param CompositeValidator $validator
     * @param Escaper $escaper
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        Session $checkoutSession,
        StoreManagerInterface $storeManager,
        FormKeyValidator $formKeyValidator,
        CustomerCart $cart,
        CartRepositoryInterface $quoteRepository,
        CompositeValidator $validator,
        Escaper $escaper,
        LoggerInterface $logger
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->validator = $validator;
        $this->escaper = $escaper;
        $this->logger = $logger;

        parent::__construct(
            $context,
            $scopeConfig,
            $checkoutSession,
            $storeManager,
            $formKeyValidator,
            $cart
        );
    }

    /**
     * Apply coupon code
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $couponCode = trim($this->getRequest()->getParam('code'));
        try {
            $valid = $this->validator->validate($couponCode);
            if ($valid) {
                $quote = $this->cart->getQuote();
                if ($quote->getItemsCount()) {
                    $quote->getShippingAddress()->setCollectShippingRates(true);
                    $quote->setCouponCode($couponCode)->collectTotals();
                    $this->quoteRepository->save($quote);
                    /* check applied coupon code */
                    if ($couponCode != $quote->getCouponCode()) {
                        $valid = false;
                    }
                } else {
                    $this->_checkoutSession->getQuote()
                        ->setCouponCode($couponCode)->save();
                }
            }
            $this->addResultMessage($valid, $couponCode);
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage(
                $e->getMessage()
            );
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('We cannot apply the coupon code.')
            );
            $this->logger->critical($e);
        }
        return $this->_redirect('*/*/index', ['_secure' => true]);
    }

    /**
     * Add result message
     *
     * @param bool $valid
     * @param string $couponCode
     * @return void
     */
    protected function addResultMessage($valid, $couponCode)
    {
        $couponCode = $this->escaper->escapeHtml($couponCode);
        if ($valid) {
            $this->messageManager->addSuccessMessage(
                __('You used coupon code "%1".', $couponCode)
            );
        } else {
            $this->messageManager->addErrorMessage(
                __('The coupon code "%1" is not valid.', $couponCode)
            );
        }
    }
}
