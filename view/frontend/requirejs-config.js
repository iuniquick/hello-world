var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-shipping-information': {
                'Sale_Dropdown/js/action/set-shipping-information-mixin' : true
            }
        }
    },
    "map": {
        "*": {
            "Magento_Checkout/js/model/shipping-save-processor/default" : "Sale_Dropdown/js/shipping-save-processor-demo",
            
        }
    }
};