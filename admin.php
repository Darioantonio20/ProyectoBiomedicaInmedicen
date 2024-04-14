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
  .data-table th h1 {
    font-weight: bold;
    font-size: auto;
    text-align: center; 
    color: #ffffff;
}

.data-table td {
    font-weight: normal;
    font-size: 1em;
    text-align: center; /* Añadido para centrar el texto */
    -webkit-box-shadow: 0 2px 2px -2px #9d9d9e;
    -moz-box-shadow: 0 2px 2px -2px #9d9d9e;
    box-shadow: 0 2px 2px -2px #9d9d9e;
}

.data-table {
    text-align: center;
    overflow-x: auto; /* Added for horizontal scrolling on smaller screens */
    width: 97%; /* Changed from 90vw to 100% for full width */
    margin: 0 auto;
    display: table;
    padding: 0 0 8em 0;
    border-radius: 3rem; /* Added border radius */
}

.data-table td, .data-table th {
    padding: 4%; 
    width: 10%; /* Added for equal width of all cells */
    margin: 1%; /* Added for spacing */
}
.data-table tr:nth-child(odd) {
    background-color: #ffffff;
}

.data-table tr:nth-child(even) {
    background-color: #ffffff;
}

.data-table th {
    background-color: #a40000d0;
}
.nombre-alumno,
.tipo-busqueda {
    color: #a8a8b1;
}
.data-table td:first-child { color: #a9b1a8; }

.data-table tr:hover {
    background-color: #ffffff;
    -webkit-box-shadow: 0 6px 6px -6px #9d9d9e;
    -moz-box-shadow: 0 6px 6px -6px #9d9d9e;
    box-shadow: 0 6px 6px -6px #9d9d9e;
}

.data-table td:hover {
    background-color: #e8e8e8;
    color: #383737;
    font-weight: bold;
    
    box-shadow: #9d9d9e -1px 1px, #9d9d9e -2px 2px, #9d9d9e -3px 3px, #9d9d9e -4px 4px, #9d9d9e -5px 5px, #9d9d9e -6px 6px;
    transform: translate3d(6px, -6px, 0);
    
    transition-delay: 0s;
    transition-duration: 0.4s;
    transition-property: all;
    transition-timing-function: line;
}

@media (max-width: 800px) {
.data-table td:nth-child(4),
.data-table th:nth-child(4) { display: none; }
}

/* Existing styles... */

/* Responsive table */
@media screen and (max-width: 600px) {
    .data-table {
        border: 0;
        width: 100%;
    }

    .data-table thead {
        display: none;
    }

    .data-table tr {
        margin-bottom: 10px;
        display: block;
        border-bottom: 2px solid #ddd;
    }

    .data-table td {
        display: block;
        text-align: right;
        font-size: 13px;
        border-bottom: 1px dotted #ccc;
    }

    .data-table td::before {
        content: attr(data-label);
        float: left;
        text-transform: uppercase;
        font-weight: bold;
    }
}

@media screen and (max-width: 600px) {
    .data-table thead {
        display: none;
    }

    .data-table tr {
        margin-bottom: 10px;
        display: block;
        border-bottom: 2px solid #ddd;
    }

    .data-table th, .data-table td {
        display: block;
        text-align: right;
        font-size: 13px;
        border-bottom: 1px dotted #ccc;
    }

    .data-table th::before, .data-table td::before {
        content: attr(data-label);
        float: left;
        text-transform: uppercase;
        font-weight: bold;
    }
}


/* input */

.contenedor {
    margin-top: 3rem; /* Ajusta este valor según tus necesidades */
}

.group {
    display: flex;
    line-height: 2rem;
    align-items: center;
    position: relative;
    max-width: 45%;
    margin: auto;
    margin-bottom: 3rem;
    justify-content: center;
}
  
.input {
    width: 45vw;
    height: 6vh;
    line-height: 2rem;
    padding: 0 1rem;
    padding-left: 2.5rem;
    border: 2px solid transparent;
    border-radius: 8px;
    outline: none;
    background-color: #d8d8e8;
    color: #0d0c22;
    text-align: center; /* Añadido para centrar el texto */
    box-shadow: 0 0 5px #9691c2, 0 0 0 10px #f5f5f5eb;
    transition: .3s ease;
}
  
  .input::placeholder {
    color: #777;
  }
  
  .icon {
    position: absolute;
    left: 1rem;
    fill: #777;
    width: 1rem;
    height: 1rem;
  }

   .login-button {
    display: block;
    width: 15%;
    font-weight: bold;
    background: #0048A0;
    color: white;
    padding-block: 15px;
    margin: 20px auto;
    border-radius: 20px;
    box-shadow: #0048A0 0px 20px 10px -15px;
    border: none;
    transition: all 0.2s ease-in-out;
  }

   .login-button:hover {
    transform: scale(1.03);
    box-shadow: #0048A0 0px 23px 10px -20px;
  }

   .login-button:active {
    transform: scale(0.95);
    box-shadow: #0048A0 0px 15px 10px -10px;
  }

  .login-button-red {
  display: block;
  width: 15%;
  font-weight: bold;
  background: linear-gradient(45deg, rgb(211, 16, 16) 0%, rgb(209, 18, 18) 100%);
  color: white;
  padding-block: 15px;
  margin: 20px auto;
  border-radius: 20px;
  box-shadow: rgba(215, 133, 133, 0.878) 0px 20px 10px -15px;
  border: none;
  transition: all 0.2s ease-in-out;
  }

  .login-button-red:hover {
  transform: scale(1.03);
  box-shadow: rgba(215, 133, 133, 0.878) 0px 23px 10px -20px;
  }

  .login-button-red:active {
  transform: scale(0.95);
  box-shadow: rgba(215, 133, 133, 0.878) 0px 15px 10px -10px;
  }
  .button-container {
    display: flex;
    flex-direction: row; /* Changed from column to row */
    align-items: center;
    justify-content: center;
    flex-wrap: wrap; /* Added to wrap buttons to next line if container width is not enough */
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
<h1 class="text-center mt-5 mb-5">Busqueda en Inventario</h1>
    <div class="group">
        <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
            <g>
                <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
            </g>
        </svg>
        <input type="search" placeholder="Buscar..." class="input" />
    </div>
    <div class="button-container text-center">
        <button class="login-button">Crear Mantenimiento</button>
        <button class="login-button">Añadir Equipo</button>
        <button class="login-button">Busqueda De Insumo</button>
        <button class="login-button-red">Cerrar Sesión</button>
    </div>
    <div class="contenedor">
        <table class="data-table" >
            <thead>
                <tr style="color: #ffffff;">
                    <th>#</th>
                    <th>ID</th>
                    <th>Nombre Del Equipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Número De Serie</th>
                    <th>Número De Control</th>
                    <th>Institución</th>
                    <th>Formato</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <td>.....</td>
                    <td>.....</td>
                    <td>.....</td>
                    <td>.....</td>
                    <td>.....</td>
                    <td>.....</td>
                    <td>.....</td>
                    <td>.....</td>
                    <td>.....</td>
                    <td>.....</td>
                </tr>
                <tr>
    
                </tr>
            </tbody>
        </table>
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
