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

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// CSRF Protection
		//$this->beforeFilter('csrf', array('on' => 'post'));

		$this->messageBag = new Illuminate\Support\MessageBag;
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{

        View::share('site_name', Config::get('settings.site.title'));

        if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
