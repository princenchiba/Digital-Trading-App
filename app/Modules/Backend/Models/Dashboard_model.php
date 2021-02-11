<?php namespace App\Modules\Backend\Models;

class Dashboard_model
{
	
	public function __construct()
    {
        $this->db = db_connect();
    }

    public function monthlyDeposit($currency = 'USD')
	{

		$sql = "SELECT MONTHNAME(`deposit_date`) as month, SUM(`amount`) as deposit FROM `dbt_deposit` WHERE `currency_symbol`='".$currency."' AND `status`='1' GROUP BY YEAR(`deposit_date`), MONTH(`deposit_date`)";
        return $this->db->query($sql, [])->getResult();
	}

	public function monthlyWithdraw($currency = 'USD')
	{

		$sql = "SELECT MONTHNAME(`request_date`) as month, SUM(`amount`) as withdraw FROM `dbt_withdraw` WHERE `currency_symbol`='".$currency."' AND `status`='1' GROUP BY YEAR(`request_date`), MONTH(`request_date`)";
        return $this->db->query($sql, [])->getResult();
	}

	public function monthlyTransfer($currency = 'USD')
	{

		$sql = "SELECT MONTHNAME(`date`) as month, SUM(`amount`) as transfer FROM `dbt_transfer` WHERE `currency_symbol`='".$currency."' AND `status`='1' GROUP BY YEAR(`date`), MONTH(`date`)";
        return $this->db->query($sql, [])->getResult();
	}

	public function userGrowth($year = '')
	{
		if(empty($year)){

			$sql = "SELECT MONTHNAME(`created_date`) as month, COUNT(`user_id`) as totaUsers FROM `dbt_user` GROUP BY YEAR(`created_date`), MONTH(`created_date`)";

		} else {

			$sql = "SELECT MONTHNAME(`created_date`) as month, COUNT(`user_id`) as totaUsers FROM `dbt_user` WHERE YEAR(`created_date`) = '".$year."' GROUP BY YEAR(`created`), MONTH(`created_date`)";
		}

        return $this->db->query($sql, [])->getResult();
	}

	public function monthlyFees($currency = 'BTC')
	{

		$sql = "SELECT MONTHNAME(`success_time`) as month, SUM(`fees_amount`) as fees FROM `dbt_biding_log` WHERE `currency_symbol`='".$currency."' GROUP BY YEAR(`success_time`), MONTH(`success_time`)";
        return $this->db->query($sql, [])->getResult();
	}

	public function currentMonthFeesTotal($currency = 'BTC')
	{
		$current_date = date('Y-m-d');
		$sql1 = "SELECT SUM(`fees_amount`) as fees FROM `dbt_biding_log` WHERE MONTH(`success_time`)=MONTH('".$current_date."') AND `currency_symbol`='".$currency."' AND `status` = '1'";
		$buySellFees = $this->db->query($sql1, [])->getRow();

		$sql2 = "SELECT SUM(`fees_amount`) as depositTotalFees FROM `dbt_deposit` WHERE MONTH(`deposit_date`)=MONTH('".$current_date."') AND `currency_symbol`='".$currency."' AND `status` = '1'";
		$depositFees = $this->db->query($sql2, [])->getRow();

		$sql3 = "SELECT SUM(`fees_amount`) as withdrawTotalFees FROM `dbt_withdraw` WHERE MONTH(`success_date`)=MONTH('".$current_date."') AND `currency_symbol`='".$currency."' AND `status` = '1'";
		$withdrawFees = $this->db->query($sql3, [])->getRow();

		$sql4 = "SELECT SUM(`fees`) as transferTotalFees FROM `dbt_transfer` WHERE MONTH(`date`)=MONTH('".$current_date."') AND `currency_symbol`='".$currency."' AND `status` = '1'";
		$transferFees = $this->db->query($sql4, [])->getRow();

		$resutl =  array('buySellFees' => @$buySellFees->fees, 'depositFees' => @$depositFees->depositTotalFees, 'withdrawFees' => @$withdrawFees->withdrawTotalFees, 'transferFees' => @$transferFees->transferTotalFees);

        return $resutl;
	}

	public function monthlyBuy($currency = 'USD')
	{

		$sql = "SELECT MONTHNAME(`success_time`) as month, SUM(`complete_amount`) as totalBuy FROM `dbt_biding_log` WHERE `currency_symbol`='".$currency."' AND `bid_type`='BUY' AND `status`= '1' GROUP BY YEAR(`success_time`), MONTH(`success_time`)";
        return $this->db->query($sql, [])->getResult();
	}
	public function monthlySell($currency = 'USD')
	{

		$sql = "SELECT MONTHNAME(`success_time`) as month, SUM(`complete_amount`) as totalSell FROM `dbt_biding_log` WHERE `currency_symbol`='".$currency."' AND `bid_type`='SELL' AND `status`= '1' GROUP BY YEAR(`success_time`), MONTH(`success_time`)";
        return $this->db->query($sql, [])->getResult();
	}

	public function currentMonthFeesDeposit($currency = 'BTC')
	{
		$current_date = date('Y-m-d');
		$sql = "SELECT SUM(`fees_amount`) as fees FROM `dbt_biding_log` WHERE MONTH(`success_time`)=MONTH('".$current_date."') AND `currency_symbol`='".$currency."' AND `status` = '1'";
        return $this->db->query($sql, [])->getRow();
	}

	public function coinTradeMarket()
	{
		$sql = "SELECT `currency_symbol` as currency_symbol, SUM(`bid_qty`) as bid_qty FROM `dbt_biding` WHERE `bid_type`='BUY' GROUP BY `currency_symbol`";
        return $this->db->query($sql, [])->getResult();
	}

	
	public function marketTradeHistory()
	{
		
		$builder = $this->db->table('dbt_biding bidmaster');
        $builder->select('bidmaster.*, biddetail.bid_type as bid_type1, biddetail.bid_price as bid_price1, biddetail.market_symbol as market_symbol1, biddetail.complete_amount as complete_amount1, biddetail.success_time as success_time1, biddetail.complete_qty, biddetail.complete_amount, biddetail.success_time');
        $builder->join('dbt_biding_log biddetail', 'biddetail.bid_id = bidmaster.id', 'left');
        $builder->limit(15);
        $query = $builder->get();
        return $data = $query->getResult();
	}
}