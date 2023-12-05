<?php
/**
 * Class Decision
 *
 * Represents a decision made in a certain period by a user for a specific company.
 */
class Decision
{
    private int $decision_id;
    private DateTime $timestamp;
    private int $company_id;
    private int $user_id;
    private int $period_id;

    /**
     * Decision constructor.
     *
     * @param int $decision_id The unique identifier for the decision.
     * @param DateTime $timestamp The timestamp when the decision was made.
     * @param int $company_id The identifier of the company for which the decision was made.
     * @param int $user_id The identifier of the user who made the decision.
     * @param int $period_id The identifier of the period in which the decision was made.
     */
    public function __construct(int $decision_id, DateTime $timestamp, int $company_id, int $user_id, int $period_id)
    {
        $this->decision_id = $decision_id;
        $this->timestamp = $timestamp;
        $this->company_id = $company_id;
        $this->user_id = $user_id;
        $this->period_id = $period_id;
    }

    /**
     * Get the unique identifier for the decision.
     *
     * @return int The decision_id.
     */
    public function getDecisionId(): int
    {
        return $this->decision_id;
    }

    /**
     * Set the unique identifier for the decision.
     *
     * @param int $decision_id The decision_id to set.
     */
    public function setDecisionId(int $decision_id): void
    {
        $this->decision_id = $decision_id;
    }

    /**
     * Get the timestamp when the decision was made.
     *
     * @return DateTime The timestamp.
     */
    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    /**
     * Set the timestamp when the decision was made.
     *
     * @param DateTime $timestamp The timestamp to set.
     */
    public function setTimestamp(DateTime $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Get the identifier of the company for which the decision was made.
     *
     * @return int The company_id.
     */
    public function getCompanyId(): int
    {
        return $this->company_id;
    }

    /**
     * Set the identifier of the company for which the decision was made.
     *
     * @param int $company_id The company_id to set.
     */
    public function setCompanyId(int $company_id): void
    {
        $this->company_id = $company_id;
    }

    /**
     * Get the identifier of the user who made the decision.
     *
     * @return int The user_id.
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Set the identifier of the user who made the decision.
     *
     * @param int $user_id The user_id to set.
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * Get the identifier of the period in which the decision was made.
     *
     * @return int The period_id.
     */
    public function getPeriodId(): int
    {
        return $this->period_id;
    }

    /**
     * Set the identifier of the period in which the decision was made.
     *
     * @param int $period_id The period_id to set.
     */
    public function setPeriodId(int $period_id): void
    {
        $this->period_id = $period_id;
    }
}