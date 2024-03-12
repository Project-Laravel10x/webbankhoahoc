<?php
function getCategories($categories, $old = '', $parentId = 0, $char = '')
{

    if ($categories) {
        foreach ($categories as $key => $category) {
            $selected = '';
            if ($old == $category['id']) {
                $selected = ' selected';
            }

            if ($category['parent_id'] == $parentId) {
                echo '<option value="' . $category['id'] . '" ';
                echo $selected;
                echo '  >' . $char . $category['name'] . '</option>';
                unset($category[$key]);
                getCategories($categories, $old, $category['id'], $char . '  |- ');
            }
        }
    }
}

