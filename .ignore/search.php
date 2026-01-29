<u>Search Engines</u>: 
<?php
$engines = [
	'' =>['code' => '29e47bd630f4c73c0"', 'name' => 'All YieldMore', 'description' => 'All YieldMore and Amadeus sites'],
	'mothersriaurobindo' =>['code' => '84d24b3918cbd5f1a', 'name' => 'Mother Sri Aurobindo', 'description' => 'Resource Sites of the Aurobindonian World'],
	'realms' =>['code' => '04ab4883fdabf070a', 'name' => 'Manifesting Realms', 'description' => 'The Forerunners, Society Stirrers, Heroes and Change-makers of this Earth!'],
	'waves' =>['code' => '', 'name' => 'Wavemakers', 'description' => 'Educators and Social Workers whom we support'],
	'law' =>['code' => '3beacabff7e7fd047', 'name' => 'IP Law', 'description' => 'Intellectual Property Legal Information Websites'],
	//'four' =>['code' => '', 'name' => '', 'description' => ''],
];

$id = am_var('page_parameter1') ? am_var('page_parameter1') : '';
$engine = $engines[$id];

foreach ($engines as $slug => $item) {
	echo sprintf('%s<a href="%s" title="%s">%s</a>%s | ', $slug == $id ? '<b>' : '', am_var('url') . 'search/' . ($slug ? $slug . '/' : ''), $item['description'], $item['name'], $slug == $id ? '</b>' : '');
}

?>

<h2><u>Name</u>: <?php echo $engine['name']; ?></h2>
<h3><u>Searches</u> <?php echo $engine['description']; ?></h3>
<script async src="https://cse.google.com/cse.js?cx=<?php echo $engine['code']; ?>"></script>
<div class="gcse-search"></div>