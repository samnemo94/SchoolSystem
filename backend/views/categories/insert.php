<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/23/2016
 * Time: 6:24 PM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Categories;
use backend\models\Values;
use backend\models\Items;

?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <a href="javascript:void(0);" class="add_button" title="Add field">add</a>

    <select id="language_selector">
        <option value="">Select language</option>
        <?php
        foreach ($langs as $lang)
        {
            echo '<option value="' . $lang['language_id'] . '">' . $lang['language_code'] . '</option> ';
        }
        ?>
    </select>

<?php
ActiveForm::begin(['action' => 'index.php?r=categories/insert&id=' . $id, 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]);
foreach ($fields as $field)
{
    if (!$field['has_translate'])
        printFieldInput($field,$items);
}

foreach ($langs as $lang)
{
    ?>
    <div hidden id="div_<?= $lang->language_code ?>">
        <h2> <?= $lang->language_code ?> </h2>
        <?php
        foreach ($fields as $field)
        {
            if ($field['has_translate'])
                printFieldInput($field,$items, $lang->language_code);
        }
        ?>
    </div>
    <?php
}

echo Html::submitButton('Save', ['id' => 'btn', 'class' => 'btn']);
ActiveForm::end();
?>

<script type="text/javascript">

$(document).ready(function () {

    var addButton = $('.add_button'); //Add button selector
    var add_languages = '';
    $(addButton).click(function () {
        var language_name = $('#language_selector').find(":selected").text();
        if (language_name != 'Select language' && add_languages.indexOf('[' + language_name + ']') == -1) {
            add_languages += '[' + language_name + ']';
            $('#div_'+language_name).show();
        }
    });
});
</script>


<?php

function printFieldInput($field,$items, $lang = '')
{
    ?>
    <div class="row">
        <label class="col-sm-2" id="label_<?= $field->field_id ?>_<?= $lang ?>">
            <?= $field['field_title'] ?>
        </label>
        <div class="col-sm-4">
            <?php
            switch ($field['field_type'])
            {
                case  'int':
                    ?>
                    <input type="number" id="input_<?= $field->field_id ?>_<?= $lang ?>"
                           name=" <?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'varchar' :
                    ?>
                    <input type="text" id="input_<?= $field->field_id ?>_<?= $lang ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'text' :
                    echo \dosamigos\tinymce\TinyMce::widget([
                        'name' => $field['field_title'] . (($lang) ? $lang : ''),
                        'id' => "input_" . $field->field_id . "_$lang",
                        'options' => ['rows' => 6],
                        'language' => 'en_GB',
                        'clientOptions' => [
                            'plugins' => [
                                "advlist autolink lists link charmap preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste"
                            ],
                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                        ]
                    ]);
                    break;
                case 'double' :
                    ?>
                    <input step="0.01" type="number" id="input_<?= $field->field_id ?>_<?= $lang ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'date' :
                    ?>
                    <input type="date" id="input_<?= $field->field_id ?>_<?= $lang ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'time':
                    ?>
                    <input type="time" id="input_<?= $field->field_id ?>_<?= $lang ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'date_time' :
                    ?>
                    <input type="datetime-local" id="input_<?= $field->field_id ?>_<?= $lang ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'image' :
                    ?>
                    <input type="file" id="input_<?= $field->field_id ?>_<?= $lang ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'file' :
                    ?>
                    <input type="file" id="input_<?= $field->field_id ?>_<?= $lang ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'foreign_key' :
                    ?>
                    <select id="input_<?= $field->field_id ?>_<?= $lang ?>"
                            name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                        <option value="">Select Item</option>
                        <?php
                        foreach ($items[$field->fk_table] as $item)
                        {
                            echo "<option value=\"" . $item['item_id'] . "\">" . $item['item_id'] . "</option> ";
                        }
                        ?>
                    </select>
                    <?php
                    break;
            }
            ?>
        </div>
    </div>
    <?php
}

?>