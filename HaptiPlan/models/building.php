<?php
/**
 * Class Building
 *
 * This class represents a building and extends the Decision class.
 */
require_once 'decision.php';
class Building extends Decision
{

    private int $position;
    private int $decision_type;
    private int $building_type_id;

    /**
     * Building constructor.
     *
     * @param int $position The position of the building.
     * @param int $decision_type The decision type associated with the building.
     * @param int $building_type_id The building type identifier.
     */
    public function __construct(int $position, int $decision_type, int $building_type_id)
    {
        $this->position = $position;
        $this->decision_type = $decision_type;
        $this->building_type_id = $building_type_id;
    }

    /**
     * Get the position of the building.
     *
     * @return int The position of the building.
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * Get the decision type associated with the building.
     *
     * @return int The decision type associated with the building.
     */
    public function getDecisionType(): int
    {
        return $this->decision_type;
    }

    /**
     * Get the building type identifier.
     *
     * @return int The building type identifier.
     */
    public function getBuildingTypeId(): int
    {
        return $this->building_type_id;
    }
}
