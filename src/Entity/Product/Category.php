<?php

namespace ZoomosApi\Entity\Product;

use ZoomosApi\Entity\Base\WithNameTrait;
use ZoomosApi\Entity\BaseData;

class Category extends BaseData
{
    use WithNameTrait;

    public function getLinkRewrite(): string
    {
        return $this->getStringField('linkRewrite') ?? '';
    }
}
