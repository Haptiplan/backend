<?php
require_once 'decision.php';

/**
 * Class Machine
 *
 * Represents a decision related to machines and extends the Decision class.
 */
class Machine extends Decision
{

    private int $position;
    private int $decision_type;
    private int $machine_type_id;

    /**
     * Machine constructor.
     *
     * @param int $position The position of the machine.
     * @param int $decision_type The decision type associated with the machine.
     * @param int $machine_type_id The machine type identifier.
     */
    public function __construct(int $position, int $decision_type, int $machine_type_id)
    {
        $this->position = $position;
        $this->decision_type = $decision_type;
        $this->machine_type_id = $machine_type_id;
    }

    /**
     * Get the position of the machine.
     *
     * @return int The position of the machine.
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * Get the decision type associated with the machine.
     *
     * @return int The decision type associated with the machine.
     */
    public function getDecisionType(): int
    {
        return $this->decision_type;
    }

    /**
     * Get the machine type identifier.
     *
     * @return int The machine type identifier.
     */
    public function getMachineTypeId(): int
    {
        return $this->machine_type_id;
    }

}