<?php
/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
    exit;

class LogMeInAs extends Module
{
    public function __construct()
    {
        $this->name = 'logmeinas';
        $this->tab = '';
        $this->version = '1.0.0';
        $this->author = 'Pierrick Pobelle';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Log Me In As ...');
        $this->description = $this->l('Log admin as a client.');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        return (parent::install() && $this->registerHook('displayAdminCustomers')  );
    }


    public function hookdisplayAdminCustomers($params)
    {

        $customer = new CustomerCore($params['id_customer']);

        $html = '<div class="col-lg-6"><div class="panel">
<div class="panel-heading">
<i class="icon-connectdevelop"></i> Log Me In As ...
</div>
<div class="text-left">
<form action="http://prestashop.loc/connexion" method="post">
<input type="hidden" name="email" value="'.$customer->email.'">
<input type="hidden" name="secure_key" value="'.md5($customer->secure_key.$customer->passwd).'">
<button type="submit" name="SubmitLogin" class="btn btn-success btn-lg"><i class="icon-user"></i> Me connecter en tant que '.$customer->firstname." ".$customer->lasname.'</button></div>
</form>
</div>
</div>';


        return $html;
    }


}