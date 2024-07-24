<?php

class RestCountriesAPI {
    private $baseUrl = 'https://restcountries.com/v3.1';

    public function fetchCountries() {
        return $this->fetchData("{$this->baseUrl}/all");
    }

    public function fetchCountriesByCurrency($currency) {
        return $this->fetchData("{$this->baseUrl}/currency/{$currency}");
    }

    public function fetchCountriesByLanguage($language) {
        return $this->fetchData("{$this->baseUrl}/lang/{$language}");
    }

    public function fetchCountriesByCapital($capital) {
        return $this->fetchData("{$this->baseUrl}/capital/{$capital}");
    }

    public function fetchCountriesByRegion($region) {
        return $this->fetchData("{$this->baseUrl}/region/{$region}");
    }

    private function fetchData($url) {
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}
