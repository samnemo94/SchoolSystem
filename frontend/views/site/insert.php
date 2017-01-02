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

    <script>
        var add_languages = '';
        x = function ()
        {
            selectt = document.getElementById('language_selector');
            var language_name = selectt.options[selectt.selectedIndex].text;
            if (language_name != 'Select language' && add_languages.indexOf('[' + language_name + ']') == -1) {
                add_languages += '[' + language_name + ']';
                iid = 'div_'+language_name;
                document.getElementById(iid).style.display = 'block';
            }
        };
    </script>

<div class="field">
    <select id="language_selector" class="ui fluid dropdown" style="width: 25%">
        <option value="">Select language</option>
        <?php
        foreach ($langs as $lang)
        {
            echo '<option value="' . $lang['language_id'] . '">' . $lang['language_code'] . '</option> ';
        }
        ?>
    </select>
<br>
<?php if( yii::$app->language == 'en')
    echo '<button onclick="x()" class="ui blue basic button" title="Add field">add language</button>';
else
    echo '<button onclick="x()" class="ui blue basic button" title="Add field">اضافة لغة</button>'; ?>
    <br>
    <br>
    <br>
</div>
<?php
ActiveForm::begin(['action' => 'index.php?r=site/insert&id=' . $id. '&fk_id='.$fk_id, 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data','class'=>'ui form']]);


foreach ($fields as $field)
{
    if (!$field['has_translate'] && $field['is_show'] == 1)
        printFieldInput($field,$items);
}

foreach ($langs as $lang)
{
    ?>
    <div style="display: none;margin-bottom: 25px" id="div_<?= $lang->language_code ?>">
        <h3 class="ui horizontal divider header">
            <i class=""></i>
            <?= $lang->language_code ?>
        </h3>
        <?php
        foreach ($fields as $field)
        {
            if ($field['has_translate'] && $field['is_show'] == 1)
                printFieldInput($field,$items, $lang->language_code);
        }
        ?>
    </div>
    <?php
}
if ( yii::$app->language == 'en')
echo Html::submitButton('Save', ['id' => 'btn', 'class' => 'btn']);
else  echo Html::submitButton('حفظ', ['id' => 'btn', 'class' => 'btn']);
ActiveForm::end();
?>



<?php

function printFieldInput($field,$items, $lang = '')
{
    ?>
<div class="field">
        <?php
        $language = yii::$app->language;
        if($language == 'en')
            echo '<label  id="label_<?= $field->field_id ?>_<?= $lang ?>">'.$field['field_title'].'</label>';
        else
            echo '<label  id="label_<?= $field->field_id ?>_<?= $lang ?>">'.$field['field_title_ar'].'</label>';;
        ?>

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
                    <select class="ui fluid dropdown" id="input_<?= $field->field_id ?>_<?= $lang ?>"
                            name="<?= $field['field_title'] . (($lang) ? $lang : '') ?>">
                        <option value="">Select Item</option>
                        <?php
                        $langg = \backend\models\Languages::findOne(['language_code' => Yii::$app->language])->language_id;
                        foreach ($items[$field->fk_table] as $item) {
                            $fkTable = Categories::find()->where(['category_id'=>$field->fk_table])->one();
                            $fkTable = $fkTable['category_title'];

                            if ($fkTable == 'teachers'){
                                $t_info = \frontend\controllers\MyController::getItemInfo($item['item_id'], $langg);
                                echo "<option value=\"" . $item['item_id'] . "\">" . $t_info['first_name']['value'].' '. $t_info['last_name']['value']. "</option> ";
                            }

                            else
                            {
                                $s_info = \frontend\controllers\MyController::getItemInfo($item['item_id'], $langg);
                                if (array_key_exists('title', $s_info))
                                    echo "<option value=\"" . $item['item_id'] . "\">" . $s_info['title']['value'] . "</option> ";
                                else
                                    echo "<option value=\"" . $item['item_id'] . "\">" . $s_info['item_id'] . "</option> ";
                            }
                        }
                        ?>
                    </select>
                    <?php
                    break;
            }
            ?>
    </div>
<?php
}

?>

