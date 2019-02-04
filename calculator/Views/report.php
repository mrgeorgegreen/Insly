<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2>HTML Table</h2>

<table>
    <tr>
        <th></th>
        <th>Policy</th>
        <th>1 instalment</th>
        <?php
        for ($i = 2; $i <= $instalments; $i++) {
            echo "<th>$i instalment</th>";
        }
        ?>
    </tr>
    <tr>
        <td>Value</td>
        <td><?php echo $value; ?></td>
        <?php
        echo "<td></td>";
        for ($i = 2; $i <= $instalments; $i++) {
            echo "<td></td>";
        }
        ?>
    </tr>
    <tr>
        <td>Base premium</td>
        <td><?php echo $basePremium['main']; ?></td>
        <?php
        echo "<td>" . ($instalments == 1 ? $basePremium['main'] : $basePremium['sep'] + $basePremium['correction']) . "</td>";
        for ($i = 2; $i <= $instalments; $i++) {
            echo '<td>' . $basePremium['sep'] . '</td>';
        }
        ?>
    </tr>
    <tr>
        <td>Commission</td>
        <td><?php echo $commission['main']; ?></td>
        <?php
        echo "<td>" . ($instalments == 1 ? $commission['main'] : $commission['sep'] + $commission['correction']) . "</td>";
        for ($i = 2; $i <= $instalments; $i++) {
            echo '<td>' . $commission['sep'] . '</td>';
        }
        ?>
    </tr>
    <tr>
        <td>Tax</td>
        <td><?php echo $tax['main']; ?></td>
        <?php
        echo "<td>" . ($instalments == 1 ? $tax['main'] : $tax['sep'] + $tax['correction']) . "</td>";
        for ($i = 2; $i <= $instalments; $i++) {
            echo '<td>' . $tax['sep'] . '</td>';
        }
        ?>
    </tr>
    <tr>
        <td><b>Total coast</b></td>
        <td><b><?php echo $basePremium['main'] + $commission['main'] + $tax['main']; ?></b></td>
        <?php
        echo "<td><b>" . ($instalments == 1
                ? $basePremium['main'] + $commission['main'] + $tax['main']
                : $basePremium['sep'] + $commission['sep'] + $tax['sep'] +
                $basePremium['correction'] + $commission['correction'] + $tax['correction']) . "</b></td>";
        for ($i = 2; $i <= $instalments; $i++) {
            echo '<td><b>' . ($basePremium['sep'] + $commission['sep'] + $tax['sep']) . '</b></td>';
        }
        ?>
    </tr>

</table>


</body>
</html>