<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{
	var $countries_table = "countries";
	var $cities_table = "cities";
	var $select_countries_column = array("country_id", "country_name");
	var $select_cities_column = array("id", "city_name");
	//var $select_countries_column = array("country_id","country_name","country_code","iso_code");
	//var $select_cities_column = array("id","country_id","state_id","city_name");

	private $_countryID, $_countryName, $_cityID, $_cityName;

    // set country id
    public function setCountryID($countryID) {
        return $this->_countryID = $countryID;
    }
    // set country Name
    public function setCountryName($countryName) {
        return $this->_countryName = $countryName;
    }

    // set city id
    public function setCityID($cityID) {
        return $this->_cityID = $cityID;
    }
    // set city Name
    public function setCityName($cityName) {
        return $this->_cityName = $cityName;
    }

    // code change by sonam - get All Countries - 23-10-2020 start
    public function getHelpAllCountries() {
        $this->db->select('e.id, c.name');
        $this->db->from('emergency_helpline as e');
        $this->db->join('countries as c','c.id = e.country_id');
        $this->db->group_by('c.name');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    // code change by sonam - get All Countries - 23-10-2020 end


    // get All Countries
    public function getAllCountries() {
        $this->db->select(array('c.id as country_id', 'c.name as country_name'));
        $this->db->from('countries as c');
        $this->db->like('c.name', $this->_countryName, 'both');
        $query = $this->db->get();
        return $query->result_array();
    }

    // get All Cities
    public function getAllCities() {
    	//echo $this->_countryID;
        $this->db->select(array('c.id as city_id', 'c.name as city_name'));
        $this->db->where('c.country_id', $this->_countryID);
        $this->db->from('cities as c');
        $this->db->like('c.name', $this->_cityName, 'both');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSearchCities($title) {
        /*$this->db->select(array('c.id as city_id', 'c.city_name as city_name'));
        $this->db->from('cities as c');
        $this->db->like('c.city_name', $this->_cityName, 'both');
        $query = $this->db->get();
        return $query->result_array();*/
        $this->db->like('name', $title , 'both');
        $this->db->order_by('name', 'ASC');
        $this->db->limit(10);
        return $this->db->get('cities')->result();
    }

	/*function fetch_country($query)
	{
		$this->db->select($this->select_countries_column);
	  	$this->db->from($this->countries_table);
	  	if(trim($query) != '')
	  	{
	   		$this->db->like('country_name', trim($query), 'both');
	  	}
	  	$this->db->limit(10);
	  	//$this->db->order_by('country_name', 'ASC');
	  	//return $this->db->get($this->countries_table)->result();
	  	$query = $this->db->get();
        $results = $query->result_array();
        return $results;
	}*/

	/*function fetch_city($query)
	{
	  	$this->db->select($this->select_cities_column);
	  	//$this->db->from($this->cities_table);
	  	if($query != '')
	  	{
	   		$this->db->like('city_name', $query, 'both');
	  	}
	  	$this->db->limit(10);
	  	//$this->db->order_by('city_name', 'ASC');
	  	return $this->db->get($this->cities_table)->result();
	}*/
}