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
        $langs = \backend\models\Languages::find()->all();
        foreach ($langs as $lang)
        {
            echo '<option value="' . $lang['language_id'] . '">' . $lang['language_code'] . '</option> ';
        }
        ?>
    </select>


<?php ActiveForm::begin(['action' => 'index.php?r=categories/insert&id=' . $id, 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<?php
foreach ($fields as $field)
{
    if (!$field['has_translate'])
        printFieldInput($field);
}
?>

    <div class="field_wrapper">

    </div>

<?php
echo Html::submitButton('Save', ['id' => 'btn', 'class' => 'btn']);
ActiveForm::end();
?>


    <script type="text/javascript">

        $(document).ready(function () {
            String.prototype.replaceAll = function(search, replacement) {
                var target = this;
                return target.replace(new RegExp(search, 'g'), replacement);
            };
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper');
            var x = 1; //Initial field counter is 1
            var add_languages = '';
            $(addButton).click(function () {
                var language_name = $('#language_selector').find(":selected").text();
                if (language_name != 'Select language' && add_languages.indexOf('[' + language_name + ']') == -1) {
                    add_languages += '[' + language_name + ']';
                    var assignLanggauegToPhp = '<?php $lang = "'+language_name+'";?>';
                    var fieldHTML = <?php
                        echo '<div>';
                        echo '<h2>_FDSADFASD_</h2>';
                        foreach ($fields as $field)
                        {
                            if ($field['has_translate'])
                                printFieldInput($field, $lang);
                        }
                        echo '</div>';
                        ?>; //New input field html

                    //Once add button is clicked
                    console.log(fieldHTML);
                    fieldHTML = fieldHTML.replaceAll('_FDSADFASD_','_'+language_name);
                    $(wrapper).append(fieldHTML); // Add field html
                    console.log(fieldHTML);
                }
            });
            $(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').parent('div').parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

    </script>


<?php

function printFieldInput($field, $lang = '')
{
    ?>
    <div class="row">
        <label class="col-sm-2">
            <?= $field['field_title'] ?>
        </label>
        <div class="col-sm-4">
            <?php
            switch ($field['field_type'])
            {
                case  'int':
                    ?>
                    <input id="int" type="number"
                           name=" <?= $field['field_title'] . (($lang) ? '_FDSADFASD_' : '') ?>">
                    <?php
                    break;
                case 'varchar' :
                    ?>
                    <input id="varchar" type="text"
                           name="<?= $field['field_title'] . (($lang) ? '_FDSADFASD_' : '') ?>">
                    <?php
                    break;
                case 'text' :
                    echo \dosamigos\ckeditor\CKEditor::widget([
                        'name' => $field['field_title'] . (($lang) ? '_FDSADFASD_' : ''),
                        'options' => ['rows' => 6],
                        'preset' => 'basic'
                    ]);
                    break;
                case 'double' :
                    ?>
                    <input id="double" step="0.01" type="number"
                           name="<?= $field['field_title'] . (($lang) ? '_FDSADFASD_' : '') ?>">
                    <?php
                    break;
                case 'date' :
                    ?>
                    <input id="date" type="date"
                           name="<?= $field['field_title'] . (($lang) ? '_FDSADFASD_' : '') ?>">
                    <?php
                    break;
                case 'time':
                    ?>
                    <input id="time" type="time"
                           name="<?= $field['field_title'] . (($lang) ? '_FDSADFASD_' : '') ?>">
                    <?php
                    break;
                case 'date_time' :
                    ?>
                    <input id="datetime" type="datetime-local"
                           name="<?= $field['field_title'] . (($lang) ? '_FDSADFASD_' : '') ?>">
                    <?php
                    break;
                case 'image' :
                    ?>
                    <input id="image" type="file"
                           name="<?= $field['field_title'] . (($lang) ? '_FDSADFASD_' : '') ?>">
                    <?php
                    break;
                case 'file' :
                    ?>
                    <input id="file" type="file"
                           name="<?= $field['field_title'] . (($lang) ? '_FDSADFASD_' : '') ?>">
                    <?php
                    break;
                case 'foreign_key' :
                    ?>
                    <select name="<?= $field['field_title'] . (($lang) ? '_FDSADFASD_' : '') ?>">
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