Here at YM, we have a simplistic way of encouraging #DirectDonations to our volunteers, supporters and member organizations. We do not track donations not do we ask/route any money/fee to ourselves. Write to us for a listing.

<?php
yas_lembas();

function yas_lembas() {
	$link = '../' . cs_var('node') . '/';
	$filter = [
		'who'  => isset($_GET['who'])  ? $_GET['who']  : false,
		'what' => isset($_GET['what']) ? $_GET['what'] : false,
	];

		$r =
'<table class="border" border="1">
	<tr>
		<th><a href="' . $link . '">Who / What</a></th>
		<th>Purpose / Status</th>
		<th>Target / Date (Raised)</th>
		<th>Donate</th><th></th>
	</tr>
	<tr style="display: none;">
		<th colspan="4">Content / Video / Tally</th>
	</tr>';

	$cols = 'object';
	$file = __DIR__ . '/fundraisers.tsv';
	$rows = tsv_to_array(file_get_contents($file), $cols);
	$link = '<a href="' . $link . '?who=%s">%s</a>';
	$toggle = '<a href="javascript:" onclick="jQuery(this).closest(\'tr\').next().toggle()">&darr;</a>';
	$upi = 'upi://pay?pa=%s&amp;pn=%s&amp;cu=INR';
	foreach ($rows as $item) {
		$who = urlize($item[$cols->who]);
		$what = urlize($item[$cols->what]);
		if ($filter['who'] && $filter['who'] != $who) continue;
		if ($filter['what'] && $filter['what'] != $what) continue;
		$op = [
			'who' => sprintf($link, $who, $item[$cols->who]),
			'what' => sprintf($link, $who . '&what=' . $what, $item[$cols->what]),
			'status' => $item[$cols->status],
			'purpose' => $item[$cols->purpose],
			'target' => $item[$cols->target],
			'raised' => $item[$cols->raised],
			'by_date' => $item[$cols->by_date],
		];

		$give = $item[$cols->pay_to];
		$give = startsWith($give, 'PAYPAL:') ? sprintf('<a href="https://paypal.me/%s" target="_blank">paypal</a>', substr($give, strlen('PAYPAL:')))
					: (startsWith($give, 'UPI:') ? sprintf('<a href="%s" target="_blank">upi</a>', sprintf($upi, substr($give, strlen('UPI:')), $item[$cols->who])) : 'not set');

		$r .= sprintf('
	<tr class="row-group">
		<td>%s for %s<br /><i>%s</i></td>
		<td>%s</td>
		<td>%s of %s<br />(%s)</td>
		<td>%s</td><td>%s</td>
	</tr>', $op['what'], $op['who'], $op['status'], $op['purpose'], $op['raised'], $op['target'], $op['by_date'], $give, $filter['what'] ? '' : $toggle);

		$video = $item[$cols->video] ? '<div class="video-bgd"><div class="container"><div class="video-container">' . $item[$cols->video] . '</div></div></div>' : '--NO VIDEO--';
		$lnk  = $item[$cols->link] ? '<a href="' . $item[$cols->link] . '" target="_blank">' . $item[$cols->link] . '</a>' : '--NO LINK--';
		$r .= sprintf('
	<tr style="%s">
		<th colspan="4">%s<br >[Tally]<hr />%s</th>
	</tr>', $filter['what'] ? '' : 'display: none;', $lnk, $video);
	
	}

	echo $r . '</table>';
}
?>