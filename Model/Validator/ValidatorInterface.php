<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\CouponLink\Model\Validator;

/**
 * Coupon validator interface
 */
interface ValidatorInterface
{
    /**
     * Validate coupon code
     *
     * @param string $couponCode
     * @return bool
     */
    public function validate($couponCode);
}
