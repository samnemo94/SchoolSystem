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




<?php
echo ' <a href="javascript:void(0);" class="add_button" title="Add field">add</a>';
echo '<select id="language_selector" >
				<option value="" >Select language </option>';
$langs = \backend\models\Languages::find()->all();
foreach ($langs as $lang){
    echo "<option value=\"".$lang['language_id']."\">".$lang['language_code']."</option> ";
}
echo '</select>';
?>

<?php ActiveForm::begin(['action' => 'index.php?r=categories/insert&id='.$id, 'method' => 'post','options'=>['enctype' => 'multipart/form-data']]); ?>
<?php
foreach ($fields as $field){
    switch ($field['field_type']){
        case  'int':
            echo '<div class="row">';
            echo '<label class="col-sm-2" for="int">'.$field['field_title'].'</label>';
            echo '<div class="col-sm-4">
				<input id="int" type="number" name="'.$field['field_title'].'">
				</div>
			</div>';
            break;

        case 'varchar' :
            echo '<div class="row">';
            echo '<label class="col-sm-2" for="varchar">'.$field['field_title'].'</label>';
            echo '<div class="col-sm-4">';
            echo '<input id="varchar" type="text" name="'.$field['field_title'].'">';
            echo '</div>';
            echo '</div>';
            // echo '<button name="add" id="add" title="Add translate">add translate</button>';}
            break;
        case 'text' :
            echo '<div class="row">';
            echo '<label class="col-sm-2" for="text">'.$field['field_title'].'</label>';
            echo '<div class="col-sm-4">
				<textarea id="text" name="'.$field['field_title'].'" cols="40" rows="5"></textarea>
				</div>
			</div>';
            break;
        case 'double' :
            echo '<div class="row">';
            echo '<label class="col-sm-2" for="double">'.$field['field_title'].'</label>';
            echo '<div class="col-sm-4">
				<input id="double" step="0.01" type="number" name="'.$field['field_title'].'">
				</div>
			</div>';
            break;
        case 'date' :
            echo '<div class="row">';
            echo '<label class="col-sm-2" for="date">'.$field['field_title'].'</label>';
            echo '<div class="col-sm-4">
				<input id="date" type="date" name="'.$field['field_title'].'">
				</div>
			</div>';
            break;
        case 'time':
            echo '<div class="row">';
            echo '<label class="col-sm-2" for="time">'.$field['field_title'].'</label>';
            echo '<div class="col-sm-4">
				<input id="time" type="time" name="'.$field['field_title'].'">
				</div>
			</div>';
            break;
        case 'date_time' :
            echo '<div class="row">';
            echo '<label class="col-sm-2" for="datetime">'.$field['field_title'].'</label>';
            echo '<div class="col-sm-4">
				<input id="datetime" type="datetime-local" name="'.$field['field_title'].'">
				</div>
			</div>';
            break;
        case 'image' :
            echo '<div class="row">';
            echo '<label class="col-sm-2" for="image">'.$field['field_title'].'</label>';
            echo '<div class="col-sm-4">
				<input id="image" type="file" name="'.$field['field_title'].'">
				</div>
			</div>';
            break;
        case 'file' :
            echo '<div class="row">';
            echo '<label class="col-sm-2" for="file">'.$field['field_title'].'</label>';
            echo '<div class="col-sm-4">
				<input id="file" type="file" name="'.$field['field_title'].'">
				</div>
			</div>';
            break;
        case 'foreign_key' :
            echo '<div class="row">';
            echo '<label class="col-sm-2" for="varchar">'.$field['field_title'].'</label>';
            echo '<div class="col-sm-4">
				<select name="'.$field['field_title'].'">
				<option value="" >Select Item </option>';
            foreach ($items as $item){
                echo "<option value=\"".$item['item_id']."\">".$item['item_id']."</option> ";
            }
            echo '</select> 
                </div>
			</div>';
            break;
    }

}
echo '<div class="field_wrapper">';
echo '</div>';

echo Html::submitButton('Save', ['id'=>'btn','class' => 'btn']) ?>
<?php ActiveForm::end(); ?>


<script type="text/javascript">

        $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper');
              var x = 1; //Initial field counter is 1
        $(addButton).click(function(){
            var language_name = $('#language_selector').find(":selected").text();
            var assignLanggauegToPhp = '<?php $lang = "'+language_name+'";?>';
            var fieldHTML = '<?php
                echo '<div>';
                foreach ($fields as $field){
                    switch ($field['field_type']){
                        case 'varchar' :
                            echo '<div class="row">';
                            echo '<label class="col-sm-2" for="varchar">'.$field['field_title'].'_'.$lang.'</label>';
                            echo '<div class="col-sm-4">';
                            echo '<input id="varchar" type="text" name="'.$field['field_title'].'_'.$lang.'"> <a href="javascript:void(0);" class="remove_button" title="Remove field">remove</a></div>';
                            ;
                            // echo '<button name="add" id="add" title="Add translate">add translate</button>';}
                            echo '</div>';
                            break;


                        case 'text' :
                            echo '<div class="row"><label class="col-sm-2" for="text">'.$field['field_title'].'_'.$lang.'</label>';
                            echo '<div class="col-sm-4"><textarea id="text" name="'.$field['field_title'].'_'.$lang.'" cols="40" rows="5"></textarea></div></div>';
                            break;
                    }
                }
                echo '</div>';
                ?>'; //New input field html


            //Once add button is clicked
                $(wrapper).append(fieldHTML); // Add field html
                console.log(fieldHTML);
        });
        $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').parent('div').parent().remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

</script>

