if(document.getElementById('datatable') !== null) {
    $(document).ready(function() {
      $('#datatable').DataTable( {
        "language": {
          "decimal":        "",
          "emptyTable":     "اطلاعاتی جهت نمایش وجود ندارد",
          "info":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
          "infoEmpty":      "نمایش 0 تا 0 از 0 ورودی",
          "infoFiltered":   "(filtered from _MAX_ total entries)",
          "infoPostFix":    "",
          "thousands":      ",",
          "lengthMenu":     "نمایش _MENU_ رکورد در صفحه",
          "loadingRecords": "در حال بارگزاری...",
          "processing":     "در حال پردازش...",
          "search":         "جستجو: ",
          "zeroRecords":    "مطابقتی پیدا نشد",
          "paginate": {
            "first":      "اولین",
            "last":       "آخرین",
            "next":       "بعدی",
            "previous":   "قبلی"
          },
          "aria": {
            "sortAscending":  ": activate to sort column ascending",
            "sortDescending": ": activate to sort column descending"
          }
        }
      });
    });
  }
/* Changing english numbers to perisan */
var map = ["\u0660", "\u0661", "\u0662", "\u0663", "\u0664", "\u0665", "\u0666", "\u0667", "\u0668", "\u0669"];
function replaceNumbers(node) {
  if (node.nodeType === 3 && node.parentNode.localName != "style" && node.parentNode.localName != "script") {
    node.nodeValue = node.nodeValue.replace(/[0-9]/g, getArabicNumber);
  }
}
function getArabicNumber(n) {
  return map[parseInt(n, 10)];
}
function walk(node, func) {
  func(node);
  node = node.firstChild;
  while (node) {
    walk(node, func);
    node = node.nextSibling;
  }
};
walk(document.body, replaceNumbers);