<?php
/**
* Register a post type, with REST API support
*
* Based on example at: http://codex.wordpress.org/Function_Reference/register_post_type
* @package Get Rocket
*/
add_action( 'init', 'get_rocket_custom_post_materiais' );
function get_rocket_custom_post_materiais()
{
    $labels = array(
    'name'               => _x( 'Materiais', 'post type general name' ),
    'singular_name'      => _x( 'Material', 'post type singular name' ),
    'menu_name'          => _x( 'Materiais', 'admin menu' ),
    'name_admin_bar'     => _x( 'Materiais', 'add new on admin bar' ),
    'add_new'            => _x( 'Adicionar Novo', 'item' ),
    'add_new_item'       => __( 'Adicionar Novo' ),
    'new_item'           => __( 'Novo' ),
    'update_item'        => __( 'Salvar' ),
    'edit_item'          => __( 'Editar Material' ),
    'view_item'          => __( 'Ver Material' ),
    'all_items'          => __( 'Todos Materiais' ),
    'search_items'       => __( 'Procurar Material' ),
    'parent_item_colon'  => __( 'Parent Itens:' ),
    'not_found'          => __( 'Material não encontrado.' ),
    'not_found_in_trash' => __( 'Materiais não encontrado.' )
    );
    
    $args = array(
    'labels'                => $labels,
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'show_in_rest'          => true,
    'show_in_menu'          => true,
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'material' ),
    'capability_type'       => 'post',
    'has_archive'           => true,
    'menu_icon'             => 'dashicons-welcome-learn-more',
    'hierarchical'          => false,
    'menu_position'         => 5,
    'rest_base'             => 'material',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'supports'              => array( 'title','thumbnail')
    );
    
    register_post_type( 'material', $args );
}

add_action( 'init', 'get_rocket_custom_post_cursos' );
function get_rocket_custom_post_cursos()
{
    $labels = array(
    'name'               => _x( 'Cursos', 'post type general name' ),
    'singular_name'      => _x( 'Curso', 'post type singular name' ),
    'menu_name'          => _x( 'Cursos', 'admin menu' ),
    'name_admin_bar'     => _x( 'Cursos', 'add new on admin bar' ),
    'add_new'            => _x( 'Adicionar Novo', 'item' ),
    'add_new_item'       => __( 'Adicionar Novo' ),
    'new_item'           => __( 'Novo' ),
    'update_item'        => __( 'Salvar' ),
    'edit_item'          => __( 'Editar Curso' ),
    'view_item'          => __( 'Ver Curso' ),
    'all_items'          => __( 'Todos Cursos' ),
    'search_items'       => __( 'Procurar Curso' ),
    'parent_item_colon'  => __( 'Parent Itens:' ),
    'not_found'          => __( 'Curso não encontrado.' ),
    'not_found_in_trash' => __( 'Cursos não encontrado.' )
    );
    
    $args = array(
    'labels'                => $labels,
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'show_in_rest'          => true,
    'show_in_menu'          => true,
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'cursos' ),
    'capability_type'       => 'post',
    'has_archive'           => true,
    'menu_icon'             => 'dashicons-welcome-learn-more',
    'hierarchical'          => false,
    'menu_position'         => 5,
    'rest_base'             => 'cursos',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'supports'              => array( 'title','thumbnail')
    );
    
    register_post_type( 'cursos', $args );
}

add_action( 'init', 'get_rocket_custom_post_ebook' );
function get_rocket_custom_post_ebook()
{
    $labels = array(
    'name'               => _x( 'Ebooks', 'post type general name' ),
    'singular_name'      => _x( 'Ebook', 'post type singular name' ),
    'menu_name'          => _x( 'Ebooks', 'admin menu' ),
    'name_admin_bar'     => _x( 'Ebooks', 'add new on admin bar' ),
    'add_new'            => _x( 'Adicionar Novo', 'item' ),
    'add_new_item'       => __( 'Adicionar Novo' ),
    'new_item'           => __( 'Novo' ),
    'update_item'        => __( 'Salvar' ),
    'edit_item'          => __( 'Editar Ebook' ),
    'view_item'          => __( 'Ver Ebook' ),
    'all_items'          => __( 'Todos Ebooks' ),
    'search_items'       => __( 'Procurar Ebook' ),
    'parent_item_colon'  => __( 'Parent Itens:' ),
    'not_found'          => __( 'Ebook não encontrado.' ),
    'not_found_in_trash' => __( 'Ebooks não encontrado.' )
    );
    
    $args = array(
    'labels'                => $labels,
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'show_in_rest'          => true,
    'show_in_menu'          => true,
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'ebook' ),
    'capability_type'       => 'post',
    'has_archive'           => true,
    'menu_icon'             => 'dashicons-book-alt',
    'hierarchical'          => false,
    'menu_position'         => 5,
    'rest_base'             => 'ebook',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'supports'              => array( 'title','thumbnail','editor')
    );
    
    register_post_type( 'ebook', $args );
}
