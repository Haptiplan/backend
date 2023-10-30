<?php
/**
 * Die Game-Klasse repräsentiert das Spiel und verwaltet 
 * die Periode und Unternehmen.
 */
class Game{   
    private int $id;
    private int $currentPeriod;
    private array $companies;
    
    /**
     * Setzt beim Erstellen eines Objekts die Periode auf 0 und
     * erstellt ein Unternehmen Array.
     */
    public function __construct()
    {
        $this->currentPeriod = 0;   
        $this->companies = array();        
    }   

    /**
     * Diese Methode erhört den Wert der Periode um 1.
     * 
     * @return void Kein Rückgabenwert.
     */
    public function endPeriod() : void
    { 
        $this->currentPeriod++;
    }    

    /**
     * __toString Methode entscheidet wie die Klasse reagiert, wenn
     * die Klasse wie ein String behandelt wird.
     * 
     * @return string Gibt alle Unternehmen aus.
     */
    public function __toString() : string
    { 
        $output = "";
        foreach($this->companies as $company){ //diplays company array
            $output .= $company;
        }
        return $output;
    }
    
    /**
     * Gibt die ID des Games zurück.
     * 
     * @return int ID des Games.
     */
    public function getGameId() : int
    {
        return $this->id;
    }

    /**
     * Erstellt ein Unternehmen und fügt es in dem Array hinzu.
     * 
     * @param int $id des Unternehmens.
     * @param string $name des Unternehmens.
     * @return $company Das erstellte Unternehmen wird zurückgegeben.
     * 
     */
    public function addCompany(int $id, string $name)
    {
        $company = new Company($id, $name);
        $this->companies[] = $company;
        /*Funktioniert noch nicht-> Es wird nichts eingefügt im json.
        $jsonCompanyData = json_encode($this->companies, JSON_PRETTY_PRINT);
        $companyJsonPath = 'companydata.json';
        file_put_contents($companyJsonPath, $jsonCompanyData);*/
        return $company;   
    }
    
    /**
     * Löscht ein Unternehmen anhand seiner ID aus dem Array.
     * 
     * @param int $id des Unternehmens.
     * 
     */
    public function deleteCompany(int $id)
    {        
        unset($this->companies[$id]);
    }

    /**
     * Verändert die Id und den Namen eines Unternehmens.
     * 
     * @param int $key Welches Element im Array angesprochen werden soll
     * @param int $id Die neue ID des Unternehmens.
     * @param string $name Der neue Name des Unternehmens.
     */
    public function updateCompany(int $key, int $id, string $name)
    {
        $this->companies[$key] = new Company($id, $name); 
    }    
}
