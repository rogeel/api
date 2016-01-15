<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Address;

/**
 * Class AddressTransformer
 * @package namespace App\Transformers;
 */
class AddressTransformer extends TransformerAbstract
{

    /**
     * Transform the \Address entity
     * @param \Address $model
     *
     * @return array
     */
     // 'profile_id'  => $model->profile()->get(),

    public function transform(Address $model)
    {
        return [
            'id'          => (int) $model->id,
            'profile_id'  => (int) $model->profile_id,
            'type'        => $model->type,
            'address1'    => $model->address_1,
            'address2'    => $model->address_2,
            'city'        => $model->city,
            'state'       => $model->state,
            'country_id'  => $model->country_id,
            'postal_code' => $model->postal_code,
            'phone'       => (int) $model->phone,
            'mobile'      => (int) $model->mobile
        ];
    }
}
