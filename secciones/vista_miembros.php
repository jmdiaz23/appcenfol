<?php include('../templates/cabecera.php') ;?>
    <div class="row">
    <div class="col-5">
        <form action="" method="post">
        <div class="card">
            <div class="card-header">
                Miembros
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label for="id" class="form-label">ID</label>
                  <input type="text"
                    class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                  
                </div>

                <div class="mb-3">
                  <label for="nombres" class="form-label">Nombres</label>
                  <input type="text"
                    class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="Nombre Completo">
                  
                </div>
                <div class="mb-3">
                  <label for="nombres" class="form-label">Nombres</label>
                  <input type="text"
                    class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="Nombre Completo">
                  
                </div>

            </div>
            
        </div>
    </form>
        
    </div>
    <div class="col-7">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>sede</th>
                <th>Direccion</th>
                <th>Tiempo</th>
                <th>Fecha Nac</th>
                <th>Estado</th>
                <th>Foto</th>
                <th>Ciudad</th>
                <th>Region</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row"></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    
    </div>
    </div>
<?php include('../templates/pie.php') ;?>