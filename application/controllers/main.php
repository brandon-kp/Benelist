<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$time  = microtime();
$time  = explode(" ", $time);
$time  = $time[1] + $time[0];
$start = $time;

class Main extends CI_Controller {

	public function index()
	{
		$this->load->view('main_view');
	}

    public function create()
    {   
        $this->load->helper('form');
        
        $this->load->library('form_validation');

        if($this->input->post('submit') === 'Create List')
        {
            $slug        = substr(uniqid(),-5);
            $title       = $this->input->post('listname');
            $description = $this->input->post('listdesc');
            $items_array = $this->input->post('listitem');

            if(strlen($this->input->post('listpass')) == '0')
            {
                $list_pass = '';
            }
            else
            {
                $list_pass   = sha1($this->input->post('listpass').$this->config->item('encryption_key'));
            }
            
            $this->form_validation->set_rules('listname','Title','xss_clean|max_length[75]');
            $this->form_validation->set_rules('listdesc','Description','xss_clean|max_length[255]');
            $this->form_validation->set_rules('listitem','List Items','xss_clean|callback__filter_list');
            
            $items_array = str_replace('#','[POUND]',$items_array);
            
            $items_string = ''; //We need to initialize this, but make it empty, lest we catch a notice.
            
            foreach($items_array as $ind_item)
            {
                $items_string .= $ind_item.'##';
            }
            
            $items = $items_string;
            
            $this->load->model('Benelist_model');
            
            $this->Benelist_model->create_model($slug, $title, $description, $items, $list_pass);
            
            redirect('main/view/'.$slug);
        }
        else
        {
            $this->load->view('newlist_view');
        }
    }
    
    public function view()
    {
         $slug = $this->uri->segment(3);
         
         if(strlen($slug) > 5)
         {
            show_error('Invalid URL');   
         }
         else
         {
            $this->load->model('Benelist_model');
            
            $this->Benelist_model->view_model($slug);
            //$this->Benelist_model->get_assoc_model($slug);

            $data['result'] = $this->Benelist_model->view_model($slug);
            $data['items']  = explode('##',$data['result'][0]->items); //convert the string of items into array
            $count          = count($data['items'])-1;
            
            unset($data['items'][$count]); //get rid of the empty array item caused by the appended '##' to each item
            
            $data['items']       = str_replace('[POUND]','#',$data['items']);
            $data['title']       = $data['result'][0]->title;
            $data['description'] = $data['result'][0]->description;
            $data['list_pass']   = $data['result'][0]->listpass;
            $data['slug']        = $slug;
            
            if(strlen($data['list_pass']) == 0)
            {
                $data['show_edit'] = FALSE; //there is no password set, don't show the edit link
            }
            else
            {
                $data['show_edit'] = TRUE;
            }
        
            if($this->uri->segment(4) === 'print')
            {
                $this->load->view('printlist_view', $data);
            }
            else
            {
				$data['assoc'] = $this->Benelist_model->get_assoc_model($slug);
                $this->load->view('viewlist_view', $data);
            }
            
         }
    }
    
    public function recent()
    {
         $this->load->model('Benelist_model');
         
         $this->Benelist_model->recent_model();
         
         $data['result'] = $this->Benelist_model->recent_model();
         
         $this->load->view('viewall_view.php', $data); 
    }
    
    public function _filter_list($listitem)
    {
        str_replace('#','&#0023;',$listitem);
    }
    
    public function edit(){
        $slug = $this->uri->segment(3);
        $this->load->helper('form');
        $this->load->library('form_validation');
        
         if(strlen($slug) > 5)
         {
            show_error('Invalid URL');
            exit;
         }
        
        $this->load->model('Benelist_model');
        
        $this->Benelist_model->view_model($slug);
        $data['result'] = $this->Benelist_model->view_model($slug);
        
        $data['id']          = $data['result'][0]->id;
        $data['slug']        = $data['result'][0]->slug;
        $data['title']       = $data['result'][0]->title;
        $data['description'] = $data['result'][0]->description;
        $data['listpass']    = $data['result'][0]->listpass;
        $data['items']       = explode('##',$data['result'][0]->items); //convert the string of items into array
        $count               = count($data['items'])-1;
        
        unset($data['items'][$count]);
        $data['items']       = str_replace('[POUND]','#',$data['items']);
        
        if(sha1($this->input->post('listpass').$this->config->item('encryption_key')) === $data['listpass'])
        {
            $title       = $this->input->post('listname');
            $description = $this->input->post('listdesc');
            $items_array = $this->input->post('listitem');
            $list_pass   = $data['listpass'];
            
            $this->form_validation->set_rules('listname','Title','xss_clean|max_length[75]');
            $this->form_validation->set_rules('listdesc','Description','xss_clean|max_length[255]');
            $this->form_validation->set_rules('listitem','List Items','xss_clean|callback__filter_list');
            
            $items_array = str_replace('#','[POUND]',$items_array);
            
            $items_string = ''; //We need to initialize this, but make it empty, lest we catch a notice.
            
            foreach($items_array as $ind_item)
            {
                $items_string .= $ind_item.'##';
            }
            
            $items = $items_string;
            
            
            $this->Benelist_model->edit_model($title, $description, $items, $slug, $list_pass);
        }
        
        $this->load->view('editlist_view', $data);
    }
    
    public function clonelist()
    {
        $slug = $this->uri->segment(3);
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        if(strlen($slug) > 5)
        {
            show_error('Invalid URL');
            exit;
        }
        
        $this->load->model('Benelist_model');
        
        $this->Benelist_model->view_model($slug);
        $data['result'] = $this->Benelist_model->view_model($slug);
        
        $data['id']          = $data['result'][0]->id;
        $data['slug']        = $data['result'][0]->slug;
        $data['title']       = $data['result'][0]->title;
        $data['description'] = $data['result'][0]->description;
        $data['listpass']    = $data['result'][0]->listpass;
        $data['items']       = explode('##',$data['result'][0]->items); //convert the string of items into array
        $count               = count($data['items'])-1;
        
        unset($data['items'][$count]); //the last item is always  empty. This gets rid of it.
        $data['items']       = str_replace('[POUND]','#',$data['items']);

        if($this->input->post('submit') === 'Clone List')
        {
            $slug        = substr(uniqid(),-5);
            $title       = $this->input->post('listname');
            $description = $this->input->post('listdesc');
            $items_array = $this->input->post('listitem');
            $assoc       = $this->uri->segment(3);

            if(strlen($this->input->post('listpass')) == '0')
            {
                $list_pass = '';
            }
            else
            {
                $list_pass   = sha1($this->input->post('listpass').$this->config->item('encryption_key'));
            }
            
            $this->form_validation->set_rules('listname','Title','xss_clean|max_length[75]');
            $this->form_validation->set_rules('listdesc','Description','xss_clean|max_length[255]');
            $this->form_validation->set_rules('listitem','List Items','xss_clean|callback__filter_list');
            
            $items_array = str_replace('#','[POUND]',$items_array);
            
            $items_string = ''; //We need to initialize this, but make it empty, lest we catch a notice.
            
            foreach($items_array as $ind_item)
            {
                $items_string .= $ind_item.'##';
            }
            
            $items = $items_string;
            
            $this->load->model('Benelist_model');
            
            $this->Benelist_model->clonelist_model($slug, $title, $description, $items, $list_pass, $assoc);
            
            redirect('main/view/'.$slug);
        }
        
        $this->load->view('clonelist_view', $data);      
    }
    
    function info()
    {  
        $controllerDir = glob("application/controllers/*.php");
        
        foreach($controllerDir as $controller_Dir)
        {
            $controllers = file_get_contents($controller_Dir);
            
            if (preg_match_all ("/(.*?)(function)(\s+)((?:[a-z][a-z]+))/is", $controllers, $matches))
            {
                $functionList = array();
                
                foreach($matches[4] as $listem)
                {
                    array_push($functionList, $listem);   
                }
                
                global $totaltime, $start;
                
                $time                  = microtime();
                $time                  = explode(" ", $time);
                $time                  = $time[1] + $time[0];
                $finish                = $time;
                $totaltime             = ($finish-$start);
                $data['totaltime']     = substr($totaltime,0,5);
                $data['function_list'] = $functionList;
                
                $data['footer'] = $this->load->view('footer.php',$data);
            }
        }
    }
}