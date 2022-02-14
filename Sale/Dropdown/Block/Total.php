<?php
 
namespace Sale\Dropdown\Block;
 
use Magento\Framework\View\Element\Template;
 
class Total extends Template
{
    public function __construct(
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->setInitialFields();
    }
 
    public function setInitialFields()
    {
        if (!$this->getLabel()) {
            $this->setLabel(__('Order Packing Charges'));
        }
    }
 
    public function initTotals()
    {
        $this->getParentBlock()->addTotal(
            new \Magento\Framework\DataObject(
                [
                    'code' => 'customvar',
                    'strong' => $this->getStrong(),
                    'value' => $this->getOrder()->getCustomvar(), // extension attribute field
                    'base_value' => $this->getOrder()->getCustomvar(),
                    'label' => __($this->getLabel()),
                ]
            ),
            $this->getAfter()
        );
        return $this;
    }
 
    public function getOrder()
    {
        return $this->getParentBlock()->getOrder();
    }
 
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }
}