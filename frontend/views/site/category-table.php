<?php use yii\helpers\Html; ?>
<div class="categories-view">

    <div class="content table-responsive table-full-width">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <?php
                foreach ($columns as $col)
                {
                  echo '<th>'.$col['title'].'</th>' ;
                }
                ?>
                <th>
                    <?php if ( yii::$app->language == 'en' )
                        echo 'update';
                    else echo 'تعديل'; ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($rows as $key =>$row) {

                echo '<tr>';

                foreach ($row as $col) {
                    if ($col['value'] == "")
                        continue;
                    else
                        echo '<td>' . $col['value'] . '</td>';
                }

                echo '<td>';
                if ( yii::$app->language == 'en')
                echo
                Html::a('Update',
                    ['site/update-row', 'id' => $key], [
                        'title' => Yii::t('yii', 'Update'),
                    ]);
                else
                    echo
                Html::a('تعديل',
                    ['site/update-row', 'id' => $key], [
                        'title' => Yii::t('yii', 'Update'),
                    ]);
//                Html::a('Delete',
//                    ['site/delete-row', 'id' => $key], [
//                        'title' => Yii::t('yii', 'Delete'),
//                    ]);
                echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>

</div>