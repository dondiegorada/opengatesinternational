<div class="row mt-5 z-index-1">
  <div class="col-md-10 approved">
    <?php include('../components/search.html'); ?>
  </div>

  <div class="col-md-2 text-center count-registers"></div>
</div>

<?php include('../components/pagination.html'); ?>

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
          <th>Opción</th>
        </tr>
    </thead>
    
    <tbody class="tbody"></tbody>
    <!--
      <td>
        <button type="button" class="btn" onclick="declinar(<?php echo $row['_id']?>)">
          <img src="../media/img/cerrar.svg" height="30" alt="declinar">
        </button>
      </td>
    </tr> -->
  </table>
</div>