// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    order: [[3, 'desc']]
  });

  $('#dataTableIngresos').DataTable({
    order: [[2, 'desc']]
  });
});
