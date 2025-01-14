<!-- Left Sidebar -->
<?php
@session_start();
// Sisa kode Anda di sini
?>

<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="index.html"><img src="assets/images/logo.svg" width="25" alt="Aero"><span class="m-l-10">Aero</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="profile.html"><img src="assets/images/profile_av.jpg" alt="User"></a>
                    <div class="detail">
                        <h4><?php echo ($_SESSION["lengkap"]);?></h4>
                        <small>Super Admin</small>
                    </div>
                </div>
            </li>
            <li class="main"><a href="/sdbpkad"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            <li class="main"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Master</span></a>
                <ul class="ml-menu">
                    <li><a href="/sdbpkad/skpd">Opd</a></li>
                    <li><a href="/sdbpkad/sumberdana">Sumber Dana</a></li>
                    <li class="main menu"><a href="/sdbpkad/bagsumberdana">Sub Sumber Dana</a></li>
                    <li class="main menu"><a href="/sdbpkad/perubahan">Jenis Perubahan</a></li>
                </ul>
            </li>
            <li class="main"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-flower"></i><span>Settings</span></a>
                <ul class="ml-menu">
                    <li class="main menu"><a href="/sdbpkad/pagu">Pagu</a></li>
                    <li class="main menu"><a href="/sdbpkad/sumberdanaopd">Sumber Dana</a></li>
                    <!-- <li><a href="/sdbpkad/perubahan">Perubahan</a></li> -->
                    <li class="main menu"><a href="icons-weather.html">User Management</a></li>
                </ul>
            </li>
            <li class="main"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Transaction</span></a>
                <ul class="ml-menu">
                    <li class="main menu"><a href="/sdbpkad/lacaksalur">Income</a></li>
                    <li class="main menu"><a href="/sdbpkad/expenses">Expense</a></li>
                </ul>
            </li>
            <li class="main"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-copy"></i><span>Report</span></a>
                <ul class="ml-menu">
                    <li class="main menu"><a href="/sdbpkad/reportincome">Income</a></li>
                    <li class="main menu"><a href="blank.html">expenses</a></li>
                    <li class="main menu"><a href="blank.html">Sumber Dana</a></li>
                </ul>
            </li>
            <li class="main"> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Mock API SIPD</span></a>
                <ul class="ml-menu">
                    <li class="main menu"><a href="/sdbpkad/tagihan">SPM</a></li>
                    <li class="main menu"><a href="/sdbpkad/sp2d">SP2D</a></li>
                    <li class="main menu"><a href="ticket-list.html">Relisasi Belanja</a></li>
                    <li class="main menu"><a href="ticket-detail.html">Realisasi Potongan</a></li>
                </ul>
            </li>
            <li class="main"><a href="/sdbpkad/change"><i class="zmdi zmdi-key"></i><span>Ganti Password</span></a></li>
            <li class="main"><a href="/sdbpkad/logout"><i class="zmdi zmdi-close"></i><span>Close</span></a></li>
        </ul>
        
    </div>
</aside>


