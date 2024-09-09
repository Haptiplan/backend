<?php

/**
 * Class JsonHandler
 *
 * The JsonHandler class provides methods for handling JSON data, including reading, writing, and checking the existence
 * of a JSON file.
 */
class JsonHandler
{
    /**
     * JsonHandler constructor.
     *
     * Creates a new JsonHandler instance. If the specified JSON file does not exist, it initializes it with the provided
     * JSON data.
     *
     * @param string $json_file_path The path to the JSON file.
     * @param array $json_data The initial JSON data to be written to the file if it doesn't exist.
     */
    public function __construct(string $json_file_path, array $json_data)
    {
        if (!$this->checkJsonExists($json_file_path)) {
            file_put_contents($json_file_path, $json_data);
        }
    }

    /**
     * getJsonData method.
     *
     * Reads the content of a JSON file, decodes it, and returns the resulting associative array.
     *
     * @param string $json_file_path The path to the JSON file.
     * @return array The decoded JSON data.
     */
    public function getJsonData(string $json_file_path): array
    {
        $existing_data = json_decode(file_get_contents($json_file_path), true);
        return $existing_data;
    }

    /**
     * setJsonData method.
     *
     * Encodes an associative array as JSON and writes it to the specified JSON file.
     *
     * @param string $json_file_path The path to the JSON file.
     * @param array $existing_data The data to be written to the JSON file.
     */
    public function setJsonData(string $json_file_path, array $existing_data): void
    {
        $json_data = json_encode($existing_data, JSON_PRETTY_PRINT);
        file_put_contents($json_file_path, $json_data);
    }

    /**
     * checkJsonExists method.
     *
     * Checks if the specified JSON file exists.
     *
     * @param string $json_file_path The path to the JSON file.
     * @return bool True if the JSON file exists, false otherwise.
     */
    public function checkJsonExists(string $json_file_path): bool
    {
        $json_exists = false;

        if (file_exists($json_file_path)) {
            $json_exists = true;
        }

        return $json_exists;
    }

    /**
     * last_id_in_the_JSON method.
     *
     * Retrieves the highest 'id' value from the JSON file.
     *
     * @param string $json_file_path The path to the JSON file.
     * @return int The highest 'id' value.
     */
    public function last_id_in_the_JSON(string $json_file_path): int
    {
        $existing_data = $this->getJsonData($json_file_path);

        $array_of_ids = [];

        for ($i = 0; $i < count($existing_data); $i++) {
            $array_of_ids[$i] = $existing_data[$i]['id'];
        }

        if (!empty($array_of_ids)) {
            $max = max($array_of_ids);
        } else {
            $max = 0;
        }

        return $max;
    }
}