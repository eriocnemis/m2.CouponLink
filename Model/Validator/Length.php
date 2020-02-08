<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\CouponLink\Model\Validator;

use Magento\Checkout\Helper\Cart as CartHelper;

/**
 * Coupon length validator
 */
class Length implements ValidatorInterface
{
    /**
     * Validate coupon code
     *
     * @param string $couponCode
     * @return bool
     */
    public function validate($couponCode)
    {
        $codeLength = strlen($couponCode);
        if ($codeLength && $codeLength <= CartHelper::COUPON_CODE_MAX_LENGTH) {
            return true;
        }
        return false;
    }
}
