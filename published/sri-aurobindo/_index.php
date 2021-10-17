<h1>Sri Aurobindo</h1>

<h2>A brief biography</h2>

[to be expanded]

<h1>Complete Works of Sri Aurobindo</h1>

<blockquote>In 1997, <a href="https://www.sriaurobindoashram.org/sriaurobindo/writings.php" target="_blank">the Sri Aurobindo Ashram* began to publish the Complete Works of Sri Aurobindo</a> in a uniform library edition of 37 volumes. All the 36 text volumes have been issued. The remaining reference volume, with an index and glossary, is being prepared. The Complete Works contains all the writings published earlier in the 30-volume Sri Aurobindo Birth Centenary Library, as well as around 4000 pages of new texts.</blockquote>

* his works became open domain in 2010 and thus are published here at YM.

<?php
$files = [
	'cwsa-01-early-cultural-writings',
	'cwsa-02-collected-poems',
	'cwsa-03-04-collected-plays-and-stories',
	'cwsa-05-translations',
	'cwsa-06-07-bandemataram',
	'cwsa-08-karmayogin',
	'cwsa-09-writings-in-bengali-and-sanskrit',
	'cwsa-10-11-record-of-yoga',
	'cwsa-12-essays-divine-and-human',
	'cwsa-13-essays-in-philosophy-and-yoga',
	'cwsa-14-vedic-and-philological-studies',
	'cwsa-15-the-secret-of-the-veda',
	'cwsa-16-hymns-to-the-mystic-fire',
	'cwsa-17-isha-upanishad',
	'cwsa-18-kena-and-other-upanishads',
	'cwsa-19-essays-on-the-gita',
	'cwsa-20-the-renaissance-in-india',
	'cwsa-21-22-the-life-divine',
	'cwsa-23-24-the-synthesis-of-yoga',
	'cwsa-25-the-human-cycle',
	'cwsa-26-the-future-poetry',
	'cwsa-27-letters-on-poetry-and-art',
	'cwsa-28-letters-on-yoga-i',
	'cwsa-29-letters-on-yoga-ii',
	'cwsa-30-letters-on-yoga-iii',
	'cwsa-31-letters-on-yoga-iv',
	'cwsa-32-the-mother-with-letters-on-the-mother',
	'cwsa-33-34-savitri',
	'cwsa-35-letters-on-himself-and-the-ashram',
	'cwsa-36-autobiographical-notes',
];

foreach ($files as $file) {
	$path = __DIR__ . '/' . $file . '.txt';
	if (!file_exists($path)) continue; //TODO: remove this line after adding some basic content for empty files
	echo '<h2><a href="../' . $file . '/">' . substr(humanize($file), 5) . '</a></h2>';
	$raw = file_get_contents($path);
	echo $raw && $raw[0] == '#' ? markdown($raw) : wpautop($raw);
	echo '<hr />';
}
?>

<h1>Sri Aurobindo at YieldMore.org (a 10 year journey)</h1>

I will write more of my journey with Sri Aurobindo and the Mother - until then I let this picture speak:

<div class="banner"><img src="../assets/sections/imran-mm.jpg" class="img-fluid" /></div>

We, YieldMore.org had earlier published 4 of <a href="https://legacy.yieldmore.org/people/sri-aurobindo/bio/" target="_blank">Sri Aurobindo's works</a> viz: <a href="https://legacy.yieldmore.org/works/essays-on-the-gita/" target="_blank">Essays on the Gita</a>, <a href="https://legacy.yieldmore.org/works/hour-of-god/" target="_blank">Hour of God</a>, <a href="https://legacy.yieldmore.org/works/problem-of-rebirth/" target="_blank">The Problem of Rebirth</a> and <a href="https://legacy.yieldmore.org/works/savitri/" target="_blank">Savitri</a>. Some of his quotes on Hinduism, you will find on <a href="https://legacy.yieldmore.org/topics/religion/" target="_blank">our legacy religion page</a>.

<a href="https://imran.yieldmore.org/" target="_blank">Imran</a> is a volunteer at <a href="https://sriaurobindodhama.org/" target="_blank">Sri Aurobindo Dhama</a> and has been published at <a href="https://journal.aurobharati.in/author/imran-ali-namazi/" target="_blank">Renaissance (an AuroBharati publication)</a>. Imran has <a href="https://imran.yieldmore.org/impelled/for/msa/" target="_blank">dedicated a few poems to Mother/Sri Aurobindo</a> and used to distribute copies of <a href="../sri-aurobindos-gita/">Sri Aurobindo's Gita</a>.
