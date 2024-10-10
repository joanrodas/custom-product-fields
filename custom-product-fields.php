<?php

/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Product Fields
 * Plugin URI:        https://sirvelia.com/
 * Description:       WooCommerce fields made simple.
 * Version:           1.0.0
 * Author:            Joan Rodas - Sirvelia
 * Author URI:        https://sirvelia.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       cpf
 * Domain Path:       /languages
 */

require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';


add_action('after_setup_theme', function () {
	CPF\Loader::load();
});

add_action('cpf_register_fields', function () {

	// CPF\Section\ProductSection::create('dtf_section', 'Opciones DTF', [
	// 	CPF\Field\Field::create('number', 'altura', 'Altura (mm)')->default_value('550'),
	// 	CPF\Field\Field::create('number', 'amplada', 'Amplada (mm)')->default_value('1000'),
	// 	CPF\Field\Field::create('color', 'color', 'Color principal')->default_value('#009d45'),
	// 	CPF\Field\Field::create('select', 'dtf_type', 'Tipus')->default_value('normal')
	// 		->set_options([
	// 			'normal' => 'Sense tall',
	// 			'dxf' => 'Amb tall (DXF)'
	// 		]),
	// 	CPF\Field\Field::create('number', 'base_price', 'Preu base')->default_value(0),
	// 	CPF\Field\RepeatableField::create('dtf_prices', 'Preus', [
	// 		CPF\Field\Field::create('number', 'from', 'Metres (des de)')->step('0.01'),
	// 		CPF\Field\Field::create('number', 'price', 'Preu per metre')->step('0.01')
	// 	]),
	// 	CPF\Field\RepeatableField::create('dxf_prices', 'Preus tall', [
	// 		CPF\Field\Field::create('number', 'from_h', 'H (mm)')->step('0.01'),
	// 		CPF\Field\Field::create('number', 'from_w', 'W (mm)')->step('0.01'),
	// 		CPF\Field\RepeatableField::create('dxf_quantities', 'Quantitats', [
	// 			CPF\Field\Field::create('number', 'quantity', 'Quantitat')->step('1'),
	// 			CPF\Field\Field::create('number', 'price', 'Preu per metre')->step('0.01')
	// 		])
	// 	])
	// ])
	// 	->if_tab('general');

		CPF\Section\PostSection::create('dtf_section', 'Opciones DTF', [
			CPF\Field\Field::create('text', 'altura', 'Altura (mm)')->default_value('550'),
			CPF\Field\Field::create('password', 'amplada', 'Amplada (mm)')->default_value('1000'),
			CPF\Field\Field::create('color', 'color', 'Color principal')->default_value('#009d45'),
			CPF\Field\Field::create('select', 'dtf_type', 'Tipus')->default_value('normal')
				->set_options([
					'normal' => 'Sense tall',
					'dxf' => 'Amb tall (DXF)'
				]),
			CPF\Field\Field::create('number', 'base_price', 'Preu base')->default_value(0),
			CPF\Field\RepeatableField::create('dtf_prices', 'Preus', [
				CPF\Field\Field::create('number', 'from', 'Metres (des de)')->step('0.01'),
				CPF\Field\Field::create('number', 'price', 'Preu per metre')->step('0.01')
			]),
			CPF\Field\RepeatableField::create('dxf_prices', 'Preus tall', [
				CPF\Field\Field::create('number', 'from_h', 'H (mm)')->step('0.01'),
				CPF\Field\Field::create('number', 'from_w', 'W (mm)')->step('0.01'),
				CPF\Field\RepeatableField::create('dxf_quantities', 'Quantitats', [
					CPF\Field\Field::create('text', 'quantity', 'Quantitat'),
					CPF\Field\Field::create('password', 'price', 'Preu per metre')
				])
			])
		])
			->if_post_type('page')
			;





});