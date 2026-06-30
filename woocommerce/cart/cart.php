<?php
function anneo_get_cart_items()
{

    $items = [];

    foreach (WC()->cart->get_cart() as $key => $item) {

        $product = $item['data'];

        $items[] = [

            'key' => $key,

            'id' => $product->get_id(),

            'name' => $product->get_name(),

            'price' => $product->get_price(),

            'qty' => $item['quantity'],

            'image' => wp_get_attachment_image_url(
                $product->get_image_id(),
                'thumbnail'
            )

        ];

    }

    return $items;

}