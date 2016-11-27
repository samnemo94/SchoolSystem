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
<?php ActiveForm::begin(['action' => 'index.php?r=categories/update-row&id='.$id.'&id2='.$id2, 'method' => 'post','options'=>['enctype' => 'multipart/form-data']]); ?>

<?php

$i = 0;
foreach ($values as $value){
        $field = \backend\models\Fields::find()->where(['field_id'=>$value['field_id']])->one();
        $type = $field['field_type'];
        switch ($type){
            case  'int':
                echo '<div class="row">';
                echo '<label class="col-sm-2" for="int">'.$field['field_title'].'</label>';
                echo '<div class="col-sm-4">
				<input id="int" value="'.$value['value'].'" type="number" name="'.$field['field_title'].'">
				</div>
			</div>';
                break;

            case 'varchar' :
                echo '<div class="row">';
                echo '<label class="col-sm-2" for="varchar">'.$field['field_title'].'</label>';
                echo '<div class="col-sm-4">
				<input id="varchar" value="'.$value['value'].'" type="text" name="'.$field['field_title'].'">
				</div>
			</div>';
                break;
            case 'text' :
                echo '<div class="row">';
                echo '<label class="col-sm-2" for="text">'.$field['field_title'].'</label>';
                echo '<div class="col-sm-4">
				<textarea id="text" value="'.$value['value'].'" name="'.$field['field_title'].'" cols="40" rows="5"></textarea>
				</div>
			</div>';
                break;
            case 'double' :
                echo '<div class="row">';
                echo '<label class="col-sm-2" for="double">'.$field['field_title'].'</label>';
                echo '<div class="col-sm-4">
				<input id="double" value="'.$value['value'].'" step="0.01" type="number" name="'.$field['field_title'].'">
				</div>
			</div>';
                break;
            case 'date' :
                echo '<div class="row">';
                echo '<label class="col-sm-2" for="date">'.$field['field_title'].'</label>';
                echo '<div class="col-sm-4">
				<input id="date" value="'.$value['value'].'"  type="date" name="'.$field['field_title'].'">
				</div>
			</div>';
                break;
            case 'time':
                echo '<div class="row">';
                echo '<label class="col-sm-2" for="time">'.$field['field_title'].'</label>';
                echo '<div class="col-sm-4">
				<input id="time" value="'.$value['value'].'" type="time" name="'.$field['field_title'].'">
				</div>
			</div>';
                break;
            case 'date_time' :
                echo '<div class="row">';
                echo '<label class="col-sm-2" for="datetime">'.$field['field_title'].'</label>';
                echo '<div class="col-sm-4">
				<input id="datetime" value="'.$value['value'].'" type="datetime-local" name="'.$field['field_title'].'">
				</div>
			</div>';
                break;
            case 'image' :
                echo '<div class="row">';
                echo '<label class="col-sm-2" for="image">'.$field['field_title'].'</label>';
                echo '<div class="col-sm-4">
				<input id="image" value="'.$value['value'].'" type="file" name="'.$field['field_title'].'">
				</div>
			</div>';
                break;
            case 'file' :
                echo '<div class="row">';
                echo '<label class="col-sm-2" for="file">'.$field['field_title'].'</label>';
                echo '<div class="col-sm-4">
				<input id="file" value="'.$value['value'].'" type="file" name="'.$field['field_title'].'">
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

echo Html::submitButton('Save', ['class' => 'btn']) ?>
<?php ActiveForm::end(); ?>

