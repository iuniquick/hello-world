<?php

namespace Sale\Dropdown\Model\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddHtmlToOrderShippingViewObserver implements ObserverInterface
{

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectmanager
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectmanager)
    {
        $this->_objectManager = $objectmanager;
    }

    public function execute(EventObserver $observer)
    {
        if($observer->getElementName() == 'order_shipping_view')
        {
            $orderShippingViewBlock = $observer->getLayout()->getBlock($observer->getElementName());
            $order = $orderShippingViewBlock->getOrder();
            $localeDate = $this->_objectManager->create('\Magento\Framework\Stdlib\DateTime\TimezoneInterface');
            // $formattedDate = $localeDate->formatDate(
            //     $localeDate->scopeDate(
            //         $order->getStore(),
            //         $order->getDeliveryDate(),
            //         true
            //     ),
            //     \IntlDateFormatter::MEDIUM,
            //     false
            // );
            $formattedDate = $order->getCustomvar();

            $deliveryDateBlock = $this->_objectManager->create('Magento\Framework\View\Element\Template');
            $deliveryDateBlock->setCustomvar($formattedDate);
            $deliveryDateBlock->setTemplate('Sale_Dropdown::order_info_shipping_info.phtml');
            $html = $observer->getTransport()->getOutput() . $deliveryDateBlock->toHtml();
            $observer->getTransport()->setOutput($html);
        }
    }
}