<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\CouponLink\Model\Validator;

use Magento\SalesRule\Model\CouponFactory;

/**
 * Coupon exist validator
 */
class EntityExist implements ValidatorInterface
{
    /**
     * Coupon factory
     *
     * @var CouponFactory
     */
    protected $couponFactory;

    /**
     * Initialize validator
     *
     * @param CouponFactory $couponFactory
     */
    public function __construct(
        CouponFactory $couponFactory
    ) {
        $this->couponFactory = $couponFactory;
    }

    /**
     * Validate coupon code
     *
     * @param string $couponCode
     * @return bool
     */
    public function validate($couponCode)
    {
        $coupon = $this->couponFactory->create()->load($couponCode, 'code');
        if ($coupon->getId()) {
            return true;
        }
        return false;
    }
}
