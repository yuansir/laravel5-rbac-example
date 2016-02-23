<?php

namespace App\Presenters;

use App\Transformers\AdminUserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AdminUserPresenter
 *
 * @package namespace App\Presenters;
 */
class AdminUserPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminUserTransformer();
    }
}
