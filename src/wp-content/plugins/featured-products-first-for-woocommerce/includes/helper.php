<?php


if (!function_exists('wff_get_featured_product_ids')) {
	function wff_get_featured_product_ids() {
		$featured_product_id = apply_filters( 'wff_featured_product_ids', wc_get_featured_product_ids() );
		return $featured_product_id;
	}
}
