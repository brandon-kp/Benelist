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
    
    public function recent_model()
    {
        $query = $this->db->get('lists');
        
        if ($query->num_rows() == 0)
        {
            show_error('sup homie');
        }
        else
        {
            return $query->result();
        }
    }
    
    public function create_model($slug, $title, $description, $items, $list_pass)
    {
        $sql = "INSERT INTO `lists` (`slug`, `title`, `description`, `items`, `listpass`) VALUES(?, ?, ?, ?, ?);";
        
        $this->db->query($sql, array($slug, $title, $description, $items, $list_pass)); 
    }
    
    public function edit_model($title, $description, $items, $slug, $list_pass)
    {
        $sql = "UPDATE `lists` 
                SET 
                    `items` = '$items',
                    `title` = '$title',
                    `description` = '$description'
                WHERE 
                    `slug` = '$slug' AND 
                    `listpass` = '$list_pass' 
                LIMIT 1";
        
        $this->db->query($sql);
    }

}

/*

INSERT INTO `benelist`.`lists` (
`id` ,
`slug` ,
`title` ,
`description` ,
`items`
)
VALUES (
NULL , 'z91H6', 'I like turtles', 'This a list of turtles.', 'Leonardo, Michelangelo, Donatello, Raphael'
);


*/