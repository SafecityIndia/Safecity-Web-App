<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Language_model extends CI_Model {

	protected $table_name = 'languages';

	/**
	 * Get Autocomplete results
	 * @param  string  $query  		User text query
	 * @param  integer $client_id
	 * @return Array
	 */
	public function getAutocomplete($client_id)
	{
		$this->db->select('l.*');
		$this->db->from($this->table_name.' as l');
		$this->db->join('client_languages as cl', 'cl.language_id=l.id');
		$this->db->where('cl.client_id', $client_id);
		$this->db->order_by('name');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getTableColumns($table_name)
	{
		//SELECT column_name FROM information_schema.columns WHERE table_name=$table_name; 
		return $this->db->list_fields($table_name);
	}

	public function getData($table_name, $lang_id)
	{
		$this->db->where('lang_id', $lang_id);
		$query = $this->db->get($table_name);
    	$result = $query->result_array();

        if($result) {
            return $result;
        }
        return FALSE;
    }

	public function importBulkData($table_name, $data)
	{
		$result = $this->db->insert_batch($table_name, $data);
        if($result) {
            return TRUE;
        }
        return FALSE;
    }

    public function updateBulkData($table_name, $data)
	{
		$result = $this->db->update_batch($table_name,$data, 'id');
        if($result) {
            return TRUE;
        }
        return FALSE;
    }

    public function deleteBulkData($table_name, $lang_id)
	{
		$result = $this->db->delete($table_name, array('lang_id' => $lang_id));
        if($result) {
            return TRUE;
        }
        return FALSE;
    }

}