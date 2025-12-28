import "./bootstrap";
import Alpine from "alpinejs";
import jQuery from "jquery";

window.$ = window.jQuery = jQuery;

// DataTables (AUTO attach ke jQuery)
import "datatables.net-dt";
import "datatables.net-dt/css/dataTables.dataTables.css";

window.Alpine = Alpine;
Alpine.start();
