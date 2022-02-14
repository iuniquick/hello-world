<?php        
namespace Sale\Dropdown\Observer;

class SaveCustomFieldsInOrder implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();

        $order->setData('customvar', $quote->getCustomvar());
        $order->setData('mob_type', $quote->getMobType());
        
        return $this;
    }
}