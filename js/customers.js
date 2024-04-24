function phoneRender (params) {
  const prefijo = params.value.substr(1, 2);

  if ( prefijo == 57 )
    return `<a href="https://wa.me/${params.value}" target="_blank">${params.value}</a>`;
  else
    return `<a href="https://wa.me/57${params.value}" target="_blank">${params.value}</a>`;
}

function emailRender (params) {
  return `<a href="mailto:${params.value}" target="_blank">${params.value}</a>`;
}

let gridApiPending;
let gridApiApproved;
let gridApiRefused;

let selectedRows;

// Configuraciones para las tablas
const gridOptions = {
  columnDefs: [
    {
      field: "nombres",
      checkboxSelection: true,
      editable: true,
      cellEditor: "agSelectCellEditor",
    },
    { field: "telefono", filter: "numericColumn", cellRenderer: phoneRender },
    { field: "email", cellRenderer: emailRender },
    { field: "edad" },
    { field: "fecha_registro", headerName: "Fecha Registro" }
  ],
  defaultColDef: {
    flex: 1,
    filter: true,
    floatingFilter: true,
  },
  dataTypeDefinitions: {
    object: {
      baseDataType: "object",
      extendsDataType: "object",
      valueParser: (params) => ({ name: params.newValue }),
      valueFormatter: (params) =>
        params.value == null ? "" : params.value.name,
    }
  },
  rowSelection: "multiple",
  pagination: true,
  paginationPageSize: 10,
  paginationPageSizeSelector: [10, 25, 50],
  onSelectionChanged: onSelectionChanged,
};

// Evento para obtener registro seleccionado
function onSelectionChanged() {
  selectedRows = gridApiPending.getSelectedRows();

  if ( selectedRows.length > 0 ) {
    for (let i = 0; i < document.getElementsByClassName('dropdown-item').length; i++) {
      document.getElementsByClassName('dropdown-item')[i].classList.remove('disabled');
    }

  } else {
    for (let i = 0; i < document.getElementsByClassName('dropdown-item').length; i++) {
      document.getElementsByClassName('dropdown-item')[i].classList.add('disabled');
    }
  }

  console.log(gridApiPending.getSelectedRows());
}

// Configurar la cuadrícula después de que la página haya terminado de cargarse
document.addEventListener("DOMContentLoaded", async () => {
  getCustomersPending();
  getCustomersApproved();
  getCustomersRefused();
});

// Metodo para obtener registros pendientes
const getCustomersPending = async () => {
  const gridPending = document.querySelector("#pending-tab-pane");
  gridApiPending = agGrid.createGrid(gridPending, gridOptions);
  const data = await getData('P');

  gridApiPending.setGridOption('rowData', data.map(customer => ({ ...customer, fecha_registro: customer.fecha_registro.split(' ')[0] })));
}

// Metodo para obtener registros aprovados
const getCustomersApproved = async () => {
  const gridapproved = document.querySelector("#approved-tab-pane");
  gridApiApproved = agGrid.createGrid(gridapproved, gridOptions);
  const data = await getData('A');

  gridApiApproved.setGridOption('rowData', data.map(customer => ({ ...customer, fecha_registro: customer.fecha_registro.split(' ')[0] })));
}

// Metodo para obtener registros rechazados
const getCustomersRefused = async () => {
  const gridrefused = document.querySelector("#refused-tab-pane");
  gridApiRefused = agGrid.createGrid(gridrefused, gridOptions);
  const data = await getData('R');

  gridApiRefused.setGridOption('rowData', data.map(customer => ({ ...customer, fecha_registro: customer.fecha_registro.split(' ')[0] })));
}

// Función para consumir endpoint
const getData = async ( status ) => {
  const response = await fetch(`../process/customers.process.php?FUNCION=getAll&status=${ status }`, {
    method: 'GET',
    redirect: 'follow'
  });

  const { data } = await response.json();
  return data;
}

const approved = async () => {
  const response = await fetch(`../process/customers.process.php?FUNCION=approvedRow&_id=${ selectedRows[0]._id }`, {
    method: 'GET',
    redirect: 'follow'
  });

  const { success, message } = await response.json();

  if ( success ) {
    showToast(message);
    getCustomersApproved();
  }
}

const refused = async () => {
  const response = await fetch(`../process/customers.process.php?FUNCION=declinar&_id=${ selectedRows[0]._id }`, {
    method: 'GET',
    redirect: 'follow'
  });

  const { success, message } = await response.json();

  if ( success ) {
    showToast(message);
    getCustomersRefused();
  }
}