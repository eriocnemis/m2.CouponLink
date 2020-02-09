# Magento2 CouponLink

The extension allows you to create URL links that will automatically add a coupon code for your customer to the shopping cart. Used in newsletter campaigns, marketing banners or posts, social media posting or in any promotional tools.

## Compatibility

Version | 2.0.* | 2.1.* | 2.2.* | 2.3.* | 2.4.*
--- | --- | --- | --- | --- | ---
Magento Community | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark:
Magento Enterprise | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark:
Magento Cloud | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark:
CouponLink | 2.0.* | 2.0.* | 2.0.* | 2.0.* | 2.0.*

## Install

1. Create a folder {Magento root}/app/code/Eriocnemis/CouponLink

2. Download the corresponding [latest version](https://github.com/eriocnemis/m2.CouponLink/releases)

3. Copy the unzip content to the folder ({Magento root}/app/code/Eriocnemis/CouponLink)

4. Go to Magento2 root folder

5. Enter following commands:

    ```bash
    php bin/magento setup:upgrade
    php bin/magento setup:di:compile
    php bin/magento setup:static-content:deploy  (optional)

## Usage

Format of the link is http://{domain}/checkout/cart/coupon/?code={code}

## Uninstall

1. Remove the folder {Magento root}/app/code/Eriocnemis/CouponLink

2. Go to Magento2 root folder

3. Enter following commands:

    ```bash
    php bin/magento setup:upgrade
    php bin/magento setup:di:compile
    php bin/magento setup:static-content:deploy  (optional)

## License

[The Open Software License 3.0 (OSL-3.0)](https://github.com/eriocnemis/m2.CouponLink/blob/master/LICENSE.md)

## Contribution

Want to contribute to this extension? The best possibility to provide any code is to open a [pull requests](https://github.com/eriocnemis/m2.CouponLink/pulls) on GitHub. Please see the [CONTRIBUTING.md](https://github.com/eriocnemis/m2.CouponLink/blob/master/.github/CONTRIBUTING.md) file for more.

## Suggestions

We're also interested in your feedback for the future of extension. You can submit a suggestion or feature request through the [issue](https://github.com/eriocnemis/m2.CouponLink/issues) tracker. But you must acknowledge and agree that your offer will not prevent Eriocnemis from using your ideas without obligation to you.

## Support

If you encounter any problems or bugs, please open a [issue](https://github.com/eriocnemis/m2.CouponLink/issues). To make this process more effective, we're asking that these include more information to help define them more clearly. Pleace, do not enumerate multiple bugs or feature requests in the same issue. Similarly do not add your issue as a comment to an existing issue. Many issues look similar, but have different causes.

<p align="center"><img src="https://avatars3.githubusercontent.com/u/48807026?s=48&v=4"></p>
