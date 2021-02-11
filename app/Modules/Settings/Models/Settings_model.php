<?php namespace App\Modules\Settings\Models;

class Settings_model
{
	
	public function __construct()
  {
    $this->db = db_connect();
  }
  
  public function findAllPageContend($where = array(), $limit = 5, $offset = 0)
  {
    $builder = $this->db->table('web_article');
    $builder->select('web_article.*, web_category.cat_name_en, web_category.cat_name_fr');
    $builder->join('web_category', 'web_category.cat_id = web_article.cat_id', 'left');
    $builder->where($where);
    $builder->limit($limit, $offset);
    $query = $builder->get();
    return $data = $query->getResult();
  }

  public function findAllNews($where = array(), $limit = 5, $offset = 0)
  {
    $builder = $this->db->table('web_news');
    $builder->select('web_news.*, web_category.cat_name_en, web_category.cat_name_fr');
    $builder->join('web_category', 'web_category.cat_id = web_news.cat_id', 'left');
    $builder->where($where);
    $builder->limit($limit, $offset);
    $builder->orderBy('article_id', 'desc');
    $query = $builder->get();
    return $data = $query->getResult();
  }
}