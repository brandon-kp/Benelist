<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Benelist_model extends CI_Model {

	public function view_model($slug)
	{
		$query = $this->db->get_where('lists', array('slug' => $slug));

        if ($query->num_rows() == 0)  
        {  
            show_error('Database is empty!');  
        }
        else
        {  
            return $query->result();
        }  
	}
    
    public function recent_model($offset = '0')
    {
		//$offset = '0';
        $query = $this->db->query("SELECT * FROM `lists` LIMIT $offset , 20");
        
        if ($query->num_rows() == 0)
        {
            show_error('sup homie');
        }
        else
        {
            return $query->result();
        }
    }
    
    public function create_model($slug, $title, $description, $items, $list_pass, $time)
    {
        $sql = "INSERT INTO `lists` (`slug`, `title`, `description`, `items`, `listpass`, `time`) VALUES(?, ?, ?, ?, ?, ?);";
        
        $this->db->query($sql, array($slug, $title, $description, $items, $list_pass, $time)); 
    }
    
    public function clonelist_model($slug, $title, $description, $items, $list_pass, $assoc)
    {
        $sql = "INSERT INTO `lists` (`slug`, `title`, `description`, `items`, `listpass`, `assoc`) VALUES(?, ?, ?, ?, ?, ?);";
        
        $this->db->query($sql, array($slug, $title, $description, $items, $list_pass, $assoc)); 
    }
    
    public function edit_model($title, $description, $items, $slug, $list_pass)
    {
        $title       = $this->db->escape($title);
        $description = $this->db->escape($description);
        $items       = $this->db->escape($items);
        $list_pass   = $this->db->escape($list_pass);
        
        $sql = "UPDATE `lists` 
                SET 
                    `items` = $items,
                    `title` = $title,
                    `description` = $description
                WHERE 
                    `slug` = $slug AND 
                    `listpass` = $list_pass 
                LIMIT 1";
        
        $this->db->query($sql);
    }
    
    public function get_assoc_model($slug)
    {	
        $slug  = $this->db->escape($slug);
        
		$query = $this->db->query("SELECT `slug`,`title`,`description` FROM `lists` WHERE `assoc` = ".$slug."");
		
		return $query->result();
    }

}