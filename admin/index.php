<?php
include(__DIR__.'/views/header.php');
include('sistema.class.php');
$app = new Sistema();
$sql = 'SELECT m.marca as marca, SUM(p.precio*vd.cantidad) as dinero_generado
from marca m left join producto p on m.id_marca = p.id_marca
             left join venta_detalle vd on p.id_producto = vd.id_producto
group by m.marca order by m.marca asc;';
$datos = $app->query($sql);
$roles = $app->getRol('luislao@itcelaya.edu.mx');
$privilegios = $app->getPrivilegio('luislao@itcelaya.edu.mx');
echo '<pre>';
print_r($roles);
print_r($privilegios);
$login = $app->login('21030140@itcelaya.edu.mx','1234');
var_dump($login); //ve hasta los tipos de dato
die;
?>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Copper", 500, "#b87333"],
        <?php foreach($datos as $dato): ?>
          ["<?php echo $dato['marca']; ?>", <?php echo $dato['dinero_generado']; ?>, "#b87333"],
        <?php endforeach; ?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Density of Precious Metals, in g/cm^3",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>
<div id="barchart_values" style="width: 900px; height: 300px;"></div>
 
    
<?php
include('views/footer.php');
?>