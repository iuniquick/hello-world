<?php
namespace Sale\Dropdown\ViewModel;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\Request\Http;

class BasysInfo implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $logger;
    protected $request;
    protected $order;

    public function __construct(
        LoggerInterface $logger,
        Http $request,
        \Magento\Sales\Api\OrderRepositoryInterface $order
    ) {
        $this->logger = $logger;
        $this->request = $request;
        $this->order = $order;
    }
    public function getOrderId()
    {
        $this->logger->info('order id '.$this->request->getParam('order_id'));
        $order = $this->order->get(2);
        $this->logger->info('basys order id '.$order->getData('customvar'));
        return $order->getData('customvar');
    }
}