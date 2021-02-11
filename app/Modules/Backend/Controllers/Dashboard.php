<?php namespace App\Modules\Backend\Controllers;


class Dashboard extends BaseController
{
    public function index()
    {

        $data['total_user']       = $this->M_crud->countRow('dbt_user', array('status'=>1));
        $data['total_market']     = $this->M_crud->countRow('dbt_coinpair');
        $data['total_trade']      = $this->M_crud->countRow('dbt_biding_log');
        $data['coins']            = $this->M_crud->get_all('dbt_cryptocoin', array('status'=>1), 'rank','asc',10000,0);
        $data['trade_history']    = $this->dashboard_model->marketTradeHistory();

        $maxBuyCurrency           = "SELECT currency_symbol, sum(complete_amount) as totalBuyAmount, count(*) as buycount FROM dbt_biding_log where `bid_type` = 'BUY' AND `status`= '1' GROUP BY currency_symbol ORDER BY buycount DESC Limit 1";
        $data['maxBuyCurrency']   =  $this->db->query($maxBuyCurrency, [])->getRow(); 

        $maxSellCurrency           = "SELECT currency_symbol, sum(complete_amount) as totalSellAmount, count(*) as sellcount FROM dbt_biding_log where `bid_type` = 'SELL' AND `status`= '1' GROUP BY currency_symbol ORDER BY sellcount DESC Limit 1";
        $data['maxSellCurrency']   =  $this->db->query($maxSellCurrency, [])->getRow();   

        $data['title']  = 'Dashboard';
        $data['module'] = "Backend";
        $data['page']   = 'dashboard/home'; 
        return $this->template->layout($data);
    }

    public function total_referral_value()
    {

        $sql = "SELECT `currency_symbol`, SUM(`transaction_amount`) as transaction_amount FROM dbt_balance_log WHERE `transaction_type`='REFERRAL' GROUP BY `currency_symbol` ORDER BY `dbt_balance_log`.`currency_symbol` ASC";
        $referral_value = $this->db->query($sql, [])->getResult();

        echo json_encode(array('referral_value' => $referral_value));
    }

    public function all_fees_value()
    {
        
        $result  = array();
        $results = array();

        $sql = "SELECT `currency_symbol`, SUM(`transaction_fees`) as fees_amount FROM dbt_balance_log WHERE `transaction_type`!='REFERRAL' GROUP BY `currency_symbol` ORDER BY `dbt_balance_log`.`currency_symbol` ASC";
        $all_fees_balance = $this->db->query($sql, [])->getResult();

        $sql2 = "SELECT IF(`bid_type`='BUY', SUBSTRING_INDEX(`market_symbol`,'_',-1), `currency_symbol`) as currency_symbol, SUBSTRING_INDEX(`market_symbol`,'_',-1) as currency_symbol2, SUM(`fees_amount`) as fees_amount FROM dbt_biding WHERE `status`=1 GROUP BY IF(`bid_type`='BUY', `currency_symbol2`, `currency_symbol`) ORDER BY `dbt_biding`.`currency_symbol` ASC";
        $all_fees_trade = $this->db->query($sql2, [])->getResult();

        $results = array_merge($all_fees_balance, $all_fees_trade);

        foreach ($results as $key => $value) {
            $sum_value =0;
            foreach ($results as $keyt => $valuet) {
                if ($valuet->currency_symbol == $value->currency_symbol) {
                    $sum_value += $valuet->fees_amount;
                }
            }
            
            array_push($result, 
                array(
                    'currency_symbol' => $value->currency_symbol,
                    'total_qty'       => $sum_value,
                )
            );
        }

        echo json_encode(array('fees_value' => $result));
    }

    
    public function monthly_buy_sell(){

        $currecy_symbol = $this->request->getPost('symbol');
        if(!empty($currecy_symbol)){

            $symbol = $currecy_symbol;

        } else {

            $symbol = "BTC";
        }

        $monthly_monthlyBuy   = $this->dashboard_model->monthlyBuy($symbol);
        $monthly_monthlySell  = $this->dashboard_model->monthlySell($symbol);
     
        $monthBuy = array();
        $monthSell = array();
        
        $buyMonth  = '';
        $buyAmount = '';
        foreach ($monthly_monthlyBuy as $key => $value) {
            $buyMonth .=  $value->month.', ';
            $buyAmount .= $value->totalBuy.', ';

            array_push($monthBuy,$value->month);
        }
        $buyMonth     = rtrim($buyMonth, ", "); 
        $buyAmount   = rtrim($buyAmount, ", ");


        //withdraw chart data start
        $sellMonth = '';
        $sellAmount = '';
        foreach ($monthly_monthlySell as $key => $value) {
            $sellMonth  .= $value->month.', ';
            $sellAmount .= $value->totalSell.', ';

            array_push($monthSell,$value->month);
        }
        $sellMonth    = rtrim($sellMonth, ", "); 
        $sellAmount   = rtrim($sellAmount, ", ");
        //withdraw chart data emn

        $linechartDepositdata = array('buy_months' => $buyMonth,'buy_amount' => $sellAmount, 'sell_month' => $sellMonth, 'sell_amount' => $sellAmount);

        echo json_encode($linechartDepositdata);
       
    }
    public function deposit_withdraw_transfer_chart_data(){

        $currecy_symbol = $this->request->getPost('symbol');
        if(!empty($currecy_symbol)){

            $symbol = $currecy_symbol;

        } else {

            $symbol = "USD";
        }

        $monthly_deposit  = $this->dashboard_model->monthlyDeposit($symbol);
        $monthly_withdraw = $this->dashboard_model->monthlyWithdraw($symbol);
        $monthly_transfer = $this->dashboard_model->monthlyTransfer($symbol);

        $monthsd = array();
        $monthsw = array();
        $monthst = array();

        $depomonth = '';
        $depoamount = '';
        foreach ($monthly_deposit as $key => $value) {
            $depomonth .=  $value->month.', ';
            $depoamount .= $value->deposit.', ';

            array_push($monthsd,$value->month);
        }
        $depomonth     = rtrim($depomonth, ", "); 
        $depoamount   = rtrim($depoamount, ", ");


        //withdraw chart data start
        $withamount = '';
        foreach ($monthly_withdraw as $key => $value) {
            $withamount .= $value->withdraw.', ';
        }
        $withamount   = rtrim($withamount, ", ");
        //withdraw chart data end

        //trans chart data start
        $transAmount = '';
        foreach ($monthly_transfer as $key => $value) {
            $transAmount .= $value->transfer.', ';
        }
     
        $transAmount   = rtrim($transAmount, ", ");
        //trans chart data end
        $linechartDepositdata = array('dep_months' => $depomonth,'dep_amount' => $depoamount, 'with_amount' => $withamount, 'trans_amount' => $transAmount);

        echo json_encode($linechartDepositdata);
       
    }

    public function user_growth()
    {     
       
        $user_growth = $this->dashboard_model->userGrowth($this->request->getPost('user_growth'));
       
        //if (!empty($user_growth)) {

            $toaluser = '';
            $months = '';

            foreach ($user_growth as $key => $value) {
                $toaluser .= ''.$value->totaUsers.',';
                $months .= ''.$value->month.',';
            }

            $toaluser          = rtrim($toaluser, ","); 
            $months            = rtrim($months, ",");
            $forecastChartData = array('months' => $months,'toaluser' => $toaluser);
            echo json_encode($forecastChartData);
        //}
    }

    public function linechart_fees_data()
    {     
        $currecy_symbol = $this->request->getPost('symbol');

        if(!empty($currecy_symbol)){

            $symbol = $currecy_symbol;

        } else {

            $symbol = "BTC";
        }
        $currentMonthFeesTotal = $this->dashboard_model->currentMonthFeesTotal($symbol);

        echo json_encode($currentMonthFeesTotal);
    }

  
    public function profile()
    {
        $data['title']    = display('profile'); 
        $data['user']     = $this->M_crud->findById('admin', array('id'=>$this->session->get('id')));

        $data['module'] = "Backend";
        $data['page']   = 'dashboard/profile'; 
        return $this->template->layout($data);  
    }

    public function edit_profile()
    { 
        $data['title'] = display('edit_profile');
        $id            = $this->session->get('id');

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'firstname' => 'required|max_length[100]', 
                'lastname'  => 'required|max_length[50]',
                'email'     => 'required|valid_email|max_length[100]',
                'about'     => 'max_length[1000]',
                'image'     => 'ext_in[image,png,jpg,gif,ico]|is_image[image]'
            ];
          
            $image = '';
            if($img = $this->request->getFile('image', FILTER_SANITIZE_STRING))
            {
                if ($img->isValid() && ! $img->hasMoved())
                {
                    $image = $img->getRandomName();
                    $img->move('./upload/settings', $image);
                }
            }

            if(empty($img->getClientExtension())){
                $image = $this->request->getVar('old_image', FILTER_SANITIZE_STRING);
            } else {
                $image = 'upload/settings/'.($image);
            }

            $existInfo = $this->M_crud->findById('admin', array('id'=>$id));

            if(!empty($this->request->getVar('password'))){

                $passwordNew = md5($this->request->getVar('password'));

            } else if(empty($existInfo)){

                $rules = ['password' => 'required|max_length[32]|md5'];
                $passwordNew = md5($this->request->getVar('password', FILTER_SANITIZE_STRING));

            } else {

                $passwordNew = $existInfo->password;
            }

            $data['user'] = (object)$userData = array(

                'firstname'   => $this->request->getVar('firstname', FILTER_SANITIZE_STRING),
                'lastname'    => $this->request->getVar('lastname', FILTER_SANITIZE_STRING),
                'email'       => $this->request->getVar('email', FILTER_SANITIZE_STRING),
                'password'    => $passwordNew,
                'about'       => $this->request->getVar('about', FILTER_SANITIZE_STRING),
                'image'       => $image 
            );
          
            if ($this->validate($rules, $rules)) {

               
                if (empty($userData['image'])) {
                    $this->session->setflashdata('exception', "Your are not any selected image!"); 
                }

                if ($this->M_crud->update('admin',$userData, array('id' => $id))) 
                {

     
                    $this->session->set(array(
                        'fullname'   => $this->request->getVar('firstname', FILTER_SANITIZE_STRING). ' ' .$this->request->getVar('lastname', FILTER_SANITIZE_STRING),
                        'email'      => $this->request->getVar('email', FILTER_SANITIZE_STRING),
                        'image'      => (!empty($image)?$image:$this->request->getVar('old_image', FILTER_SANITIZE_STRING))
                    ));

                    $this->session->setflashdata('message', display('update_successfully'));

                } else {
                    $this->session->setflashdata('exception',  display('please_try_again'));
                    return redirect()->route('dashboard/edit-profile');

                }
                return redirect()->route('dashboard/edit-profile');
            }  else {

                $this->session->setFlashdata("exception", $this->validation->listErrors());
                return redirect()->route('dashboard/edit-profile');
            }
        } else {

            $data['user']   = $this->M_crud->findById('admin', array('id' => $id));
            $data['module'] = "Backend";
            $data['page']   = 'dashboard/edit_profile'; 
            return $this->template->layout($data);  
        }

    }


    public function confirm_withdraw()
    {
        $set_status   = 1;
        $user_id      = $this->request->getVar('user_id');
        $id           = $this->request->getVar('id');
        $data         = array(
            'success_date' =>date('Y-m-d h:i:s'),
            'status' => $set_status,
        );

        $this->M_crud->update('dbt_withdraw', $data, array('user_id'=>$user_id, 'id' => $id));

        $t_data             = $this->M_crud->findById('dbt_withdraw', array('id' => $id, 'user_id' => $user_id));
        $userinfo           = $this->M_crud->findById('dbt_user', array('user_id' => $user_id));
        $set                = $this->M_crud->findById('sms_email_send_setup', array('method' => 'email'));
        $appSetting         = $this->template->setting_data();
        $check_user_balance = $this->M_crud->findById('dbt_balance', array('user_id' => $user_id, 'currency_symbol' =>$t_data->currency_symbol));

        $new_balance = $check_user_balance->balance-($t_data->amount+$t_data->fees_amount);
        $newbalance['balance'] = $check_user_balance->balance-($t_data->amount+$t_data->fees_amount);
        $this->M_crud->update('dbt_balance', $newbalance, array('user_id'=>$user_id, 'currency_symbol' => $t_data->currency_symbol));

        //User Financial Log
        if ($check_user_balance) {

            $depositdata = array(
                'user_id'            => $user_id,
                'balance_id'         => $check_user_balance->id,
                'currency_symbol'    => $t_data->currency_symbol,
                'transaction_type'   => 'WITHDRAW',
                'transaction_amount' => $t_data->amount,
                'transaction_fees'   => $t_data->fees_amount,
                'ip'                 => $t_data->ip,
                'date'               => $t_data->request_date
            );

            //balance log save
            $this->M_crud->save('dbt_balance_log', $depositdata);
        }

        
        #----------------------------
        #      email verify smtp
        #----------------------------
        $post = array(
            'title'             => $appSetting->title,
            'subject'           => 'Withdraw',
            'to'                => $this->session->get('email'),
            'message'           => 'You successfully withdraw the amount Is '.$t_data->amount.'. from your account. Your new balance is '.$new_balance,
        );

        $send = $this->M_crud->send_email($post);
        if($send){
                $n = array(
                'user_id'                => $user_id,
                'subject'                => display('withdraw'),
                'notification_type'      => 'withdraw',
                'details'                => 'You successfully withdraw the amount Is '.$t_data->amount.'. from your account. Your new balance is '.$new_balance,
                'date'                   => date('Y-m-d h:i:s'),
                'status'                 => '0'
            );
            //notification save
            $this->M_crud->save('notifications',$n);    
        }

        #----------------------------
        #      Sms verify
        #----------------------------


        $template = array( 
            'name'          => $userinfo->first_name." ".$userinfo->last_name,
            'amount'        => $t_data->amount,
            'new_balance'   => $new_balance,
            'date'          => date('d F Y')
        );

        if (@$userinfo->phone) {
            $send_sms = $this->sms_lib->send(array(
                'to'              => $userinfo->phone, 
                'subject'         => 'Withdraw',
                'template'        => 'You successfully withdraw the amount is %amount% from your account. Your new balance is %new_balance%', 
                'template_config' => $template, 
            ));

        } else {
            $this->session->setFlashdata('exception', display('there_is_no_phone_number'));
        }
                
        if(@$send_sms){
            $message_data = array(
                'sender_id'   => 1,
                'receiver_id' => $userinfo->user_id,
                'subject'     => 'Withdraw',
                'message'     => 'You successfully withdraw the amount is '.$t_data->amount.'. from your account. Your new balance is '.$new_balance,
                'datetime'    => date('Y-m-d h:i:s'),
            );

            //message save;
            $this->M_crud->save('message', $message_data);
        }

        return redirect()->route('dashboard/home');
    }

    public function cancel_withdraw()
    {
        $set_status = 0;
        $user_id    = $this->request->getVar('user_id');
        $id         = $this->request->getVar('id');

        $data = array(
            'cancel_date' =>date('Y-m-d h:i:s'),
            'status'      => $set_status,
        );

        $this->M_crud->update('dbt_withdraw', $data, array('id' => $id, 'user_id' => $user_id));
        $this->session->setFlashdata('message', 'Withdraw Cancel successfully!');

        return redirect()->route('dashboard/home');
    }
}
