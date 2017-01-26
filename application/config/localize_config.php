<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Настройки локализации сайта.
 *
 *     default_key => язык сайта по умолчанию
 *     list        => список доступных языков
 *
 * @author Sergey Makhlenko
 * @version 1.0
 */
$config['ROUTE_LOCALIZE'] = array(
    'default_key' => 1, // Язык по-умолчанию, указывается ключ из массива "list" (0 -> by, 1 -> ru, .... 4 -> en)
    'list'        => array('ru','en'), // Доступные языки для сайта
    );
