<?php namespace App\Modules\Trade\Controllers;


class TradeController extends BaseController
{
    /**
    * Constructor.
    */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        
        if (!$this->session->get('isLogIn')){
            return redirect()->route('admin/login');
        }
    }
   

    public function open_order(){


        $page_number      = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        $data['open_trade']  = $this->M_crud->get_all('dbt_biding', array('status' => 2), 'id','desc',20,($page_number-1)*20);
        $total            = $this->M_crud->countRow('dbt_biding', array('status' => 2));
        $data['pager']    = $this->pager->makeLinks($page_number, 20, $total);


        $data['title']  = 'Open Order List';
        $data['module'] = "Trade";
        $data['page']   = 'exchange/open_order'; 
        return $this->template->layout($data);
    } 

    public function trade_history(){


        $page_number            = (!empty($this->request->getVar('page'))?$this->request->getVar('page'):1);
        $total                  = $this->M_crud->countRow('dbt_biding', array());
        $data['trade_history']  = $this->trade_model->get_trade_history(20,($page_number-1)*20);
        $data['pager']          = $this->pager->makeLinks($page_number, 20, $total);


        $data['title']  = 'Open Order List';
        $data['module'] = "Trade";
        $data['page']   = 'exchange/trade_history'; 
        return $this->template->layout($data);
    }
    
}
