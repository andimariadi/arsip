<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
function permission_administrator($res) {
    $CI =& get_instance();
    if ($CI->session->userdata('level') == 'administrator') {
        return $res;
    }
}