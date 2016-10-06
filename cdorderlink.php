<?php
/**
* 2007-2014 PrestaShop
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
*  @author    Dominique <dominique@chez-dominique.fr>
*  @copyright 2007-2016 Chez-Dominique
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class CdOrderLink extends Module
{

    public function __construct()
    {
        if (!defined('_PS_VERSION_')) {
            exit();
        }

        $this->name = "cdorderlink";
        $this->author = "Dominique";
        $this->author_uri = "www.chez-dominique.fr";
        $this->tab = "administration";
        $this->version = "1.0.0";
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l("Bouton commande.");
        $this->description = $this->l("Ajoute un bouton 'Nouvelle commande' dans la fiche commande");

    }

    public function install()
    {
        if (!parent::install() ||
            !$this->registerHook('displayAdminOrder')
        ) {
            return false;
        }
        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()
        ) {
            return false;
        }
        return true;
    }


    public function hookDisplayAdminOrder($params)
    {
        $id_customer = $this->context->customer->id;
        $link_tab_order = $this->context->link->getAdminLink('AdminOrders');
        $link = $link_tab_order . '&addorder&createorderfromcustomer&id_customer=' . $id_customer;

        $this->smarty->assign(array('link' => $link));

        return $this->display(__FILE__, 'orderlink.tpl');
    }
}
