

function formatedNumberToFloat(price, currencyFormat, currencySign)
{
	price = price.replace(currencySign, '');
	if (currencyFormat === 1)
		return parseFloat(price.replace(',', '').replace(' ', ''));
	else if (currencyFormat === 2)
		return parseFloat(price.replace(' ', '').replace(',', '.'));
	else if (currencyFormat === 3)
		return parseFloat(price.replace('.', '').replace(' ', '').replace(',', '.'));
	else if (currencyFormat === 4)
		return parseFloat(price.replace(',', '').replace(' ', ''));
	return price;
}

//return a formatted number
function formatNumber(value, numberOfDecimal, thousenSeparator, virgule)
{
	value = value.toFixed(numberOfDecimal);
	var val_string = value+'';
	var tmp = val_string.split('.');
	var abs_val_string = (tmp.length === 2) ? tmp[0] : val_string;
	var deci_string = ('0.' + (tmp.length === 2 ? tmp[1] : 0)).substr(2);
	var nb = abs_val_string.length;

	for (var i = 1 ; i < 4; i++)
		if (value >= Math.pow(10, (3 * i)))
			abs_val_string = abs_val_string.substring(0, nb - (3 * i)) + thousenSeparator + abs_val_string.substring(nb - (3 * i));

	if (parseInt(numberOfDecimal) === 0)
		return abs_val_string;
	return abs_val_string + virgule + (deci_string > 0 ? deci_string : '00');
}

function formatCurrency(price, currencyFormat, currencySign, currencyBlank)
{
	// if you modified this function, don't forget to modify the PHP function displayPrice (in the Tools.php class)
	var blank = '';
	price = parseFloat(price.toFixed(10));
	price = ps_round(price, priceDisplayPrecision);
	if (currencyBlank > 0)
		blank = ' ';
	if (currencyFormat == 1)
		return currencySign + blank + formatNumber(price, priceDisplayPrecision, ',', '.');
	if (currencyFormat == 2)
		return (formatNumber(price, priceDisplayPrecision, ' ', ',') + blank + currencySign);
	if (currencyFormat == 3)
		return (currencySign + blank + formatNumber(price, priceDisplayPrecision, '.', ','));
	if (currencyFormat == 4)
		return (formatNumber(price, priceDisplayPrecision, ',', '.') + blank + currencySign);
	if (currencyFormat == 5)
		return (currencySign + blank + formatNumber(price, priceDisplayPrecision, '\'', '.'));
	return price;
}

function ps_round_helper(value, mode)
{
	// From PHP Math.c
	if (value >= 0.0)
	{
		tmp_value = Math.floor(value + 0.5);
		if ((mode == 3 && value == (-0.5 + tmp_value)) ||
			(mode == 4 && value == (0.5 + 2 * Math.floor(tmp_value / 2.0))) ||
			(mode == 5 && value == (0.5 + 2 * Math.floor(tmp_value / 2.0) - 1.0)))
			tmp_value -= 1.0;
	}
	else
	{
		tmp_value = Math.ceil(value - 0.5);
		if ((mode == 3 && value == (0.5 + tmp_value)) ||
			(mode == 4 && value == (-0.5 + 2 * Math.ceil(tmp_value / 2.0))) ||
			(mode == 5 && value == (-0.5 + 2 * Math.ceil(tmp_value / 2.0) + 1.0)))
			tmp_value += 1.0;
	}

	return tmp_value;
}

function ps_log10(value)
{
	return Math.log(value) / Math.LN10;
}

function ps_round_half_up(value, precision)
{
	var mul = Math.pow(10, precision);
	var val = value * mul;

	var next_digit = Math.floor(val * 10) - 10 * Math.floor(val);
	if (next_digit >= 5)
		val = Math.ceil(val);
	else
		val = Math.floor(val);

	return val / mul;
}

function ps_round(value, places)
{
	if (typeof(roundMode) === 'undefined')
		roundMode = 2;
	if (typeof(places) === 'undefined')
		places = 2;

	var method = roundMode;

	if (method === 0)
		return ceilf(value, places);
	else if (method === 1)
		return floorf(value, places);
	else if (method === 2)
		return ps_round_half_up(value, places);
	else if (method == 3 || method == 4 || method == 5)
	{
		// From PHP Math.c
		var precision_places = 14 - Math.floor(ps_log10(Math.abs(value)));
		var f1 = Math.pow(10, Math.abs(places));

		if (precision_places > places && precision_places - places < 15)
		{
			var f2 = Math.pow(10, Math.abs(precision_places));
			if (precision_places >= 0)
				tmp_value = value * f2;
			else
				tmp_value = value / f2;

			tmp_value = ps_round_helper(tmp_value, roundMode);

			/* now correctly move the decimal point */
			f2 = Math.pow(10, Math.abs(places - precision_places));
			/* because places < precision_places */
			tmp_value /= f2;
		}
		else
		{
			/* adjust the value */
			if (places >= 0)
				tmp_value = value * f1;
			else
				tmp_value = value / f1;

			if (Math.abs(tmp_value) >= 1e15)
				return value;
		}

		tmp_value = ps_round_helper(tmp_value, roundMode);
		if (places > 0)
			tmp_value = tmp_value / f1;
		else
			tmp_value = tmp_value * f1;

		return tmp_value;
	}
}

function autoUrl(name, dest)
{
	var loc;
	var id_list;

	id_list = document.getElementById(name);
	loc = id_list.options[id_list.selectedIndex].value;
	if (loc != 0)
		location.href = dest+loc;
	return ;
}

function autoUrlNoList(name, dest)
{
	var loc;

	loc = document.getElementById(name).checked;
	location.href = dest + (loc == true ? 1 : 0);
	return ;
}

/*
** show or hide element e depending on condition show
*/
function toggle(e, show)
{
	e.style.display = show ? '' : 'none';
}

function toggleMultiple(tab)
{
    var len = tab.length;

    for (var i = 0; i < len; i++)
        if (tab[i].style)
            toggle(tab[i], tab[i].style.display == 'none');
}

/**
* Show dynamicaly an element by changing the sytle "display" property
* depending on the option selected in a select.
*
* @param string $select_id id of the select who controls the display
* @param string $elem_id prefix id of the elements controlled by the select
*   the real id must be : 'elem_id'+nb with nb the corresponding number in the
*   select (starting with 0).
*/
function showElemFromSelect(select_id, elem_id)
{
	var select = document.getElementById(select_id);
	for (var i = 0; i < select.length; ++i)
	{
	    var elem = document.getElementById(elem_id + select.options[i].value);
		if (elem != null)
			toggle(elem, i == select.selectedIndex);
	}
}

/**
* Get all div with specified name and for each one (by id), toggle their visibility
*/
function openCloseAllDiv(name, option)
{
	var tab = $('*[name='+name+']');
	for (var i = 0; i < tab.length; ++i)
		toggle(tab[i], option);
}

function toggleDiv(name, option)
{
	$('*[name='+name+']').each(function(){
		if (option == 'open')
		{
			$('#buttonall').data('status', 'close');
			$(this).hide();
		}
		else
		{
			$('#buttonall').data('status', 'open');
			$(this).show();
		}
	})
}

function toggleButtonValue(id_button, text1, text2)
{
	if ($('#'+id_button).find('i').first().hasClass('process-icon-compress'))
	{
		$('#'+id_button).find('i').first().removeClass('process-icon-compress').addClass('process-icon-expand');
		$('#'+id_button).find('span').first().html(text1);
	}
	else
	{
		$('#'+id_button).find('i').first().removeClass('process-icon-expand').addClass('process-icon-compress');
		$('#'+id_button).find('span').first().html(text2);
	}
}


/**
* Toggle the value of the element id_button between text1 and text2
*/
function toggleElemValue(id_button, text1, text2)
{
	var obj = document.getElementById(id_button);
	if (obj)
		obj.value = ((!obj.value || obj.value == text2) ? text1 : text2);
}

function addBookmark(url, title)
{
	if (window.sidebar && window.sidebar.addPanel)
		return window.sidebar.addPanel(title, url, "");
	else if ( window.external && ('AddFavorite' in window.external))
		return window.external.AddFavorite( url, title);
}

function writeBookmarkLink(url, title, text, img)
{
	var insert = '';
	if (img)
		insert = writeBookmarkLinkObject(url, title, '<img src="' + img + '" alt="' + escape(text) + '" title="' + removeQuotes(text) + '" />') + '&nbsp';
	insert += writeBookmarkLinkObject(url, title, text);
	if (window.sidebar || window.opera && window.print || (window.external && ('AddFavorite' in window.external)))
		$('.add_bookmark, #header_link_bookmark').append(insert);
}

function writeBookmarkLinkObject(url, title, insert)
{
	if (window.sidebar || window.external)
		return ('<a href="javascript:addBookmark(\'' + escape(url) + '\', \'' + removeQuotes(title) + '\')">' + insert + '</a>');
	else if (window.opera && window.print)
		return ('<a rel="sidebar" href="' + escape(url) + '" title="' + removeQuotes(title) + '">' + insert + '</a>');
	return ('');
}

function checkCustomizations()
{
	var pattern = new RegExp(' ?filled ?');

	if (typeof customizationFields != 'undefined')
		for (var i = 0; i < customizationFields.length; i++)
		{
			/* If the field is required and empty then we abort */
			if (parseInt(customizationFields[i][1]) == 1 && ($('#' + customizationFields[i][0]).html() == '' ||  $('#' + customizationFields[i][0]).text() != $('#' + customizationFields[i][0]).val()) && !pattern.test($('#' + customizationFields[i][0]).attr('class')))
				return false;
		}
	return true;
}

function emptyCustomizations()
{
	if(typeof(customizationFields) == 'undefined') return;

	$('.customization_block .success').fadeOut(function(){
		$(this).remove();
	});
	$('.customization_block .error').fadeOut(function(){
		$(this).remove();
	});
	for (var i = 0; i < customizationFields.length; i++)
	{
		$('#' + customizationFields[i][0]).html('');
		$('#' + customizationFields[i][0]).val('');
	}
}

function ceilf(value, precision)
{
	if (typeof(precision) === 'undefined')
		precision = 0;
	var precisionFactor = precision === 0 ? 1 : Math.pow(10, precision);
	var tmp = value * precisionFactor;
	var tmp2 = tmp.toString();
	if (tmp2[tmp2.length - 1] === 0)
		return value;
	return Math.ceil(value * precisionFactor) / precisionFactor;
}

function floorf(value, precision)
{
	if (typeof(precision) === 'undefined')
		precision = 0;
	var precisionFactor = precision === 0 ? 1 : Math.pow(10, precision);
	var tmp = value * precisionFactor;
	var tmp2 = tmp.toString();
	if (tmp2[tmp2.length - 1] === 0)
		return value;
	return Math.floor(value * precisionFactor) / precisionFactor;
}

function setCurrency(id_currency)
{
	$.ajax({
		type: 'POST',
		headers: { "cache-control": "no-cache" },
		url: baseDir + 'index.php' + '?rand=' + new Date().getTime(),
		data: 'controller=change-currency&id_currency='+ parseInt(id_currency),
		success: function(msg)
		{
			location.reload(true);
		}
	});
}

function isArrowKey(k_ev)
{
	var unicode=k_ev.keyCode? k_ev.keyCode : k_ev.charCode;
	if (unicode >= 37 && unicode <= 40)
		return true;
	return false;
}

function removeQuotes(value)
{
	value = value.replace(/\\"/g, '');
	value = value.replace(/"/g, '');
	value = value.replace(/\\'/g, '');
	value = value.replace(/'/g, '');

	return value;
}

function sprintf(format)
{
	for(var i=1; i < arguments.length; i++)
		format = format.replace(/%s/, arguments[i]);

	return format;
}

/**
 * Display a MessageBox
 * @param {string} msg
 * @param {string} title (optional)
 */
function fancyMsgBox(msg, title)
{
    if (title) msg = "<h2>" + title + "</h2><p>" + msg + "</p>";
    msg += "<br/><p class=\"submit\" style=\"text-align:right; padding-bottom: 0\"><input class=\"button\" type=\"button\" value=\"OK\" onclick=\"$.fancybox.close();\" /></p>";
	if(!!$.prototype.fancybox)
    	$.fancybox( msg, {'autoDimensions': false, 'autoSize': false, 'width': 500, 'height': 'auto', 'openEffect': 'none', 'closeEffect': 'none'} );
}

/**
 * Display a messageDialog with different buttons including a callback for each one
 * @param {string} question
 * @param {mixed} title Optional title for the dialog box. Send false if you don't want any title
 * @param {object} buttons Associative array containg a list of {buttonCaption: callbackFunctionName, ...}. Use an empty space instead of function name for no callback
 * @param {mixed} otherParams Optional data sent to the callback function
 */
function fancyChooseBox(question, title, buttons, otherParams)
{
    var msg, funcName, action;
	msg = '';
    if (title)
		msg = "<h2>" + title + "</h2><p>" + question + "</p>";
    msg += "<br/><p class=\"submit\" style=\"text-align:right; padding-bottom: 0\">";
    var i = 0;
    for (var caption in buttons) {
        if (!buttons.hasOwnProperty(caption)) continue;
        funcName = buttons[caption];
        if (typeof otherParams == 'undefined') otherParams = 0;
        otherParams = escape(JSON.stringify(otherParams));
        action = funcName ? "$.fancybox.close();window['" + funcName + "'](JSON.parse(unescape('" + otherParams + "')), " + i + ")" : "$.fancybox.close()";
	  msg += '<button type="submit" class="button btn-default button-medium" style="margin-right: 5px;" value="true" onclick="' + action + '" >';
	  msg += '<span>' + caption + '</span></button>'
        i++;
    }
    msg += "</p>";
	if(!!$.prototype.fancybox)
    	$.fancybox(msg, {'autoDimensions': false, 'width': 500, 'height': 'auto', 'openEffect': 'none', 'closeEffect': 'none'});
}

function toggleLayer(whichLayer, flag)
{
	if (!flag)
		$(whichLayer).hide();
	else
		$(whichLayer).show();
}

function openCloseLayer(whichLayer, action)
{
	if (!action)
	{
		if ($(whichLayer).css('display') == 'none')
			$(whichLayer).show();
		else
			$(whichLayer).hide();
	}
	else if (action == 'open')
		$(whichLayer).show();
	else if (action == 'close')
		$(whichLayer).hide();
}

function updateTextWithEffect(jQueryElement, text, velocity, effect1, effect2, newClass)
{
	if(jQueryElement.text() !== text)
	{
		if(effect1 === 'fade')
			jQueryElement.fadeOut(velocity, function(){
				$(this).addClass(newClass);
				if(effect2 === 'fade') $(this).text(text).fadeIn(velocity);
				else if(effect2 === 'slide') $(this).text(text).slideDown(velocity);
					else if(effect2 === 'show')	$(this).text(text).show(velocity, function(){});
			});
		else if(effect1 === 'slide')
			jQueryElement.slideUp(velocity, function(){
				$(this).addClass(newClass);
				if(effect2 === 'fade') $(this).text(text).fadeIn(velocity);
				else if(effect2 === 'slide') $(this).text(text).slideDown(velocity);
					else if(effect2 === 'show')	$(this).text(text).show(velocity);
			});
		else if(effect1 === 'hide')
			jQueryElement.hide(velocity, function(){
				$(this).addClass(newClass);
				if(effect2 === 'fade') $(this).text(text).fadeIn(velocity);
				else if(effect2 === 'slide') $(this).text(text).slideDown(velocity);
					else if(effect2 === 'show')	$(this).text(text).show(velocity);
			});
	}
}
//show a JS debug
function dbg(value)
{
	var active = false;//true for active
	var firefox = true;//true if debug under firefox

	if (active)
		if (firefox)
			console.log(value);
		else
			alert(value);
}

/**
* Function : print_r()
* Arguments: The element  - array,hash(associative array),object
*            The limit - OPTIONAL LIMIT
*            The depth - OPTIONAL
* Returns  : The textual representation of the array.
* This function was inspired by the print_r function of PHP.
* This will accept some data as the argument and return a
* text that will be a more readable version of the
* array/hash/object that is given.
*/
function print_r(element, limit, depth)
{
	depth =	depth?depth:0;
	limit = limit?limit:1;

	returnString = '<ol>';

	for(property in element)
	{
		//Property domConfig isn't accessable
		if (property != 'domConfig')
		{
			returnString += '<li><strong>'+ property + '</strong> <small>(' + (typeof element[property]) +')</small>';

			if (typeof element[property] == 'number' || typeof element[property] == 'boolean')
				returnString += ' : <em>' + element[property] + '</em>';
			if (typeof element[property] == 'string' && element[property])
				returnString += ': <div style="background:#C9C9C9;border:1px solid black; overflow:auto;"><code>' +
									element[property].replace(/</g, '&amp;lt;').replace(/>/g, '&amp;gt;') + '</code></div>';

			if ((typeof element[property] == 'object') && (depth < limit))
				returnString += print_r(element[property], limit, (depth + 1));

			returnString += '</li>';
		}
	}
	returnString += '</ol>';

	if(depth == 0)
	{
		winpop = window.open("", "","width=800,height=600,scrollbars,resizable");
		winpop.document.write('<pre>'+returnString+ '</pre>');
		winpop.document.close();
	}
	return returnString;
}

//verify if value is in the array
function in_array(value, array)
{
	for (var i in array)
		if ((array[i] + '') === (value + ''))
			return true;
	return false;
}

function isCleanHtml(content)
{
	var events = 'onmousedown|onmousemove|onmmouseup|onmouseover|onmouseout|onload|onunload|onfocus|onblur|onchange';
	events += '|onsubmit|ondblclick|onclick|onkeydown|onkeyup|onkeypress|onmouseenter|onmouseleave|onerror|onselect|onreset|onabort|ondragdrop|onresize|onactivate|onafterprint|onmoveend';
	events += '|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onmove';
	events += '|onbounce|oncellchange|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavailable|ondatasetchanged|ondatasetcomplete|ondeactivate|ondrag|ondragend|ondragenter|onmousewheel';
	events += '|ondragleave|ondragover|ondragstart|ondrop|onerrorupdate|onfilterchange|onfinish|onfocusin|onfocusout|onhashchange|onhelp|oninput|onlosecapture|onmessage|onmouseup|onmovestart';
	events += '|onoffline|ononline|onpaste|onpropertychange|onreadystatechange|onresizeend|onresizestart|onrowenter|onrowexit|onrowsdelete|onrowsinserted|onscroll|onsearch|onselectionchange';
	events += '|onselectstart|onstart|onstop';

	var script1 = /<[\s]*script/im;
	var script2 = new RegExp('('+events+')[\s]*=', 'im');
	var script3 = /.*script\:/im;
	var script4 = /<[\s]*(i?frame|embed|object)/im;

	if (script1.test(content) || script2.test(content) || script3.test(content) || script4.test(content))
		return false;

	return true;
}

function sleep(milliseconds)
{
	var start = new Date().getTime();

	for (var i = 0; i < 1e7; i++) {
		if ((new Date().getTime() - start) > milliseconds) {
			break;
		}
	}
}

$(document).ready(function()
{
	// Hide all elements with .hideOnSubmit class when parent form is submit
	$('form').submit(function() {
		$(this).find('.hideOnSubmit').hide();
	});

	$.fn.checkboxChange = function(fnChecked, fnUnchecked) {
		if ($(this).prop('checked') && fnChecked)
			fnChecked.call(this);
		else if(fnUnchecked)
			fnUnchecked.call(this);

		if (!$(this).attr('eventCheckboxChange'))
		{
			$(this).on('change', function() { $(this).checkboxChange(fnChecked, fnUnchecked); });
			$(this).attr('eventCheckboxChange', true);
		}
	};

	// attribute target="_blank" is not W3C compliant
	$('a._blank, a.js-new-window').attr('target', '_blank');
});




///

var ajaxQueries = new Array();
var ajaxLoaderOn = 0;
var sliderList = new Array();
var slidersInit = false;

$(document).ready(function()
{
	cancelFilter();
	openCloseFilter();

	// Click on color
	$(document).on('click', '#layered_form input[type=button], #layered_form label.layered_color', function(e) {
		if (!$('input[name='+$(this).attr('name')+'][type=hidden]').length)
			$('<input />').attr('type', 'hidden').attr('name', $(this).attr('name')).val($(this).data('rel')).appendTo('#layered_form');
		else
			$('input[name='+$(this).attr('name')+'][type=hidden]').remove();
		reloadContent(true);
	});

	$(document).on('click', '#layered_form .select, #layered_form input[type=checkbox], #layered_form input[type=radio]', function(e) {

		reloadContent(true);
	});

	// Changing content of an input text
	$(document).on('keyup', '#layered_form input.layered_input_range', function(e){
		if ($(this).attr('timeout_id'))
			window.clearTimeout($(this).attr('timeout_id'));

		// IE Hack, setTimeout do not acept the third parameter
		var reference = this;

		$(this).attr('timeout_id', window.setTimeout(function(it){
			if (!$(it).attr('id'))
				it = reference;

			var filter = $(it).attr('id').replace(/^layered_(.+)_range_.*$/, '$1');

			var value_min = parseInt($('#layered_'+filter+'_range_min').val());
			if (isNaN(value_min))
				value_min = 0;
			$('#layered_'+filter+'_range_min').val(value_min);

			var value_max = parseInt($('#layered_'+filter+'_range_max').val());
			if (isNaN(value_max))
				value_max = 0;
			$('#layered_'+filter+'_range_max').val(value_max);

			if (value_max < value_min) {
				$('#layered_'+filter+'_range_max').val($(it).val());
				$('#layered_'+filter+'_range_min').val($(it).val());
			}
			reloadContent();
		}, 500, this));
	});

	$(document).on('click', '#layered_block_left .radio', function(e){
		var name = $(this).attr('name');
		$.each($(this).parent().parent().find('input[type=button]'), function (it, item) {
			if ($(item).hasClass('on') && $(item).attr('name') != name)
				$(item).click();
		});
		return true;
	});

	// Click on label
	$('#layered_block_left label:not(.layered_color) a').on({
		click: function(e) {
			e.preventDefault();
			var disable = $(this).parent().parent().find('input').attr('disabled');
			if (disable == ''
			|| typeof(disable) == 'undefined'
			|| disable == false)
			{
				$(this).parent().parent().find('input').click();
				reloadContent();
			}
		}
	});

	layered_hidden_list = {};
	$('.hide-action').on('click', function(e){
		if (typeof(layered_hidden_list[$(this).parent().find('ul').attr('id')]) == 'undefined' || layered_hidden_list[$(this).parent().find('ul').attr('id')] == false)
			layered_hidden_list[$(this).parent().find('ul').attr('id')] = true;
		else
			layered_hidden_list[$(this).parent().find('ul').attr('id')] = false;
		hideFilterValueAction(this);
	});
	$('.hide-action').each(function() {
		hideFilterValueAction(this);
	});

	$('.selectProductSort').unbind('change').bind('change', function(event) {
		$('.selectProductSort').val($(this).val());

		if($('#layered_form').length > 0)
			reloadContent(true);
	});

	$(document).off('change', '#layered_form select[name=n]').on('change', '#layered_form select[name=n]', function(e)
	{
		$('select[name=n]').val($(this).val());
		reloadContent(true);
	});

	paginationButton(false);
	initLayered();
});

function initFilters()
{
	if (typeof filters !== 'undefined')
	{
		for (key in filters)
		{
			if (filters.hasOwnProperty(key))
				var filter = filters[key];

			if (typeof filter.slider !== 'undefined' && parseInt(filter.filter_type) == 0)
			{
				var filterRange = parseInt(filter.max)-parseInt(filter.min);
				var step = filterRange / 100;

				if (step > 1)
					step = parseInt(step);

				addSlider(filter.type,
				{
					range: true,
					step: step,
					min: parseInt(filter.min),
					max: parseInt(filter.max),
					values: [filter.values[0], filter.values[1]],
					slide: function(event, ui) {
						stopAjaxQuery();

						if (parseInt($(event.target).data('format')) < 5)
						{
							from = formatCurrency(ui.values[0], parseInt($(event.target).data('format')),
								$(event.target).data('unit'));
							to = formatCurrency(ui.values[1], parseInt($(event.target).data('format')),
								$(event.target).data('unit'));
						}
						else
						{
							from = ui.values[0] + $(event.target).data('unit');
							to = ui.values[1] + $(event.target).data('unit');
						}

						$('#layered_' + $(event.target).data('type') + '_range').html(from + ' - ' + to);
					},
					stop: function () {
						reloadContent(true);
					}
				}, filter.unit, parseInt(filter.format));
			}
			else if(typeof filter.slider !== 'undefined' && parseInt(filter.filter_type) == 1)
			{
				$('#layered_' + filter.type + '_range_min').attr('limitValue', filter.min);
				$('#layered_' + filter.type + '_range_max').attr('limitValue', filter.max);
			}

			$('.layered_' + filter.type).show();
		}
		initUniform();
	}
}

function initUniform()
{
	$("#layered_form input[type='checkbox'], #layered_form input[type='radio'], select.form-control").uniform();
}

function hideFilterValueAction(it)
{
	if (typeof(layered_hidden_list[$(it).parent().find('ul').attr('id')]) == 'undefined'
		|| layered_hidden_list[$(it).parent().find('ul').attr('id')] == false)
	{
		$(it).parent().find('.hiddable').hide();
		$(it).parent().find('.hide-action.less').hide();
		$(it).parent().find('.hide-action.more').show();
	}
	else
	{
		$(it).parent().find('.hiddable').show();
		$(it).parent().find('.hide-action.less').show();
		$(it).parent().find('.hide-action.more').hide();
	}
}

function addSlider(type, data, unit, format)
{
	sliderList.push({
		type: type,
		data: data,
		unit: unit,
		format: format
	});
}

function initSliders()
{
	$(sliderList).each(function(i, slider){
		$('#layered_'+slider['type']+'_slider').slider(slider['data']);

		var from = '';
		var to = '';
		switch (slider['format'])
		{
			case 1:
			case 2:
			case 3:
			case 4:
				from = formatCurrency($('#layered_'+slider['type']+'_slider').slider('values', 0), slider['format'], slider['unit']);
				to = formatCurrency($('#layered_'+slider['type']+'_slider').slider('values', 1), slider['format'], slider['unit']);
				break;
			case 5:
				from =  $('#layered_'+slider['type']+'_slider').slider('values', 0)+slider['unit']
				to = $('#layered_'+slider['type']+'_slider').slider('values', 1)+slider['unit'];
				break;
		}
		$('#layered_'+slider['type']+'_range').html(from+' - '+to);
	});
}

function initLayered()
{
	initFilters();
	initSliders();
	initLocationChange();
	updateProductUrl();
	if (window.location.href.split('#').length == 2 && window.location.href.split('#')[1] != '')
	{
		var params = window.location.href.split('#')[1];
		reloadContent('&selected_filters='+params);
	}
}

function paginationButton(nbProductsIn, nbProductOut)
{
	if (typeof(current_friendly_url) === 'undefined')
		current_friendly_url = '#';

	$('div.pagination a').not(':hidden').each(function () {

		if ($(this).attr('href').search(/(\?|&)p=/) == -1)
			var page = 1;
		else
			var page = parseInt($(this).attr('href').replace(/^.*(\?|&)p=(\d+).*$/, '$2'));

		var location = window.location.href.replace(/#.*$/, '');
		$(this).attr('href', location + current_friendly_url.replace(/\/page-(\d+)/, '') + '/page-' + page);
	});

	$('div.pagination li').not('.current, .disabled').each(function () {
		var nbPage = 0;
		if ($(this).hasClass('pagination_next'))
			nbPage = parseInt($('div.pagination li.current').children().children().html())+ 1;
		else if ($(this).hasClass('pagination_previous'))
			nbPage = parseInt($('div.pagination li.current').children().children().html())- 1;

		$(this).children().children().on('click', function(e)
		{
			e.preventDefault();
			if (nbPage == 0)
				p = parseInt($(this).html()) + parseInt(nbPage);
			else
				p = nbPage;
			p = '&p='+ p;
			reloadContent(p);
			nbPage = 0;
		});
	});

	//product count refresh
	if(nbProductsIn!=false)
	{
		if(isNaN(nbProductsIn) == 0)
		{
			// add variables
			var productCountRow = $('.product-count').html();
			var nbPage = parseInt($('div.pagination li.current').children().children().html());
			var nb_products = nbProductsIn;

			if ($('#nb_item option:selected').length == 0)
				var nbPerPage = nb_products;
			else
				var nbPerPage = parseInt($('#nb_item option:selected').val());

			isNaN(nbPage) ? nbPage = 1 : nbPage = nbPage;
			nbPerPage*nbPage < nb_products ? productShowing = nbPerPage*nbPage :productShowing = (nbPerPage*nbPage-nb_products-nbPerPage*nbPage)*-1;
			nbPage==1 ? productShowingStart=1 : productShowingStart=nbPerPage*nbPage-nbPerPage+1;


			//insert values into a .product-count
			productCountRow = $.trim(productCountRow);
			productCountRow = productCountRow.split(' ');

			var backStart = new Array;
			for (row in productCountRow)
				if (parseInt(productCountRow[row]) + 0 == parseInt(productCountRow[row]))
					backStart.push(row);

			if (typeof backStart[0] !== 'undefined')
				productCountRow[backStart[0]] = productShowingStart;
			if (typeof backStart[1] !== 'undefined')
				productCountRow[backStart[1]] = (nbProductOut != 'undefined') && (nbProductOut > productShowing) ? nbProductOut : productShowing;
			if (typeof backStart[2] !== 'undefined')
				productCountRow[backStart[2]] = nb_products;

			if (typeof backStart[1] !== 'undefined' && typeof backStart[2] !== 'undefined' && productCountRow[backStart[1]] > productCountRow[backStart[2]])
				productCountRow[backStart[1]] = productCountRow[backStart[2]];

			productCountRow = productCountRow.join(' ');
			$('.product-count').html(productCountRow);
			$('.product-count').show();
		}
		else
			$('.product-count').hide();
	}
}

function cancelFilter()
{
	$(document).on('click', '#enabled_filters a', function(e){
		if ($(this).data('rel').search(/_slider$/) > 0)
		{
			if ($('#'+$(this).data('rel')).length)
			{
				$('#'+$(this).data('rel')).slider('values' , 0, $('#'+$(this).data('rel')).slider('option' , 'min' ));
				$('#'+$(this).data('rel')).slider('values' , 1, $('#'+$(this).data('rel')).slider('option' , 'max' ));
				$('#'+$(this).data('rel')).slider('option', 'slide')(0,{values:[$('#'+$(this).data('rel')).slider( 'option' , 'min' ), $('#'+$(this).data('rel')).slider( 'option' , 'max' )]});
			}
			else if($('#'+$(this).data('rel').replace(/_slider$/, '_range_min')).length)
			{
				$('#'+$(this).data('rel').replace(/_slider$/, '_range_min')).val($('#'+$(this).data('rel').replace(/_slider$/, '_range_min')).attr('limitValue'));
				$('#'+$(this).data('rel').replace(/_slider$/, '_range_max')).val($('#'+$(this).data('rel').replace(/_slider$/, '_range_max')).attr('limitValue'));
			}
		}
		else
		{
			if ($('option#'+$(this).data('rel')).length)
				$('#'+$(this).data('rel')).parent().val('');
			else
			{
				$('#'+$(this).data('rel')).attr('checked', false);
				$('.'+$(this).data('rel')).attr('checked', false);
				$('#layered_form input[type=hidden][name='+$(this).data('rel')+']').remove();
			}
		}
		reloadContent(true);
		e.preventDefault();
	});
}

function openCloseFilter()
{
	$(document).on('click', '#layered_form span.layered_close a', function(e)
	{
		if ($(this).html() == '&lt;')
		{
			$('#'+$(this).data('rel')).show();
			$(this).html('v');
			$(this).parent().removeClass('closed');
		}
		else
		{
			$('#'+$(this).data('rel')).hide();
			$(this).html('&lt;');
			$(this).parent().addClass('closed');
		}

		e.preventDefault();
	});
}

function stopAjaxQuery() {
	if (typeof(ajaxQueries) == 'undefined')
		ajaxQueries = new Array();
	for(i = 0; i < ajaxQueries.length; i++)
		ajaxQueries[i].abort();
	ajaxQueries = new Array();
}

function reloadContent(params_plus)
{
	stopAjaxQuery();

	if (!ajaxLoaderOn)
	{
		$('.product_list').prepend($('#layered_ajax_loader').html());
		$('.product_list').css('opacity', '1');
		ajaxLoaderOn = 1;
	}

	data = $('#layered_form').serialize();
	$('.layered_slider').each( function () {
		var sliderStart = $(this).slider('values', 0);
		var sliderStop = $(this).slider('values', 1);
		if (typeof(sliderStart) == 'number' && typeof(sliderStop) == 'number')
			data += '&'+$(this).attr('id')+'='+sliderStart+'_'+sliderStop;
	});

	$(['price', 'weight']).each(function(it, sliderType)
	{
		if ($('#layered_'+sliderType+'_range_min').length)
			data += '&layered_'+sliderType+'_slider='+$('#layered_'+sliderType+'_range_min').val()+'_'+$('#layered_'+sliderType+'_range_max').val();
	});

	$('#layered_form .select option').each( function () {
		if($(this).attr('id') && $(this).parent().val() == $(this).val())
			data += '&'+$(this).attr('id') + '=' + $(this).val();
	});

	if ($('.selectProductSort').length && $('.selectProductSort').val())
	{
		if ($('.selectProductSort').val().search(/orderby=/) > 0)
		{
			// Old ordering working
			var splitData = [
				$('.selectProductSort').val().match(/orderby=(\w*)/)[1],
				$('.selectProductSort').val().match(/orderway=(\w*)/)[1]
			];
		}
		else
		{
			// New working for default theme 1.4 and theme 1.5
			var splitData = $('.selectProductSort').val().split(':');
		}
		data += '&orderby='+splitData[0]+'&orderway='+splitData[1];
	}
	if ($('select[name=n]:first').length)
	{
		if (params_plus)
			data += '&n=' + $('select[name=n]:first').val();
		else
			data += '&n=' + $('div.pagination form.showall').find('input[name=n]').val();
	}

	var slideUp = true;
	if (params_plus == undefined || !(typeof params_plus == 'string'))
	{
		params_plus = '';
		slideUp = false;
	}

	// Get nb items per page
	var n = '';
	if (params_plus)
	{
		$('div.pagination select[name=n]').children().each(function(it, option) {
			if (option.selected)
				n = '&n=' + option.value;
		});
	}
	ajaxQuery = $.ajax(
	{
		type: 'GET',
		url: baseDir + 'modules/blocklayered/blocklayered-ajax.php',
		data: data+params_plus+n,
		dataType: 'json',
		cache: false, // @todo see a way to use cache and to add a timestamps parameter to refresh cache each 10 minutes for example
		success: function(result)
		{
			if (result.meta_description != '')
				$('meta[name="description"]').attr('content', result.meta_description);

			if (result.meta_keywords != '')
				$('meta[name="keywords"]').attr('content', result.meta_keywords);

			if (result.meta_title != '')
				$('title').html(result.meta_title);

			if (result.heading != '')
				$('h1.page-heading .cat-name').html(result.heading);

			$('#layered_block_left').replaceWith(utf8_decode(result.filtersBlock));
			$('.category-product-count, .heading-counter').html(result.categoryCount);

			if (result.nbRenderedProducts == result.nbAskedProducts)
				$('div.clearfix.selector1').hide();

			if (result.productList)
				$('.product_list').replaceWith(utf8_decode(result.productList));
			else
				$('.product_list').html('');

			$('.product_list').css('opacity', '1');
			if ($.browser.msie) // Fix bug with IE8 and aliasing
				$('.product_list').css('filter', '');

			if (result.pagination.search(/[^\s]/) >= 0)
			{
				var pagination = $('<div/>').html(result.pagination)
				var pagination_bottom = $('<div/>').html(result.pagination_bottom);

				if ($('<div/>').html(pagination).find('#pagination').length)
				{
					$('#pagination').show();
					$('#pagination').replaceWith(pagination.find('#pagination'));
				}
				else
					$('#pagination').hide();

				if ($('<div/>').html(pagination_bottom).find('#pagination_bottom').length)
				{
					$('#pagination_bottom').show();
					$('#pagination_bottom').replaceWith(pagination_bottom.find('#pagination_bottom'));
				}
				else
					$('#pagination_bottom').hide();
			}
			else
			{
				$('#pagination').hide();
				$('#pagination_bottom').hide();
			}

			paginationButton(result.nbRenderedProducts, result.nbAskedProducts);
			ajaxLoaderOn = 0;

			// On submiting nb items form, relaod with the good nb of items
			$('div.pagination form').on('submit', function(e)
			{
				e.preventDefault();
				val = $('div.pagination select[name=n]').val();

				$('div.pagination select[name=n]').children().each(function(it, option) {
					if (option.value == val)
						$(option).attr('selected', true);
					else
						$(option).removeAttr('selected');
				});

				// Reload products and pagination
				reloadContent();
			});
			if (typeof(ajaxCart) != "undefined")
				ajaxCart.overrideButtonsInThePage();

			if (typeof(reloadProductComparison) == 'function')
				reloadProductComparison();

			filters = result.filters;
			initFilters();
			initSliders();

			current_friendly_url = result.current_friendly_url;

			// Currente page url
			if (typeof(current_friendly_url) === 'undefined')
				current_friendly_url = '#';

			// Get all sliders value
			$(['price', 'weight']).each(function(it, sliderType)
			{
				if ($('#layered_'+sliderType+'_slider').length)
				{
					// Check if slider is enable & if slider is used
					if (typeof($('#layered_'+sliderType+'_slider').slider('values', 0)) != 'object')
					{
						if ($('#layered_'+sliderType+'_slider').slider('values', 0) != $('#layered_'+sliderType+'_slider').slider('option' , 'min')
						|| $('#layered_'+sliderType+'_slider').slider('values', 1) != $('#layered_'+sliderType+'_slider').slider('option' , 'max'))
							current_friendly_url += '/'+blocklayeredSliderName[sliderType]+'-'+$('#layered_'+sliderType+'_slider').slider('values', 0)+'-'+$('#layered_'+sliderType+'_slider').slider('values', 1)
					}
				}
				else if ($('#layered_'+sliderType+'_range_min').length)
					current_friendly_url += '/'+blocklayeredSliderName[sliderType]+'-'+$('#layered_'+sliderType+'_range_min').val()+'-'+$('#layered_'+sliderType+'_range_max').val();
			});

			window.location.href = current_friendly_url;

			if (current_friendly_url != '#/show-all')
				$('div.clearfix.selector1').show();

			lockLocationChecking = true;

			if (slideUp)
				$.scrollTo('.product_list', 400);
			updateProductUrl();

			$('.hide-action').each(function() {
				hideFilterValueAction(this);
			});

			if (display instanceof Function) {
				var view = $.totalStorage('display');

				if (view && view != 'grid')
					display(view);
			}
		}
	});
	ajaxQueries.push(ajaxQuery);
}

function initLocationChange(func, time)
{
	if (!time)
		time = 500;
	var current_friendly_url = getUrlParams();
	setInterval(function()
	{
		if(getUrlParams() != current_friendly_url && !lockLocationChecking)
		{
			// Don't reload page if current_friendly_url and real url match
			if (current_friendly_url.replace(/^#(\/)?/, '') == getUrlParams().replace(/^#(\/)?/, ''))
				return;

			lockLocationChecking = true;
			reloadContent('&selected_filters='+getUrlParams().replace(/^#/, ''));
		}
		else
		{
			lockLocationChecking = false;
			current_friendly_url = getUrlParams();
		}
	}, time);
}

function getUrlParams()
{
	if (typeof(current_friendly_url) === 'undefined')
		current_friendly_url = '#';

	var params = current_friendly_url;
	if(window.location.href.split('#').length == 2 && window.location.href.split('#')[1] != '')
		params = '#'+window.location.href.split('#')[1];
	return params;
}

function updateProductUrl()
{
	// Adding the filters to URL product
	if (typeof(param_product_url) != 'undefined' && param_product_url != '' && param_product_url !='#') {
		$.each($('ul.product_list li.ajax_block_product .product_img_link,'+
				'ul.product_list li.ajax_block_product h5 a,'+
				'ul.product_list li.ajax_block_product .product_desc a,'+
				'ul.product_list li.ajax_block_product .lnk_view'), function() {
			$(this).attr('href', $(this).attr('href') + param_product_url);
		});
	}
}

/**
 * Copy of the php function utf8_decode()
 */
function utf8_decode (utfstr)
{
	var res = '';
	for (var i = 0; i < utfstr.length;) {
		var c = utfstr.charCodeAt(i);

		if (c < 128)
		{
			res += String.fromCharCode(c);
			i++;
		}
		else if((c > 191) && (c < 224))
		{
			var c1 = utfstr.charCodeAt(i+1);
			res += String.fromCharCode(((c & 31) << 6) | (c1 & 63));
			i += 2;
		}
		else
		{
			var c1 = utfstr.charCodeAt(i+1);
			var c2 = utfstr.charCodeAt(i+2);
			res += String.fromCharCode(((c & 15) << 12) | ((c1 & 63) << 6) | (c2 & 63));
			i += 3;
		}
	}
	return res;
}