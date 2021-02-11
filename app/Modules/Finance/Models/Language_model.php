<?php namespace App\Modules\Backend\Models;
use CodeIgniter\Model;
class Language_model extends Model
{

	    protected $table         = 'language';
        protected $phrase        = 'phrase';
        protected $setting_table = 'setting';
        protected $default_lang  = 'english';
    public function __construct()
    {
        $this->db = db_connect();

    }


       public function languages()
    { 
        if ($this->db->tableExists($this->table)) { 

                $fields = $this->db->getFieldNames($this->table);

                $i = 1;
                foreach ($fields as $field)
                {  
                    if ($i++ > 2)
                    $result[$field] = ucfirst($field);
                }

                if (!empty($result)) return $result;
 

        } else {
            return false; 
        }
    }


        public function phrases($languages)
    {
        if ($this->db->tableExists($this->table)) {

            if ($this->db->fieldExists($this->phrase, $this->table)) {


              $builder = $this->db->table('language')
                             ->orderBy($this->phrase,'asc')
                             ->get()
                             ->getResult(); 
        return $builder;

            }  

        } 

        return false;
    }


        public function getPhrases($postData=null){
         $response = array();
         ## Read value
      
         $draw = $postData['draw'];
         $start = $postData['start'];
         $rowperpage = $postData['length']; // Rows display per page
         $columnIndex = $postData['order'][0]['column']; // Column index
         $columnName = $postData['columns'][$columnIndex]['data']; // Column name
         $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
         $searchValue = $postData['search']['value']; // Search value
         $language = $postData['language'];
         ## Search 
         $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (phrase like '%".$searchValue."%') ";
         }
         ## Total number of records without filtering
           $builder1 = $this->db->table('language');
           $builder1->select("count(*) as allcount");
               if($searchValue != ''){
                   $builder1->where($searchQuery);
               }
                   $query   =  $builder1->get();
                   $records =   $query->getRow();
         $totalRecords = $records->allcount;
         
         ## Total number of record with filtering
           $lang2 = $this->db->table('language');
           $lang2->select("count(*) as allcount");
               if($searchValue != ''){
                   $lang2->where($searchQuery);
               }
                   $query2   =  $lang2->get();
                   $records =   $query2->getRow();
         $totalRecordwithFilter = $records->allcount;
        ## Fetch records
          $lang3 = $this->db->table('language');
          $lang3->select("*");
        if($searchValue != ''){
           $lang3->where($searchQuery);
               }
         $lang3->orderBy($columnName, $columnSortOrder);
         $lang3->limit($rowperpage, $start);
         $query3   =  $lang3->get();
         $records =   $query3->getResultArray();
         $data = array();
         $sl =1;
        
         foreach($records as $record ){ 
            $label = '';
            if(empty($record[$language])){
                $borderclass = 'is-invalid';
                
            }else{
                $borderclass = '';
            }
            $label ='<input type="hidden" name="phrase[]" value="'.$record['phrase'].'" class="form-control" readonly><input type="text" name="lang[]" value="'.$record[$language].'" class="form-control '.$borderclass.'">';
            $data[] = array( 
                'sl'         => $sl,
                'phrase'     => $record['phrase'],
                 $language   => $label,
    
                
            ); 
            $sl++;
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
         );

         return $response; 
    }
   
}
?>