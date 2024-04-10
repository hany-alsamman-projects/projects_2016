<?php
/*
.---------------------------------------------------------------------------.
| License does not expire.                                                  |
| Can be used on 1 site, 1 server                                           |
| Source-code or binary products cannot be resold or distributed            |
| Commercial/none use only                                                  |
| Unauthorized copying of this file, via any medium is strictly prohibited  |
| ------------------------------------------------------------------------- |
| Cannot modify source-code for any purpose (cannot create derivative works)|
'---------------------------------------------------------------------------'
*/

/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Copyright © 2013 CODEXC.COM
 * @version 4.1 RC1
 * @access private
 * @license http://www.binpress.com/license/view/l/9f75712c904c6fae3ed66dc3d620f19f license for commercial use
 */

use Moltin\Currency\Currency as Currency;
use Moltin\Currency\Format\Runtime as RuntimeFormat;
use Moltin\Currency\Exchange\OpenExchangeRates as OpenExchange;

class BaseController extends Controller
{

	/**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;
	var $currency;
	var $scheduler;
	var $menu = false;
    var $layout = 'index_default';

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// CSRF Protection
		//$this->beforeFilter('csrf', array('on' => 'post'));

        //$this->currency = new Currency(new OpenExchange(Config::get('settings.currency_api_key')), new RuntimeFormat);

        //$this->scheduler = new SchedulerController;

		$this->messageBag = new Illuminate\Support\MessageBag;

        View::share('search_mode', false);
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{

        if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
