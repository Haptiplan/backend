<?php
/**
 * Class Employeeproduction
 *
 * Represents a decision related to employee production and extends the Decision class.
 */
require_once 'decision.php';

class Employeeproduction extends Decision
{
    private int $decision_type;
    private int $employee_id;

    /**
     * Employeeproduction constructor.
     *
     * @param int $decision_type The decision type associated with employee production.
     * @param int $employee_id The identifier of the employee.
     */
    public function __construct(int $decision_type, int $employee_id)
    {
        $this->decision_type = $decision_type;
        $this->employee_id = $employee_id;
    }

    /**
     * Get the decision type associated with employee production.
     *
     * @return int The decision type.
     */
    public function getDecisionType(): int
    {
        return $this->decision_type;
    }

    /**
     * Get the identifier of the employee.
     *
     * @return int The employee_id.
     */
    public function getEmployeeId(): int
    {
        return $this->employee_id;
    }
}