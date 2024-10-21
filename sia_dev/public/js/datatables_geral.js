$(document).ready(function() {

    //Versaun manual
 $("#buscar_versaun thead tr")
 .clone(true)
 .addClass("filters")
 .appendTo("#buscar_versaun thead");
var table = $("#buscar_versaun").DataTable({
 orderCellsTop: true,
 fixedHeader: true,
 order: [[1, "desc"]],
 columnDefs: [{ searchable: false, targets: 2 }],
 initComplete: function() {
     var api = this.api();
     api
         .columns()
         .eq(0)
         .each(function(colIdx) {
             var cell = $(".filters th").eq(
                 $(api.column(colIdx).header()).index()
             );
             var title = $(cell).text();
             if ($(api.column(colIdx).header()).index() >= 0) {
                 $(cell).html(
                     '<input class="form-control form-control form-filter datatable-input" type="text" placeholder="' +
                     title +
                     '"/>'
                 );
             }
             $(
                     "input",
                     $(".filters th").eq($(api.column(colIdx).header()).index())
                 )
                 .off("keyup change")
                 .on("keyup change", function(e) {
                     e.stopPropagation();
                     $(this).attr("title", $(this).val());
                     var regexr = "({search})";
                     var cursorPosition = this.selectionStart;
                     api
                         .column(colIdx)
                         .search(
                             this.value != "" ?
                             regexr.replace("{search}", "(((" + this.value + ")))") :
                             "",
                             this.value != "",
                             this.value == ""
                         )
                         .draw();
                     $(this)
                         .focus()[0]
                         .setSelectionRange(cursorPosition, cursorPosition);
                 });
         });
 },
});
});