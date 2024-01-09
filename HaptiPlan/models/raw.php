<?php
/**
 * Class Raw
 *
 * Represents a decision related to raw materials and extends the Decision class.
 */
require_once 'decision.php';

class Raw extends Decision
{

    private int $position;
    private int $decision_type;
    private int $product_type_id;

    /**
     * Raw constructor.
     *
     * @param int $position The position of the raw material.
     * @param int $decision_type The decision type associated with the raw material.
     * @param int $product_type_id The product type identifier.
     */
    public function __construct(int $position, int $decision_type, int $product_type_id)
    {
        $this->position = $position;
        $this->decision_type = $decision_type;
        $this->product_type_id = $product_type_id;
    }

    /**
     * Get the position of the raw material.
     *
     * @return int The position of the raw material.
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * Get the decision type associated with the raw material.
     *
     * @return int The decision type associated with the raw material.
     */
    public function getDecisionType(): int
    {
        return $this->decision_type;
    }

    /**
     * Get the product type identifier.
     *
     * @return int The product type identifier.
     */
    public function getProductTypeId(): int
    {
        return $this->product_type_id;
    }
}