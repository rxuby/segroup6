<?php
/**
 * 2007-2020 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

use PrestaShop\PrestaShop\Core\Payment\PaymentOption;

if (!defined('_PS_VERSION_')) {
    exit;
}

class OnlinePayment extends PaymentModule
{
    public function __construct()
    {
        $this->name = 'onlinepayment';
        $this->tab = 'payments_gateways';
        $this->version = '1.0.0';
        $this->ps_versions_compliancy = ['min' => '1.7.6.0', 'max' => _PS_VERSION_];
        $this->author = 'SEN Power of friendship';
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Online payment');
        $this->description = $this->l('Accept payments by displaying QR Code and Bank account number during the checkout.');
    }

    public function install()
    {
        return parent::install()
        && $this->registerHook('displayPaymentReturn')
        && $this->registerHook('paymentOptions');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function hookDisplayPaymentReturn()
    {
        $this->smarty->assign([
            
        ]);

        return $this->fetch('module:onlinepayment/views/templates/hook/return.tpl');
    }

    public function hookPaymentOptions()
    {
        $OnlinePaymentOption = new PaymentOption();
        $OnlinePaymentOption->setModuleName($this->name)
                ->setCallToActionText($this->l('Online Payment'))
                ->setAction($this->context->link->getModuleLink($this->name, 'payment', [], true))
                ->setAdditionalInformation($this->fetch('module:onlinepayment/views/templates/hook/onlinepayment_intro.tpl'));
        
        $payment_options = [
            $OnlinePaymentOption,
        ];

        return $payment_options;
    }

    public function getContent()
    {
        // if(Tools::isSubmit('savebanktransfer'))
        // {
        //     $bankname = Tools::getValue('bankname');
        //     $bankaccount_number = Tools::getValue('bankaccount_number');
        //     Configuration::updateValue('BANKNAME', $bankname);
        //     Configuration::updateValue('BANKACCOUNT_NUMBER', $bankaccount_number);
        // }
        // if(Tools::isSubmit('saveqrpayment'))
        // {
        //     $qrimg = Tools::getValue('qrcode');
        //     Configuration::updateValue('QRPAYMENT_IMG', $qrimg);
        // }
        // $this->context->smarty->assign([
        //     'BANKNAME' => Configuration::get('BANKNAME'),
        //     'BANKACCOUNT_NUMBER' =>  Configuration::get('BANKACCOUNT_NUMBER'),
        //     'QRPAYMENT_IMG' => 'Test QR IMG' // Configuration::get('QRPAYMENT_IMG')
        // ]);
        return $this->fetch('module:onlinepayment/views/templates/admin/configure.tpl');
    }
}
