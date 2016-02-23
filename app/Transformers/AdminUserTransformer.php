<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\AdminUser;

/**
 * Class AdminUserTransformer
 * @package namespace App\Transformers;
 */
class AdminUserTransformer extends TransformerAbstract
{

    /**
     * Transform the \AdminUser entity
     * @param \AdminUser $model
     *
     * @return array
     */
    public function transform(AdminUser $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
