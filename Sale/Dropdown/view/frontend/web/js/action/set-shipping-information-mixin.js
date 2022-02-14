define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper, quote) {
    'use strict';

    return function (setShippingInformationAction) {

        return wrapper.wrap(setShippingInformationAction, function (originalAction) {
            var shippingAddress = quote.shippingAddress();
            if (shippingAddress['extension_attributes'] === undefined) {
                shippingAddress['extension_attributes'] = {};
            }

            // you can extract value of extension attribute from any place (in this example I use customAttributes approach)
            shippingAddress['extension_attributes']['customvar'] = jQuery('input[name="customvar"]').val();
            shippingAddress['extension_attributes']['mob_type'] = jQuery('input[name="mob_type"]').val();
            // pass execution to original action ('Magento_Checkout/js/action/set-shipping-information')
            return originalAction();
        });
    };
});
