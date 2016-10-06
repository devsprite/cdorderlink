<?php

if (!defined('_PS_VERSION_')) {
    exit();
}


class CdOrderLink extends Module
{

    public function __construct()
    {


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
