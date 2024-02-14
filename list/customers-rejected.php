<div class="row mt-5 z-index-1">
  <div class="col-md-10 rejected">
    <?php include('../components/search.html'); ?>
  </div>

  <div class="col-md-2 text-center count-registers"></div>
</div>

<div class="table-responseve mt-5">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Nombres</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Edad</th>
        <th>Dudas</th>
        <th>Estado</th>
        <th>Fecha de registro</th>
        <th colspan="2">Opción</th>
      </tr>
    </thead>
    
    <tbody class="tbody"></tbody>
    
    <!-- <tr>
      <td><?php echo $row['nombres']; ?></td>
      <td><?php echo $row['apellidos']; ?></td>
      <td><?php echo $row['telefono']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['edad']; ?></td>
      <td><?php echo $row['comentario']; ?></td>
      <td><span class="badge bg-dark"><?php echo $row['estado']; ?></span></td>
      <td><?php echo $row['fecha_registro']; ?></td>
      <td>
        <button type="button" class="btn" onclick="seleccionar(<?php echo $row['_id']?>)">
          <img src="../media/img/comprobado.svg" height="30" alt="aprobar">
        </button>
      </td>
    </tr> -->
  </table>
</div>