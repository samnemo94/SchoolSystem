<?php use yii\helpers\Html; ?>
<div class="site-about">

    <table class="table">
      <thead>
       <tr>
           <?php
           foreach ($columns as $col)
           {
               ?>
               <th><?= $col['title'] ?></th>
    <?php
            }
            ?>
        </tr>
       </thead>
        <tbody>
      <?php
      foreach ($rows as $row)
       {
            ?>
          <tr>
             <?php
              foreach ($row as $col)
             {
             ?>
                   <td><?= $col['value'] ?></td>
                       <?php
               }
             ?>
          </tr>
   <?php
        }
       ?>
     </tbody>
    </table>
    <div class="row">


        <?php
        if( Yii::$app->language == 'en')
            echo '<h1> Teachers Requests :</h1>';
        else echo '<h1>طلبات الانضمام:</h1>';

        foreach ($rows as $key =>$row)
        {
            if (!$row['is_active']['value']){
                echo $row['first_name']['value'].'  '.$row['last_name']['value'];
                echo "\t";
                if( Yii::$app->language == 'en'){
               echo Html::button('Approve',['id'=>'demo','onclick'=>'approve('.$key.')']).'<br>';}
                else {
                    echo Html::button('قبول', ['id' => 'demo', 'onclick' => 'approve(' . $key . ')']) . '<br>';
                }
            }
        }
        ?>

    </div>
    <div class="row">

        <?php
        if( Yii::$app->language == 'en')
            echo '<h1> Teachers :</h1>';
        else echo '<h1>المدرسين  :</h1>';
        foreach ($rows as $row)
        {
            if ($row['is_active']['value']){
                echo $row['first_name']['value'].'  '.$row['last_name']['value'];
                echo '<br>';

            }
        }
        ?>

    </div>
</div>

<script type="text/javascript">
    function approve(key)
    {
        document.getElementById('demo').style.display = 'none';
        values = {key:key};
        //console.log(values);
        $.ajax({
            url: "index.php?r=site/active",
            type: "POST",
            data: values ,
            success: function (response) {
                console.log(response);
                console.log(values);
            }
        });
    }
</script>
