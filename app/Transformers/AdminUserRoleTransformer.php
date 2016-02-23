<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\AdminUserRole;

/**
 * Class AdminUserRoleTransformer
 * @package namespace App\Transformers;
 */
class AdminUserRoleTransformer extends TransformerAbstract
{

    /**
     * Transform the \AdminUserRole entity
     * @param \AdminUserRole $model
     *
     * @return array
     */
    public function transform(AdminUserRole $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
