<?php use yii\helpers\Html; ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){ /* to make sure the script runs after page load */
        $('.item').each(function(event){ /* select all divs with the item class */
            var max_length = 100; /* set the max content length before a read more link will be added */
            if($(this).html().length > max_length){ /* check for content length */
                var short_content 	= $(this).html().substr(0,max_length); /* split the content in two parts */
                var long_content	= $(this).html().substr(max_length);
                $(this).html(short_content); /* Alter the html to allow the read more functionality */
            }

        });
    });

    </script>

<div class="site-about">
<div class="row">

    <?php
    foreach ($rows as $row)
    {
        echo Html::a(  $row['title']['value'], $url = ['/site/page','id'=>$row['item_id']] );
        ?>
    <div class="item">
        <?= $row['description']['value']; ?>
        </div>
        <?php if( Yii::$app->language == 'en')
        echo Html::a('.......Read more', $url = ['/site/page','id'=>$row['item_id']] ).'<br>';
        else
            echo Html::a('.... قراءة المزيد ', $url = ['/site/page','id'=>$row['item_id']] ).'<br>';
    } ?>

</div>
</div>



<!--<table class="table">-->
<!--    <thead>-->
<!--    <tr>-->
<!--        --><?php
//        foreach ($columns as $col)
//        {
//            ?>
<!--            <th>--><?//= $col['title'] ?><!-- </th>-->
<!--            --><?php
//        }
//        ?>
<!--    </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
<!--    --><?php
//    foreach ($rows as $row)
//    {
//        ?>
<!--        <tr>-->
<!--            --><?php
//            foreach ($row as $col)
//            {
//                ?>
<!--                <td>--><?//= $col['value'] ?><!-- </td>-->
<!--                --><?php
//            }
//            ?>
<!--        </tr>-->
<!--        --><?php
//    }
//    ?>
<!--    </tbody>-->
<!--</table>-->