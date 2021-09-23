$(document).ready(function() {
	var toc = false;
	var contents = false;

	var headings = $('h1, h2, h3', $('#content'));

	if (headings.length < 3) return;

	headings.each(function(ix, el) {
		if (!toc) {
			toc = $('<ul class="contents" />').insertBefore('#content');
			contents = $('<strong>CONTENTS</strong>').insertBefore('ul.contents');
			return; //skip page heading
		}
		toc.append(createHeading(el, toc));
		$(el).addClass('go-to-toc').append('&nbsp;&nbsp;<i class="arrow up"></i>');
	});

	function createHeading(el) {
		var li = $('<li class="indent-' + el.tagName.toLowerCase() + '">' + el.innerText + '</li>');
		li.click(function() { el.scrollIntoView(); li.addClass('selected'); li.siblings().removeClass('selected'); });
		$(el).click(function() { contents[0].scrollIntoView(); });
		return li;
	}
});
