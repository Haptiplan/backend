<?php
/**
 * Class Credit
 *
 * This class represents a credit decision and extends the Decision class.
 */
require_once 'decision.php';

class Credit extends Decision
{

    private int $amount;
    private int $decision_type;
    private int $credit_type_id;

    /**
     * Credit constructor.
     *
     * @param int $amount The amount of the credit.
     * @param int $decision_type The decision type associated with the credit.
     * @param int $credit_type_id The credit type identifier.
     */
    public function __construct(int $amount, int $decision_type, int $credit_type_id)
    {
        $this->amount = $amount;
        $this->decision_type = $decision_type;
        $this->credit_type_id = $credit_type_id;
    }

    /**
     * Get the amount of the credit.
     *
     * @return int The amount of the credit.
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Get the decision type associated with the credit.
     *
     * @return int The decision type associated with the credit.
     */
    public function getDecisionType(): int
    {
        return $this->decision_type;
    }

    /**
     * Get the credit type identifier.
     *
     * @return int The credit type identifier.
     */
    public function getCreditTypeId(): int
    {
        return $this->credit_type_id;
    }
}