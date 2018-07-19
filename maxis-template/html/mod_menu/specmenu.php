<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$id = '';

if ($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}

// The menu class is deprecated. Use nav instead
?>
<nav id="ml-stack-nav-1" class="ml-stack-nav js-ml-stack-nav" aria-expanded="false">
<ul class="ml-stack-nav__menu <?php echo $class_sfx; ?>"<?php echo $id; ?>>
<?php foreach ($list as $i => &$item)
{
	$class = 'ml-stack-nav__item item-' . $item->id;

	if ($item->id == $default_id)
	{
		$class .= ' default';
	}

	if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id))
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->type === 'separator')
	{
		$class .= ' divider';
	}

	if ($item->deeper)
	{
		$class .= ' deeper';
	}

	if ($item->parent)
	{
		$class .= ' parent';
	}

	echo '<li class="' . $class . '">';

	echo '<div class="ml-stack-nav__item-inner">';

	if ($item->deeper)
	{
	echo '<button class="ml-stack-nav__next js-ml-stack-nav-next" type="button" title="Go to the next level">→</button>';
	}


	switch ($item->type) :
		case 'separator':
		case 'component':
		case 'heading':
		case 'url':
			require JModuleHelper::getLayoutPath('mod_menu', 'specmenu_' . $item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'specmenu_url');
			break;
	endswitch;



	echo "</div>";

	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<ul class="ml-stack-nav__menu nav-child unstyled small">';
		echo '<li class="ml-stack-nav__item">
                    <button class="ml-stack-nav__back js-ml-stack-nav-back" type="button" title="Go to the previous level">← Back</button>
                </li>';
	}
	// The next item is shallower.
	elseif ($item->shallower)
	{

		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else
	{
		echo '</li>';
	}
}
?></ul></nav>
<script>
    $(".js-ml-stack-nav").mlStackNav();
</script>
