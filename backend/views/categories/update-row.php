<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/27/2016
 * Time: 6:31 PM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php ActiveForm::begin(['action' => 'index.php?r=categories/update-row&id='.$id, 'method' => 'post','options'=>['enctype' => 'multipart/form-data']]);

foreach ($fields as $field)
{
    if (!$field['has_translate'])
        printFieldInput($field,$values);
}

foreach ($langs as $lang)
{
    ?>
    <div>
        <h2> <?= $lang->language_code ?> </h2>
        <?php
        foreach ($fields as $field)
        {
            if ($field['has_translate'])
                printFieldInput($field,$values,$lang->language_code);
        }
        ?>
    </div>
    <?php
}

echo Html::submitButton('Save', ['id' => 'btn', 'class' => 'btn']);
ActiveForm::end();
?>

<?php

function printFieldInput($field,$values,$lang = '')
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
                    <input type="number" value="<?= $values[$field['field_id']][$lang?$lang:'0'] ?>"
                           name=" <?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'varchar' :
                    ?>
                    <input type="text" value="<?= $values[$field['field_id']][$lang?$lang:'0'] ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'text' :
                    echo \dosamigos\tinymce\TinyMce::widget([
                        'name' => $field['field_title'] . (($lang) ? $lang : ''),
                        'value' => $values[$field['field_id']][$lang?$lang:'0'],
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
                    <input step="0.01" type="number" value="<?= $values[$field['field_id']][$lang?$lang:'0'] ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'date' :
                    ?>
                    <input type="date" value="<?= $values[$field['field_id']][$lang?$lang:'0'] ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'time':
                    ?>
                    <input type="time" value="<?= $values[$field['field_id']][$lang?$lang:'0'] ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'date_time' :
                    ?>
                    <input type="datetime-local" value="<?= $values[$field['field_id']][$lang?$lang:'0'] ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'image' :
                    ?>
                    <input type="file" value="<?= $values[$field['field_id']][$lang?$lang:'0'] ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'file' :
                    ?>
                    <input type="file" value="<?= $values[$field['field_id']][$lang?$lang:'0'] ?>"
                           name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                    <?php
                    break;
                case 'foreign_key' :
                    ?>
                    <select value="<?= $values[$field['field_id']][$lang?$lang:'0'] ?>"
                            name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                        <option value="">Select Item</option>
                        <?php
                        foreach ($items as $item)
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
