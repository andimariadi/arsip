<?php
defined('BASEPATH') or exit('No direct script access allowed');

function permission_read($res) {
    $CI =& get_instance();
    if ($CI->session->userdata('access_read') == 'true') {
        return $res;
    }
}
function permission_update($res) {
    $CI =& get_instance();
    if ($CI->session->userdata('access_update') == 'true') {
        return $res;
    }
}
function permission_create($res) {
    $CI =& get_instance();
    if ($CI->session->userdata('access_create') == 'true') {
        return $res;
    }
}
function permission_delete($res) {
    $CI =& get_instance();
    if ($CI->session->userdata('access_delete') == 'true') {
        return $res;
    }
}
function permission_export($res) {
    $CI =& get_instance();
    if ($CI->session->userdata('access_export') == 'true') {
        return $res;
    }
}
function permission_restrict($res) {
    $CI =& get_instance();
    $restrict_menu = explode(',', $CI->session->userdata('restrict'));
    if ( (string)array_search($res, $restrict_menu) !== "")
        return redirect(base_url('auth'));
}
function permission_menu_restrict($menu,$res) {
    $CI =& get_instance();
    $restrict_menu = explode(',', $CI->session->userdata('restrict'));
    if ( (string)array_search($menu, $restrict_menu) === "")
        return $res;
}
function permission_administrator($res) {
    $CI =& get_instance();
    if ($CI->session->userdata('level') == 'administrator') {
        return $res;
    }
}