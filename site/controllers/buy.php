<?php

return function ($page) {

  $sale = option('sale.eur');

  return [
    'sale'     => $sale,
    'saleText' => option('sale.text'),
    'price'    => option('price.eur')
  ];

};
