<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\CouponLink\Model;

use Magento\Framework\Exception\LocalizedException;
use Eriocnemis\CouponLink\Model\Validator\ValidatorInterface;

/**
 * Coupon composite validator
 */
class CompositeValidator implements ValidatorInterface
{
    /**
     * Coupon validators
     *
     * @var ValidatorInterface[]
     */
    protected $validators = [];

    /**
     * Initialize validator
     *
     * @param ValidatorInterface[] $validators
     */
    public function __construct(
        array $validators = []
    ) {
        foreach ($validators as $validator) {
            if (!$validator instanceof ValidatorInterface) {
                throw new LocalizedException(
                    __('Validator must implement %1.', ValidatorInterface::class)
                );
            }
        }
        $this->validators = $validators;
    }

    /**
     * Validate coupon code
     *
     * @param string $couponCode
     * @return bool
     */
    public function validate($couponCode)
    {
        foreach ($this->validators as $validator) {
            if (!$validator->validate($couponCode)) {
                return false;
            }
        }
        return true;
    }
}
