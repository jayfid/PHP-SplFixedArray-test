<?php
function make_combos($lists, $use_spl_array = TRUE) {
  $total_combos = 1;
  foreach ($lists as $key => $list) {
    $total_combos *= count($list);
  }
  
  if ($use_spl_array) {
    $combos = new SplFixedArray($total_combos);
  }
  else {
  	$combos = array();
  }
  
  $switch_point = $total_combos;
  
  foreach ($lists as $list) {
    $switch_point = $switch_point / count($list);
    $i = 0;
	$k = 0;
    $j = 0;
	
    while ($i < $total_combos) {
      if ($k == $switch_point) {
		$k = 0;
        if ($j == (count($list) - 1)) {
	
			$j = 0;
			
		} else {
			
			$j++;
		}
		

      }
      $combos[$i] = $combos[$i] . $list[$j];
      $i++;
		$k++;
    }
	
  }
  return $combos;
}
$list = array(
	array('a', 'b', 'c'),
	array('d', 'e'),
	array('f', 'g', 'h'),
	array('i', 'j', 'k'),
	array('l', 'm', 'n', 'o', 'p'),
	array('q', 'r', 's', 't', 'u', 'v'),
	array('w', 'x', 'y', 'z'),
	array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0'),
	array('alpha', 'beta', 'gamma', 'delta', 'epsilon', 'zeta', 'eta', 'theta',
	  'iota', 'kappa', 'lambda', 'mu', 'nu', 'xi', 'omicron', 'pi', 'rho',
	  'sigma', 'tau', 'upsilon', 'phi', 'chi', 'psi', 'omega'
	),
);
$start_time = microtime(TRUE);
$comb = make_combos($list, TRUE);
$spl_time =  microtime(true) - $start_time;
print memory_get_peak_usage() . PHP_EOL;
unset($comb);
unset($start_time);

$start_time = microtime(TRUE);
$comb = make_combos($list, FALSE);
$arr_time = microtime(true) - $start_time;
print memory_get_peak_usage() . PHP_EOL;
unset($comb);
unset($start_time);
print $arr_time - $spl_time;
?>