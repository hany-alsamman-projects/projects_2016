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

class AuthorizedController extends BaseController {

	/**
	 * Whitelisted auth routes.
	 *
	 * @var array
	 */
	protected $whitelist = array();

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{

		// Apply the auth filter
		$this->beforeFilter('auth', array('except' => $this->whitelist));

		// Call parent
		parent::__construct();
	}

}
