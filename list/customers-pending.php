<div class="row mt-5 z-index-1">
  <div class="col-md-10 pending">
    <?php include('../components/search.html'); ?>
  </div>

  <div class="col-md-2 text-center count-registers"></div>
</div>

<?php include('../components/pagination.html'); ?>

<div class="table-responseve">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Nombres</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Edad</th>
        <th>Testimonios</th>
        <th>Estado</th>
        <th>Fecha de registro</th>
        <th colspan="2">Opción</th>
      </tr>
    </thead>
        
    <tbody class="tbody"></tbody>
  </table>
</div>