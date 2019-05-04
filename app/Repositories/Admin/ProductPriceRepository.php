<?php

namespace AVDPainel\Repositories\Admin;

use AVDPainel\Models\Admin\ProductPrice as Model;
use AVDPainel\Interfaces\Admin\ProductPriceInterface;


class ProductPriceRepository implements ProductPriceInterface
{

    public $model;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create($input, $idpro, $offer)
    {     
        $text_offer_card = '';
        $text_offer_cash = '';
        foreach ($input as $key => $value) {

            ($value['price_cash_percent'] < 0 ? $sum_cash = '-' : $sum_cash = '+');
            ($value['price_card_percent'] < 0 ? $sum_card = '-' : $sum_card = '+');
            
            ($value['profile'] != 'Normal' ? $value['sum_card'] = $sum_card : $value['sum_card'] = '-');
            ($value['profile'] != 'Normal' ? $value['sum_cash'] = $sum_cash : $value['sum_cash'] = '-');

            $value['price_cash_percent'] = abs($value['price_cash_percent']);
            $value['price_card_percent'] = abs($value['price_card_percent']);

            $value['product_id'] = $idpro;

            $data = $this->model->create($value);
            if ($data) {
                if ($offer == 1) {
                    $text_offer_card = '- Oferta Parcelado:'.setReal($data->offer_card);
                    $text_offer_cash = ', Á vista:'.round($data->offer_percent, 2).'% '.setReal($data->offer_cash);
                }
                if ($data->profile == 'Normal') {
                    $price_card_percent = '';
                    $price_cash_percent = round($data->price_cash_percent, 2);
                } else {
                    $price_card_percent = round($data->price_card_percent, 2);
                    $price_cash_percent = round($data->price_cash_percent, 2);
                } 
                generateAccessesTxt(utf8_decode('Perfil:'.$data->profile.
                    ', Parcelado:'.$price_card_percent.'% '.setReal($data->price_card).
                    ', À Vista:'.$price_cash_percent.'% '.setReal($data->price_cash).
                    ' '.$text_offer_card . $text_offer_cash));

            }
        }

        return $data;        
    }


    public function update($input, $idpro, $offer)
    {

        $text_offer_card = '';
        $text_offer_cash = '';

        foreach ($input as $key => $value) {
            ($value['price_cash_percent'] < 0 ? $sum_cash = '-' : $sum_cash = '+');
            ($value['price_card_percent'] < 0 ? $sum_card = '-' : $sum_card = '+');
            
            ($value['profile'] != 'Normal' ? $value['sum_card'] = $sum_card : $value['sum_card'] = '-');
            ($value['profile'] != 'Normal' ? $value['sum_cash'] = $sum_cash : $value['sum_cash'] = '-');

            $value['price_cash_percent'] = abs($value['price_cash_percent']);
            $value['price_card_percent'] = abs($value['price_card_percent']);

            $value['product_id'] = $idpro;

            $data   = $this->model->find($value['id']);

            $update = $data->update($value);

            if ($update) {
                if ($offer == 1) {
                    $text_offer_card = '- Oferta Parcelado:'.setReal($data->offer_card);
                    $text_offer_cash = ', Á vista:'.round($data->offer_percent, 2).'% '.setReal($data->offer_cash);
                }
                if ($data->profile == 'Normal') {
                    $price_card_percent = '';
                    $price_cash_percent = round($data->price_cash_percent, 2);
                } else {
                    $price_card_percent = round($data->price_card_percent, 2).'% ';
                    $price_cash_percent = round($data->price_cash_percent, 2);
                } 
                generateAccessesTxt(utf8_decode('Perfil:'.$data->profile.
                    ', Parcelado:'.$price_card_percent.setReal($data->price_card).
                    ', À Vista:'.$price_cash_percent.'% '.setReal($data->price_cash).
                    ' '.$text_offer_card . $text_offer_cash));
            }
        }

        return $update;     
    }


}