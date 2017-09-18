<?php
/**
* @package Get Rocket
*/


function get_rocket_show_page_header()
{
    if (class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_enabled()) {
        $global_settings = FLBuilderModel::get_global_settings();

        if (! $global_settings->show_default_heading) {
            return false;
        }
    }

    return true;
}
