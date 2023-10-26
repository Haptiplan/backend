<?php

class Game{   
    private int $id;
    private int $currentPeriod = 0;
    private array $companies;
    
    public function __construct()
    {
        $this->currentPeriod = 0;   
        $this->companies = array();        
    }   

    public function endPeriod() : void
    { 
        $this->currentPeriod++;
    }    

    public function __toString() : string
    { 
        $output = "";
        foreach($this->companies as $company){ //diplays company array
            $output .= $company . "<br>";
        }
        return $output;
    }
    
    public function getId() : int
    {
        return $this->id;
    }

    public function add($id, $name)
    {
        $company = new Company($id, $name);
        $this->companies[] = $company;

        /*Funktioniert noch nicht-> Es wird nichts eingefügt im json.
        $jsonCompanyData = json_encode($this->companies, JSON_PRETTY_PRINT);
        $companyJsonPath = 'companydata.json';
        file_put_contents($companyJsonPath, $jsonCompanyData);*/

        return $company;
        
    }
    
    public function delete(int $id)
    {        
        unset($this->companies[$id]);
    }

    public function update(int $key, int $id, string $name)
    {
        $this->companies[$key] = new Company($id, $name); 
    }    
}
?>