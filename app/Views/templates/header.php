<?php
$session = session();
$email = $session->get('email');
if ($email == null) {
  echo
  "<script>
 window.location.href = '/login/';
 </script>";
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FOX SISTEMAS</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url('theme/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('theme/dist/css/adminlte.min.css') ?>">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">

  <link rel="stylesheet" href="<?php echo base_url('theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('theme/plugins/select2/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">

  <link rel="stylesheet" href="<?php echo base_url('theme/plugins/pace-progress/themes/black/pace-theme-flat-top.css') ?>">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="stylesheet" href="<?php echo base_url('theme/plugins/fontawesome-free/css/all.min.css') ?>">

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="<?php echo base_url('theme/dist/css/adminlte.min.css?v=3.2.0') ?>">
  <script nonce="39c0ddd2-7f72-458f-be78-a66aa4ff23c7">
    try {
      (function(w, d) {
        ! function(bu, bv, bw, bx) {
          bu[bw] = bu[bw] || {};
          bu[bw].executed = [];
          bu.zaraz = {
            deferred: [],
            listeners: []
          };
          bu.zaraz.q = [];
          bu.zaraz._f = function(by) {
            return async function() {
              var bz = Array.prototype.slice.call(arguments);
              bu.zaraz.q.push({
                m: by,
                a: bz
              })
            }
          };
          for (const bA of ["track", "set", "debug"]) bu.zaraz[bA] = bu.zaraz._f(bA);
          bu.zaraz.init = () => {
            var bB = bv.getElementsByTagName(bx)[0],
              bC = bv.createElement(bx),
              bD = bv.getElementsByTagName("title")[0];
            bD && (bu[bw].t = bv.getElementsByTagName("title")[0].text);
            bu[bw].x = Math.random();
            bu[bw].w = bu.screen.width;
            bu[bw].h = bu.screen.height;
            bu[bw].j = bu.innerHeight;
            bu[bw].e = bu.innerWidth;
            bu[bw].l = bu.location.href;
            bu[bw].r = bv.referrer;
            bu[bw].k = bu.screen.colorDepth;
            bu[bw].n = bv.characterSet;
            bu[bw].o = (new Date).getTimezoneOffset();
            if (bu.dataLayer)
              for (const bH of Object.entries(Object.entries(dataLayer).reduce(((bI, bJ) => ({
                  ...bI[1],
                  ...bJ[1]
                })), {}))) zaraz.set(bH[0], bH[1], {
                scope: "page"
              });
            bu[bw].q = [];
            for (; bu.zaraz.q.length;) {
              const bK = bu.zaraz.q.shift();
              bu[bw].q.push(bK)
            }
            bC.defer = !0;
            for (const bL of [localStorage, sessionStorage]) Object.keys(bL || {}).filter((bN => bN.startsWith("_zaraz_"))).forEach((bM => {
              try {
                bu[bw]["z_" + bM.slice(7)] = JSON.parse(bL.getItem(bM))
              } catch {
                bu[bw]["z_" + bM.slice(7)] = bL.getItem(bM)
              }
            }));
            bC.referrerPolicy = "origin";
            bC.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(bu[bw])));
            bB.parentNode.insertBefore(bC, bB)
          };
          ["complete", "interactive"].includes(bv.readyState) ? zaraz.init() : bu.addEventListener("DOMContentLoaded", zaraz.init)
        }(w, d, "zarazData", "script");
      })(window, document)
    } catch (e) {
      throw fetch("/cdn-cgi/zaraz/t"), e;
    };
  </script>
</head>




</head>
</head>

<body class="hold-transition sidebar-mini pace-primary text-sm">
  <div class="wrapper">

    <?php include_once('navbar.php') ?>
    <?php include_once('sidebar.php') ?>