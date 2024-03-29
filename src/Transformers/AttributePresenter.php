<?php

namespace Corals\Utility\Category\Transformers;

use Corals\Foundation\Transformers\FractalPresenter;

class AttributePresenter extends FractalPresenter
{
    /**
     * @param array $extras
     * @return AttributeTransformer|\League\Fractal\TransformerAbstract
     */
    public function getTransformer($extras = [])
    {
        return new AttributeTransformer($extras);
    }
}
