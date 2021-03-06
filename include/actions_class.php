<?php

/***********************************************************************
* Class: MPEBY_Actions
*
* The MoneyPress : eBay Edition action hooks and helpers.
*
* The methods in here are normally called from an action hook that is
* called via the WordPress action stack.
*
* See http://codex.wordpress.org/Plugin_API/Action_Reference
*
************************************************************************/

if (! class_exists('MPEBY_Actions')) {
    class MPEBY_Actions {

        /******************************
         * PUBLIC PROPERTIES & METHODS
         ******************************/
        public $parent = null;

        /*************************************
         * The Constructor
         */
        function __construct($params=null) {
        }


        /**
         * Set the parent property to point to the primary plugin object.
         *
         * Returns false if we can't get to the main plugin object.
         *
         * @global wpCSL_plugin__slplus $slplus_plugin
         * @return type boolean true if plugin property is valid
         */
        function setParent() {
            if (!isset($this->parent) || ($this->parent == null)) {
                global $MP_ebay_plugin;
                $this->parent = $MP_ebay_plugin;
            }
            return (isset($this->parent) && ($this->parent != null));
        }

        /**
         * Process teh admin init hook for WordPress
         *
         * Called after admin_menu().
         */
        function admin_init() {
        }

        /**
         * Process the admin menu hook for WordPress
         *
         * Add the Pro Pack settings page to the sidebar.
         * 
         * Called before admin_init().
         *
         */
        function admin_menu() {
            if (!$this->setParent()) { return; }

            // Prepare the AdminUI object for future use
            //
            require_once($this->parent->plugin_path.'/include/admin_ui.php');
            $this->parent->AdminUI = new MPEBY_AdminUI(array('parent'=>$this->parent));


            add_submenu_page(
                $this->parent->prefix . '-options',
                __('Pro Settings', MP_EBAY_PREFIX),
                __('Pro Settings', MP_EBAY_PREFIX),
                'administrator',
                $this->parent->prefix . '-pro_options',
                array($this->parent->AdminUI,'pro_options')
            );
        }
    }
}
?>
