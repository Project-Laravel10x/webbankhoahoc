<?php
function getNewsCategoriesCheckbox($news, $old = [], $parentId = 0, $char = '')
{

    if ($news) {
        foreach ($news as $key => $new) {
            if ($new['parent_id'] == $parentId) {
                $checked = !empty($old) && in_array($new['id'],$old) ? 'checked' : '';
                echo '<label class="d-block"><input type="checkbox" name="new_category_id[]" value="'.$new["id"].'" '.$checked.'>' . $char . $new['name'] . '</label>';
                unset($new[$key]);
                getNewsCategoriesCheckbox($news, $old, $new['id'], $char . '  |- ');
            }
        }
    }
}

