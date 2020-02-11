<?php

defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

class Resources {
    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'resourcesScrips'));
        add_action('admin_enqueue_scripts', array($this, 'resourcesStyles'));
    }

    /* Recursos Scrips */
    public function resourcesScrips() {
        if (isset($_REQUEST['page']) && strrpos($_REQUEST['page'], 'burguer-reservas') !== false) {
            /* CDN */
            wp_enqueue_script('script', "https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js");
            wp_enqueue_script('popper', "https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js");
            wp_enqueue_script('matchHeight', "https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js");
            wp_enqueue_script('chartsJS', "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js");

            /* JS Panel */
            wp_enqueue_script('dashboard', content_url() . '/plugins/burgerReservas/src/resources/js/dashboard.js');
            wp_enqueue_script('main', content_url() . '/plugins/burgerReservas/src/resources/js/main.js');
            wp_enqueue_script('sampledata', content_url() . '/plugins/burgerReservas/src/resources/js/vmap.sampledata.js');
            wp_enqueue_script('dashboard', content_url() . '/plugins/burgerReservas/src/resources/js/custom.js');
            wp_enqueue_script('panelCharts', content_url() . '/plugins/burgerReservas/src/resources/js/panelCharts.js');
        }
    }

    /* Recursos Styles */
    public function resourcesStyles() {
        if (isset($_REQUEST['page']) && strrpos($_REQUEST['page'], 'burguer-reservas') !== false) {
            /* CDN */
            wp_enqueue_style('fontawesome-style', "https://use.fontawesome.com/releases/v5.10.2/css/all.css");
            wp_enqueue_style('bootstrap-style', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
            wp_enqueue_style('normalize', "https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css");
            wp_enqueue_style('stroke', "https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css");
            wp_enqueue_style('chartsCSS', "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css");

            /* Css PANEL ADMIN */
            wp_enqueue_style('style-panel', content_url() . '/plugins/burgerReservas/src/resources/css/cs-skin-elastic.css');
            wp_enqueue_style('style-panel2', content_url() . '/plugins/burgerReservas/src/resources/css/style.css');
            wp_enqueue_style('style-panel3', content_url() . '/plugins/burgerReservas/src/resources/css/mainPanel.css');
        }
    }
}