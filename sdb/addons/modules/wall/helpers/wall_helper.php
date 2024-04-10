<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * vcard helpers
 *
 * @package		PyroCMS
 * @subpackage	Comments Module
 * @category	Helper
 * @author		Hany alsamman - CodexFW Dev Team
 */

    function tolink($text){
            $text = html_entity_decode($text);
            $text = " ".$text;
            $text = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
                    '<a href="\\1">\\1</a>', $text);
            $text = eregi_replace('(((f|ht){1}tps://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
                    '<a href="\\1">\\1</a>', $text);
            $text = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
            '\\1<a href="http://\\2">\\2</a>', $text);
            $text = eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})',
            '<a href="mailto:\\1">\\1</a>', $text);
            return $text;
    }

/*
    time_delta() returns the difference between two times
    expressed in many ways.
    
    https://gist.github.com/967604
    
    (mixed) $start: The initial time to calculate from
    (mixed) $target: The time in the past or future to calculate the difference between
    (int) $precision:
    0: Generic - ex. "About 7 hours ago"
    1: Approximate - ex. "7 hours, 15 minutes ago"
    2: Exact - ex. "7 hours, 15 minutes and 6 seconds ago"
    s: seconds
    m: minutes
    h: hours
    d: days
    w: weeks
    mo: months
    y: years
    (int) $labels:
    0: No labels - ex. "7 15 6 ago"
    1: Short - ex. "7h 15m 6s ago"
    2: Long - ex. "7 hours, 15 minutes and 6 seconds ago"
    (bool) $suffix: Whether or not to add "ago" or "from now"

    echo time_delta('now', 'April 16, 1986');
    // Outputs "25 years ago"
    echo time_delta('now', 'December 21, 2012', 2);
    // Outputs "1 year and 7 months from now"
    echo time_delta('now', '17:46');
    // Outputs "About an hour from now"
    echo time_delta('now', '8/18/2012', 2);
    // Outputs "1 year, 3 months, 1 week, 1 day, 17 hours, 44 minutes and 53 seconds from now"

*/

function time_delta($start = 'now', $target = '', $precision = 0, $labels = 2, $suffix = true)
{
    // date_default_timezone_set('America/Los_Angeles'); // PHP complains if this isn't set, for some reason
    // Define all time units in terms of seconds
    $units = array('y' => array('سنة', 31556926), // Source: Google calculator
        'mo' => array('شهر', 2629744), // Source: Google calculator
        'w' => array('اسبوع', 604800), 
        'd' => array('يوم', 86400), 
        'h' => array('ساعة', 3600), 
        'm' => array('دقيقة', 60), 
        's' => array('ثانية', 1));

    // Some basic sanity checking
    if (empty($target))
        return "No target time specified.\n";
    if ($start < 0)
        return "Invalid start time.\n";
    if (!array_key_exists($precision, $units) and $precision > 2)
        return "Improper value for precision.\n";
    if (!is_int($labels) or !is_bool($suffix))
        return "Improper values for labels and/or suffix.\n";
    if (!is_int($target) and !strtotime($target))
        return "Could not understand your target time.\n";
    if (!is_int($start) and !strtotime($start))
        return "Could not understand your start time.\n";

    // Set some sensible defaults
    $fuzz_factor = 0.8; // How close to the next value will we call it "about" something?
    if ($precision < 0 or $precision > 2)
        $precision = 2;
    if ($labels < 0 or $labels > 2)
        $labels = 2;
    if (!is_int($start))
        $start = strtotime($start);
    if (!is_int($target))
        $target = strtotime($target);

    // Are we past or future?
    $ending = ($target > $start) ? " منذ الآن" : " مضى";

    // Calculate time difference & initialize output string
    $delta = abs($target - $start);
    
    if(!$delta) return "الآن فقط";
    
    $out = '';

    // Calculate for single-unit precision
    if (is_string($precision)) {
        if ($delta < $units[$precision][1]) {
            $out .= "Less than one {$units[$precision][0]}";
            return ($suffix === true) ? $out . $ending : $out;
        } else {
            $out .= intval(($delta / $units[$precision][1]));
            if ($labels == 0)
                return $out;
            $out .= ($labels == 1) ? $precision : ' ' . $units[$precision][0] . (($out > 1 and
                $labels >= 2) ? 's' : '');
            return ($suffix === true) ? $out . $ending : $out;
        }
    }

    /* Calculate fuzzy precision
    -------------------------
    Fuzzy precision should output only one unit of precision
    and use the modifier "about" if the remainder is > $fuzz_factor.
    */
    if ($precision == 0) {
        foreach ($units as $unit => $type) {
            if ($delta >= $type[1] * $fuzz_factor) {
                $fuzzy = (fmod(($delta / $type[1]), 1) > $fuzz_factor) ? true : false;
                if ($labels > 0 and $labels >= 2)
                    $out .= ($fuzzy === true) ? 'حوالي ' : '';
//                $diff = ($fuzzy === true) ? ceil($delta / $type[1]) : intval($delta / $type[1]);
//                if ($diff == 1 and $fuzzy === true)
//                    $out .= ($unit == 'h') ? 'an ' : 'a ';
//                else
//                    $out .= $diff;
                if ($labels == 0)
                    return $diff;
                $out .= ($labels > 1 or $fuzzy === false) ? ' ' : '';
                $out .= ($labels == 1) ? $unit : $type[0];
                $out .= ($diff > 1 and $labels > 1) ? 's' : '';
                return ($suffix === true) ? $out . $ending : $out;
            }
        }
    }
    /* Calculate approximate and exact precision
    -----------------------------------------
    Approximate precision outputs up to 2 units of measure, exact prints
    as many as we have.
    */  else {
        $max = ($precision == 1) ? 2 : count($units); // Iterate twice if approximate precision
        $i = 0;
        foreach ($units as $unit => $type) {
            if ($delta >= $type[1] and $i < $max) {
                $diff = intval($delta / $type[1]);
                $out .= $diff . (($labels > 1) ? (' ' . $type[0]) : (($labels == 0) ? ' ' : $unit)) . (($diff >
                    1 and $labels > 1) ? ('s') : (''));
                $delta -= intval($delta / $type[1]) * $type[1];
                $out .= ($i == 0 and $precision == 1 and $labels > 0 and !empty($diff)) ?
                    ' and ' : '';
                $next_index = array_search($unit, array_keys($units)) + 1;
                $units_numeric = array_values($units);
                if (array_key_exists($next_index, $units_numeric))
                    $next = $units_numeric[$next_index][1];
                $and = ($precision == 2 and $labels > 0 and ($delta % $next == 0) and $unit !=
                    's');
                $out .= $and ? ' and ' : (($labels > 0 and $unit != 's' and $precision != 1) ?
                    ', ' : '');
                $i++;
            }
        }
        return ($suffix === true) ? $out . $ending : $out;
    }
}

function time_ago($time)
{
    $periods = array("second", "minute", "hour", "day", "اسبوع", "month", "year","decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    $now = time();

    $difference = $now - $time;
    $tense = "ago";

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if ($difference != 1) {
        //$periods[$j] .= "s";
    }

    return " 'مضت' $periods[$j]  $difference";
}


/**
 * Function to display a cast stars
 *
 * @param	int		$ref_id		The ID of the comment (I guess?)
 * @param	bool	$reference	Whether to use a reference or not (?)
 * @return	void
 */
function display_cast($vid, $gid)
{
    
	$ci =& get_instance();



	$ci->load->view('vcard/cast_stars', $data);
}