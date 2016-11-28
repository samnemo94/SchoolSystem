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
            echo '<div class="col-sm-4">
				<input id="varchar" type="text" name="'.$field['field_title'].'">
				</div>
			</div>';
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
  echo Html::submitButton('Save', ['id'=>'btn','class' => 'btn']) ?>
<?php ActiveForm::end(); ?>

