<?php use yii\helpers\Html; ?>
<div class="categories-view">

    <div class="content table-responsive table-full-width">
        <table class="table table-hover table-striped">
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
                   <th>
                        <?= 'Active' ?>
                   </th>
                </tr>
            </thead>
        <tbody>
              <?php
              foreach ($rows as $key =>$row)
               {
                   ?>
                  <tr>
                     <?php
                      foreach ($row as $col)
                     {
                         if ($col['value'] == "")
                             continue;
                         else
                     ?>
                           <td><?= $col['value'] ?></td>

                         <?php
                       }
                     ?>
                      <td> <?php if ($row['is_active']['value'] == 1 ) {
                          echo Html::button('Deactivate',['class' =>'btn-link','id'=>'demo','onclick'=>'active('.$key.')']).'<br>';
                          }
                          else echo Html::button('Activeate',['class' =>'btn-link','id'=>'demo','onclick'=>'active('.$key.')']).'<br>'; ?>
                      </td>
                  </tr>
           <?php
                }
            ?>
     </tbody>
    </table>
        </div>

</div>

<script type="text/javascript">
    function active(key)
    {
        //document.getElementById('demo')
        values = {key:key};
        //console.log(values);
        $.ajax({
            url: "index.php?r=site/active",
            type: "POST",
            data: values ,
            success: function (response) {
                console.log(response);
                console.log(values);
                location.reload();
            }
        });
    }
</script>