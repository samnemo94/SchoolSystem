
<table class="table">
    <thead>
    <tr>
        <?php
        foreach ($columns as $col)
        {
            ?>
            <th><?= $col['title'] ?> </th>
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
                <td><?= $col ?> </td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>