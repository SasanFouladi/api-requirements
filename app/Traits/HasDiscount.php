<?php

namespace App\Traits;

trait HasDiscount
{
    /**
     * Check has discount or not
     *
     * @return bool
     */
    public function hasDiscount()
    {
        return $this->getAllDiscount() == 0;
    }

    /**
     * Get all discount
     *
     * @return int
     */
    public function getAllDiscount(): int
    {
        return $this->getCategoryDiscount() + $this->getSkuDiscount();
    }

    /**
     * Return all discount with % string
     *
     * @return ?string
     */
    public function getDiscountPercentage(): ?string
    {
        if ($this->hasDiscount()) {
            return null;
        }
        return $this->getAllDiscount() . '%';
    }

    /**
     * Process category discount
     *
     * @return int
     */
    public function getCategoryDiscount(): int
    {
        $categories = ['insurance'];
        if (in_array($this->category, $categories)) {
            return 30;
        }
        return 0;
    }

    /**
     * Process category discount
     *
     * @return int
     */
    public function getSkuDiscount(): int
    {
        $discountSku = ['000003'];
        if (in_array($this->sku, $discountSku)) {
            return 15;
        }
        return 0;
    }
}
