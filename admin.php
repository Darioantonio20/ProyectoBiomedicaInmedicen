<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <style>
        /* Estilos para los botones de pestaña */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            position: relative;
            text-align: center; /* Centra el contenido dentro del contenedor */
        }
        
        .tab button {
            background-color: inherit;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
            float: none; /* Elimina la propiedad float */
            display: inline-block; /* Permite que los botones se alineen horizontalmente */
        }
        
        .tab button:hover {
            background-color: #ddd;
        }
        
        /* Contenedor del contenido de la pestaña */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
            clear: both;
        }
        
        /* Estilos para la imagen en la esquina superior derecha */
        .corner-image {
            position: absolute;
            top: 0;
            right: 0;
            padding: 5px;
            width: 100px; /* Tamaño deseado */
            height: auto; /* Altura automática para mantener la proporción */
        }
    </style>
</head>
<body>

<!-- Pestañas para la navegación en la parte superior -->
<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Inventario')">Inventario/Mantenimiento</button>
  <button class="tablinks" onclick="openTab(event, 'Empresas')">Empresas</button>
  <button class="tablinks" onclick="openTab(event, 'CrearAcceso')">Crear Nuevo Acceso</button>
</div>

<!-- Contenido de la sección Inventario -->
<div id="Inventario" class="tabcontent">
  <h3>Inventario</h3>
  <?php include("inventario.php"); ?>
</div>

<!-- Contenido de la sección Empresas -->
<div id="Empresas" class="tabcontent">
  <h3>Empresas</h3>
  <?php include("empresas.php"); ?>
</div>

<!-- Contenido de la sección Crear Nuevo Acceso -->
<div id="CrearAcceso" class="tabcontent">
    <h3>Crear Nuevo Acceso</h3>
    <iframe src="crear_accesos.php" style="width:100%; height:800px; border:none;"></iframe>
</div>


<script>
// Script para manejar la apertura de las pestañas
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Obtén el elemento con id="defaultOpen" y haz clic en él
// Esto hará que la primera pestaña esté abierta por defecto (puedes asignar este id al botón de la primera pestaña)
document.getElementsByClassName("tablinks")[0].click();
</script>

</body>
</html>
