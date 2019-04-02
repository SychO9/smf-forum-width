<?php
/**
 * @package Forum Width Setting
 * @author Sami "SychO" Mazouz
 * @version 1.1
 * @license Copyright (c) 2019 Sami "SychO" Mazouz
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
if (!defined('SMF'))
	die('No direct access...');

/**
 * Adds the forum width setting to the theme settings page
 * integrate_theme_settings
 */
function forum_width_setting()
{
	global $context, $settings, $txt;
	// Language strings
	loadLanguage('ForumWidth');
	$desc = $txt['forum_width_desc'];
	// if this isn't the Curve2 theme, add a warning that it might not work
	if($settings['theme_id'] != 1)
		$desc .= '<br>' . $txt['forum_width_warning'];
	// Add the setting to themes settings page(any theme)
	$context['theme_settings'] = array_merge(array(
		array(
			'id' => 'forum_width',
			'label' => $txt['forum_width'],
			'description' => $desc,
			'type' => 'text'
		)
	), $context['theme_settings']);
}

/**
 * The css code that controls the forum width
 * integrate_pre_css_output
 */
function forum_width_css()
{
	global $settings;
	// This is where the magic happens !
	if(!empty($settings['forum_width']))
		addInlineCss('
			#top_section .inner_wrap, #wrapper, #header, #footer .inner_wrap
			{
				max-width:'.$settings['forum_width'].';
				width: unset;
			}
			#footer, #top_section
			{
				padding-left: 2px;
				padding-right: 2px;
			}
			@media screen and (max-width: 720px)
			{
				#top_section .inner_wrap, #wrapper, #header, #footer .inner_wrap
				{
					max-width: unset;
					width: 100%;
				}
			}
		');
}

/**
 * Credits
 * integrate_credits
 */
function forum_width_credits()
{
	global $context;
	$context['copyrights']['mods'][] = '<a href="https://github.com/SychO9/smf-forum-width">Forum Width Setting v1.1</a> by <a href="https://github.com/SychO9">SychO</a> &copy; 2019 | Licensed under <a href="http://en.wikipedia.org/wiki/MIT_License" target="_blank" rel="noopener">The MIT License (MIT)</a>';
}