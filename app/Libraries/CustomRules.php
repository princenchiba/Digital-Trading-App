<?php namespace App\Libraries;

use Config\Database;

/*FDSFDSFSDFSD*/
class CustomRules
{
  
  public function username_check($username, $uid)
  { 
      $db=  db_connect();
      $builder=$db->table('user_registration');
      $usernameExists = $builder->select('username')
      ->where('username',$username) 
      ->where('uid != ',$uid)
      ->get()
      ->getResult();
      if (!empty($usernameExists)){
          return false;
      } else {
          return true;
      }
  }
     
  public function email_check($email, $uid)
  {
      $db=  db_connect();
      $builder=$db->table('user_registration');
      $emailExists = $builder->select('email')
      ->where('email',$email) 
      ->where('uid != ',$uid)
      ->get()
      ->getResult();
      if (!empty($emailExists)){
          return false;
      }else {
          return true;
      }
  }
  public function admin_email_check($email, $id)
  { 
    $db=  db_connect();
        $builder=$db->table('admin');
        $emailExists = $builder->select('email')
        ->where('email',$email) 
        ->where('id != ',$id)
        ->get()
        ->getResult();
        if (!empty($emailExists)){
            return false;
        }else {
            return true;
        }
  } 
  public function slug_check($headline_en, $article_id)
  { 
      $this->validation     =  \Config\Services::validation();
      $db=  db_connect();
      $builder=$db->table('web_article');
      $packageExists = $builder->select('*')
          ->where('headline_en',$headline_en) 
          ->where('article_id !=',$article_id)
          ->get()
          ->getResult();

      if (!empty($packageExists)) {
          return false;
      } else {
          return true;
      }
  }
  public function news_slug_check($headline_en, $article_id)
  { 
      $this->validation     =  \Config\Services::validation();
      $db=  db_connect();
      $builder=$db->table('web_news');
      $packageExists = $builder->select('*')
          ->where('headline_en',$headline_en) 
          ->where('article_id !=',$article_id)
          ->get()
          ->getResult();

      if (!empty($packageExists)){
             return false;
         }else{
             return true;
         }
  }
        
  public function cat_slug_check($cat_name_en, $cat_id)
  { 
      $this->validation     =  \Config\Services::validation();
      $db=  db_connect();
      $builder=$db->table('web_category');
      $packageExists = $builder->select('*')
          ->where('cat_name_en',$cat_name_en) 
          ->where('cat_id !=',$cat_id)
          ->get()
          ->getResult();
        echo $db->getLastQuery();

      if (!empty($packageExists)){
             return false;
         }else{
             return true;
         }
  } 
  public function callback_coinsym_check($id)
  { 
      $this->validation     =  \Config\Services::validation();
      $db =  db_connect();
      $builder = $db->table('dbt_coinpair');
      $packageExists = $builder->select('*')
          ->where('id !=',$id)
          ->get()
          ->getResult();

      if (!empty($packageExists)){
             return false;
         }else{
             return true;
         }
  }
  
  public function custom_valid_url(string $str = null)
  {
            
    if (empty($str))
    {
      return false;
    }
    elseif (preg_match('/^(?:([^:]*)\:)?\/\/(.+)$/', $str))
    {

      return true;
                    
    }
    return false;
  }

  public function remove_script_test($data = array())
  {

    if (empty($str))
    {
      return false;
    }
    elseif (preg_match('/^(?:([^:]*)\:)?\/\/(.+)$/', $str))
    {

      return true;
                    
    }
    return false;
  }

  public function remove_script($str = null, string $fields, array $data): bool
  {

    foreach ($fields as $field)
    {
      if (array_key_exists($field, $data))
      {
        return false;
      } else {

        return true;

      }
    }
  }

}