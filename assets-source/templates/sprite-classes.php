<?php
/**
 * Theme Instructions: Sprite Classes
 *
 * @package _starter
 * @author  @troutacular <troutacular@gmail.com>
 */

?>

<h3 id="title-icon">Icon</h3>
<ul class="sprite-icon-samples">
{{#shapes}}
	<li class="icon-{{base}}">icon-{{base}}</li>
{{/shapes}}
</ul>

<h3 id="title-icon-only">Icon Only</h3>
<ul class="sprite-icon-samples">
{{#shapes}}
	<li><span class="icon-only-{{base}}"></span>icon-only-{{base}}</li>
{{/shapes}}
</ul>
