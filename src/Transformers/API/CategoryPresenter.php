<?php

namespace Corals\Modules\Utility\Category\Transformers\API;

use Corals\Foundation\Transformers\FractalPresenter;

class CategoryPresenter extends FractalPresenter
{
    /**
     * @return CategoryTransformer
     */
    public function getTransformer()
    {
        return new CategoryTransformer();
    }
}
